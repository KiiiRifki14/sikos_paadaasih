<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tagihan Saya - SIKOS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
      body { font-family: 'Inter', sans-serif; background: #f8fafc; }
      .sidebar { width: 260px; background: white; height: 100vh; position: fixed; border-right: 1px solid #e2e8f0; }
      .main-content { margin-left: 260px; padding: 32px; }
      .card { background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
      
      .nav-item { display: flex; align-items: center; padding: 12px 24px; color: #64748b; text-decoration: none; transition: all 0.2s; border-left: 3px solid transparent; }
      .nav-item:hover { background: #f1f5f9; color: #334155; }
      .nav-item.active { background: #eff6ff; color: #2563eb; border-left-color: #2563eb; }
      
      .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
      .badge-warning { background: #fef3c7; color: #d97706; } /* Pending */
      .badge-success { background: #dcfce7; color: #16a34a; } /* Lunas */
      .badge-danger { background: #fee2e2; color: #991b1b; } /* Belum Bayar */
      
      .btn { padding: 8px 16px; border-radius: 8px; font-weight: 500; font-size: 14px; cursor: pointer; border: none; color: white; text-decoration: none; display: inline-block; }
      .btn-primary { background: #2563eb; }
  </style>
 </head>
 <body>
  
  <aside class="sidebar">
   <div style="padding: 24px 20px; border-bottom: 1px solid #e2e8f0;">
    <h1 style="font-size: 24px; font-weight: 700; color: #16a34a;">SIKOS</h1>
    <p style="font-size: 13px; color: #64748b;">Panel Penghuni</p>
   </div>
   <nav style="padding: 16px 0;">
    <a href="dashboard_user.php?page=dashboard" class="nav-item"> <span>🏠</span> <span class="ml-3">Dashboard</span> </a>
    <a href="dashboard_user.php?page=kamar" class="nav-item"> <span>🛏️</span> <span class="ml-3">Kamar Saya</span> </a>
    <a href="dashboard_user.php?page=tagihan" class="nav-item active"> <span>💰</span> <span class="ml-3">Tagihan</span> </a>
    <a href="dashboard_user.php?page=profil" class="nav-item"> <span>👤</span> <span class="ml-3">Profil</span> </a>
    <a href="proses.php?action=logout" class="nav-item" style="color: #ef4444;"> <span>🚪</span> <span class="ml-3">Logout</span> </a>
   </nav>
  </aside>
  
  <main class="main-content">
   <div class="card">
    <h2 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 20px;">Daftar Tagihan</h2>
    
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left;">
                <th style="padding: 12px; color: #64748b;">Bulan</th>
                <th style="padding: 12px; color: #64748b;">Jumlah</th>
                <th style="padding: 12px; color: #64748b;">Status</th>
                <th style="padding: 12px; color: #64748b;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($list_tagihan)): ?>
                <?php foreach($list_tagihan as $row): ?>
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 16px 12px; font-weight: 600;"><?= $row['periode_bulan']; ?></td>
                    <td style="padding: 16px 12px;">Rp <?= number_format($row['jumlah_tagihan']); ?></td>
                    <td style="padding: 16px 12px;">
                        <?php if($row['status_bayar'] == 'lunas'): ?>
                            <span class="badge badge-success">Lunas</span>
                        <?php elseif($row['status_bayar'] == 'menunggu_verifikasi'): ?>
                            <span class="badge badge-warning">Menunggu Verifikasi</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Belum Bayar</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding: 16px 12px;">
                        <?php if($row['status_bayar'] == 'belum_bayar'): ?>
                            <a href="#" class="btn btn-primary" onclick="alert('Fitur Upload Bukti Bayar akan segera hadir!')">Bayar</a>
                        <?php else: ?>
                            <span style="color: #94a3b8; font-size: 13px;">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px; color: #94a3b8;">Belum ada tagihan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
   </div>
  </main>

 </body>
</html>