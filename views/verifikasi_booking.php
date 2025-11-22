<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <title>Verifikasi Booking - SIKOS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
        /* CSS Sama dengan data_kamar.php */
        body { font-family: 'Inter', sans-serif; background: #f8fafc; margin: 0; padding: 0; }
        .sidebar { width: 260px; background: white; height: 100vh; position: fixed; left: 0; top: 0; border-right: 1px solid #e2e8f0; overflow-y: auto; z-index: 50; }
        .main-content { margin-left: 260px; padding: 32px; min-height: 100vh; }
        .nav-item { display: flex; align-items: center; padding: 12px 24px; color: #64748b; text-decoration: none; }
        .nav-item:hover { background: #f1f5f9; }
        .nav-item.active { background: #eff6ff; color: #2563eb; border-left: 3px solid #2563eb; }
        .card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 12px; border-bottom: 2px solid #e2e8f0; font-size: 14px; color: #475569; }
        td { padding: 16px 12px; border-bottom: 1px solid #f1f5f9; }
        .btn { padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer; border: none; color: white; text-decoration: none; display: inline-block;}
        .btn-success { background: #10b981; }
        .btn-danger { background: #ef4444; }
  </style>
 </head>
 <body>
  
  <aside class="sidebar">
   <div style="padding: 24px 24px; border-bottom: 1px solid #e2e8f0;">
    <h1 style="font-size: 24px; font-weight: 800; color: #1e293b;">SIKOS</h1>
    <p style="font-size: 13px; color: #64748b;">Owner Dashboard</p>
   </div>
   <nav style="padding: 24px 0;">
        <a class="nav-item" href="dashboard_owner.php"> <span>📊</span> <span style="margin-left: 12px;">Dashboard</span> </a> 
        <a class="nav-item" href="data_kamar.php"> <span>🏠</span> <span style="margin-left: 12px;">Kelola Kamar</span> </a> 
        <a class="nav-item active" href="verifikasi_booking.php"> <span>📝</span> <span style="margin-left: 12px;">Verifikasi Booking</span> </a> 
        <a class="nav-item" href="tagihan.php"> <span>💰</span> <span style="margin-left: 12px;">Tagihan</span> </a> 
        <a class="nav-item" href="proses.php?action=logout" onclick="return confirm('Keluar?')" style="color: #ef4444;"> <span>🚪</span> <span style="margin-left: 12px;">Logout</span> </a>
   </nav>
  </aside>
  
  <main class="main-content">
    <div class="card">
        <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 20px;">Verifikasi Booking Masuk</h2>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Penyewa</th>
                    <th>No. HP</th>
                    <th>Kamar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($data_booking)) {
                    foreach($data_booking as $row) { 
                ?>
                <tr>
                    <td><?= date('d M Y', strtotime($row['tanggal_transaksi'])); ?></td>
                    <td style="font-weight: 600;"><?= $row['nama_lengkap']; ?></td>
                    <td><?= $row['no_hp']; ?></td>
                    <td><?= $row['nomor_kamar']; ?></td>
                    <td><span style="background:#fef3c7; color:#d97706; padding:4px 10px; border-radius:20px; font-size:12px; font-weight:bold;">Pending</span></td>
                    <td>
                        <a href="proses.php?action=terima_sewa&id=<?= $row['id_transaksi']; ?>" class="btn btn-success" onclick="return confirm('Terima penyewaan ini?')">Terima</a>
                        <a href="proses.php?action=tolak_sewa&id=<?= $row['id_transaksi']; ?>" class="btn btn-danger" onclick="return confirm('Tolak penyewaan ini?')">Tolak</a>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; padding:20px; color:#94a3b8;'>Belum ada permintaan booking baru.</td></tr>";
                } 
                ?>
            </tbody>
        </table>
    </div>
  </main>
 </body>
</html>