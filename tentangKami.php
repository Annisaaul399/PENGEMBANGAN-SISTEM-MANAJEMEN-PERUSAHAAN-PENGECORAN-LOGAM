<?php
// Fetch active about content from database
require_once 'config/database.php';
$database = new Database();
$conn = $database->getConnection();

try {
    $query = "SELECT * FROM about_content WHERE status = 'active' ORDER BY section_order ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $aboutContents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $aboutContents = [];
}

// Group content by section type
$sections = [];
foreach ($aboutContents as $content) {
    $sections[$content['section_type']][] = $content;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami - CV KEMBAR JAYA ABADI</title>
    <link rel="stylesheet" href="tentangKami.css" />
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
                <li><a href="tentangKami.php" class="active">About Us</a></li>
                <li><a href="pengecoran.php">Casting</a></li>
                <li><a href="bubut.php">Turning</a></li>
                <li><a href="drilling.php">Drilling</a></li>
                <li><a href="galeri.php">Gallery</a></li>
                <li><a href="pemesanan.php">Order</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero Banner -->
    <section class="about-hero">
        <div class="container">
            <h1 class="about-hero-title">TENTANG KAMI</h1>
        </div>
    </section>

    <!-- Main About Section -->
    <?php if (isset($sections['main'])): ?>
    <section class="about-section">
        <div class="container about-container">
            <?php foreach ($sections['main'] as $index => $content): ?>
            <?php if ($index === 0): // First main content with image ?>
            <div class="about-content">
                <h2 class="section-title"><?php echo htmlspecialchars($content['title']); ?></h2>
                <p class="about-text"><?php echo nl2br(htmlspecialchars($content['content'])); ?></p>

                <?php if (!empty($content['button_text']) && !empty($content['button_url'])): ?>
                <a href="<?php echo htmlspecialchars($content['button_url']); ?>" class="contact-btn" target="_blank"
                    rel="noopener noreferrer">
                    <?php echo htmlspecialchars($content['button_text']); ?>
                </a>
                <?php endif; ?>
            </div>

            <?php if (!empty($content['image_url'])): ?>
            <div class="about-image">
                <?php if (filter_var($content['image_url'], FILTER_VALIDATE_URL)): ?>
                <img src="<?php echo htmlspecialchars($content['image_url']); ?>"
                    alt="<?php echo htmlspecialchars($content['title']); ?>" />
                <?php else: ?>
                <img src="<?php echo htmlspecialchars($content['image_url']); ?>"
                    alt="<?php echo htmlspecialchars($content['title']); ?>" />
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php else: // Additional main content ?>
            <div class="about-content">
                <p class="about-text"><?php echo nl2br(htmlspecialchars($content['content'])); ?></p>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Services Section -->
    <<?php if (isset($sections['services'])): ?> <section class="services-section">
        <div class="container services-container">
            <div class="service-content">
                <?php foreach ($sections['services'] as $content): ?>
                <?php if (!empty($content['title'])): ?>
                <h2 class="section-title"><?php echo htmlspecialchars($content['title']); ?></h2>
                <?php endif; ?>
                <p class="service-text"><?php echo nl2br(htmlspecialchars($content['content'])); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        </section>
        <?php endif; ?>

        <!-- Vision & Mission -->
        <?php if (isset($sections['vision'])): ?>
        <section class="vision-mission about-dark">
            <div class="container">
                <?php 
        $visionMain = null;
        $missionItems = [];
        
        foreach ($sections['vision'] as $content) {
            if (strpos(strtolower($content['title']), 'visi') !== false || 
                strpos(strtolower($content['content']), 'visi') !== false) {
                $visionMain = $content;
            } else {
                $missionItems[] = $content;
            }
        }
        ?>

                <?php if ($visionMain): ?>
                <h2 class="vision-mission-title">Visi dan Misi</h2>
                <h2 class="vision-mission-title"><?php echo htmlspecialchars($visionMain['content']); ?></h2>
                <?php endif; ?>

                <?php if (!empty($missionItems)): ?>
                <div class="values-container">
                    <?php foreach ($missionItems as $index => $mission): ?>
                    <div class="value-card">
                        <h3 class="value-title"><?php echo $index + 1; ?></h3>
                        <p class="value-text"><?php echo nl2br(htmlspecialchars($mission['content'])); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="divider"></div>

                <?php 
        // Look for closing text in vision section
        $closingText = null;
        foreach ($sections['vision'] as $content) {
            if (strpos(strtolower($content['content']), 'bersama') !== false || 
                strpos(strtolower($content['content']), 'hubungi') !== false) {
                $closingText = $content['content'];
                break;
            }
        }
        ?>

                <?php if ($closingText): ?>
                <p><?php echo nl2br(htmlspecialchars($closingText)); ?></p>
                <?php else: ?>
                <p>Bersama CV KEMBAR JAYA ABADI, wujudkan proyek impian Anda dengan solusi terpercaya dan hasil
                    maksimal.
                    Hubungi kami untuk konsultasi dan penawaran terbaik.</p>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Stats Section -->
        <?php if (isset($sections['stats'])): ?>
        <section class="stats-section">
            <div class="container">
                <div class="stats-container">
                    <?php foreach ($sections['stats'] as $stat): ?>
                    <div class="stat-card">
                        <?php if (!empty($stat['image_url'])): ?>
                        <?php if (filter_var($stat['image_url'], FILTER_VALIDATE_URL)): ?>
                        <img src="<?php echo htmlspecialchars($stat['image_url']); ?>"
                            alt="<?php echo htmlspecialchars($stat['title']); ?>" width="100" />
                        <?php else: ?>
                        <img src="<?php echo htmlspecialchars($stat['image_url']); ?>"
                            alt="<?php echo htmlspecialchars($stat['title']); ?>" width="100" />
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if (!empty($stat['stat_number'])): ?>
                        <h3 class="stat-number"><?php echo htmlspecialchars($stat['stat_number']); ?></h3>
                        <?php endif; ?>

                        <h4 class="stat-title"><?php echo htmlspecialchars($stat['title']); ?></h4>
                        <p class="stat-description"><?php echo nl2br(htmlspecialchars($stat['content'])); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

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
            const sections = document.querySelectorAll('section');

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.style.animation = 'fadeIn 1s ease-out forwards';

                            // Activate animations for children elements
                            const animatedElements = entry.target.querySelectorAll(
                                '.about-content, .about-image, .value-card, .stat-card');
                            animatedElements.forEach((element, index) => {
                                setTimeout(() => {
                                    if (element.classList.contains(
                                            'about-content')) {
                                        element.style.animation =
                                            'slideInFromLeft 1s ease-out forwards';
                                    } else if (element.classList.contains(
                                            'about-image')) {
                                        element.style.animation =
                                            'slideInFromRight 1s ease-out forwards';
                                    } else {
                                        element.style.animation =
                                            'scale 0.6s ease-out forwards';
                                    }
                                }, index * 150);
                            });
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
        </script>
</body>

</html>