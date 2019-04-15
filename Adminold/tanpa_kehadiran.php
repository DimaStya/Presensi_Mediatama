<?php
session_start();
$_SESSION['tanggal']=$_POST['tanggal_download'];
include('function_tidak.php'); 
my_constants();
xlscreation_direct();
die();
?>