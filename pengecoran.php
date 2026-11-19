<?php
// pengecoran.php
require_once 'config/database.php';

// Fetch casting services from database
$database = new Database();
$conn = $database->getConnection();

try {
    $query = "SELECT * FROM casting_services WHERE status = 'active' ORDER BY sort_order ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $casting_services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $casting_services = [];
    error_log("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengecoran Logam - CV KEMBAR JAYA ABADI</title>
    <link rel="stylesheet" href="pengecoran.css" />
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
                <li><a href="pengecoran.php" class="active">Casting</a></li>
                <li><a href="bubut.php">Turning</a></li>
                <li><a href="drilling.php">Drilling</a></li>
                <li><a href="galeri.php">Gallery</a></li>
                <li><a href="pemesanan.php">Order</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">LAYANAN CASTING</h1>
            <h2 class="hero-subtitle"
                style="background-color: rgba(255, 0, 0, 0.29); border-radius: 5px; display: outline-block">Spesialis
                dalam cor aluminium, kuningan, baja, dan logam lainnya</h2>
            <p class="hero-description">
                Casting (layanan pengecoran) adalah teknik manufaktur yang memanfaatkan logam cair untuk menciptakan
                komponen dengan bentuk kompleks dan tingkat presisi tinggi. Metode ini menjadi solusi terbaik untuk
                memenuhi kebutuhan industri
                yang mengutamakan kualitas dan detail dalam setiap produknya.
            </p>
        </div>
    </section>

    <!-- Info Section - Now Dynamic -->
    <section class="info-section">
        <div class="container">
            <div class="section-divider"></div>
            <h2 class="section-heading">Kami melayani berbagai jenis pengecoran logam untuk kebutuhan dan custom</h2>
            <div class="section-divider"></div>

            <!-- Horizontal scrollable services grid - Now Dynamic -->
            <div class="services-grid">
                <?php if (!empty($casting_services)): ?>
                <?php foreach ($casting_services as $service): ?>
                <div class="service-card">
                    <div class="service-image"
                        style="background-image: url('<?php echo htmlspecialchars($service['image_url']); ?>')"></div>
                    <div class="service-info">
                        <h3 class="service-title"><?php echo htmlspecialchars($service['title']); ?></h3>
                        <p class="service-description"><?php echo htmlspecialchars($service['description']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <!-- Fallback static content jika database kosong -->
                <div class="service-card">
                    <div class="service-image" style="background-image: url('sand casting.jpeg')"></div>
                    <div class="service-info">
                        <h3 class="service-title">Sand Casting (Pengecoran Pasir)</h3>
                        <p class="service-description">Proses pengecoran menggunakan cetakan pasir untuk menghasilkan
                            produk dengan bentuk yang presisi dan fleksibilitas tinggi.</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-image" style="background-image: url('rough finishing.jpeg')"></div>
                    <div class="service-info">
                        <h3 class="service-title">Rough Finishing (Finishing Kasar)</h3>
                        <p class="service-description">Layanan untuk menghilangkan sisa cetakan dan memperbaiki
                            permukaan kasar pada hasil coran.</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-image" style="background-image: url('custom casting.jpeg')"></div>
                    <div class="service-info">
                        <h3 class="service-title">Custom Casting (Pengecoran Kustom)</h3>
                        <p class="service-description">Pengecoran sesuai kebutuhan khusus pelanggan, dirancang untuk
                            memenuhi spesifikasi unik.</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-image" style="background-image: url('repair casting.jpeg')"></div>
                    <div class="service-info">
                        <h3 class="service-title">Repair Casting (Perbaikan Coran)</h3>
                        <p class="service-description">Layanan perbaikan untuk memastikan hasil coran bebas cacat dan
                            berkualitas tinggi.</p>
                    </div>
                </div>
                <?php endif; ?>
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

    <!-- Equipment Section -->
    <section class="equipment-section">
        <div class="container equipment-container">
            <h2 class="section-title">Fasilitas Produksi</h2>
            <p class="equipment-text">
                Parama Logam menggunakan 4 tungku induksi (Induction Melting Furnace) berkapasitas 250 kg, 500 kg, 1000
                kg, dan 2000 kg untuk memproses material FC, FCD, dan steel dengan kapasitas produksi hingga 5 ton per
                hari. Dengan teknik
                modern ini, kami mampu menghasilkan produk berkualitas tinggi yang siap mendukung performa industri
                Anda.
            </p>

            <div class="equipment-grid">
                <div class="equipment-card">
                    <div class="equipment-icon">🔥</div>
                    <h3 class="equipment-name">Tungku Induksi</h3>
                    <p class="equipment-spec">Kapasitas 250 kg - 2000 kg dengan teknologi modern untuk hasil lebih
                        presisi</p>
                </div>
                <div class="equipment-card">
                    <div class="equipment-icon">⚙️</div>
                    <h3 class="equipment-name">Fasilitas Machining</h3>
                    <p class="equipment-spec">Peralatan pemesinan lengkap untuk finishing presisi tinggi</p>
                </div>
                <div class="equipment-card">
                    <div class="equipment-icon">🔨</div>
                    <h3 class="equipment-name">Heat Treatment</h3>
                    <p class="equipment-spec">Proses perlakuan panas untuk meningkatkan kekuatan material</p>
                </div>
                <div class="equipment-card">
                    <div class="equipment-icon">🔍</div>
                    <h3 class="equipment-name">Pengujian Material</h3>
                    <p class="equipment-spec">Uji komposisi, hardness, dan uji tarik untuk jaminan kualitas</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Materials Section -->
    <section class="materials-section">
        <div class="container">
            <h2 class="section-title">Material pengecoran</h2>
            <p class="equipment-text">Kami menyediakan berbagai pilihan material berkualitas tinggi untuk memenuhi
                kebutuhan spesifik industri Anda dengan karakteristik dan ketahanan yang optimal.</p>

            <div class="materials-grid">
                <div class="material-card">
                    <h3 class="material-name">FC & FCD</h3>
                    <p class="material-description">Material dasar besi cor dengan ketahanan dan kekuatan tinggi</p>
                </div>
                <div class="material-card">
                    <h3 class="material-name">Steel</h3>
                    <p class="material-description">Baja dengan durabilitas dan ketahanan terhadap beban berat</p>
                </div>
                <div class="material-card">
                    <h3 class="material-name">Mangansteel</h3>
                    <p class="material-description">Ketahanan terhadap abrasi dan keausan yang sangat baik</p>
                </div>
                <div class="material-card">
                    <h3 class="material-name">Ni Hard</h3>
                    <p class="material-description">Kekerasan tinggi untuk aplikasi dengan tingkat gesekan ekstrem</p>
                </div>
                <div class="material-card">
                    <h3 class="material-name">High Chrome</h3>
                    <p class="material-description">Ketahanan korosi dan suhu tinggi yang optimal</p>
                </div>
                <div class="material-card">
                    <h3 class="material-name">Bronze & Kuningan</h3>
                    <p class="material-description">Konduktivitas dan ketahanan korosi yang baik</p>
                </div>
                <div class="material-card">
                    <h3 class="material-name">Aluminium</h3>
                    <p class="material-description">Ringan dan tahan korosi untuk aplikasi khusus</p>
                </div>
                <div class="material-card">
                    <h3 class="material-name">Stainless Steel</h3>
                    <p class="material-description">SS304, SS306, SS316 untuk kebutuhan khusus</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section">
        <div class="container">
            <h2 class="section-title">Proses pengecoran</h2>
            <p class="equipment-text">Setiap produk pengecoran kami melalui proses produksi yang terstandarisasi untuk
                memastikan kualitas dan presisi yang terjamin.</p>

            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Konsultasi & Desain</h3>
                    <p class="step-description">Analisis kebutuhan dan penentuan spesifikasi material serta bentuk yang
                        dibutuhkan</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Pembuatan Pattern</h3>
                    <p class="step-description">Proses pembuatan cetakan sesuai dengan desain yang telah disetujui</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Pengecoran</h3>
                    <p class="step-description">Peleburan material dan penuangan ke dalam cetakan dengan presisi tinggi
                    </p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3 class="step-title">Machining & Finishing</h3>
                    <p class="step-description">Proses pemesinan dan penyelesaian akhir produk sesuai spesifikasi</p>
                </div>
                <div class="process-step">
                    <div class="step-number">5</div>
                    <h3 class="step-title">Quality Control</h3>
                    <p class="step-description">Pengujian menyeluruh terhadap kualitas, dimensi, dan performa produk</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2 class="cta-title">Butuh Layanan Casting Berkualitas?</h2>
            <p class="cta-text">Diskusikan kebutuhan casting anda dengan tim ahli kami. Dapatkan konsultasi dan
                penawaran terbaik untuk memaksimalkan produktivitas industri Anda.</p>
            <a href="https://wa.me/6281226177600" class="cta-btn" target="_blank" rel="noopener noreferrer">Konsultasi
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
                    <a href="pengecoran.php">Casting</a>
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
        const sections = document.querySelectorAll('section');
        const cards = document.querySelectorAll(
            '.service-card, .equipment-card, .material-card, .process-step');

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // If the element is in view, add animation classes
                        entry.target.style.animationPlayState = 'running';

                        // Add staggered animations to cards if this is a section with cards
                        if (entry.target.classList.contains('equipment-section') || entry.target
                            .classList.contains('materials-section') || entry.target.classList
                            .contains('process-section') || entry.target.classList.contains(
                                'info-section')) {
                            const cardsInSection = entry.target.querySelectorAll(
                                '.service-card, .equipment-card, .material-card, .process-step');
                            cardsInSection.forEach((card, index) => {
                                setTimeout(() => {
                                    card.style.opacity = '0';
                                    card.style.animation =
                                        'scale 0.6s ease-out forwards';
                                    card.style.animationDelay = `${index * 0.1}s`;
                                }, 100);
                            });
                        }
                    }
                });
            }, {
                threshold: 0.1, // Trigger when 10% of the element is visible
            }
        );

        // Observe all sections
        sections.forEach((section) => {
            observer.observe(section);
        });
    });

    // Script for the horizontal scrolling functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Get the services grid element
        const servicesGrid = document.querySelector('.services-grid');

        // Get the scroll buttons
        const scrollLeftBtn = document.getElementById('scroll-left');
        const scrollRightBtn = document.getElementById('scroll-right');

        // Add event listeners to buttons
        if (scrollLeftBtn && scrollRightBtn && servicesGrid) {
            // Scroll left when the left button is clicked
            scrollLeftBtn.addEventListener('click', function() {
                servicesGrid.scrollBy({
                    left: -310, // Scroll by card width + margin
                    behavior: 'smooth',
                });
            });

            // Scroll right when the right button is clicked
            scrollRightBtn.addEventListener('click', function() {
                servicesGrid.scrollBy({
                    left: 310, // Scroll by card width + margin
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