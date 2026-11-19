<?php
require_once 'config/database.php';
$database = new Database();
$conn = $database->getConnection();

// Ambil data berdasarkan kategori dengan status aktif
function getGaleriByCategory($conn, $category) {
    $stmt = $conn->prepare("SELECT * FROM galeri_services WHERE category = ? AND status = 'active' ORDER BY sort_order ASC, created_at DESC");
    $stmt->execute([$category]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$castingItems = getGaleriByCategory($conn, 'casting');
$turningItems = getGaleriByCategory($conn, 'turning');
$drillingItems = getGaleriByCategory($conn, 'drilling');
?>

<?php
function renderGaleriItems($items) {
    foreach ($items as $item) {
        $image = htmlspecialchars($item['image_url']);
        $title = htmlspecialchars($item['title']);
        echo <<<HTML
        <div class="galeri-item">
            <div class="galeri-item-image" style="background-image: url('{$image}')"></div>
            <div class="galeri-item-info">
                <h3 class="galeri-item-title">{$title}</h3>
            </div>
        </div>
        HTML;
    }
}
?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Galeri - CV KEMBAR JAYA ABADI</title>
    <link rel="stylesheet" href="galeri.css" />
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
                <li><a href="drilling.php">Drilling</a></li>
                <li><a href="galeri.php" class="active">Gallery</a></li>
                <li><a href="pemesanan.php">Order</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero Banner -->
    <section class="galeri-hero">
        <div class="container">
            <h1>Selamat Datang di Galeri Kami</h1>
            <p>Memproduksi berbagai macam layanan logam seperti Casting, Turning dan Drilling.</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="galeri-section">
        <div class="container">
            <div class="galeri-tabs">
                <button class="galeri-tab" data-tab="semua">Semua</button>
                <button class="galeri-tab" data-tab="proses">Casting</button>
                <button class="galeri-tab" data-tab="dokumentasi">Turning</button>
                <button class="galeri-tab" data-tab="drilling">Drilling</button>
            </div>

            <!-- Semua Tab Content -->
            <div id="semua-content" class="galeri-tab-content active">
                <!-- Baris 1: Casting -->
                <div class="galeri-content">
                    <button class="scroll-arrow scroll-left">&#10094;</button>
                    <div class="galeri-row" id="galeri-row-casting">
                        <?php renderGaleriItems($castingItems); ?>
                    </div>
                    <button class="scroll-arrow scroll-right">&#10095;</button>
                    <div class="scroll-indicator"></div>
                </div>

                <!-- Baris 2: Turning -->
                <div class="galeri-content" style="margin-top: 40px">
                    <button class="scroll-arrow scroll-left">&#10094;</button>
                    <div class="galeri-row" id="galeri-row-turning">
                        <?php renderGaleriItems($turningItems); ?>
                    </div>
                    <button class="scroll-arrow scroll-right">&#10095;</button>
                    <div class="scroll-indicator"></div>
                </div>

                <!-- Baris 3: Drilling -->
                <div class="galeri-content" style="margin-top: 40px">
                    <button class="scroll-arrow scroll-left">&#10094;</button>
                    <div class="galeri-row" id="galeri-row-drilling">
                        <?php renderGaleriItems($drillingItems); ?>
                    </div>
                    <button class="scroll-arrow scroll-right">&#10095;</button>
                    <div class="scroll-indicator"></div>
                </div>
            </div>


            <!-- Dokumentasi Casting -->
            <div id="proses-content" class="content-section">
                <h2 class="section-title">Produk Casting Berkualitas</h2>
                <p class="section-description">
                    Koleksi produk logam berkualitas tinggi hasil pengecoran dengan presisi, dirancang untuk memenuhi
                    berbagai kebutuhan industri.
                </p>

                <div class="galeri-content">
                    <button class="scroll-arrow scroll-left">&#10094;</button>
                    <div class="galeri-row" id="galeri-row-proses">
                        <?php renderGaleriItems($castingItems); ?>
                    </div>
                    <button class="scroll-arrow scroll-right">&#10095;</button>
                    <div class="scroll-indicator"></div>
                </div>
            </div>

            <!-- Dokumentasi Turning -->
            <div id="dokumentasi-content" class="content-section">
                <h2 class="section-title">Produk Turning Berkualitas</h2>
                <p class="section-description">
                    Hasil pembubutan presisi dengan detail sempurna, cocok untuk komponen industri dengan standar
                    tinggi.
                </p>

                <div class="galeri-content">
                    <button class="scroll-arrow scroll-left">&#10094;</button>
                    <div class="galeri-row" id="galeri-row-dokumentasi">
                        <?php renderGaleriItems($turningItems); ?>
                    </div>
                    <button class="scroll-arrow scroll-right">&#10095;</button>
                    <div class="scroll-indicator"></div>
                </div>
            </div>

            <!-- Dokumentasi Drilling -->
            <div id="drilling-content" class="content-section">
                <h2 class="section-title">Produk Drilling Berkualitas</h2>
                <p class="section-description">
                    Koleksi produk dengan lubang presisi hasil pengeboran, dirancang untuk mendukung kebutuhan teknis
                    yang kompleks.
                </p>

                <div class="galeri-content">
                    <button class="scroll-arrow scroll-left">&#10094;</button>
                    <div class="galeri-row" id="galeri-row-drilling">
                        <?php renderGaleriItems($drillingItems); ?>
                    </div>
                    <button class="scroll-arrow scroll-right">&#10095;</button>
                    <div class="scroll-indicator"></div>
                </div>
            </div>


            <div class="modal-overlay" id="productModal">
                <div class="modal">
                    <div class="modal-header">
                        <div class="modal-title" id="modalTitle">Nama Produk</div>
                        <button class="modal-close" id="modalClose">&times;</button>
                    </div>
                    <div class="modal-content">
                        <div class="modal-image-container">
                            <img src="/api/placeholder/600/400" alt="Product Image" class="modal-image"
                                id="modalImage" />
                        </div>
                        <div class="modal-description" id="modalDescription">Deskripsi produk akan muncul di sini.
                            Informasi
                            detil tentang produk, kegunaan, dan keunggulannya.</div>
                        <div class="modal-specs">
                            <h3>Spesifikasi Teknis:</h3>
                            <div id="modalSpecs">
                                <!-- Specs will be loaded here -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-button" id="modalClose2">Tutup</button>
                    </div>
                </div>
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
    document.addEventListener('DOMContentLoaded', function() {

        // Function to handle scrolling with scroll indicator updates
        function setupScrolling(rowId, contentContainer) {
            const scrollRow = document.getElementById(rowId);

            if (!scrollRow) return; // Skip if element doesn't exist

            const leftBtn = contentContainer.querySelector('.scroll-left');
            const rightBtn = contentContainer.querySelector('.scroll-right');
            const scrollIndicator = contentContainer.querySelector('.scroll-indicator');

            // Create the progress indicator element if it doesn't exist
            if (scrollIndicator && !scrollIndicator.querySelector('::before')) {
                const progressIndicator = document.createElement('div');
                progressIndicator.classList.add('scroll-progress');
                scrollIndicator.appendChild(progressIndicator);
            }

            // Initial update of scroll indicator
            updateScrollIndicator();

            // Update scroll indicator on scroll
            scrollRow.addEventListener('scroll', updateScrollIndicator);

            // Function to update scroll indicator
            function updateScrollIndicator() {
                if (!scrollIndicator) return;

                const scrollLeft = scrollRow.scrollLeft;
                const maxScrollLeft = scrollRow.scrollWidth - scrollRow.clientWidth;
                const scrollPercentage = (scrollLeft / maxScrollLeft) * 100;

                // Set width of indicator based on scroll position
                scrollIndicator.style.background =
                    `linear-gradient(to right, #a40e0e ${scrollPercentage}%, #f0f0f0 ${scrollPercentage}%)`;
            }

            // Scroll amount - make it responsive to container width
            const scrollAmount = scrollRow.clientWidth * 0.8;

            // Set up click handlers for scroll arrows
            if (leftBtn) {
                leftBtn.addEventListener('click', function() {
                    scrollRow.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth',
                    });
                });
            }

            if (rightBtn) {
                rightBtn.addEventListener('click', function() {
                    scrollRow.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth',
                    });
                });
            }

            // Add keyboard navigation support
            scrollRow.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    scrollRow.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth',
                    });
                    e.preventDefault();
                } else if (e.key === 'ArrowRight') {
                    scrollRow.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth',
                    });
                    e.preventDefault();
                }
            });

            // Make the row focusable for keyboard navigation
            scrollRow.setAttribute('tabindex', '0');
        }

        // Setup scrolling for each gallery row
        const galleryContents = document.querySelectorAll('.galeri-content');
        galleryContents.forEach((container) => {
            const row = container.querySelector('.galeri-row');
            if (row && row.id) {
                setupScrolling(row.id, container);
            }
        });

        // Tab switching functionality
        const tabs = document.querySelectorAll('.galeri-tab');
        const contentSections = document.querySelectorAll('.content-section');

        tabs.forEach((tab) => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                tabs.forEach((t) => t.classList.remove('active'));

                // Add active class to clicked tab
                this.classList.add('active');

                // Get the tab identifier
                const tabId = this.getAttribute('data-tab');

                // Hide all content sections
                contentSections.forEach((section) => {
                    section.classList.remove('active');
                });

                // Show the selected content section
                const activeContent = document.getElementById(tabId + '-content');
                if (activeContent) {
                    activeContent.classList.add('active');

                    // Re-initialize scroll indicators for the newly visible content
                    const galleryContents = activeContent.querySelectorAll('.galeri-content');
                    galleryContents.forEach((container) => {
                        const row = container.querySelector('.galeri-row');
                        if (row && row.id) {
                            const scrollIndicator = container.querySelector(
                                '.scroll-indicator');
                            if (scrollIndicator) {
                                scrollIndicator.style.background =
                                    'linear-gradient(to right, #a40e0e 0%, #f0f0f0 0%)';
                            }
                        }
                    });
                }
            });
        });

        // Set "Semua" tab as default active
        const semuaTab = document.querySelector('.galeri-tab[data-tab="semua"]');
        if (semuaTab) {
            semuaTab.classList.add('active');
        }

        // Function to open modal with product info and image
        function openProductModal(productName, productImage, productDescription) {
            // Create modal if it doesn't exist
            let modal = document.getElementById('productModal');
            if (!modal) {
                modal = createProductModal();
            }

            // Set modal content
            document.getElementById('modalTitle').textContent = productName;
            const modalImage = document.getElementById('modalImage');
            modalImage.src = productImage;
            modalImage.alt = productName;

            // Set description if available
            const modalDescription = document.getElementById('modalDescription');
            if (modalDescription) {
                modalDescription.textContent = productDescription || 'Deskripsi produk tidak tersedia.';
            }

            // Show the modal
            modal.style.display = 'flex';
            document.body.classList.add('modal-open');
        }

        // Function to create modal HTML structure
        function createProductModal() {
            const modalHTML = `
                <div id="productModal" class="product-modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 id="modalTitle"></h2>
                            <button id="modalClose" class="modal-close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-image-container">
                                <img id="modalImage" src="" alt="" class="modal-image">
                            </div>
                            <div class="modal-info">
                                <p id="modalDescription"></p>
                                <div id="modalSpecs" class="modal-specs"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="modalClose2" class="modal-close-btn">Tutup</button>
                        </div>
                    </div>
                </div>
            `;

            // Add modal to body
            document.body.insertAdjacentHTML('beforeend', modalHTML);

            // Add CSS styles for modal
            const modalStyles = `
                <style>
                .product-modal {
                    display: none;
                    position: fixed;
                    z-index: 1000;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.8);
                    align-items: center;
                    justify-content: center;
                }

                .modal-content {
                    background-color: #fff;
                    border-radius: 10px;
                    max-width: 90%;
                    max-height: 90%;
                    overflow-y: auto;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
                }

                .modal-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 20px;
                    border-bottom: 1px solid #eee;
                    background-color: #f8f9fa;
                    border-radius: 10px 10px 0 0;
                }

                .modal-header h2 {
                    margin: 0;
                    color: #333;
                    font-size: 1.5rem;
                }

                .modal-close {
                    background: none;
                    border: none;
                    font-size: 2rem;
                    cursor: pointer;
                    color: #666;
                    padding: 0;
                    width: 40px;
                    height: 40px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 50%;
                    transition: all 0.3s ease;
                }

                .modal-close:hover {
                    background-color: #f0f0f0;
                    color: #333;
                }

                .modal-body {
                    padding: 20px;
                    display: flex;
                    gap: 20px;
                    flex-wrap: wrap;
                }

                .modal-image-container {
                    flex: 1;
                    min-width: 300px;
                    display: flex;
                    justify-content: center;
                    align-items: flex-start;
                }

                .modal-image {
                    max-width: 100%;
                    max-height: 400px;
                    object-fit: contain;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }

                .modal-info {
                    flex: 1;
                    min-width: 300px;
                }

                .modal-info p {
                    line-height: 1.6;
                    color: #666;
                    margin-bottom: 20px;
                }

                .modal-specs {
                    display: grid;
                    gap: 10px;
                }

                .spec-item {
                    display: grid;
                    grid-template-columns: 1fr 2fr;
                    gap: 10px;
                    padding: 10px;
                    background-color: #f8f9fa;
                    border-radius: 5px;
                }

                .spec-label {
                    font-weight: bold;
                    color: #333;
                }

                .spec-value {
                    color: #666;
                }

                .modal-footer {
                    padding: 20px;
                    text-align: center;
                    border-top: 1px solid #eee;
                    background-color: #f8f9fa;
                    border-radius: 0 0 10px 10px;
                }

                .modal-close-btn {
                    background-color: #a40e0e;
                    color: white;
                    border: none;
                    padding: 10px 30px;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 1rem;
                    transition: background-color 0.3s ease;
                }

                .modal-close-btn:hover {
                    background-color: #8a0c0c;
                }

                .modal-open {
                    overflow: hidden;
                }

                @media (max-width: 768px) {
                    .modal-content {
                        max-width: 95%;
                        margin: 10px;
                    }
                    
                    .modal-body {
                        flex-direction: column;
                    }
                    
                    .modal-image-container,
                    .modal-info {
                        min-width: auto;
                    }
                }
                </style>
            `;

            document.head.insertAdjacentHTML('beforeend', modalStyles);

            return document.getElementById('productModal');
        }

        // Add click event to all "Lihat Selengkapnya" links
        // const productLinks = document.querySelectorAll('.lihat-selengkapnya');
        // productLinks.forEach((link) => {
        //     link.addEventListener('click', function(e) {
        //         e.preventDefault();

        //         // Get the product info from the closest gallery item
        //         const galleryItem = this.closest('.galeri-item');
        //         const productName = galleryItem.querySelector('.galeri-item-title').textContent;

        //         // Get product image - try different possible selectors
        //         let productImage = '';
        //         const imgElement = galleryItem.querySelector('img');
        //         if (imgElement) {
        //             productImage = imgElement.src;
        //         }

        //         // Get product description if available
        //         let productDescription = '';
        //         const descElement = galleryItem.querySelector(
        //             '.galeri-item-description, .product-description, p');
        //         if (descElement) {
        //             productDescription = descElement.textContent;
        //         }

        //         // Check if productData exists (from your original code)
        //         if (typeof productData !== 'undefined' && productData[productName]) {
        //             const product = productData[productName];
        //             openProductModal(productName, product.image || productImage, product
        //                 .description || productDescription);

        //             // Set specs if available
        //             const specsContainer = document.getElementById('modalSpecs');
        //             if (specsContainer && product.specs) {
        //                 specsContainer.innerHTML = '';
        //                 product.specs.forEach((spec) => {
        //                     const specElement = document.createElement('div');
        //                     specElement.className = 'spec-item';

        //                     const labelElement = document.createElement('div');
        //                     labelElement.className = 'spec-label';
        //                     labelElement.textContent = spec.label + ':';

        //                     const valueElement = document.createElement('div');
        //                     valueElement.className = 'spec-value';
        //                     valueElement.textContent = spec.value;

        //                     specElement.appendChild(labelElement);
        //                     specElement.appendChild(valueElement);
        //                     specsContainer.appendChild(specElement);
        //                 });
        //             }
        //         } else {
        //             // Use data from gallery item directly
        //             openProductModal(productName, productImage, productDescription);
        //         }
        //     });
        // });

        // Event delegation for dynamically created modal close buttons
        document.addEventListener('click', function(e) {
            if (e.target.id === 'modalClose' || e.target.id === 'modalClose2') {
                const modal = document.getElementById('productModal');
                if (modal) {
                    modal.style.display = 'none';
                    document.body.classList.remove('modal-open');
                }
            }

            // Close modal when clicking outside of modal content
            if (e.target.id === 'productModal') {
                e.target.style.display = 'none';
                document.body.classList.remove('modal-open');
            }
        });

        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('productModal');
                if (modal && modal.style.display === 'flex') {
                    modal.style.display = 'none';
                    document.body.classList.remove('modal-open');
                }
            }
        });
    });
    </script>
    <script>
    const tabs = document.querySelectorAll('.galeri-tab');
    const semuaContent = document.getElementById('semua-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const tabName = tab.getAttribute('data-tab');

            // Tampilkan/hilangkan berdasarkan tab
            if (tabName === 'semua') {
                semuaContent.style.display = 'block';
            } else {
                semuaContent.style.display = 'none';
            }

            // Tambah/kurangi kelas aktif
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });
    </script>

    <script>
    document.querySelectorAll('.galeri-content').forEach((section) => {
        const row = section.querySelector('.galeri-row');
        const leftBtn = section.querySelector('.scroll-left');
        const rightBtn = section.querySelector('.scroll-right');

        const scrollAmount = 300; // pixel scroll per klik

        if (leftBtn && rightBtn && row) {
            leftBtn.addEventListener('click', () => {
                row.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });

            rightBtn.addEventListener('click', () => {
                row.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
        }
    });
    </script>


</body>

</html>