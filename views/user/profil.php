<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <script src="https://cdn.tailwindcss.com"></script>
  </head>
<body>
  <aside class="sidebar">
   </aside>

  <main class="main-content">
    <h1 style="font-size: 24px; font-weight: 700; margin-bottom: 20px;">👤 Profil Saya</h1>
    
    <div class="card" style="max-width: 600px;">
      <form action="proses.php?action=update_profil" method="post">
        <div class="mb-4">
           <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
           <input type="text" name="nama" value="<?= $user_data['nama_lengkap'] ?>" class="w-full p-2 border rounded-lg">
        </div>
        <div class="mb-4">
           <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
           <input type="email" name="email" value="<?= $user_data['email'] ?>" class="w-full p-2 border rounded-lg" readonly style="background:#f1f5f9;">
        </div>
        <div class="mb-4">
           <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
           <input type="text" name="hp" value="<?= $user_data['no_hp'] ?>" class="w-full p-2 border rounded-lg">
        </div>
        
        <button type="submit" class="w-full bg-green-600 text-white p-3 rounded-lg font-bold hover:bg-green-700">Simpan Perubahan</button>
      </form>
    </div>
  </main>
</body>
</html>