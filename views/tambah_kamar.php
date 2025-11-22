<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Kamar - SIKOS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
        /* CSS Global Konsisten */
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

        /* Form Card */
        .card { background: white; border-radius: 12px; padding: 32px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; max-width: 900px; margin: 0 auto; }
        .card-title { font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 24px 0; padding-bottom: 16px; border-bottom: 1px solid #f1f5f9; }

        /* Form Elements */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px; }
        .form-input, .form-select { width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.2s; color: #1e293b; }
        .form-input:focus, .form-select:focus { border-color: #2563eb; outline: none; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
        
        /* Checkbox Grid */
        .checkbox-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 12px; }
        .checkbox-item { display: flex; align-items: center; padding: 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer; transition: all 0.2s; }
        .checkbox-item:hover { border-color: #cbd5e1; background: #f1f5f9; }
        .checkbox-item input { width: 16px; height: 16px; margin-right: 10px; accent-color: #2563eb; }
        .checkbox-item label { cursor: pointer; font-size: 14px; color: #475569; font-weight: 500; }

        /* Upload Area */
        .upload-area { border: 2px dashed #cbd5e1; border-radius: 12px; padding: 32px; text-align: center; cursor: pointer; background: #f8fafc; transition: all 0.2s; }
        .upload-area:hover { border-color: #2563eb; background: #eff6ff; }

        /* Buttons */
        .btn { padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; }
        .btn-primary { background: #2563eb; color: white; width: 100%; justify-content: center; }
        .btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }
        .btn-secondary { background: #e2e8f0; color: #475569; text-decoration: none; justify-content: center; }
        .btn-secondary:hover { background: #cbd5e1; }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; padding: 16px; }
            .checkbox-grid { grid-template-columns: 1fr; }
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
        <a class="nav-item" href="../proses.php?action=logout" onclick="return confirm('Yakin ingin keluar?')" style="color: #ef4444;"> <span class="nav-icon">🚪</span> <span>Logout</span> </a>
   </nav>
  </aside>
  
  <main class="main-content">
   <div class="card">
     <h2 class="card-title">Tambah Kamar Baru</h2>
     
     <form action="../proses.php?action=tambah_kamar" method="post" enctype="multipart/form-data">
      
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
          <div class="form-group">
              <label class="form-label">Nomor Kamar <span style="color:red">*</span></label> 
              <input type="text" name="nomor_kamar" class="form-input" placeholder="Contoh: A01" required>
          </div>
          
          <div class="form-group">
              <label class="form-label">Tipe Kamar <span style="color:red">*</span></label> 
              <select name="tipe_kamar" class="form-select" required> 
                  <option value="">Pilih Tipe...</option>
                  <option value="Standard">Standard</option> 
                  <option value="Deluxe">Deluxe</option> 
                  <option value="VIP">VIP</option> 
              </select>
          </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px; margin-bottom: 24px;">
          <div class="form-group">
              <label class="form-label">Harga per Bulan (Rp) <span style="color:red">*</span></label> 
              <input type="number" name="harga_bulanan" class="form-input" placeholder="Contoh: 800000" required>
          </div>

          <div class="form-group">
              <label class="form-label">Ukuran Kamar</label> 
              <input type="text" name="luas_kamar" class="form-input" placeholder="Contoh: 3x4 m">
          </div>

          <div class="form-group">
              <label class="form-label">Lokasi Lantai</label> 
              <select name="lantai" class="form-select">
                  <option value="1">Lantai 1</option> 
                  <option value="2">Lantai 2</option> 
                  <option value="3">Lantai 3</option> 
              </select>
          </div>
      </div>

      <div class="form-group">
        <label class="form-label">Fasilitas Tersedia</label>
        <div class="checkbox-grid">
            <label class="checkbox-item"><input type="checkbox" name="fasilitas[]" value="Kasur"> <span>🛏️ Kasur</span></label>
            <label class="checkbox-item"><input type="checkbox" name="fasilitas[]" value="Lemari"> <span>🪑 Lemari</span></label>
            <label class="checkbox-item"><input type="checkbox" name="fasilitas[]" value="AC"> <span>❄️ AC</span></label>
            <label class="checkbox-item"><input type="checkbox" name="fasilitas[]" value="WiFi"> <span>📡 WiFi</span></label>
            <label class="checkbox-item"><input type="checkbox" name="fasilitas[]" value="Kamar Mandi Dalam"> <span>🚿 KM Dalam</span></label>
            <label class="checkbox-item"><input type="checkbox" name="fasilitas[]" value="Jendela"> <span>🪟 Jendela</span></label>
        </div>
      </div>

      <div class="form-group">
          <label class="form-label">Foto Kamar (Opsional)</label>
          <div class="upload-area" onclick="document.getElementById('foto_input').click()">
              <input type="file" id="foto_input" name="foto_kamar" accept="image/*" style="display: none;" onchange="previewImage(this)">
              <div style="font-size: 32px; margin-bottom: 8px;">📷</div>
              <p style="margin: 0; color: #64748b; font-size: 14px;">Klik di sini untuk upload foto kamar</p>
              <p id="file-name" style="margin: 4px 0 0 0; color: #2563eb; font-size: 12px; font-weight: 500;"></p>
          </div>
      </div>

      <div style="display: flex; gap: 16px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
        <button type="submit" class="btn btn-primary">Simpan Data</button>
        <a href="../data_kamar.php" class="btn btn-secondary">Batal</a>
      </div>

     </form>
   </div>
  </main>

  <script>
      function previewImage(input) {
          if (input.files && input.files[0]) {
              document.getElementById('file-name').textContent = "File terpilih: " + input.files[0].name;
          }
      }
  </script>
 </body>
</html>