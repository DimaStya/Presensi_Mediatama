<?php
session_start();
$_SESSION['tanggal']=$_POST['tanggal_download'];
$_SESSION['tombol'] = $_POST['tombol'];
include('function_tidak.php'); 
my_constants();
xlscreation_direct();
die();
?>