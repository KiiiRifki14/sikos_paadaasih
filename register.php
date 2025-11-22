<?php
session_start();
// Jika sudah login, lempar ke dashboard
if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){
    if($_SESSION['role'] == 'owner'){
        header("location:dashboard_owner.php");
    } else {
        header("location:dashboard_user.php");
    }
}
// Panggil View
include 'views/register.php';
?>