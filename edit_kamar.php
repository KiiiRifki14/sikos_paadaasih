<?php
session_start();

// 1. Cek Security
if($_SESSION['status'] != "login" || $_SESSION['role'] != "owner"){
    header("location:login.php");
    exit();
}

// 2. Panggil Model
include 'koneksi.php';
$db = new database();

// 3. Ambil ID dari URL (edit_kamar.php?id=1)
$id_kamar = $_GET['id'];

// 4. Ambil Data Lama dari Database (untuk ditampilkan di form)
$data = $db->ambil_data_kamar_by_id($id_kamar);

// 5. Panggil View
include 'views/edit_kamar.php';
?>