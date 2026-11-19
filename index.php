<?php
// index.php
require_once 'config/database.php';

// Fetch products from database
$database = new Database();
$conn = $database->getConnection();

try {
    $query = "SELECT * FROM products WHERE status = 'active' ORDER BY sort_order ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $products = [];
    error_log("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CV KEMBAR JAYA ABADI Logam - Spesialis Pengecoran Logam</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!-- Header & Navigation -->
    <header>
        <div class="container nav-container">
            <div class="nav-logo">
                <img src="logo.png" alt="Logo" class="logo-img" />
            </div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="tentangKami.php">About Us</a></li>
                <li><a href="pengecoran.php">Casting</a></li>
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
            <h1 class="hero-title">SPAREPART BERKUALITAS</h1>
            <h1 class="hero-title"
                style="background-color: rgba(255, 0, 0, 0.29); border-radius: 5px; display: outline-block">PERFORMA
                MAKSIMAL</h1>
            <p class="hero-description">CV KEMBAR JAYA ABADI menyediakan solusi pengecoran logam dan pemesinan
                berkualitas untuk kebutuhan industri. Dapatkan produk dengan presisi tinggi dan ketahanan maksimal.</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <div class="container about-container">
            <div class="about-content">
                <h2 class="section-title">Tentang Kami</h2>
                <p class="about-text">
                    CV KEMBAR JAYA ABADI adalah mitra terpercaya dalam jasa pengecoran logam dan permesinan, menyediakan
                    kebutuhan berbagai spare part industri. Dengan material pilihan seperti FC, FCD, Steel, Mangansteel,
                    Ni Hard, High Chrome,
                    Kuningan, Bronze, Alumunium Bronze, SS304, SS306, SS316, hingga Alloy, sehingga kami pastikan setiap
                    produk memiliki ketahanan dan presisi terbaik sesuai kebutuhan pelanggan.
                </p>
                <p class="about-text">
                    Didukung tungku induksi mulai dari 250 kg, 500 kg hingga kapasitas 1000 kg dan fasilitas tambahan
                    seperti machining, heat treatment, shot blasting, serta pengujian lengkap (Uji komposisi, hardness,
                    tarik). CV KEMBAR JAYA ABADI
                    Logam menghadirkan produk pengecoran dari barang mentah menjadi barang jadi.
                </p>
                <button id="downloadBrosur" class="hero-btn">Lihat Selengkapnya</button>
            </div>
            <div class="about-image">
                <img src="foto logam ikan.jpg" alt="Metal Part" />
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="features-title">
                <h2 class="section-title" style="text-align: center">Mitra Andal Kebutuhan Anda</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">$</div>
                    <h3 class="feature-title">Harga Kompetitif Langsung dari Pabrik</h3>
                    <p class="feature-text">Semua produk adalah hasil dari produksi menggunakan fasilitas sendiri,
                        memungkinkan Anda mendapatkan penawaran harga yang lebih terjangkau dari tempat lainnya.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✓</div>
                    <h3 class="feature-title">Kualitas Produk yang Terjamin</h3>
                    <p class="feature-text">Setiap produk melalui proses produksi yang sangat detail, mulai dari
                        pemeriksaan material, pengecekaan selama machining, hingga inspeksi akhir.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⏱</div>
                    <h3 class="feature-title">Pengerjaan Sesuai Estimasi</h3>
                    <p class="feature-text">Komitmen kami untuk menyelesaikan setiap proyek tepat waktu sesuai estimasi
                        yang telah disepakati, sehingga Anda dapat merencanakan produksi tanpa hambatan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👤</div>
                    <h3 class="feature-title">Layanan Cepat dan Responsif</h3>
                    <p class="feature-text">Tim customer service selalu siap melayani kebutuhan Anda dengan ramah dan
                        profesional. Jaminan Quotation dapat Anda terima maksimal 48 jam tanpa penundaan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section - Now Dynamic -->
    <section class="products">
        <div class="container">
            <div class="products-title">
                <h2 class="section-title" style="text-align: center">Layanan Kami</h2>
            </div>
            <div class="products-grid">
                <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image"
                        style="background-image: url('<?php echo htmlspecialchars($product['image_url']); ?>')"></div>
                    <div class="product-info">
                        <h3 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h3>
                        <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                        <a href="<?php echo htmlspecialchars($product['page_url']); ?>"
                            class="product-btn">Selengkapnya</a>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <!-- Fallback static content -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('repair casting.jpeg')"></div>
                    <div class="product-info">
                        <h3 class="product-title">Casting</h3>
                        <p class="product-description">Proses pengecoran logam berkualitas tinggi yang menggunakan
                            teknologi modern untuk menghasilkan produk presisi, baik untuk kebutuhan standar maupun
                            desain khusus.</p>
                        <a href="pengecoran.html" class="product-btn">Selengkapnya</a>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image" style="background-image: url('taper turning.jpeg')"></div>
                    <div class="product-info">
                        <h3 class="product-title">Turning</h3>
                        <p class="product-description">Layanan pembubutan dengan mesin canggih untuk menciptakan
                            komponen dengan ukuran presisi dan hasil permukaan yang optimal, sesuai kebutuhan industri.
                        </p>
                        <a href="bubut.html" class="product-btn">Selengkapnya</a>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image"
                        style="background-image: url('https://via.placeholder.com/500x300/333/666?text=Product+3')">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Drilling</h3>
                        <p class="product-description">Proses pengeboran presisi tinggi yang dirancang untuk memenuhi
                            spesifikasi teknis pelanggan, memastikan hasil yang akurat dan andal.</p>
                        <a href="drilling.html" class="product-btn">Selengkapnya</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2 class="cta-title">Butuh Solusi Untuk Kebutuhan Industri Anda?</h2>
            <p class="cta-text">Diskusikan kebutuhan casting, turning, drilling anda dengan tim ahli kami. Dapatkan
                konsultasi dan penawaran terbaik untuk memaksimalkan produktivitas industri anda.</p>
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
    document.getElementById('downloadBrosur').addEventListener('click', function() {
        const link = document.createElement('a');
        link.href = 'assets/brosur.pdf';
        link.download = 'CV-Sri-Rejeki-Brosur.pdf';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    // Intersection Observer for animations
    document.addEventListener('DOMContentLoaded', function() {
        // For about section
        const aboutSection = document.querySelector('.about');
        const aboutContent = document.querySelector('.about-content');
        const aboutImage = document.querySelector('.about-image');

        // For features section
        const featuresSection = document.querySelector('.features');
        const featureCards = document.querySelectorAll('.feature-card');

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // If the element is in view, start the animation
                        entry.target.style.animationPlayState = 'running';

                        // If the element is a section, activate all child animations
                        if (entry.target === aboutSection) {
                            aboutContent.style.animationPlayState = 'running';
                            aboutImage.style.animationPlayState = 'running';
                        }

                        if (entry.target === featuresSection) {
                            featureCards.forEach((card, index) => {
                                // Add staggered delay for each card
                                setTimeout(() => {
                                    card.style.animationPlayState = 'running';
                                }, index * 150);
                            });
                        }
                    }
                });
            }, {
                threshold: 0.1, // Trigger when 10% of the element is visible
            }
        );

        // Observe the sections
        observer.observe(aboutSection);
        observer.observe(featuresSection);
    });
    </script>
</body>

</html>