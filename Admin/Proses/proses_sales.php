<?php
session_start();
include "../../koneksi.php";
$aksi=$_GET['aksi'];
if ($aksi == "simpan"){
	$kode_sales = $_POST['kode_sales'];
	if (empty($kode_sales)){
	    $angka=array();
		$sql = mysqli_query($con, "SELECT kode_sales FROM tbl_sales WHERE kode_perwakilan='".$_POST['kode_perwakilan']."'");
		while($data = mysqli_fetch_array($sql)){
		    $kode = explode('.', $data['kode_sales']);
		    $tambah = $kode[3];
		    Array_push($angka,$tambah);
		}
		if(empty($angka)){
			$sales_kode = $_POST['kode_perwakilan'].".1";
		}else{
		    $tambah = max($angka)+1;
			$sales_kode = $_POST['kode_perwakilan'].".".$tambah;
		} 
		
		$nama = explode(" ",$_POST['nama']);
		$pass =base64_encode(strtolower('12345'));
		$inuser = mysqli_query($con, "INSERT INTO tbl_user (username,kode, pass, hak_akses) VALUE ('".strtolower($_POST['email'])."','".$sales_kode."','".$pass."','4')");
		if($inuser){
			$insert = mysqli_query($con, "INSERT INTO tbl_sales (kode_sales, kode_perwakilan, nama_sales, email, jabatan) VALUE ('".$sales_kode."','".$_POST['kode_perwakilan']."', '".$_POST['nama']."', '".strtolower($_POST['email'])."', '".$_POST['jabatan']."')");
			if($insert){
				$_SESSION['notif']='berhasil';
				$_SESSION['pesan'] = 'Penambahan Data Berhasil!';
	    		header('Location:../addsales.php');
			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Penambahan Data Gagal!';
	    		header('Location:../addsales.php');
			}
		}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Penambahan Data Gagal!';
	    		header('Location:../addsales.php');
		}
	}else{
	    $angka=array();
		$sql = mysqli_query($con, "SELECT kode_sales FROM tbl_sales WHERE kode_perwakilan='".$_POST['kode_perwakilan']."'");
		while($data = mysqli_fetch_array($sql)){
		    $kode = explode('.', $data['kode_sales']);
		    $tambah = $kode[3];
		    Array_push($angka,$tambah);
		}
		if(empty($angka)){
			$sales_kode = $_POST['kode_perwakilan'].".1";
		}else{
		    $tambah = max($angka)+1;
			$sales_kode = $_POST['kode_perwakilan'].".".$tambah;
		} 
		$nama = explode(" ",$_POST['nama']);
		$pass =base64_encode(strtolower('12345'));
		$upuser = mysqli_query($con, "UPDATE tbl_user SET kode = '".$sales_kode."', pass='".$pass."',username ='".strtolower($_POST['email'])."' WHERE kode='".$_POST['kode_sales']."'");
		if($upuser){
			$update = mysqli_query($con, "UPDATE tbl_sales SET kode_perwakilan ='".$_POST['kode_perwakilan']."', kode_sales='".$sales_kode."', nama_sales='".$_POST['nama']."',email ='".strtolower($_POST['email'])."', jabatan='".$_POST['jabatan']."' WHERE kode_sales='".$_POST['kode_sales']."'");
			if($update){
				$_SESSION['notif']='berhasil';
				$_SESSION['pesan'] = 'Perubahan Data Berhasil!';
	    		header('Location:../addsales.php');
			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Perubahan Data Gagal!';
	    		header('Location:../addsales.php');
			}
		}else{
			$_SESSION['notif']='gagal';
			$_SESSION['pesan'] = 'Perubahan Data Gagal!';
    		header('Location:../addsales.php');
		}
	}
} else if ($aksi == "resign"){
	$delsales = mysqli_query($con, "DELETE FROM tbl_sales WHERE kode_sales='".$_GET['kode_sales']."'");
	$deluser=mysqli_query($con, "DELETE FROM tbl_user WHERE kode='".$_GET['kode_sales']."'");
	$_SESSION['notif']='berhasil';
	$_SESSION['pesan'] = 'Data Telah Terhapus!';
	header('Location:../addsales.php');
}

?>