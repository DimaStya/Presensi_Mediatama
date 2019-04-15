<?php
session_start();
include "../../koneksi.php";
$aksi=$_GET['aksi'];
if ($aksi == "simpan"){
	$kode_area = $_POST['kode_area'];
	if (empty($kode_area)){
		$sql = mysqli_query($con, "SELECT max(kode_area) FROM tbl_marea WHERE kode_nas='".$_POST['kode_nas']."'");
		$data = mysqli_fetch_array($sql);
		if($data['max(kode_area)']== null){
			$area_kode = $_POST['kode_nas'].".1";
		}else{
			$kode = explode('.', $data['max(kode_area)']);
			$tambah = $kode[1]+1;
			$area_kode = $_POST['kode_nas'].".".$tambah;
		}
		
		$nama = explode(" ",$_POST['nama']);
		$pass =base64_encode(strtolower('12345'));
		$inuser = mysqli_query($con, "INSERT INTO tbl_user (username,kode, pass, hak_akses) VALUE ('".strtolower($_POST['email'])."','".$area_kode."','".$pass."','2')");
		if($inuser){
			$insert = mysqli_query($con, "INSERT INTO tbl_marea (kode_area, kode_nas, nama_area, email , status) VALUE ('".$area_kode."','".$_POST['kode_nas']."', '".$_POST['nama']."', '".strtolower($_POST['email'])."', 'Aktif')");
			if($insert){
				$_SESSION['notif']='berhasil';
				$_SESSION['pesan'] = 'Penambahan Data Berhasil!';
	    		header('Location:../addmarea.php');
			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Penambahan Data Gagal!';
	    		header('Location:../addmarea.php');
			}
		}else{
			$_SESSION['notif']='gagal';
			$_SESSION['pesan'] = 'Penambahan Data Gagal!';
    		header('Location:../addmarea.php');
		}		
	}else{
	    $sql = mysqli_query($con, "SELECT max(kode_area) FROM tbl_marea WHERE kode_nas='".$_POST['kode_nas']."'");
		$data = mysqli_fetch_array($sql);
		if($data['max(kode_area)']== null){
			$area_kode = $_POST['kode_nas'].".1";
		}else{
			$kode = explode('.', $data['max(kode_area)']);
			$tambah = $kode[1]+1;
			$area_kode = $_POST['kode_nas'].".".$tambah;
		}
		$nama = explode(" ",$_POST['nama']);
		$pass =base64_encode(strtolower('12345'));

		if ($_POST['status']=="Aktif"){
			$upuser = mysqli_query($con, "UPDATE tbl_user SET kode='".$area_kode."', pass='".$pass."',username ='".strtolower($_POST['email'])."' WHERE kode='".$_POST['kode_area']."'");
			if($upuser){
				$update = mysqli_query($con, "UPDATE tbl_marea SET kode_area='".$area_kode."', kode_nas='".$_POST['kode_nas']."',nama_area='".$_POST['nama']."',email ='".strtolower($_POST['email'])."', status = 'Aktif' WHERE kode_area='".$_POST['kode_area']."'");
				if($update){
					$_SESSION['notif']='berhasil';
					$_SESSION['pesan'] = 'Perubahan Data Berhasil!';
		    		header('Location:../addmarea.php');
				}else{
					$_SESSION['notif']='gagal';
					$_SESSION['pesan'] = 'Perubahan Data Gagal!';
		    		header('Location:../addmarea.php');
				}

			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Perubahan Data Gagal!';
	    		header('Location:../addmarea.php');
			}			
		}else if ($_POST['status']=="Tidak Aktif"){
			$inuser = mysqli_query($con, "INSERT INTO tbl_user (username,kode, pass, hak_akses) VALUE ('".strtolower($_POST['email'])."','".$_POST['kode_area']."','".$pass."','2')");
			if($inuser){
				$update = mysqli_query($con, "UPDATE tbl_marea SET nama_area='".$_POST['nama']."',email ='".strtolower($_POST['email'])."', status = 'Aktif' WHERE kode_area='".$_POST['kode_area']."'");
				if($update){
					$_SESSION['notif']='berhasil';
					$_SESSION['pesan'] = 'Perubahan Data Berhasil!';
		    		header('Location:../addmarea.php');
				}else{
					$_SESSION['notif']='gagal';
					$_SESSION['pesan'] = 'Perubahan Data Gagal!';
		    		header('Location:../addmarea.php');
				}

			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Perubahan Data Gagal!';
	    		header('Location:../addmarea.php');
			}
		}
	}
} else if ($aksi == "resign"){
	$update = mysqli_query($con, "UPDATE tbl_marea SET nama_area='',email ='', status ='Tidak Aktif' WHERE kode_area='".$_GET['kode_area']."'");
	if($update){
		$deluser=mysqli_query($con, "DELETE FROM tbl_user WHERE kode='".$_GET['kode_area']."'");
		if($deluser){
			$_SESSION['notif']='berhasil';
			$_SESSION['pesan'] = 'Data Berhasil Berstatus Resign!';
			header('Location:../addmarea.php');
		}
	}
}
?>