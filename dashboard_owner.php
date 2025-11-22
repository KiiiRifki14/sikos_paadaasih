<?php
session_start();

// 1. Cek Security (Login & Role)
if($_SESSION['status'] != "login" || $_SESSION['role'] != "owner"){
    header("location:login.php?pesan=belum_login");
    exit();
}

// 2. Panggil Model Database
include 'koneksi.php';
$db = new database();

// 3. Siapkan Data untuk Tampilan (Logic)
$nama_lengkap  = $_SESSION['nama_lengkap']; // Data dari session
$total_kamar   = $db->hitung_kamar();       // Data dari database
$kamar_terisi  = $db->hitung_kamar_terisi();
$pending_bayar = $db->hitung_pending_bayar();

// 4. Panggil Tampilan (View)
// Kita kirim variabel di atas ke file HTML
include 'views/dashboard_owner.php';

?>