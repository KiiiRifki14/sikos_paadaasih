<?php
session_start();

// Cek Security
if($_SESSION['status'] != "login" || $_SESSION['role'] != "owner"){
    header("location:login.php");
    exit();
}

// Panggil Model
include 'koneksi.php';
$db = new database();

// Ambil Data Booking yang Pending
$data_booking = $db->get_sewa_pending();

// Panggil View
include 'views/verifikasi_booking.php';
?>