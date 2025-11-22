<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pemilik - SIKOS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
        /* CSS GLOBAL KONSISTEN (Sama dengan data_kamar.php) */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body { font-family: 'Inter', sans-serif; background: #f8fafc; margin: 0; padding: 0; }
        
        /* Sidebar Style */
        .sidebar { width: 260px; background: white; height: 100vh; position: fixed; left: 0; top: 0; border-right: 1px solid #e2e8f0; overflow-y: auto; z-index: 50; }
        .sidebar-header { padding: 24px 24px; border-bottom: 1px solid #e2e8f0; }
        .sidebar-title { font-size: 24px; font-weight: 700; color: #1e293b; margin: 0; }
        .sidebar-subtitle { font-size: 13px; color: #64748b; margin: 4px 0 0 0; }
        
        .nav-menu { padding: 16px 0; }
        .nav-item { display: flex; align-items: center; padding: 12px 24px; color: #64748b; text-decoration: none; transition: all 0.2s; font-weight: 500; border-left: 3px solid transparent; }
        .nav-item:hover { background: #f1f5f9; color: #334155; }
        .nav-item.active { background: #eff6ff; color: #2563eb; border-left-color: #2563eb; }
        .nav-icon { font-size: 20px; margin-right: 12px; width: 24px; text-align: center; }

        /* Main Content */
        .main-content { margin-left: 260px; padding: 32px; min-height: 100vh; }

        /* Topbar / Welcome Section */
        .welcome-card { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; padding: 32px; border-radius: 16px; margin-bottom: 32px; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.2); display: flex; justify-content: space-between; align-items: center; }
        .welcome-text h2 { font-size: 24px; font-weight: 700; margin: 0 0 8px 0; }
        .welcome-text p { opacity: 0.9; font-size: 14px; margin: 0; }
        .date-badge { background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 50px; font-size: 13px; font-weight: 500; backdrop-filter: blur(5px); }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; }
        
        /* Stat Card Style */
        .stat-card { background: white; padding: 24px; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        
        .stat-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px; }
        .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        
        .stat-value { font-size: 32px; font-weight: 800; color: #1e293b; margin: 0; line-height: 1; }
        .stat-label { font-size: 14px; color: #64748b; margin-top: 8px; font-weight: 500; }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; padding: 20px; }
            .welcome-card { flex-direction: column; text-align: center; gap: 16px; }
        }
  </style>
 </head>
 <body>
  
  <aside class="sidebar">
   <div class="sidebar-header">
    <h1 class="sidebar-title">SIKOS</h1>
    <p class="sidebar-subtitle">Owner Dashboard</p>
   </div>
   <nav class="nav-menu">
        <a class="nav-item active" href="dashboard_owner.php"> <span class="nav-icon">📊</span> <span>Dashboard</span> </a> 
        <a class="nav-item" href="data_kamar.php"> <span class="nav-icon">🏠</span> <span>Kelola Kamar</span> </a> 
        <a class="nav-item" href="verifikasi_booking.php"> <span class="nav-icon">📝</span> <span>Verifikasi Booking</span> </a> 
        <a class="nav-item" href="tagihan.php"> <span class="nav-icon">💰</span> <span>Tagihan</span> </a> 
        <a class="nav-item" href="proses.php?action=logout" onclick="return confirm('Yakin ingin keluar?')" style="color: #ef4444;"> <span class="nav-icon">🚪</span> <span>Logout</span> </a>
   </nav>
  </aside>
  
  <main class="main-content">
   
   <div class="welcome-card">
    <div class="welcome-text">
        <h2>Halo, <?= $_SESSION['nama_lengkap']; ?>! 👋</h2>
        <p>Selamat datang kembali di panel kontrol SIKOS.</p>
    </div>
    <div class="date-badge">
        <?= date('d F Y'); ?>
    </div>
   </div>

   <div class="stats-grid">
     
     <div class="stat-card">
      <div class="stat-header">
        <div class="stat-icon" style="background: #eff6ff; color: #2563eb;">🏠</div>
      </div>
      <h3 class="stat-value"><?= $total_kamar; ?></h3>
      <p class="stat-label">Total Kamar</p>
     </div>

     <div class="stat-card">
      <div class="stat-header">
        <div class="stat-icon" style="background: #f0fdf4; color: #16a34a;">✅</div>
      </div>
      <h3 class="stat-value"><?= $kamar_terisi; ?></h3>
      <p class="stat-label">Kamar Terisi</p>
     </div>

     <div class="stat-card">
      <div class="stat-header">
        <div class="stat-icon" style="background: #fffbeb; color: #d97706;">⏳</div>
      </div>
      <h3 class="stat-value"><?= $pending_bayar; ?></h3>
      <p class="stat-label">Menunggu Verifikasi</p>
     </div>

     <div class="stat-card">
      <div class="stat-header">
        <div class="stat-icon" style="background: #faf5ff; color: #9333ea;">💵</div>
      </div>
      <h3 class="stat-value">Rp 0</h3>
      <p class="stat-label">Pendapatan Bulan Ini</p>
     </div>

   </div>

   <div style="margin-top: 40px;">
    <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 20px;">Aksi Cepat</h3>
    <div style="display: flex; gap: 16px;">
        <a href="tambah_kamar.php" style="background: white; border: 1px solid #e2e8f0; padding: 16px 24px; border-radius: 12px; text-decoration: none; display: flex; align-items: center; gap: 12px; color: #475569; transition: all 0.2s;" onmouseover="this.style.borderColor='#2563eb';this.style.color='#2563eb'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569'">
            <span style="font-size: 20px;">➕</span> 
            <span style="font-weight: 500;">Tambah Kamar</span>
        </a>
        </div>
   </div>

  </main>
 </body>
</html>