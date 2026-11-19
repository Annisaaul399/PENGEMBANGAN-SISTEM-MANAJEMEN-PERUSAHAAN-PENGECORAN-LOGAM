<?php
//bubut.php
require_once 'config/database.php';

// Fetch turning services from database
$database = new Database();
$conn = $database->getConnection();

try {
    $query = "SELECT * FROM turning_services WHERE status = 'active' ORDER BY sort_order ASC, created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $turning_services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $turning_services = [];
    error_log("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Layanan Bubut - CV KEMBAR JAYA ABADI</title>
    <link rel="stylesheet" href="bubut.css" />
</head>

<body>
    <!-- Header & Navigation -->
    <header>
        <div class="container nav-container">
            <div class="nav-logo">
                <img src="logo.png" alt="Logo" class="logo-img" />
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="tentangKami.php">About Us</a></li>
                <li><a href="pengecoran.php">Casting</a></li>
                <li><a href="bubut.php" class="active">Turning</a></li>
                <li><a href="drilling.php">Drilling</a></li>
                <li><a href="galeri.php">Gallery</a></li>
                <li><a href="pemesanan.php">Order</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">LAYANAN TURNING</h1>
            <h2 class="hero-subtitle"
                style="background-color: rgba(255, 0, 0, 0.29); border-radius: 5px; display: outline-block">Solusi
                pengerjaan bubut untuk industri, otomotif, dan kebutuhan teknik lainnya</h2>
            <p class="hero-description">
                Turning (layanan bubut) adalah salah satu jenis layanan dalam proses permesinan (machining) yang
                menggunakan mesin bubut (lathe machine) untuk membentuk suatu benda kerja, biasanya logam, dengan cara
                memutar benda kerja terhadap
                alat potong (pahat).
            </p>
        </div>
    </section>

    <!-- Service Types with Horizontal Scroll -->
    <section class="service-types">
        <div class="container">
            <h2 class="section-title">Jenis Layanan Bubut</h2>
            <div class="scroll-container">
                <div class="service-grid">
                    <?php if (!empty($turning_services)): ?>
                    <?php foreach ($turning_services as $service): ?>
                    <div class="service-card">
                        <div class="service-image" style="background-image: url('<?php 
                                    if (!empty($service['image_url'])) {
                                        if (filter_var($service['image_url'], FILTER_VALIDATE_URL)) {
                                            echo htmlspecialchars($service['image_url']);
                                        } else {
                                            echo htmlspecialchars($service['image_url']);
                                        }
                                    } else {
                                        echo 'data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;300&quot; height=&quot;200&quot; viewBox=&quot;0 0 300 200&quot;><rect width=&quot;300&quot; height=&quot;200&quot; fill=&quot;%23f0f0f0&quot;/><text x=&quot;150&quot; y=&quot;100&quot; text-anchor=&quot;middle&quot; fill=&quot;%23999&quot; font-size=&quot;14&quot;>No Image</text></svg>';
                                    }
                                ?>')"></div>
                        <div class="service-info">
                            <h3 class="service-title"><?php echo htmlspecialchars($service['title']); ?></h3>
                            <p class="service-text"><?php echo htmlspecialchars($service['description']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <!-- Fallback content when no services are available -->
                    <div class="service-card">
                        <div class="service-image" style="background-image: url('conventional\ turning.jpeg')"></div>
                        <div class="service-info">
                            <h3 class="service-title">Conventional Turning (Pembubutan Konvensional)</h3>
                            <p class="service-text">Proses dasar pembubutan di mana pahat potong digunakan untuk
                                mengurangi diameter benda kerja menjadi ukuran tertentu dengan gerakan longitudinal.</p>
                        </div>
                    </div>
                    <div class="service-card">
                        <div class="service-image" style="background-image: url('facing\ turning.jpeg')"></div>
                        <div class="service-info">
                            <h3 class="service-title">Facing (Pembubutan Permukaan)</h3>
                            <p class="service-text">Proses pembubutan yang dilakukan untuk meratakan atau memperhalus
                                permukaan ujung benda kerja dengan gerakan pahat melintang ke arah sumbu benda kerja.
                            </p>
                        </div>
                    </div>
                    <div class="service-card">
                        <div class="service-image" style="background-image: url('taper\ turning.jpeg')"></div>
                        <div class="service-info">
                            <h3 class="service-title">Taper Turning (Pembubutan Kerucut)</h3>
                            <p class="service-text">Proses pembubutan untuk menghasilkan bentuk kerucut pada benda kerja
                                dengan mengatur sudut pahat terhadap sumbu benda kerja menggunakan teknik offset
                                tailstock atau compound rest.</p>
                        </div>
                    </div>
                    <div class="service-card">
                        <div class="service-image" style="background-image: url('grooving.jpeg')"></div>
                        <div class="service-info">
                            <h3 class="service-title">Grooving (Pembuatan Alur)</h3>
                            <p class="service-text">Proses pemotongan untuk membuat alur (groove) pada permukaan benda
                                kerja, biasanya digunakan untuk tempat cincin pengunci, segel, atau kebutuhan desain
                                lainnya.</p>
                        </div>
                    </div>
                    <div class="service-card">
                        <div class="service-image" style="background-image: url('parting.jpeg')"></div>
                        <div class="service-info">
                            <h3 class="service-title">Parting</h3>
                            <p class="service-text">Proses memotong benda kerja menjadi dua bagian menggunakan pahat
                                potong khusus yang sempit untuk menghasilkan pemisahan bersih.</p>
                        </div>
                    </div>
                    <div class="service-card">
                        <div class="service-image" style="background-image: url('knurling.jpeg')"></div>
                        <div class="service-info">
                            <h3 class="service-title">Knurling</h3>
                            <p class="service-text">Proses membuat pola bertekstur (seperti garis silang) pada permukaan
                                benda kerja menggunakan alat knurling untuk meningkatkan pegangan atau estetika.</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Scroll indicator text -->
            <div class="scroll-indicator">Geser ke samping untuk melihat lebih banyak</div>

            <!-- Navigation buttons for scrolling -->
            <div class="scroll-nav">
                <button id="scroll-left" class="scroll-btn">&#8592;</button>
                <button id="scroll-right" class="scroll-btn">&#8594;</button>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits">
        <div class="container">
            <h2 class="section-title">Keunggulan Layanan Bubut Kami</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">✓</div>
                    <h3 class="benefit-title">Presisi Tinggi</h3>
                    <p class="benefit-text">Pengerjaan dengan tingkat presisi hingga 0.01mm menggunakan peralatan modern
                        dan operator berpengalaman.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">⏱</div>
                    <h3 class="benefit-title">Waktu Pengerjaan Cepat</h3>
                    <p class="benefit-text">Proses produksi yang efisien dengan hasil berkualitas dan pengiriman tepat
                        waktu sesuai jadwal.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">$</div>
                    <h3 class="benefit-title">Harga Kompetitif</h3>
                    <p class="benefit-text">Penawaran harga terbaik dengan kualitas terjamin untuk kebutuhan produksi
                        skala kecil hingga besar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2 class="cta-title">Butuh Layanan Turning Berkualitas?</h2>
            <p class="cta-text">Diskusikan kebutuhan turning anda dengan tim ahli kami. Dapatkan konsultasi dan
                penawaran terbaik untuk mendukung produktivitas industri Anda.</p>
            <a href="https://wa.me/6281226177600" class="hero-btn" target="_blank" rel="noopener noreferrer">Konsultasi
                Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <h3>CV KEMBAR JAYA ABADI</h3>
                    <p>Spesialis casting, turning, dan drilling berkualitas untuk kebutuhan industri.</p>
                </div>
                <div class="footer-col">
                    <h3>Layanan Kami</h3>
                    <a href="pengecoran.html">Casting</a>
                    <a href="bubut.html">Turning</a>
                    <a href="drilling.html">Drilling</a>
                </div>
                <div class="footer-col">
                    <h3>Kontak</h3>
                    <div class="contact-icon">📍</div>
                    <p>Jl. Tegalsari Baru Rt 39 Rw 16 Ngawonggo Ceper Klaten</p>
                    <div class="contact-icon">📞</div>
                    <p>Telp: 0812-2617-7600</p>
                    <div class="contact-icon">✉️</div>
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
    // Intersection Observer for animations
    document.addEventListener('DOMContentLoaded', function() {
        // Get the services grid element
        const servicesGrid = document.querySelector('.service-grid');

        // Get the scroll buttons
        const scrollLeftBtn = document.getElementById('scroll-left');
        const scrollRightBtn = document.getElementById('scroll-right');

        // Add event listeners to buttons
        if (scrollLeftBtn && scrollRightBtn && servicesGrid) {
            // Scroll left when the left button is clicked
            scrollLeftBtn.addEventListener('click', function() {
                servicesGrid.scrollBy({
                    left: -300, // Scroll by card width + margin
                    behavior: 'smooth',
                });
            });

            // Scroll right when the right button is clicked
            scrollRightBtn.addEventListener('click', function() {
                servicesGrid.scrollBy({
                    left: 300, // Scroll by card width + margin
                    behavior: 'smooth',
                });
            });

            // Hide the scroll indicator after user interaction
            servicesGrid.addEventListener('scroll', function() {
                const scrollIndicator = document.querySelector('.scroll-indicator');
                if (scrollIndicator) {
                    scrollIndicator.style.display = 'none';
                }
            });

            // Check if scrolling is needed (if content width > container width)
            function checkScrollable() {
                const isScrollable = servicesGrid.scrollWidth > servicesGrid.clientWidth;
                const scrollControls = document.querySelector('.scroll-nav');
                const scrollIndicator = document.querySelector('.scroll-indicator');

                if (scrollControls && scrollIndicator) {
                    if (isScrollable) {
                        scrollControls.style.display = 'flex';
                        scrollIndicator.style.display = 'block';
                    } else {
                        scrollControls.style.display = 'none';
                        scrollIndicator.style.display = 'none';
                    }
                }
            }

            // Check on load and on window resize
            checkScrollable();
            window.addEventListener('resize', checkScrollable);
        }
    });
    </script>
</body>

</html>