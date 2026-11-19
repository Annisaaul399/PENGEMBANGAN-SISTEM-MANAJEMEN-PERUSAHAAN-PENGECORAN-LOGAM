<?php
// index.php
require_once 'config/database.php';

// Fetch drilling services from database
$database = new Database();
$conn = $database->getConnection();

try {
    $query = "SELECT * FROM services WHERE service_type = 'drilling' AND status = 'active' ORDER BY sort_order ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $services = [];
    error_log("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Drilling - CV KEMBAR JAYA ABADI Logam</title>
    <link rel="stylesheet" href="drilling.css" />
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
                <li><a href="bubut.php">Turning</a></li>
                <li><a href="drilling.php" class="active">Drilling</a></li>
                <li><a href="galeri.php">Gallery</a></li>
                <li><a href="pemesanan.php">Order</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">LAYANAN DRILLING</h1>
            <h1 class="hero-subtitle"
                style="background-color: rgba(255, 0, 0, 0.29); border-radius: 5px; display: outline-block">Presisi
                Tinggi</h1>
            <p class="hero-description">
                Drilling (layanan pengeboran) adalah proses pengeboran pada material, seperti logam atau kayu, untuk
                membuat lubang dengan ukuran dan kedalaman tertentu sesuai kebutuhan. Proses ini dilakukan menggunakan
                mesin bor presisi untuk
                memastikan akurasi tinggi dan hasil yang sesuai dengan spesifikasi teknis pelanggan.
            </p>
        </div>
    </section>

    <!-- About Drilling Section -->
    <section class="about">
        <div class="container about-container">
            <div class="about-content">
                <h2 class="section-title">Layanan Drilling Kami</h2>
                <p class="about-text">
                    Drilling atau pengeboran adalah salah satu proses pemesinan kunci yang kami tawarkan di CV KEMBAR
                    JAYA ABADI. Dengan mesin-mesin drilling berteknologi tinggi, kami mampu menghasilkan lubang dengan
                    berbagai ukuran dan kedalaman
                    yang presisi sesuai spesifikasi teknis yang dibutuhkan.
                </p>
                <p class="about-text">
                    Didukung operator yang berpengalaman dan sistem kendali mutu yang ketat, setiap proses drilling yang
                    kami lakukan menghasilkan komponen dengan toleransi minimal dan kualitas permukaan yang sempurna.
                    Layanan drilling kami
                    meliputi vertical drilling, horizontal drilling, deep hole drilling, dan precision drilling untuk
                    berbagai jenis material.
                </p>
                <a href="https://wa.me/6281226177600" class="contact-btn" target="_blank"
                    rel="noopener noreferrer">Konsultasi Sekarang</a>
            </div>
            <div class="about-image">
                <img src="drilling.png" alt="Drilling Process" />
            </div>
        </div>
    </section>

    <!-- Services Section dengan Horizontal Scroll -->
    <section class="service-section">
        <div class="container">
            <h2 class="section-title" style="text-align: center">Layanan Drilling Kami</h2>

            <div class="service-grid">
                <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                <div class="service-card">
                    <div class="service-image"
                        style="background-image: url('<?php echo !empty($service['image_url']) ? htmlspecialchars($service['image_url']) : 'https://via.placeholder.com/400x200'; ?>')">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title"><?php echo htmlspecialchars($service['title']); ?></h3>
                        <p class="service-description"><?php echo htmlspecialchars($service['description']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <!-- Fallback content if no services in database -->
                <div class="service-card">
                    <div class="service-image" style="background-image: url('https://via.placeholder.com/400x200')">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Conventional Drilling</h3>
                        <p class="service-description">Pengeboran konvensional menggunakan mesin bor manual untuk
                            berbagai jenis material dengan presisi tinggi.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image" style="background-image: url('https://via.placeholder.com/400x200')">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Center Drilling</h3>
                        <p class="service-description">Pembuatan titik pusat pada benda kerja untuk proses pembubutan
                            atau pengeboran lanjutan dengan akurasi tinggi.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image" style="background-image: url('https://via.placeholder.com/400x200')">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Tapping</h3>
                        <p class="service-description">Pembuatan ulir dalam (internal thread) pada lubang yang telah
                            dibor sesuai dengan spesifikasi yang dibutuhkan.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image" style="background-image: url('https://via.placeholder.com/400x200')">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Reaming</h3>
                        <p class="service-description">Proses finishing lubang untuk mendapatkan dimensi yang presisi
                            dan permukaan yang halus setelah pengeboran awal.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image" style="background-image: url('https://via.placeholder.com/400x200')">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Counterboring</h3>
                        <p class="service-description">Pembuatan lubang dengan diameter yang lebih besar pada bagian
                            atas untuk menyembunyikan kepala baut atau mur.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image" style="background-image: url('https://via.placeholder.com/400x200')">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Countersinking</h3>
                        <p class="service-description">Pembuatan chamfer atau sudut pada bagian atas lubang untuk kepala
                            sekrup yang rata dengan permukaan material.</p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <!-- The progress indicator with arrows and navigation buttons will be added by JavaScript -->
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="features-title">
                <h2 class="section-title" style="text-align: center">Keunggulan Layanan Drilling Kami</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">⚙️</div>
                    <h3 class="feature-title">Mesin Berteknologi Modern</h3>
                    <p class="feature-text">Menggunakan mesin drilling CNC dan konvensional dengan kemampuan pengerjaan
                        presisi hingga toleransi 0.01mm untuk memastikan kualitas hasil pengeboran terbaik.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔍</div>
                    <h3 class="feature-title">Quality Control Ketat</h3>
                    <p class="feature-text">Setiap hasil pengeboran melalui proses pemeriksaan dengan alat ukur presisi
                        tinggi untuk memastikan kesesuaian dengan spesifikasi yang diminta.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⏱</div>
                    <h3 class="feature-title">Waktu Produksi Efisien</h3>
                    <p class="feature-text">Proses perencanaan dan setup yang matang memungkinkan pengerjaan drilling
                        yang cepat dan efisien tanpa mengorbankan kualitas hasil.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🛠️</div>
                    <h3 class="feature-title">Multi-Material</h3>
                    <p class="feature-text">Kemampuan melakukan drilling pada berbagai jenis material seperti baja,
                        stainless steel, aluminium, kuningan, dan material khusus lainnya.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2 class="cta-title">Butuh Layanan Drilling Berkualitas?</h2>
            <p class="cta-text">Diskusikan kebutuhan drilling untuk industri Anda dengan tim ahli kami. Dapatkan
                konsultasi dan penawaran terbaik untuk proyek Anda.</p>
            <a href="https://wa.me/6281226177600" class="hero-btn" target="_blank" rel="noopener noreferrer">Hubungi
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

        // Horizontal Scrolling for Service Section
        const serviceGrid = document.querySelector('.service-grid');
        const serviceCards = document.querySelectorAll('.service-card');

        if (serviceGrid && serviceCards.length > 0) {
            // Container setup
            const serviceContainer = serviceGrid.parentNode;

            // Create progress indicator
            const progressIndicator = document.createElement('div');
            progressIndicator.className = 'progress-indicator';
            progressIndicator.innerHTML = '<div class="progress-bar"><div class="progress-fill"></div></div>';

            // Create instruction text
            const instructionText = document.createElement('div');
            instructionText.className = 'instruction-text';
            instructionText.textContent = 'Geser ke samping untuk melihat lebih banyak';

            // Create navigation controls at the bottom
            const scrollNav = document.createElement('div');
            scrollNav.className = 'scroll-nav';

            const scrollLeftBtn = document.createElement('button');
            scrollLeftBtn.className = 'scroll-btn';
            scrollLeftBtn.innerHTML = '&larr;'; // Left arrow symbol

            const scrollRightBtn = document.createElement('button');
            scrollRightBtn.className = 'scroll-btn';
            scrollRightBtn.innerHTML = '&rarr;'; // Right arrow symbol

            scrollNav.appendChild(scrollLeftBtn);
            scrollNav.appendChild(scrollRightBtn);

            // Insert elements after the service grid
            serviceContainer.appendChild(instructionText);
            serviceContainer.appendChild(progressIndicator);
            serviceContainer.appendChild(scrollNav);

            // Calculate scrolling parameters
            const cardWidth = serviceCards[0].offsetWidth + 20; // Include the gap
            const totalWidth = serviceGrid.scrollWidth;
            const visibleWidth = serviceGrid.clientWidth;
            const maxScroll = totalWidth - visibleWidth;

            // Function to update progress indicator
            function updateProgressIndicator() {
                const scrollPosition = serviceGrid.scrollLeft;
                const scrollPercentage = (scrollPosition / maxScroll) * 100;
                const progressFill = progressIndicator.querySelector('.progress-fill');
                progressFill.style.width = `${scrollPercentage}%`;
            }

            // Initialize progress indicator
            updateProgressIndicator();

            // Function to scroll to specific card
            let currentIndex = 0;
            const totalCards = serviceCards.length;
            const visibleCards = Math.floor(visibleWidth / cardWidth);

            function scrollToCard(index) {
                if (index < 0) index = 0;
                if (index > totalCards - visibleCards) index = totalCards - visibleCards;

                currentIndex = index;
                const scrollAmount = index * cardWidth;

                serviceGrid.scrollTo({
                    left: scrollAmount,
                    behavior: 'smooth',
                });
            }

            // Scroll functions for buttons
            scrollLeftBtn.addEventListener('click', () => {
                scrollToCard(currentIndex - 1);
            });

            scrollRightBtn.addEventListener('click', () => {
                scrollToCard(currentIndex + 1);
            });

            // Update progress on scroll
            serviceGrid.addEventListener('scroll', () => {
                updateProgressIndicator();
                currentIndex = Math.round(serviceGrid.scrollLeft / cardWidth);
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (serviceGrid.matches(':hover') || serviceContainer.matches(':hover')) {
                    if (e.key === 'ArrowLeft') {
                        scrollToCard(currentIndex - 1);
                    }
                    if (e.key === 'ArrowRight') {
                        scrollToCard(currentIndex + 1);
                    }
                }
            });

            // Touch support for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            serviceGrid.addEventListener('touchstart', (e) => {
                touchStartX = e.touches[0].screenX;
            });

            serviceGrid.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                // Swipe left (next)
                if (touchStartX - touchEndX > 50) {
                    scrollToCard(currentIndex + 1);
                }

                // Swipe right (previous)
                if (touchEndX - touchStartX > 50) {
                    scrollToCard(currentIndex - 1);
                }
            }
        }

        // Products Section Scrolling (original code, modified to use the new CSS)
        const scrollLeftBtn = document.getElementById('scrollLeft');
        const scrollRightBtn = document.getElementById('scrollRight');
        const productsContainer = document.getElementById('productsContainer');
        const scrollIndicator = document.getElementById('scrollIndicator');
        const productsScrollElement = document.querySelector('.products-scroll');

        if (productsContainer && scrollIndicator) {
            // Get product cards
            const productCards = document.querySelectorAll('.product-card');

            if (productCards.length > 0) {
                const cardWidth = productCards[0].offsetWidth;
                const containerWidth = productsScrollElement.offsetWidth;
                const visibleCards = Math.floor(containerWidth / cardWidth);
                const totalCards = productCards.length;
                const maxScroll = Math.ceil(totalCards - visibleCards);
                let currentPosition = 0;

                // Create scroll indicators (dots)
                scrollIndicator.innerHTML = ''; // Clear existing dots
                for (let i = 0; i <= maxScroll; i++) {
                    const dot = document.createElement('div');
                    dot.classList.add('scroll-dot');
                    if (i === 0) dot.classList.add('active');
                    dot.dataset.index = i;
                    dot.addEventListener('click', () => {
                        scrollToPosition(i);
                    });
                    scrollIndicator.appendChild(dot);
                }

                // Function to scroll to position
                function scrollToPosition(position) {
                    if (position < 0) position = 0;
                    if (position > maxScroll) position = maxScroll;

                    currentPosition = position;
                    const scrollAmount = position * cardWidth;
                    productsContainer.style.transform = `translateX(-${scrollAmount}px)`;

                    // Update indicator
                    document.querySelectorAll('.scroll-dot').forEach((dot, index) => {
                        if (index === position) {
                            dot.classList.add('active');
                        } else {
                            dot.classList.remove('active');
                        }
                    });
                }

                // Event listeners for scroll buttons
                if (scrollLeftBtn) {
                    scrollLeftBtn.addEventListener('click', () => {
                        scrollToPosition(currentPosition - 1);
                    });
                }

                if (scrollRightBtn) {
                    scrollRightBtn.addEventListener('click', () => {
                        scrollToPosition(currentPosition + 1);
                    });
                }

                // Touch support
                let touchStartX = 0;
                let touchEndX = 0;

                productsScrollElement.addEventListener('touchstart', (e) => {
                    touchStartX = e.touches[0].screenX;
                    stopAutoScroll();
                });

                productsScrollElement.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    handleProductsSwipe();
                    startAutoScroll();
                });

                function handleProductsSwipe() {
                    // Swipe left (next)
                    if (touchStartX - touchEndX > 50) {
                        scrollToPosition(currentPosition + 1);
                    }

                    // Swipe right (previous)
                    if (touchEndX - touchStartX > 50) {
                        scrollToPosition(currentPosition - 1);
                    }
                }

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        scrollToPosition(currentPosition - 1);
                    }
                    if (e.key === 'ArrowRight') {
                        scrollToPosition(currentPosition + 1);
                    }
                });

                // Auto-scroll every 5 seconds
                let autoScrollInterval;

                function startAutoScroll() {
                    autoScrollInterval = setInterval(() => {
                        const nextPosition = currentPosition + 1 > maxScroll ? 0 : currentPosition + 1;
                        scrollToPosition(nextPosition);
                    }, 5000);
                }

                function stopAutoScroll() {
                    clearInterval(autoScrollInterval);
                }

                // Start auto-scroll
                startAutoScroll();

                // Stop auto-scroll when user interacts
                productsScrollElement.addEventListener('mouseenter', stopAutoScroll);
                if (scrollLeftBtn) scrollLeftBtn.addEventListener('mouseenter', stopAutoScroll);
                if (scrollRightBtn) scrollRightBtn.addEventListener('mouseenter', stopAutoScroll);

                // Resume auto-scroll when user stops interacting
                productsScrollElement.addEventListener('mouseleave', startAutoScroll);
                if (scrollLeftBtn) scrollLeftBtn.addEventListener('mouseleave', startAutoScroll);
                if (scrollRightBtn) scrollRightBtn.addEventListener('mouseleave', startAutoScroll);
            }
        }
    });
    </script>
</body>

</html>