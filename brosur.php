<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CV Sri Rejeki - Brosur</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: 'Arial', sans-serif;
        background: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
      }

      .brochure {
        width: 800px;
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      }

      .header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 30px;
        text-align: center;
      }

      .header h1 {
        font-size: 2.8em;
        font-weight: bold;
        margin-bottom: 8px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
      }

      .header .subtitle {
        font-size: 1.1em;
        opacity: 0.9;
        margin-bottom: 5px;
      }

      .header .services-list {
        font-size: 0.9em;
        opacity: 0.7;
      }

      .contact-info {
        background: #f8f9fa;
        padding: 20px 30px;
        border-bottom: 3px solid #3498db;
      }

      .contact-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
      }

      .contact-label {
        font-weight: bold;
        color: #2c3e50;
        width: 80px;
      }

      .contact-value {
        color: #333;
        flex: 1;
      }

      .workshop-section {
        padding: 30px;
        text-align: center;
        background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);
      }

      .workshop-gallery {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        gap: 15px;
        height: 300px;
        margin-bottom: 20px;
      }

      .workshop-image {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        position: relative;
      }

      .workshop-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
      }

      .workshop-image:hover img {
        transform: scale(1.05);
      }

      .workshop-image.main {
        grid-row: span 2;
      }

      .workshop-image .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
        color: white;
        padding: 15px;
        font-size: 0.9em;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
      }

      .workshop-title {
        font-size: 1.5em;
        color: #2c3e50;
        margin-bottom: 10px;
        font-weight: bold;
      }

      .services-title {
        text-align: center;
        font-size: 2em;
        color: #2c3e50;
        margin: 30px 0 20px 0;
        font-weight: bold;
      }

      .services-container {
        display: flex;
        justify-content: space-between;
        padding: 0 30px 30px 30px;
        gap: 20px;
      }

      .service-card {
        flex: 1;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: 2px solid transparent;
        transition: transform 0.3s ease;
      }

      .service-card:hover {
        transform: translateY(-5px);
      }

      .service-card.casting {
        border-color: #3498db;
      }

      .service-card.turning {
        border-color: #e74c3c;
      }

      .service-card.drilling {
        border-color: #27ae60;
      }

      .service-header {
        padding: 15px;
        color: white;
        text-align: center;
        font-weight: bold;
        font-size: 1.1em;
      }

      .service-header.casting {
        background: #3498db;
      }

      .service-header.turning {
        background: #e74c3c;
      }

      .service-header.drilling {
        background: #27ae60;
      }

      .service-content {
        padding: 20px 15px;
      }

      .service-content ul {
        list-style: none;
        margin-bottom: 15px;
      }

      .service-content li {
        padding: 3px 0;
        color: #333;
        font-size: 0.9em;
      }

      .service-content li:before {
        content: '• ';
        color: #3498db;
        font-weight: bold;
      }

      .service-description {
        text-align: center;
        font-style: italic;
        color: #666;
        font-size: 0.85em;
        border-top: 1px solid #eee;
        padding-top: 10px;
      }

      .why-choose {
        background: #f8f9fa;
        padding: 30px;
      }

      .why-choose h2 {
        text-align: center;
        font-size: 1.8em;
        color: #2c3e50;
        margin-bottom: 25px;
        font-weight: bold;
      }

      .features-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
      }

      .feature-item {
        display: flex;
        align-items: center;
        background: white;
        padding: 12px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      .feature-icon {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 12px;
        flex-shrink: 0;
      }

      .feature-icon.blue {
        background: #3498db;
      }

      .feature-icon.red {
        background: #e74c3c;
      }

      .feature-text {
        font-size: 0.9em;
        color: #333;
      }

      .cta-section {
        padding: 30px;
        text-align: center;
      }

      .cta-button {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
        padding: 20px 40px;
        border-radius: 50px;
        display: inline-block;
        text-decoration: none;
        font-size: 1.2em;
        font-weight: bold;
        box-shadow: 0 5px 15px rgba(243, 156, 18, 0.4);
        margin-bottom: 10px;
      }

      .cta-subtitle {
        color: #666;
        font-size: 0.9em;
      }

      .footer {
        background: #34495e;
        color: white;
        text-align: center;
        padding: 25px;
      }

      .footer h3 {
        font-size: 1.3em;
        margin-bottom: 8px;
      }

      .footer p {
        opacity: 0.8;
        font-size: 0.9em;
      }
    </style>
  </head>
  <body>
    <div class="brochure">
      <!-- Header -->
      <div class="header">
        <h1>CV SRI REJEKI</h1>
        <div class="subtitle">Professional Manufacturing Services</div>
        <div class="services-list">Casting • Turning • Drilling</div>
      </div>

      <!-- Contact Info -->
      <div class="contact-info">
        <div class="contact-row">
          <span class="contact-label">ALAMAT:</span>
          <span class="contact-value">Jl. Tegalsari Baru Rt 39 Rw 16 Ngawonggo Ceper Klaten</span>
        </div>
        <div class="contact-row">
          <span class="contact-label">TELEPON:</span>
          <span class="contact-value">0812-2617-7600</span>
        </div>
        <div class="contact-row">
          <span class="contact-label">EMAIL:</span>
          <span class="contact-value">umarraharjo4@gmail.com</span>
        </div>
      </div>

      <!-- Workshop Section -->
      <div class="workshop-section">
        <div class="workshop-title">FASILITAS WORKSHOP KAMI</div>
        <div class="workshop-gallery">
          <div class="workshop-image main">
            <img src="tempat produksi.png" alt="Workshop CV Sri Rejeki" />
            <div class="overlay">Workshop Utama - Fasilitas Lengkap</div>
          </div>
          <div class="workshop-image">
            <img src="casting.png" />
            <div class="overlay">Peralatan Casting</div>
          </div>
          <div class="workshop-image">
            <img src="hasil_turning.png" alt="Mesin Turning" />
            <div class="overlay">Mesin Turning</div>
          </div>
          <div class="workshop-image">
            <img src="drilling.png" alt="Komponen Drilling" />
            <div class="overlay">Komponen Drilling</div>
          </div>
          <div class="workshop-image">
            <img src="tampilan depan tempat produksi.png" alt="Eksterior Workshop" />
            <div class="overlay">Eksterior Workshop</div>
          </div>
        </div>
        <p style="color: #666; font-style: italic">Dilengkapi dengan peralatan modern dan tenaga ahli berpengalaman</p>
      </div>

      <!-- Services -->
      <h2 class="services-title">LAYANAN KAMI</h2>
      <div class="services-container">
        <!-- Casting -->
        <div class="service-card casting">
          <div class="service-header casting">CASTING</div>
          <div class="service-content">
            <ul>
              <li>Sand Casting</li>
              <li>Rough Finishing</li>
              <li>Custom Casting</li>
              <li>Repair Casting</li>
            </ul>
            <div class="service-description">Pengecoran berkualitas tinggi</div>
          </div>
        </div>

        <!-- Turning -->
        <div class="service-card turning">
          <div class="service-header turning">TURNING</div>
          <div class="service-content">
            <ul>
              <li>Conventional Turning</li>
              <li>Facing Turning</li>
              <li>Taper Turning</li>
              <li>Grooving Turning</li>
            </ul>
            <div class="service-description">Pembubutan presisi tinggi</div>
          </div>
        </div>

        <!-- Drilling -->
        <div class="service-card drilling">
          <div class="service-header drilling">DRILLING</div>
          <div class="service-content">
            <ul>
              <li>Conventional Drilling</li>
              <li>Center Drilling</li>
              <li>Tapping</li>
              <li>Reaming</li>
              <li>Counterboring</li>
              <li>Countersinking</li>
            </ul>
            <div class="service-description">Pengeboran presisi</div>
          </div>
        </div>
      </div>

      <!-- Why Choose Us -->
      <div class="why-choose">
        <h2>MENGAPA MEMILIH KAMI?</h2>
        <div class="features-grid">
          <div class="feature-item">
            <div class="feature-icon blue"></div>
            <div class="feature-text">Memiliki pengalaman 3 tahun dalam industri manufaktur</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon red"></div>
            <div class="feature-text">Layanan custom sesuai kebutuhan pelanggan</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon blue"></div>
            <div class="feature-text">Peralatan modern dan teknologi terkini</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon red"></div>
            <div class="feature-text">Waktu pengerjaan yang tepat waktu</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon blue"></div>
            <div class="feature-text">Tenaga ahli berpengalaman dan terlatih</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon red"></div>
            <div class="feature-text">Konsultasi gratis untuk proyek Anda</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon blue"></div>
            <div class="feature-text">Kualitas terjamin dengan harga kompetitif</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon red"></div>
            <div class="feature-text">After-sales service terpercaya</div>
          </div>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="cta-section">
        <div class="cta-button">HUBUNGI KAMI SEKARANG!</div>
        <div class="cta-subtitle">Konsultasi Gratis • Kualitas Terjamin</div>
      </div>

      <!-- Footer -->
      <div class="footer">
        <h3>CV SRI REJEKI</h3>
        <p>Solusi Terpercaya untuk Kebutuhan Manufaktur Anda</p>
      </div>
    </div>
  </body>
</html>
