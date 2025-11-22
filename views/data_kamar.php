<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Kamar - SIKOS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
        /* Style Dasar yang Sama dengan Dashboard */
        body { font-family: 'Inter', sans-serif; background: #f8fafc; margin: 0; padding: 0; }
        
        /* Sidebar Identik */
        .sidebar { width: 260px; background: white; height: 100vh; position: fixed; left: 0; top: 0; border-right: 1px solid #e2e8f0; overflow-y: auto; z-index: 50; }
        .sidebar-header { padding: 24px 24px; border-bottom: 1px solid #e2e8f0; }
        .sidebar-title { font-size: 24px; font-weight: 700; color: #1e293b; margin: 0; }
        .sidebar-subtitle { font-size: 13px; color: #64748b; margin: 4px 0 0 0; }
        
        .nav-menu { padding: 16px 0; }
        .nav-item { display: flex; align-items: center; padding: 12px 24px; color: #64748b; text-decoration: none; transition: all 0.2s; border-left: 3px solid transparent; }
        .nav-item:hover { background: #f1f5f9; color: #334155; }
        .nav-item.active { background: #eff6ff; color: #2563eb; border-left-color: #2563eb; }
        .nav-icon { font-size: 20px; margin-right: 12px; width: 24px; text-align: center; }

        /* Main Content */
        .main-content { margin-left: 260px; padding: 32px; min-height: 100vh; }
        
        /* Table Card */
        .card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .card-title { font-size: 18px; font-weight: 600; color: #1e293b; margin: 0; }

        /* Table Style */
        .table-container { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th { text-align: left; padding: 12px 16px; border-bottom: 2px solid #e2e8f0; background: #f8fafc; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
        td { padding: 16px; border-bottom: 1px solid #f1f5f9; color: #1e293b; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background: #f8fafc; }

        /* Buttons & Badges */
        .btn { padding: 10px 20px; border-radius: 8px; font-weight: 500; font-size: 14px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; border: none; }
        .btn-primary { background: #2563eb; color: white; }
        .btn-primary:hover { background: #1d4ed8; }
        .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 6px; }
        .btn-warning { background: #f59e0b; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-danger { background: #fee2e2; color: #991b1b; }

        @media (max-width: 768px) {
            .sidebar { display: none; } /* Sementara hide di mobile biar simpel */
            .main-content { margin-left: 0; padding: 16px; }
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
        <a class="nav-item" href="dashboard_owner.php"> <span class="nav-icon">📊</span> <span>Dashboard</span> </a> 
        <a class="nav-item active" href="data_kamar.php"> <span class="nav-icon">🏠</span> <span>Kelola Kamar</span> </a> 
        <a class="nav-item" href="verifikasi_booking.php"> <span class="nav-icon">📝</span> <span>Verifikasi Booking</span> </a> 
        <a class="nav-item" href="tagihan.php"> <span class="nav-icon">💰</span> <span>Tagihan</span> </a> 
        <a class="nav-item" href="proses.php?action=logout" onclick="return confirm('Keluar?')" style="color: #ef4444;"> <span class="nav-icon">🚪</span> <span>Logout</span> </a>
   </nav>
  </aside>
  
  <main class="main-content">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Data Kamar</h2>
            <a href="tambah_kamar.php" class="btn btn-primary"><span>➕</span> Tambah Kamar</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 100px;">Foto</th>
                        <th>Info Kamar</th>
                        <th>Fasilitas</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(!empty($data_kamar)) {
                        foreach($data_kamar as $row) { 
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?php if($row['foto_kamar'] != ""): ?>
                                <img src="gambar/kamar/<?= $row['foto_kamar']; ?>" style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px;">
                            <?php else: ?>
                                <div style="width: 80px; height: 60px; background: #f1f5f9; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 10px;">No Img</div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #1e293b;"><?= $row['nomor_kamar']; ?></div>
                            <div style="font-size: 12px; color: #64748b; margin-top: 2px;"><?= $row['tipe_kamar']; ?> • <?= $row['luas_kamar']; ?></div>
                        </td>
                        <td>
                            <div style="font-size: 13px; color: #475569; max-width: 200px; line-height: 1.4;">
                                <?= substr($row['fasilitas'], 0, 50) . (strlen($row['fasilitas']) > 50 ? '...' : ''); ?>
                            </div>
                        </td>
                        <td style="font-weight: 600; color: #2563eb;">
                            Rp <?= number_format($row['harga_bulanan'], 0, ',', '.'); ?>
                            <span style="font-size: 11px; color: #64748b; font-weight: normal;">/bulan</span>
                        </td>
                        <td>
                            <?php if($row['status'] == 'kosong'): ?>
                                <span class="badge badge-success">Tersedia</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Terisi</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <a href="edit_kamar.php?id=<?= $row['id_kamar']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="proses.php?action=hapus_kamar&id=<?= $row['id_kamar']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kamar ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align:center; padding:40px; color:#94a3b8;'>Belum ada data kamar.</td></tr>";
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
  </main>
 </body>
</html>