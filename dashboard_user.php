<?php
session_start();
// Cek Security
if($_SESSION['status'] != "login" || $_SESSION['role'] != "penghuni"){
    header("location:login.php");
    exit();
}

include 'koneksi.php';
$db = new database();

// Ambil Data User dari Session
$id_user = $_SESSION['id_user'];
$nama_lengkap = $_SESSION['nama_lengkap'];

// Ambil Data Pendukung
$kamar_saya = $db->get_kamar_penghuni($id_user);
$tagihan_pending = $db->hitung_tagihan_pending($id_user);

// Routing Halaman Sederhana
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

if($page == 'dashboard') {
    include 'views/user/dashboard.php';
} elseif($page == 'profil') {
    $user_data = $db->get_user($id_user); // Ambil data detail user
    include 'views/user/profil.php';
} elseif($page == 'kamar') {
    include 'views/user/kamar_saya.php';
} elseif($page == 'tagihan') {
    $list_tagihan = $db->get_tagihan_user($id_user);
    include 'views/user/tagihan.php';
} else {
    include 'views/user/dashboard.php';
}
?>