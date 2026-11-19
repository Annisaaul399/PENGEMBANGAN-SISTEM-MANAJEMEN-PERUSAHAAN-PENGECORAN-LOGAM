<?php
// Start session at the very beginning of the file
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/database.php';

$success_message = '';
$error_message = '';
$form_data = []; // Initialize form data array
$last_order_data = null; // Initialize this variable for JavaScript

// Check if this is a redirect after successful submission
if (isset($_GET['success']) && $_GET['success'] == '1' && isset($_SESSION['last_order_data'])) {
    $last_order_data = $_SESSION['last_order_data'];
    $success_message = "Pesanan berhasil dikirim dengan ID: #" . str_pad($last_order_data['order_id'], 4, '0', STR_PAD_LEFT) . ". Harap konfirmasi pesanan Anda melalui WhatsApp.";
    unset($_SESSION['last_order_data']); // Clear session data after retrieval
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $database = new Database();
        $conn = $database->getConnection();
        
        // Store form data temporarily for re-populating form fields
        $form_data = $_POST;
        
        // Validation errors array
        $validation_errors = [];
        
        // Sanitize input data
        $name = sanitizeInput($_POST['nama']);
        $email = sanitizeInput($_POST['email']);
        $phone = sanitizeInput($_POST['telepon']);
        $address = sanitizeInput($_POST['alamat']);
        $service_type = sanitizeInput($_POST['layanan']);
        $metal_type = sanitizeInput($_POST['jenis_logam'] ?? ''); 
        $quantity = intval($_POST['jumlah'] ?? 0); 
        
        // Email validation - must be @gmail.com or @.co.id
        if (!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validation_errors[] = "Format email tidak valid.";
            } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@(gmail\.com|[a-zA-Z0-9.-]+\.co\.id)$/', $email)) {
                $validation_errors[] = "Email harus menggunakan domain @gmail.com atau @.co.id";
            }
        }
        
        // Phone number validation - must be numeric and 11-13 digits
        if (!empty($phone)) {
            if (!preg_match('/^\d{11,13}$/', $phone)) {
                $validation_errors[] = "Nomor telepon harus berupa angka dengan panjang 11-13 digit.";
            }
        }
        
        // Quantity validation - must be numeric
        if (!empty($_POST['jumlah'])) {
            if (!is_numeric($_POST['jumlah']) || $quantity <= 0) {
                $validation_errors[] = "Jumlah harus berupa angka positif.";
            }
        }
        
        // File size validation function
        function validateFileSize($file, $maxSizeMB = 10) {
            if ($file['error'] !== UPLOAD_ERR_NO_FILE) {
                $maxSizeBytes = $maxSizeMB * 1024 * 1024; // Convert MB to bytes
                if ($file['size'] > $maxSizeBytes) {
                    return false;
                }
            }
            return true;
        }
        
        // Validate file uploads
        if (isset($_FILES['gambar_teknik']) && $_FILES['gambar_teknik']['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!validateFileSize($_FILES['gambar_teknik'])) {
                $validation_errors[] = "Ukuran file gambar teknik tidak boleh lebih dari 10 MB.";
            }
        }
        
        if (isset($_FILES['pola']) && $_FILES['pola']['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!validateFileSize($_FILES['pola'])) {
                $validation_errors[] = "Ukuran file pola tidak boleh lebih dari 10 MB.";
            }
        }
        
        // If there are validation errors, display them
        if (!empty($validation_errors)) {
            $error_message = implode('<br>', $validation_errors);
        } else {
            // Proceed with file uploads and database insertion if validation passes
            
            // Create uploads directory if it doesn't exist
            $uploadDir = 'uploads/orders/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $gambar_teknik = null;
            $pattern_file = null;
            
            // Handle technical drawing upload
            if (isset($_FILES['gambar_teknik']) && $_FILES['gambar_teknik']['error'] !== UPLOAD_ERR_NO_FILE) {
                $uploadResult = uploadImage($_FILES['gambar_teknik'], $uploadDir);
                if ($uploadResult['success']) {
                    $gambar_teknik = $uploadResult['filename'];
                } else {
                    $error_message .= 'Error uploading technical drawing: ' . $uploadResult['message'] . '<br>';
                }
            }
            
            // Handle pattern file upload
            if (isset($_FILES['pola']) && $_FILES['pola']['error'] !== UPLOAD_ERR_NO_FILE) {
                $uploadResult = uploadImage($_FILES['pola'], $uploadDir);
                if ($uploadResult['success']) {
                    $pattern_file = $uploadResult['filename'];
                } else {
                    $error_message .= 'Error uploading pattern file: ' . $uploadResult['message'] . '<br>';
                }
            }
            
            // Insert into database ONLY if no upload errors
            if (empty($error_message)) {
                $query = "INSERT INTO pesanan (name, email, phone, address, service_type, metal_type, quantity, gambar_teknik, gambar_pola) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
                $stmt = $conn->prepare($query);
                $result = $stmt->execute([
                    $name, $email, $phone, $address, $service_type, 
                    $metal_type, $quantity, $gambar_teknik, $pattern_file
                ]);
                
                if ($result) {
                    $order_id = $conn->lastInsertId();
                    
                    // Debug: Log sebelum menyimpan session
                    error_log("Saving order data to session. Order ID: " . $order_id);
                    
                    // Store complete data in session including order_id
                    $_SESSION['last_order_data'] = [
                        'order_id' => $order_id,
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'address' => $address,
                        'service_type' => $service_type,
                        'metal_type' => $metal_type,
                        'quantity' => $quantity,
                        'gambar_teknik' => $gambar_teknik,
                        'pattern_file' => $pattern_file,
                        'order_date' => date('Y-m-d H:i:s')
                    ];
                    
                    // Debug: Verifikasi session tersimpan
                    error_log("Session data saved: " . print_r($_SESSION['last_order_data'], true));
                    
                    // Pastikan session tersimpan sebelum redirect
                    session_write_close();
                    
                    // Redirect to self to prevent form resubmission
                    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                    exit();
                }
            }
        }
        
    } catch (Exception $e) {
        $error_message = "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemesanan - CV KEMBAR JAYA ABADI Logam</title>
    <link rel="stylesheet" href="pemesanan.css" />
</head>

<body>
    <header>
        <div class="container nav-container">
            <div class="nav-logo">
                <img src="logo.png" alt="Logo" class="logo-img" />
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="tentangKami.php">About Us</a></li>
                <li><a href="pengecoran.php">Casting</a></li>
                <li><a href="bubut.php">Turning</a></li>
                <li><a href="drilling.php">Drilling</a></li>
                <li><a href="galeri.php">Gallery</a></li>
                <li><a href="pemesanan.php" class="active">Order</a></li>
            </ul>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">PEMESANAN</h1>
            <p class="hero-description">Isi formulir di bawah ini untuk melakukan pemesanan produk atau layanan
                pengecoran logam dan pemesinan. Tim kami akan segera menghubungi Anda.</p>
        </div>
    </section>

    <section class="form-section">
        <div class="container">
            <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($error_message)): ?>
            <div class="alert alert-error">
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>

            <form id="orderForm" action="" method="POST" enctype="multipart/form-data">
                <div class="form-card">
                    <div class="form-group">
                        <label for="email" class="required">Email <span class="required-field">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" required
                            value="<?php echo isset($form_data['email']) ? htmlspecialchars($form_data['email']) : ''; ?>" />
                        <small class="form-text text-muted">Email harus menggunakan domain @gmail.com atau
                            @.co.id</small>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-group">
                        <label for="nama">Nama <span class="required-field">*</span></label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Jawaban Anda"
                            required
                            value="<?php echo isset($form_data['nama']) ? htmlspecialchars($form_data['nama']) : ''; ?>" />
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-group">
                        <label for="telepon">No. Telepon</label>
                        <input type="tel" id="telepon" name="telepon" class="form-control" placeholder="08123456789"
                            pattern="[0-9]{11,13}" maxlength="13"
                            value="<?php echo isset($form_data['telepon']) ? htmlspecialchars($form_data['telepon']) : ''; ?>" />
                        <small class="form-text text-muted">Nomor telepon harus berupa angka dengan panjang 11-13
                            digit</small>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Jawaban Anda"
                            rows="3"><?php echo isset($form_data['alamat']) ? htmlspecialchars($form_data['alamat']) : ''; ?></textarea>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-group">
                        <label>Layanan <span class="required-field">*</span></label>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" id="bubut" name="layanan" value="Turning (Bubut)" required
                                    <?php echo (isset($form_data['layanan']) && $form_data['layanan'] === 'Turning (Bubut)') ? 'checked' : ''; ?> />
                                <label for="bubut">Turning (Bubut)</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="casting" name="layanan" value="Casting (Pengecoran)" required
                                    <?php echo (isset($form_data['layanan']) && $form_data['layanan'] === 'Casting (Pengecoran)') ? 'checked' : ''; ?> />
                                <label for="casting">Casting (Pengecoran)</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="drilling" name="layanan" value="Drilling (Pengeboran)" required
                                    <?php echo (isset($form_data['layanan']) && $form_data['layanan'] === 'Drilling (Pengeboran)') ? 'checked' : ''; ?> />
                                <label for="drilling">Drilling (Pengeboran)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-group">
                        <label>Jenis Logam</label>
                        <div class="radio-group">
                            <?php 
                            $metal_types = [
                                'FC (Cast Iron)', 'FCD (Ductile Cast Iron)', 'Steel (Baja)', 
                                'Heat Resistant Steel', 'Mangan Steel', 'Alumunium', 
                                'Kuningan (Brass)', 'Bronze', 'AB 2 (Alumunium Bronze)',
                                'SS304 (Stainless Steel 304)', 'SS316 (Stainless Steel 316)',
                                'SCH22 (Steel Casting Grade 12)', 'SCH13 (Steel Casting Grade 13)', 'Alloy'
                            ];
                            
                            foreach ($metal_types as $index => $metal): ?>
                            <div class="radio-option">
                                <input type="radio" id="metal<?php echo $index; ?>" name="jenis_logam"
                                    value="<?php echo $metal; ?>"
                                    <?php echo (isset($form_data['jenis_logam']) && $form_data['jenis_logam'] === $metal) ? 'checked' : ''; ?> />
                                <label for="metal<?php echo $index; ?>"><?php echo $metal; ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="1" min="1"
                            step="1"
                            value="<?php echo isset($form_data['jumlah']) ? htmlspecialchars($form_data['jumlah']) : ''; ?>" />
                        <small class="form-text text-muted">Jumlah harus berupa angka positif</small>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-group">
                        <label for="gambar_teknik">Upload Gambar Teknik</label>
                        <div class="file-info">Upload 1 file yang didukung. Maks 10 MB. (JPG, PNG, GIF, WebP)</div>
                        <div class="file-upload">
                            <button type="button" class="file-upload-btn"
                                onclick="document.getElementById('gambar_teknik').click()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                </svg>
                                <span id="gambar_teknik_text">Tambahkan file</span>
                            </button>
                            <input type="file" id="gambar_teknik" name="gambar_teknik" hidden accept="image/*" />
                            <div id="gambar_teknik_preview" class="file-preview"></div>
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-group">
                        <label for="pola">Upload Pola</label>
                        <div class="file-info">Upload 1 file yang didukung. Maks 10 MB. (JPG, PNG, GIF, WebP)</div>
                        <div class="file-upload">
                            <button type="button" class="file-upload-btn"
                                onclick="document.getElementById('pola').click()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                </svg>
                                <span id="pola_text">Tambahkan file</span>
                            </button>
                            <input type="file" id="pola" name="pola" hidden accept="image/*" />
                            <div id="pola_preview" class="file-preview"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Kirim Pesanan</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <h3>CV KEMBAR JAYA ABADI</h3>
                    <p>Spesialis casting, turning, dan drilling berkualitas untuk kebutuhan industri.</p>
                </div>
                <div class="footer-col">
                    <h3>Layanan Kami</h3>
                    <a href="pengecoran.php">Casting</a>
                    <a href="bubut.php">Turning</a>
                    <a href="drilling.php">Drilling</a>
                </div>
                <div class="footer-col">
                    <h3>Kontak</h3>
                    <div class="contact-icon">📍</div>
                    <p>Jl. Tegalsari Baru Rt 39 Rw 16 Ngawonggo Ceper Klaten</p>
                    <div class="contact-icon">📞</div>
                    <p>Telp: 0812-2617-7600</p>
                    <div class="contact-icon">✉</div>
                    <p>Email: umarraharjo4@gmail.com</p>
                </div>
                <div class="footer-col">
                    <h3>Jam Kerja</h3>
                    <p>Senin - Jumat: 08.00 - 17.00</p>
                    <p>Sabtu: 08.00 - 13.00</p>
                    <p>Minggu: Tutup</p>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 CV KEMBAR JAYA ABADI. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
    // PHP variables for WhatsApp data
    function createWhatsAppMessage(orderData) {
        let message = "🔔 PESANAN BARU - CV KEMBAR JAYA ABADI\n\n";

        message += "📋 DETAIL PESANAN:\n";
        message += `ID: #${String(orderData.order_id).padStart(4, '0')}\n`;
        message += `Nama: ${orderData.name}\n`;
        message += `Email: ${orderData.email}\n`;
        message += `Telepon: ${orderData.phone || '-'}\n`;
        message += `Alamat: ${orderData.address || '-'}\n`;
        message += `Layanan: ${orderData.service_type}\n`;
        message += `Jenis Logam: ${orderData.metal_type || '-'}\n`;
        message += `Jumlah: ${orderData.quantity || '-'}\n\n`;

        if (orderData.gambar_teknik) {
            message += `📐 Gambar Teknik: ${orderData.gambar_teknik}\n`;
        }

        if (orderData.pattern_file) {
            message += `📋 File Pola: ${orderData.pattern_file}\n`;
        }

        message += "\nMohon konfirmasi pesanan ini. Terima kasih!";

        return message;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // PHP variables for WhatsApp data
        const lastOrderData = <?php echo isset($last_order_data) ? json_encode($last_order_data) : 'null'; ?>;
        const whatsappNumber = '6281226177600'; // Your WhatsApp number

        // Function to open WhatsApp
        function openWhatsApp(orderData) {
            const message = createWhatsAppMessage(orderData);

            // Debug log
            console.log("Opening WhatsApp with message:", message);

            // Use whatsapp:// protocol for mobile apps, fallback to web
            const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator
                .userAgent);

            let whatsappUrl;
            if (isMobile) {
                // For mobile devices, try to open WhatsApp app directly
                whatsappUrl = `whatsapp://send?phone=${whatsappNumber}&text=${encodeURIComponent(message)}`;
            } else {
                // For desktop, use web WhatsApp
                whatsappUrl =
                    `https://web.whatsapp.com/send?phone=${whatsappNumber}&text=${encodeURIComponent(message)}`;
            }

            console.log("WhatsApp URL:", whatsappUrl);

            // Open WhatsApp
            window.open(whatsappUrl, '_blank');
        }

        // Client-side validation functions
        function validateEmail(email) {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|[a-zA-Z0-9.-]+\.co\.id)$/;
            return emailPattern.test(email);
        }

        function validatePhone(phone) {
            const phonePattern = /^\d{11,13}$/;
            return phonePattern.test(phone);
        }

        function validateFileSize(file, maxSizeMB = 10) {
            const maxSizeBytes = maxSizeMB * 1024 * 1024; // Convert MB to bytes
            return file.size <= maxSizeBytes;
        }

        // Add real-time validation
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('telepon');
        const quantityInput = document.getElementById('jumlah');

        emailInput.addEventListener('blur', function() {
            if (this.value && !validateEmail(this.value)) {
                this.setCustomValidity('Email harus menggunakan domain @gmail.com atau @.co.id');
            } else {
                this.setCustomValidity('');
            }
        });

        phoneInput.addEventListener('input', function() {
            // Only allow numbers
            this.value = this.value.replace(/[^0-9]/g, '');

            if (this.value && !validatePhone(this.value)) {
                this.setCustomValidity('Nomor telepon harus berupa angka dengan panjang 11-13 digit');
            } else {
                this.setCustomValidity('');
            }
        });

        quantityInput.addEventListener('input', function() {
            // Only allow positive numbers
            if (this.value && (isNaN(this.value) || parseFloat(this.value) <= 0)) {
                this.setCustomValidity('Jumlah harus berupa angka positif');
            } else {
                this.setCustomValidity('');
            }
        });

        // Handle file upload previews with size validation
        function setupFileUpload(inputId, textId, previewId) {
            const fileInput = document.getElementById(inputId);
            const textSpan = document.getElementById(textId);
            const previewDiv = document.getElementById(previewId);

            fileInput.addEventListener('change', function() {
                previewDiv.innerHTML = '';

                if (this.files.length > 0) {
                    const file = this.files[0];

                    // Validate file size
                    if (!validateFileSize(file)) {
                        alert('Ukuran file tidak boleh lebih dari 10 MB');
                        this.value = '';
                        textSpan.textContent = 'Tambahkan file';
                        return;
                    }

                    textSpan.textContent = file.name;

                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.style.maxWidth = '100px';
                        img.style.maxHeight = '100px';
                        img.style.marginTop = '10px';
                        img.style.marginRight = '10px';
                        img.style.verticalAlign = 'middle';
                        previewDiv.appendChild(img);

                        const fileInfoText = document.createElement('span');
                        fileInfoText.textContent =
                            `File dipilih: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                        previewDiv.appendChild(fileInfoText);
                    } else {
                        previewDiv.innerHTML =
                            `File dipilih: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                    }
                } else {
                    textSpan.textContent = 'Tambahkan file';
                }
            });
        }

        setupFileUpload('gambar_teknik', 'gambar_teknik_text', 'gambar_teknik_preview');
        setupFileUpload('pola', 'pola_text', 'pola_preview');

        // Form submission handling with validation
        const form = document.getElementById('orderForm');
        form.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const nama = document.getElementById('nama').value;
            const phone = document.getElementById('telepon').value;
            const quantity = document.getElementById('jumlah').value;
            const layanan = document.querySelector('input[name="layanan"]:checked');

            let isValid = true;
            let errorMessage = '';

            // Basic required field validation
            if (!email || !nama || !layanan) {
                isValid = false;
                errorMessage += 'Harap isi semua field yang wajib diisi (Email, Nama, dan Layanan).\n';
            }

            // Email validation
            if (email && !validateEmail(email)) {
                isValid = false;
                errorMessage += 'Email harus menggunakan domain @gmail.com atau @.co.id.\n';
            }

            // Phone validation
            if (phone && !validatePhone(phone)) {
                isValid = false;
                errorMessage += 'Nomor telepon harus berupa angka dengan panjang 11-13 digit.\n';
            }

            // Quantity validation
            if (quantity && (isNaN(quantity) || parseFloat(quantity) <= 0)) {
                isValid = false;
                errorMessage += 'Jumlah harus berupa angka positif.\n';
            }

            // File size validation
            const gambarTeknikFile = document.getElementById('gambar_teknik').files[0];
            const polaFile = document.getElementById('pola').files[0];

            if (gambarTeknikFile && !validateFileSize(gambarTeknikFile)) {
                isValid = false;
                errorMessage += 'Ukuran file gambar teknik tidak boleh lebih dari 10 MB.\n';
            }

            if (polaFile && !validateFileSize(polaFile)) {
                isValid = false;
                errorMessage += 'Ukuran file pola tidak boleh lebih dari 10 MB.\n';
            }

            if (!isValid) {
                e.preventDefault();
                alert(errorMessage);
                return false;
            }

            // Show loading state
            const submitBtn = document.querySelector('.submit-btn');
            submitBtn.innerHTML = 'Mengirim...';
            submitBtn.disabled = true;
        });

        // WhatsApp integration after successful submission
        if (lastOrderData) {
            console.log("Data pesanan diterima:", lastOrderData);

            // Add click event to WhatsApp button
            const whatsappBtn = document.getElementById('whatsappBtn');
            if (whatsappBtn) {
                whatsappBtn.addEventListener('click', function() {
                    openWhatsApp(lastOrderData);
                });
            }

            // Auto-prompt for WhatsApp after 2 seconds
            setTimeout(() => {
                if (confirm(
                        'Pesanan berhasil disimpan! Klik OK untuk mengirim ringkasan pesanan via WhatsApp.'
                    )) {
                    openWhatsApp(lastOrderData);
                }
            }, 2000);
        }
    });
    </script>
</body>

</html>