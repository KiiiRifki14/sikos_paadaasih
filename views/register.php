<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun - SIKOS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            overflow: hidden;
        }
        
        .auth-container { display: flex; height: 100%; }

        /* Kiri: Panel Biru */
        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            padding: 60px; color: white; position: relative; overflow: hidden;
        }
        .left-panel::before {
            content: ''; position: absolute; top: -50%; right: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 20s infinite;
        }
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-20px, 20px) rotate(5deg); }
        }

        /* Kanan: Form */
        .right-panel {
            flex: 1; background: #ffffff; display: flex; justify-content: center; align-items: center;
            padding: 60px; overflow-y: auto;
        }
        .form-container { width: 100%; max-width: 450px; }

        .input-group { margin-bottom: 20px; }
        .input-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #334155; font-size: 14px; }
        .input-wrapper { position: relative; }
        .input-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); font-size: 20px; pointer-events: none; }
        .input-group input {
            width: 100%; padding: 14px 16px 14px 48px; border: 2px solid #e2e8f0;
            border-radius: 12px; font-size: 15px; transition: all 0.2s;
        }
        .input-group input:focus { outline: none; border-color: #2563eb; background: #eff6ff; }

        .btn { width: 100%; padding: 16px; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; cursor: pointer; transition: all 0.3s; }
        .btn-primary { background: #2563eb; color: white; box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3); }
        .btn-primary:hover { background: #1d4ed8; transform: translateY(-2px); }

        /* Responsive */
        @media (max-width: 968px) {
            .auth-container { flex-direction: column; }
            .left-panel { padding: 40px 24px; min-height: 200px; flex: 0 0 250px; }
            .right-panel { padding: 40px 24px; flex: 1; }
        }
  </style>
 </head>
 <body>
  <div class="auth-container">
   
   <div class="left-panel">
    <div style="position: relative; z-index: 10; text-align: center;">
     <div style="font-size: 80px; margin-bottom: 24px;">🏠</div>
     <h1 style="margin: 0 0 16px 0; font-size: 48px; font-weight: 900;">SIKOS</h1>
     <p style="font-size: 18px; opacity: 0.95; line-height: 1.6;">Gabung sekarang dan temukan kos impianmu dengan mudah dan cepat.</p>
    </div>
   </div>

   <div class="right-panel">
    <div class="form-container">
     <div style="margin-bottom: 32px;">
      <h2 style="margin: 0 0 8px 0; font-size: 32px; font-weight: 800; color: #1e293b;">Buat Akun Baru</h2>
      <p style="margin: 0; font-size: 16px; color: #64748b;">Isi data diri Anda untuk mendaftar</p>
     </div>

     <?php 
     if(isset($_GET['pesan'])){
         if($_GET['pesan']=="gagal"){
             echo "<div style='background:#fee2e2; color:#991b1b; padding:12px; border-radius:10px; margin-bottom:20px; font-size:14px;'>❌ Pendaftaran Gagal! Silakan coba lagi.</div>";
         }
     }
     ?>

     <form action="proses.php?action=register" method="post">
      
      <div class="input-group">
        <label>Nama Lengkap</label>
        <div class="input-wrapper">
            <span class="input-icon">👤</span> 
            <input type="text" name="nama_lengkap" placeholder="Contoh: Ahmad Rizki" required>
        </div>
      </div>

      <div class="input-group">
        <label>Email</label>
        <div class="input-wrapper">
            <span class="input-icon">📧</span> 
            <input type="email" name="email" placeholder="nama@email.com" required>
        </div>
      </div>

      <div class="input-group">
        <label>No. Handphone</label>
        <div class="input-wrapper">
            <span class="input-icon">📱</span> 
            <input type="number" name="no_hp" placeholder="081234567890" required>
        </div>
      </div>

      <div class="input-group">
        <label>Password</label>
        <div class="input-wrapper">
            <span class="input-icon">🔒</span> 
            <input type="password" name="password" placeholder="Minimal 8 karakter" required>
        </div>
      </div>

      <div style="margin-bottom: 24px; display: flex; gap: 8px; align-items: flex-start;">
        <input type="checkbox" required style="margin-top: 4px;"> 
        <label style="font-size: 14px; color: #64748b; font-weight: normal;">Saya setuju dengan syarat & ketentuan yang berlaku di SIKOS.</label>
      </div>

      <button type="submit" class="btn btn-primary"> 
          <span>✨</span> Buat Akun
      </button>

     </form>
     
     <div style="text-align: center; margin-top: 24px; font-size: 15px; color: #64748b;">
      Sudah punya akun? <a href="login.php" style="color: #2563eb; font-weight: 700; text-decoration: none;">Masuk di sini</a>
     </div>

    </div>
   </div>
  </div>
 </body>
</html>