<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kamar - SIKOS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
        /* CSS GLOBAL (Sama seperti sebelumnya) */
        body { font-family: 'Inter', sans-serif; background: #f8fafc; margin: 0; padding: 0; }
        .sidebar { width: 260px; background: white; height: 100vh; position: fixed; left: 0; top: 0; border-right: 1px solid #e2e8f0; overflow-y: auto; z-index: 50; }
        .sidebar-header { padding: 24px 24px; border-bottom: 1px solid #e2e8f0; }
        .sidebar-title { font-size: 24px; font-weight: 700; color: #1e293b; margin: 0; }
        .sidebar-subtitle { font-size: 13px; color: #64748b; margin: 4px 0 0 0; }
        .nav-menu { padding: 16px 0; }
        .nav-item { display: flex; align-items: center; padding: 12px 24px; color: #64748b; text-decoration: none; transition: all 0.2s; font-weight: 500; border-left: 3px solid transparent; }
        .nav-item:hover { background: #f1f5f9; color: #334155; }
        .nav-item.active { background: #eff6ff; color: #2563eb; border-left-color: #2563eb; }
        .nav-icon { font-size: 20px; margin-right: 12px; width: 24px; text-align: center; }
        .main-content { margin-left: 260px; padding: 32px; min-height: 100vh; }
        
        /* FORM STYLE */
        .card { background: white; border-radius: 12px; padding: 32px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; max-width: 900px; margin: 0 auto; }
        .card-title { font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 24px 0; padding-bottom: 16px; border-bottom: 1px solid #f1f5f9; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px; }
        .form-input, .form-select { width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.2s; color: #1e293b; }
        .form-input:focus, .form-select:focus { border-color: #2563eb; outline: none; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
        
        /* Checkbox Grid */
        .checkbox-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 12px; }
        .checkbox-item { display: flex; align-items: center; padding: 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer; transition: all 0.2s; }
        .checkbox-item:hover { border-color: #cbd5e1; background: #f1f5f9; }
        .checkbox-item input { width: 16px; height: 16px; margin-right: 10px; accent-color: #2563eb; }
        
        /* Buttons */
        .btn { padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; }
        .btn-warning { background: #f59e0b; color: white; width: 100%; justify-content: center; }
        .btn-warning:hover { background: #d97706; transform: translateY(-1px); }
        .btn-secondary { background: #e2e8f0; color: #475569; text-decoration: none; justify-content: center; }
        .btn-secondary:hover { background: #cbd5e1; }

        @media (max-width: 768px) {
            .sidebar { display: none; }
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
        <a class="nav-item" href="../dashboard_owner.php"> <span class="nav-icon">📊</span> <span>Dashboard</span> </a> 
        <a class="nav-item active" href="../data_kamar.php"> <span class="nav-icon">🏠</span> <span>Kelola Kamar</span> </a> 
        <a class="nav-item" href="../verifikasi_booking.php"> <span class="nav-icon">📝</span> <span>Verifikasi Booking</span> </a> 
        <a class="nav-item" href="../tagihan.php"> <span class="nav-icon">💰</span> <span>Tagihan</span> </a> 
        <a class="nav-item" href="../proses.php?action=logout" onclick="return confirm('Keluar?')" style="color: #ef4444;"> <span class="nav-icon">🚪</span> <span>Logout</span> </a>
   </nav>
  </aside>
  
  <main class="main-content">
   <div class="card">
     <div class="card-header">
        <h2 class="card-title">
            <span style="background: #fffbeb; padding: 8px; border-radius: 8px; font-size: 20px; color:#d97706;">✏️</span> 
            Edit Data Kamar
        </h2>
     </div>
     
     <form action="../proses.php?action=edit_kamar" method="post" enctype="multipart/form-data">
      
      <input type="hidden" name="id_kamar" value="<?= $data['id_kamar']; ?>">

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
          <div class="form-group">
              <label class="form-label">Nomor Kamar</label> 
              <input type="text" name="nomor_kamar" class="form-input" value="<?= $data['nomor_kamar']; ?>" required>
          </div>
          
          <div class="form-group">
              <label class="form-label">Tipe Kamar</label> 
              <select name="tipe_kamar" class="form-select">
                  <option value="Standar" <?= ($data['tipe_kamar']=='Standar')?'selected':''; ?>>Standar</option> 
                  <option value="Deluxe" <?= ($data['tipe_kamar']=='Deluxe')?'selected':''; ?>>Deluxe</option> 
                  <option value="VIP" <?= ($data['tipe_kamar']=='VIP')?'selected':''; ?>>VIP</option> 
              </select>
          </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px; margin-bottom: 24px;">
          <div class="form-group">
              <label class="form-label">Harga (Rp)</label> 
              <input type="number" name="harga_bulanan" class="form-input" value="<?= $data['harga_bulanan']; ?>" required>
          </div>
          <div class="form-group">
              <label class="form-label">Ukuran</label> 
              <input type="text" name="luas_kamar" class="form-input" value="<?= $data['luas_kamar']; ?>">
          </div>
          <div class="form-group">
              <label class="form-label">Lantai</label> 
              <select name="lantai" class="form-select">
                  <option value="1" <?= ($data['lantai']=='1')?'selected':''; ?>>Lantai 1</option> 
                  <option value="2" <?= ($data['lantai']=='2')?'selected':''; ?>>Lantai 2</option> 
                  <option value="3" <?= ($data['lantai']=='3')?'selected':''; ?>>Lantai 3</option> 
              </select>
          </div>
      </div>

      <div class="form-group">
        <label class="form-label">Fasilitas</label>
        <div class="checkbox-grid">
            <?php
            // Pecah string fasilitas dari database jadi array
            $f = explode(", ", $data['fasilitas']);
            ?>
            
            <label class="checkbox-item">
                <input type="checkbox" name="fasilitas[]" value="Kasur" <?= in_array('Kasur', $f)?'checked':''; ?>> 
                <span>🛏️ Kasur</span>
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="fasilitas[]" value="Lemari" <?= in_array('Lemari', $f)?'checked':''; ?>> 
                <span>🪑 Lemari</span>
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="fasilitas[]" value="AC" <?= in_array('AC', $f)?'checked':''; ?>> 
                <span>❄️ AC</span>
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="fasilitas[]" value="WiFi" <?= in_array('WiFi', $f)?'checked':''; ?>> 
                <span>📡 WiFi</span>
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="fasilitas[]" value="Kamar Mandi Dalam" <?= in_array('Kamar Mandi Dalam', $f)?'checked':''; ?>> 
                <span>🚿 KM Dalam</span>
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="fasilitas[]" value="Jendela" <?= in_array('Jendela', $f)?'checked':''; ?>> 
                <span>🪟 Jendela</span>
            </label>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Foto Saat Ini</label>
        <?php if($data['foto_kamar'] != ""): ?>
            <img src="../gambar/kamar/<?= $data['foto_kamar']; ?>" style="width: 150px; border-radius: 8px; margin-bottom: 10px;">
            <p style="font-size: 12px; color: #64748b;">Upload foto baru di bawah jika ingin mengganti.</p>
        <?php else: ?>
            <p style="font-size: 12px; color: #64748b;">Belum ada foto.</p>
        <?php endif; ?>
        
        <input type="file" name="foto_kamar" class="form-input" style="margin-top: 8px;">
      </div>

      <div style="margin-top: 40px; display: flex; gap: 16px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
        <button type="submit" class="btn btn-warning" style="flex: 1;">
            <span>💾</span> Update Data
        </button>
        <a href="../data_kamar.php" class="btn btn-secondary">
            Batal
        </a>
      </div>

     </form>
   </div>
  </main>
 </body>
</html>