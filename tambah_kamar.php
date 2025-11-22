<?php
session_start();
if($_SESSION['status'] != "login" || $_SESSION['role'] != "owner"){
    header("location:login.php");
    exit();
}
include 'views/tambah_kamar.php';
?>