<?php
session_start();

// Cek Security
if($_SESSION['status'] != "login" || $_SESSION['role'] != "owner"){
    header("location:login.php?pesan=belum_login");
    exit();
}

// Panggil Model
include 'koneksi.php';
$db = new database();

// Ambil data kamar dari database
$data_kamar = $db->tampil_kamar();

// Tampilkan View
include 'views/data_kamar.php';
?>