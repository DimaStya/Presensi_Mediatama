<?php
session_start();
include ('koneksi.php');

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
if (empty($_SESSION['id_user'])){
    $username = strtolower($_POST['username']);
	$password = base64_encode(strtolower($_POST['password']));
	$query = mysqli_query($con,"select * from tbl_user where username='$username' AND pass='$password'");
    $rows = mysqli_num_rows($query);
    $sql = mysqli_fetch_array($query);
        if ($rows == 1) {
            if ($sql['hak_akses']=='10'){
                $_SESSION['akses'] = $sql['hak_akses'];
                $_SESSION['username'] = $sql['username'];
                header("location: Admin");
            }else if ($sql['hak_akses']=='1'){
                $nas = mysqli_query($con, "SELECT nama_nasional FROM tbl_mnasional WHERE kode_nas='".$sql['kode']."'");
                $data_nas = mysqli_fetch_array($nas);
                $_SESSION['akses'] = $sql['hak_akses'];
                $_SESSION['username'] = $sql['username'];
                $_SESSION['kode'] = $sql['kode'];
                $_SESSION['nama'] = $data_nas['nama_nasional'];
                $_SESSION['jabatan'] = "Manager Nasional";
                header("location: Nasional");
            }else if ($sql['hak_akses']=='2'){
                $nas = mysqli_query($con, "SELECT nama_area FROM tbl_marea WHERE kode_area='".$sql['kode']."'");
                $data_nas = mysqli_fetch_array($nas);
                $_SESSION['akses'] = $sql['hak_akses'];
                $_SESSION['username'] = $sql['username'];
                $_SESSION['kode'] = $sql['kode'];
                $_SESSION['nama'] = $data_nas['nama_area'];
                $_SESSION['jabatan'] = "Manager Area";
                header("location: Area");
            }else if ($sql['hak_akses']=='3'){
                $nas = mysqli_query($con, "SELECT nama_kaper FROM tbl_perwakilan WHERE kode_perwakilan='".$sql['kode']."'");
                $data_nas = mysqli_fetch_array($nas);
                $_SESSION['akses'] = $sql['hak_akses'];
                $_SESSION['username'] = $sql['username'];
                $_SESSION['kode'] = $sql['kode'];
                $_SESSION['nama'] = $data_nas['nama_kaper'];
                $_SESSION['jabatan'] = "Kepala Perwakilan";
                header("location: Perwakilan");
            }else if ($sql['hak_akses']=='4'){
                $nas = mysqli_query($con, "SELECT nama_sales, jabatan FROM tbl_sales WHERE kode_sales='".$sql['kode']."'");
                $data_nas = mysqli_fetch_array($nas);
                $_SESSION['akses'] = $sql['hak_akses'];
                $_SESSION['username'] = $sql['username'];
                $_SESSION['kode'] = $sql['kode'];
                $_SESSION['nama'] = $data_nas['nama_sales'];
                $_SESSION['jabatan'] = $data_nas['jabatan'];
                header("location: Sales");
            }else if ($sql['hak_akses']=='9'){
                $nas = mysqli_query($con, "SELECT nama_guest, jabatan FROM tbl_guest WHERE kode_guest='".$sql['kode']."'");
                $data_nas = mysqli_fetch_array($nas);
                $_SESSION['akses'] = $sql['hak_akses'];
                $_SESSION['kode'] = $sql['kode'];
                $_SESSION['username'] = $sql['username'];
                $_SESSION['nama'] = $data_nas['nama_guest'];
                $_SESSION['jabatan'] = $data_nas['jabatan'];
                header("location: Guest");
            }
        }else {
            header("location: index.php");
        }
}else{
    session_destroy();
    header("location: index.php");
}

         
?>