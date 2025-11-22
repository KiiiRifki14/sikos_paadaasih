<?php
include('koneksi.php');
$koneksi = new database();

$action = $_GET['action'];

// ==============================================================
// 1. LOGIKA LOGIN
// ==============================================================
if ($action == "login") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek = $koneksi->login($email, $password);

    if ($cek) {
        if ($_SESSION['role'] == 'owner') {
            header("location:dashboard_owner.php");
        } else {
            header("location:dashboard_user.php");
        }
    } else {
        header("location:login.php?pesan=gagal");
    }

// ==============================================================
// 2. LOGIKA REGISTER
// ==============================================================
} elseif ($action == "register") {
    $nama = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $hp = $_POST['no_hp'];
    $pass = $_POST['password'];

    $simpan = $koneksi->register($nama, $email, $hp, $pass);

    if ($simpan) {
        header("location:login.php?pesan=daftar_sukses");
    } else {
        header("location:register.php?pesan=gagal");
    }

// ==============================================================
// 3. LOGIKA LOGOUT
// ==============================================================
} elseif ($action == "logout") {
    session_start();
    session_destroy();
    header("location:login.php");

// ==============================================================
// 4. LOGIKA CRUD KAMAR (OWNER)
// ==============================================================
} elseif ($action == "tambah_kamar") {
    $fasilitas = isset($_POST['fasilitas']) ? implode(", ", $_POST['fasilitas']) : "-";
    $koneksi->tambah_kamar(
        $_POST['nomor_kamar'], $_POST['tipe_kamar'], $_POST['luas_kamar'], 
        $_POST['lantai'], $fasilitas, $_POST['harga_bulanan'], $_FILES['foto_kamar']
    );
    header("location:data_kamar.php");

} elseif ($action == "edit_kamar") {
    $fasilitas = isset($_POST['fasilitas']) ? implode(", ", $_POST['fasilitas']) : "-";
    $koneksi->edit_kamar(
        $_POST['id_kamar'], $_POST['nomor_kamar'], $_POST['tipe_kamar'], 
        $_POST['luas_kamar'], $_POST['lantai'], $fasilitas, 
        $_POST['harga_bulanan'], $_FILES['foto_kamar']
    );
    header("location:data_kamar.php");

} elseif ($action == "hapus_kamar") {
    $koneksi->hapus_kamar($_GET['id']);
    header("location:data_kamar.php");

// ==============================================================
// 5. LOGIKA VERIFIKASI SEWA (OWNER)
// ==============================================================
} elseif ($action == "terima_sewa") {
    $id = $_GET['id'];
    $koneksi->konfirmasi_sewa($id);
    header("location:verifikasi_booking.php");

} elseif ($action == "tolak_sewa") {
    $id = $_GET['id'];
    $koneksi->tolak_sewa($id);
    header("location:verifikasi_booking.php");

// ==============================================================
// 6. LOGIKA BOOKING KAMAR (PENGHUNI) - INI YANG TADI HILANG
// ==============================================================
} elseif ($action == "booking") {
    session_start();
    // Cek apakah user sudah login
    if (!isset($_SESSION['id_user'])) {
        header("location:login.php");
        exit();
    }

    $id_user = $_SESSION['id_user'];
    $id_kamar = $_GET['id_kamar'];
    $harga = $_GET['harga'];

    // Panggil fungsi ajukan_sewa yang ada di koneksi.php
    $koneksi->ajukan_sewa($id_user, $id_kamar, $harga);
    
    // Redirect ke halaman Tagihan user
    header("location:dashboard_user.php?page=tagihan");
}
?>