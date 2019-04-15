<?php
session_start();
include "../../koneksi.php";
$aksi=$_GET['aksi'];
if ($aksi == "simpan"){
	$kode_guest = $_POST['kode_guest'];
	if (empty($kode_guest)){
		$sql = mysqli_query($con, "SELECT max(kode_guest) FROM tbl_guest");
		$data = mysqli_fetch_array($sql);
		if($data['max(kode_guest)']==NULL){
			$guest_kode='guest_1';
		}else{
			$id = explode("_", $data['max(kode_guest)']);
			$kode = $id[1]+1;
			$guest_kode = "guest_".$kode;

		}
		
		$pass =base64_encode(strtolower('12345'));
		$inuser = mysqli_query($con, "INSERT INTO tbl_user (username,kode, pass, hak_akses) VALUE ('".strtolower($_POST['email'])."','".$guest_kode."','".$pass."','9')");
		if($inuser){
			$insert = mysqli_query($con, "INSERT INTO tbl_guest (kode_guest, nama_guest, email, jabatan) VALUE ('".$guest_kode."','".$_POST['nama']."', '".strtolower($_POST['email'])."', '".$_POST['jabatan']."')");
			if($insert){
				$_SESSION['notif']='berhasil';
				$_SESSION['pesan'] = 'Penambahan Data Berhasil!';
	    		header('Location:../addguest.php');
			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Penambahan Data Gagal!';
	    		header('Location:../addguest.php');
			}
		}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Penambahan Data Gagal!';
	    		header('Location:../addguest.php');
		}
	}else{
		$nama = explode(" ",$_POST['nama']);
		$pass =base64_encode(strtolower('12345'));
		$upuser = mysqli_query($con, "UPDATE tbl_user SET pass='".$pass."',username ='".strtolower($_POST['email'])."' WHERE kode='".$guest_kode."'");
		if($upuser){
			$update = mysqli_query($con, "UPDATE tbl_guest SET kode_guest='".$_POST['kode_guest']."', nama_guest='".$_POST['nama']."',email ='".strtolower($_POST['email'])."', jabatan='".$_POST['jabatan']."' WHERE kode_guest='".$_POST['kode_guest']."'");
			if($update){
				$_SESSION['notif']='berhasil';
				$_SESSION['pesan'] = 'Perubahan Data Berhasil!';
	    		header('Location:../addguest.php');
			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Perubahan Data Gagal!';
	    		header('Location:../addguest.php');
			}
		}else{
			$_SESSION['notif']='gagal';
			$_SESSION['pesan'] = 'Perubahan Data Gagal!';
    		header('Location:../addguest.php');
		}
	}
} else if ($aksi == "resign"){
	$delsales = mysqli_query($con, "DELETE FROM tbl_guest WHERE kode_guest='".$_GET['kode_guest']."'");
	$deluser=mysqli_query($con, "DELETE FROM tbl_user WHERE kode='".$_GET['kode_guest']."'");
	$_SESSION['notif']='berhasil';
	$_SESSION['pesan'] = 'Data Telah Terhapus!';
	header('Location:../addguest.php');
}

?>