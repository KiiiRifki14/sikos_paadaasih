<?php
session_start();
// 1. KONEKSI KE DATABASE
include 'koneksi.php';
$db = new database();
$data_kamar = $db->tampil_kamar(); // Ambil data kamar dari database
?>

<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIKOS - Sistem Informasi Kos Modern</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
        body { font-family: 'Inter', sans-serif; background: #ffffff; scroll-behavior: smooth; }
        
        /* NAVBAR */
        .navbar { position: fixed; top: 0; left: 0; right: 0; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); z-index: 1000; padding: 16px 0; }
        .navbar-container { max-width: 1200px; margin: 0 auto; padding: 0 32px; display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 12px; font-size: 28px; font-weight: 900; color: #2563eb; text-decoration: none; }
        .nav-links { display: flex; gap: 32px; align-items: center; }
        .nav-link { color: #475569; text-decoration: none; font-weight: 600; font-size: 15px; transition: color 0.2s; }
        .nav-link:hover { color: #2563eb; }

        /* BUTTONS */
        .btn { padding: 12px 28px; border-radius: 10px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-block; border:none; }
        .btn-primary { background: #2563eb; color: white; }
        .btn-primary:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3); }
        .btn-outline { background: transparent; color: #2563eb; border: 2px solid #2563eb; }
        .btn-outline:hover { background: #eff6ff; }
        .btn-white { background: white; color: #2563eb; }
        .btn-white:hover { background: #f8fafc; transform: translateY(-2px); }

        /* HERO */
        .hero { background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); padding: 140px 32px 100px; text-align: center; color: white; margin-top: 68px; }
        .hero-title { font-size: 56px; font-weight: 900; margin-bottom: 24px; line-height: 1.2; }
        .hero-subtitle { font-size: 20px; margin-bottom: 40px; opacity: 0.95; }

        /* SECTIONS */
        .section-container { max-width: 1200px; margin: 0 auto; padding: 100px 32px; }
        .section-header { text-align: center; margin-bottom: 60px; }
        .section-title { font-size: 42px; font-weight: 900; color: #1e293b; margin-bottom: 16px; }
        .section-subtitle { font-size: 18px; color: #64748b; }

        /* ROOMS GRID */
        .rooms-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; }
        .room-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); transition: all 0.3s; }
        .room-card:hover { transform: translateY(-8px); box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15); }
        .room-image { width: 100%; height: 220px; object-fit: cover; background: #e2e8f0; }
        .room-content { padding: 28px; }
        .room-title { font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 12px; }
        .room-features { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
        .room-feature { padding: 6px 12px; background: #f1f5f9; border-radius: 8px; font-size: 13px; color: #475569; }
        .room-price { font-size: 28px; font-weight: 900; color: #2563eb; margin-bottom: 4px; }
        
        /* FEATURES & TESTIMONIALS */
        .features { background: #f8fafc; }
        .features-grid, .testimonials-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px; }
        .feature-card, .testimonial-card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
        
        /* FOOTER */
        .footer { background: #0f172a; color: white; padding: 60px 32px 32px; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; }
        .footer a { color: rgba(255,255,255,0.7); text-decoration: none; }
        .footer a:hover { color: white; }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .hero-title { font-size: 36px; }
        }
  </style>
 </head>
 <body>

  <nav class="navbar">
   <div class="navbar-container">
    <a href="#" class="logo"> <span>🏠</span> <span>SIKOS</span> </a>
    <div class="nav-links">
        <a href="#features" class="nav-link">Fitur</a> 
        <a href="#rooms" class="nav-link">Kamar</a> 
        <a href="#testimonials" class="nav-link">Testimoni</a> 
        <a href="login.php" class="btn btn-primary">Login</a>
        <a href="register.php" class="btn btn-outline">Daftar</a>
    </div>
   </div>
  </nav>

  <section class="hero">
   <div class="hero-content">
    <h1 class="hero-title">Kelola Kos Jadi Lebih Mudah dengan SIKOS</h1>
    <p class="hero-subtitle">Sistem informasi kos modern yang memudahkan pembayaran, komplain, dan monitoring kamar dalam satu platform digital</p>
    <div class="hero-buttons">
        <a href="register.php" class="btn btn-white btn-hero">Daftar Sekarang</a> 
        <a href="#features" class="btn btn-outline btn-hero" style="color:white; border-color:white;">Lihat Fitur</a>
    </div>
   </div>
  </section>

  <section class="features" id="features">
   <div class="section-container">
    <div class="section-header">
     <h2 class="section-title">Fitur Unggulan SIKOS</h2>
     <p class="section-subtitle">Semua yang Anda butuhkan untuk pengalaman ngekos yang nyaman</p>
    </div>
    <div class="features-grid">
     <div class="feature-card">
      <div style="font-size: 40px; margin-bottom: 20px;">💰</div>
      <h3 class="feature-title" style="font-size: 20px; font-weight: 700; margin-bottom: 10px;">Pembayaran Digital</h3>
      <p class="feature-desc" style="color:#64748b;">Bayar sewa bulanan dengan mudah melalui transfer bank atau e-wallet. Riwayat tersimpan otomatis.</p>
     </div>
     <div class="feature-card">
      <div style="font-size: 40px; margin-bottom: 20px;">📝</div>
      <h3 class="feature-title" style="font-size: 20px; font-weight: 700; margin-bottom: 10px;">Sistem Komplain</h3>
      <p class="feature-desc" style="color:#64748b;">Laporkan masalah kamar atau fasilitas dengan cepat. Tracking status komplain real-time.</p>
     </div>
     <div class="feature-card">
      <div style="font-size: 40px; margin-bottom: 20px;">🚪</div>
      <h3 class="feature-title" style="font-size: 20px; font-weight: 700; margin-bottom: 10px;">Info Kamar Lengkap</h3>
      <p class="feature-desc" style="color:#64748b;">Lihat detail kamar, fasilitas, dan status ketersediaan secara transparan.</p>
     </div>
    </div>
   </div>
  </section>

  <section class="rooms" id="rooms" style="background: white;">
   <div class="section-container">
    <div class="section-header">
     <h2 class="section-title">Kamar Tersedia</h2>
     <p class="section-subtitle">Pilih kamar yang sesuai dengan kebutuhan dan budget Anda</p>
    </div>

    <div class="rooms-grid">
        
        <?php 
        if(!empty($data_kamar)) {
            foreach($data_kamar as $kamar) { 
                // Cek status kamar untuk label badge
                $status_badge = ($kamar['status'] == 'kosong') ? 
                    '<span style="background:#dcfce7; color:#166534; padding:4px 10px; border-radius:6px; font-size:12px; font-weight:bold;">Tersedia</span>' : 
                    '<span style="background:#fee2e2; color:#991b1b; padding:4px 10px; border-radius:6px; font-size:12px; font-weight:bold;">Terisi</span>';
                
                // Cek foto kamar
                $foto = ($kamar['foto_kamar'] != "") ? "gambar/kamar/".$kamar['foto_kamar'] : "https://via.placeholder.com/400x300?text=No+Image";
        ?>
        
        <div class="room-card">
            <img src="<?= $foto ?>" class="room-image" alt="Foto Kamar">
            
            <div class="room-content">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <h3 class="room-title" style="margin:0;">Kamar <?= $kamar['nomor_kamar']; ?></h3>
                    <?= $status_badge; ?>
                </div>
                
                <p style="color:#64748b; font-size:14px; margin-bottom:15px;">
                    <?= $kamar['tipe_kamar']; ?> • <?= $kamar['luas_kamar']; ?> • Lt. <?= $kamar['lantai']; ?>
                </p>

                <div class="room-features">
                    <?php 
                    $fasilitas_arr = explode(",", $kamar['fasilitas']);
                    foreach($fasilitas_arr as $fas) {
                        echo '<span class="room-feature">✓ '.trim($fas).'</span>';
                    }
                    ?>
                </div>
                
                <p class="room-price">Rp <?= number_format($kamar['harga_bulanan'], 0, ',', '.'); ?></p>
                <p style="font-size:14px; color:#64748b; margin-bottom:20px;">per bulan</p>
                
                <?php if($kamar['status'] == 'kosong'): ?>
    
                <?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'login'): ?>
                    <a href="proses.php?action=booking&id_kamar=<?= $kamar['id_kamar']; ?>&harga=<?= $kamar['harga_bulanan']; ?>" 
                    class="btn btn-primary" 
                    style="width: 100%; text-align:center;"
                    onclick="return confirm('Yakin ingin menyewa kamar ini?')">
                    Sewa Sekarang
                    </a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-primary" style="width: 100%; text-align:center;">Login untuk Sewa</a>
                <?php endif; ?>

            <?php else: ?>
                    <button class="btn" style="width: 100%; background:#e2e8f0; color:#94a3b8; cursor:not-allowed;" disabled>Tidak Tersedia</button>
                <?php endif; ?>
            </div>
        </div>

        <?php 
            } // End Foreach
        } else {
            echo '<p style="grid-column: 1/-1; text-align: center; color: #64748b;">Belum ada data kamar yang tersedia saat ini.</p>';
        }
        ?>
        </div>
   </div>
  </section>

  <section class="testimonials" id="testimonials" style="background: #f8fafc;">
   <div class="section-container">
    <div class="section-header">
     <h2 class="section-title">Apa Kata Penghuni?</h2>
    </div>
    <div class="testimonials-grid">
     <div class="testimonial-card">
      <div style="font-size: 20px; margin-bottom: 10px;">⭐⭐⭐⭐⭐</div>
      <p style="font-style: italic; color:#475569; margin-bottom:20px;">"Sistem pembayaran digitalnya sangat memudahkan! Tidak perlu lagi repot transfer manual."</p>
      <div style="display:flex; gap:10px; align-items:center;">
        <div style="width:40px; height:40px; background:#cbd5e1; border-radius:50%;"></div>
        <div><strong style="display:block; color:#1e293b;">Ahmad Rizki</strong><span style="font-size:12px; color:#64748b;">Penghuni A12</span></div>
      </div>
     </div>
     </div>
   </div>
  </section>

  <footer class="footer">
   <div class="section-container">
    <div class="footer-grid">
     <div>
      <div class="logo" style="color:white; margin-bottom: 16px;"><span>🏠</span> <span>SIKOS</span></div>
      <p style="color: rgba(255, 255, 255, 0.7); font-size: 14px; line-height: 1.6;">Platform manajemen kos modern yang memudahkan penghuni dan pengelola dalam satu sistem terintegrasi.</p>
     </div>
     <div>
      <h3 style="font-weight:700; margin-bottom:20px;">Menu</h3>
      <div style="display:flex; flex-direction:column; gap:10px;">
        <a href="#features">Fitur</a>
        <a href="#rooms">Kamar</a>
        <a href="login.php">Login Admin</a>
      </div>
     </div>
     <div>
      <h3 style="font-weight:700; margin-bottom:20px;">Kontak</h3>
      <p style="color: rgba(255, 255, 255, 0.7); font-size: 14px;">📍 Jl. Paadaasih No. 123<br>📞 +62 812-3456-7890</p>
     </div>
    </div>
    <div style="border-top: 1px solid rgba(255, 255, 255, 0.1); margin-top: 40px; padding-top: 20px; text-align: center; font-size: 14px; color: rgba(255, 255, 255, 0.6);">
     <p>© 2025 SIKOS Paadaasih. All rights reserved.</p>
    </div>
   </div>
  </footer>

 </body>
</html>