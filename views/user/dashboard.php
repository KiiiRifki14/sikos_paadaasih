<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Penghuni - SIKOS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
      body { font-family: 'Inter', sans-serif; background: #f8fafc; }
      .sidebar { width: 260px; background: white; height: 100vh; position: fixed; border-right: 1px solid #e2e8f0; }
      .main-content { margin-left: 260px; padding: 32px; }
      .card { background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
      /* ... (Gunakan style yang sama dengan Owner agar konsisten) ... */
      .nav-item { display: flex; align-items: center; padding: 12px 24px; color: #64748b; text-decoration: none; }
      .nav-item:hover { background: #f1f5f9; }
      .nav-item.active { background: #ecfdf5; color: #16a34a; border-left: 3px solid #16a34a; }
  </style>
 </head>
 <body>
  
  <aside class="sidebar">
   <div style="padding: 24px 20px; border-bottom: 1px solid #e2e8f0;">
    <h1 style="font-size: 24px; font-weight: 700; color: #16a34a;">SIKOS</h1>
    <p style="font-size: 13px; color: #64748b;">Panel Penghuni</p>
   </div>
   <nav style="padding: 16px 0;">
    <a href="dashboard_user.php?page=dashboard" class="nav-item active"> <span>🏠</span> <span class="ml-3">Dashboard</span> </a>
    <a href="dashboard_user.php?page=kamar" class="nav-item"> <span>🛏️</span> <span class="ml-3">Kamar Saya</span> </a>
    <a href="dashboard_user.php?page=tagihan" class="nav-item"> <span>💰</span> <span class="ml-3">Tagihan</span> </a>
    <a href="dashboard_user.php?page=profil" class="nav-item"> <span>👤</span> <span class="ml-3">Profil</span> </a>
    <a href="proses.php?action=logout" class="nav-item" style="color: #ef4444;"> <span>🚪</span> <span class="ml-3">Logout</span> </a>
   </nav>
  </aside>
  
  <main class="main-content">
   <div style="margin-bottom: 32px;">
     <h1 style="font-size: 28px; font-weight: 800; color: #1e293b;">Halo, <?= $nama_lengkap ?>! 👋</h1>
     <p style="color: #64748b;">Selamat datang di panel penghuni.</p>
   </div>

   <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 32px;">
     
     <div class="card" style="border-left: 4px solid #16a34a;">
       <div style="display: flex; align-items: center; gap: 15px;">
         <div style="font-size: 30px;">🏠</div>
         <div>
           <p style="font-size: 14px; color: #64748b;">Kamar Saat Ini</p>
           <h3 style="font-size: 20px; font-weight: 700; color: #1e293b;">
             <?= isset($kamar_saya['nomor_kamar']) ? "Kamar ".$kamar_saya['nomor_kamar'] : "Belum Ada"; ?>
           </h3>
         </div>
       </div>
     </div>

     <div class="card" style="border-left: 4px solid #f59e0b;">
       <div style="display: flex; align-items: center; gap: 15px;">
         <div style="font-size: 30px;">💰</div>
         <div>
           <p style="font-size: 14px; color: #64748b;">Tagihan Belum Lunas</p>
           <h3 style="font-size: 20px; font-weight: 700; color: #d97706;">
             Rp <?= number_format($tagihan_pending); ?>
           </h3>
         </div>
       </div>
     </div>

   </div>

   <div class="card" style="background: linear-gradient(135deg, #16a34a 0%, #059669 100%); color: white;">
      <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 10px;">💡 Info Penting</h3>
      <p style="font-size: 14px; opacity: 0.9;">
        Jangan lupa bayar tagihan sebelum tanggal 10 setiap bulannya. Jika ada kendala fasilitas, silakan hubungi pemilik kos.
      </p>
   </div>

  </main>
 </body>
</html>