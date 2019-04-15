<?php
session_start();
include "../../koneksi.php";
$aksi=$_GET['aksi'];
if ($aksi == "simpan"){
	$kode_nasional = $_POST['kode_nasional'];
	if (empty($kode_nasional)){
		$sql = mysqli_query($con, "SELECT max(kode_nas) FROM tbl_mnasional");
		$data = mysqli_fetch_array($sql);
		$kode_nas = $data['max(kode_nas)']+1;
		$nama = explode(" ",$_POST['nama']);
		$pass =base64_encode(strtolower('12345'));
		$inuser = mysqli_query($con, "INSERT INTO tbl_user (username,kode, pass, hak_akses) VALUE ('".strtolower($_POST['email'])."','".$kode_nas."','".$pass."','1')");
		if($inuser){
			$insert = mysqli_query($con, "INSERT INTO tbl_mnasional (kode_nas, nama_nasional, email , status) VALUE ('".$kode_nas."', '".$_POST['nama']."', '".strtolower($_POST['email'])."', 'Aktif')");
			if($insert){
				$_SESSION['notif']='berhasil';
				$_SESSION['pesan'] = 'Penambahan Data Berhasil!';
	    		header('Location:../addmnasional.php');
			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Penambahan Data Gagal!';
	    		header('Location:../addmnasional.php');
			}
		}else{
			$_SESSION['notif']='gagal';
			$_SESSION['pesan'] = 'Penambahan Data Gagal!';
    		header('Location:../addmnasional.php');
		}	
		
	}else{
		$nama = explode(" ",$_POST['nama']);
		$pass =base64_encode(strtolower('12345'));

		if ($_POST['status']=="Aktif"){
			$upuser = mysqli_query($con, "UPDATE tbl_user SET pass='".$pass."',username ='".strtolower($_POST['email'])."' WHERE kode='".$_POST['kode_nasional']."'");
			if($upuser){
				$update = mysqli_query($con, "UPDATE tbl_mnasional SET nama_nasional='".$_POST['nama']."',email ='".strtolower($_POST['email'])."', status = 'Aktif' WHERE kode_nas='".$_POST['kode_nasional']."'");
				if($update){
					$_SESSION['notif']='berhasil';
					$_SESSION['pesan'] = 'Perubahan Data Berhasil!';
		    		header('Location:../addmnasional.php');
				}

			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Perubahan Data Gagal!';
	    		header('Location:../addmnasional.php');
			}
			
			
		}else if ($_POST['status']=="Tidak Aktif"){
			$inuser = mysqli_query($con, "INSERT INTO tbl_user (username,kode, pass, hak_akses) VALUE ('".strtolower($_POST['email'])."','".$_POST['kode_nasional']."','".$pass."','1')");
			if($inuser){
				$update = mysqli_query($con, "UPDATE tbl_mnasional SET nama_nasional='".$_POST['nama']."',email ='".strtolower($_POST['email'])."', status = 'Aktif' WHERE kode_nas='".$_POST['kode_nasional']."'");
				if($update){
					$_SESSION['notif']='berhasil';
					$_SESSION['pesan'] = 'Perubahan Data Berhasil!';
		    		header('Location:../addmnasional.php');
				}else{
					$_SESSION['notif']='gagal';
					$_SESSION['pesan'] = 'Perubahan Data Gagal!';
		    		header('Location:../addmnasional.php');
				}

			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Perubahan Data Gagal!';
	    		header('Location:../addmnasional.php');
			}
		}
	}
} else if ($aksi == "resign"){
	$update = mysqli_query($con, "UPDATE tbl_mnasional SET nama_nasional='',email ='', status ='Tidak Aktif' WHERE kode_nas='".$_GET['kode_nas']."'");
	if($update){
		$deluser=mysqli_query($con, "DELETE FROM tbl_user WHERE kode='".$_GET['kode_nas']."'");
		if($deluser){
			$_SESSION['notif']='berhasil';
			$_SESSION['pesan'] = 'Data Berhasil Berstatus Resign!';
			header('Location:../addmnasional.php');
		}
	}
}
?>