<?php
session_start();
include "../../koneksi.php";
$aksi=$_GET['aksi'];
if ($aksi == "simpan"){
	$kode_perwakilan = $_POST['kode_perwakilan'];
	if (empty($kode_perwakilan)){
		$angka=array();
		$sql = mysqli_query($con, "SELECT kode_perwakilan FROM tbl_perwakilan WHERE kode_area='".$_POST['kode_area']."'");
		while($data = mysqli_fetch_array($sql)){
		    $kode = explode('.', $data['kode_perwakilan']);
		    $tambah = $kode[2];
		    Array_push($angka,$tambah);
		}
		if(max($angka)== null){
			$perwakilan_kode = $_POST['kode_area'].".1";
		}else{
		    $tambah = max($angka)+1;
			$perwakilan_kode = $_POST['kode_area'].".".$tambah;
		} 
		
		$nama = explode(" ",$_POST['nama']);
		$pass =base64_encode(strtolower('12345'));
		$inuser = mysqli_query($con, "INSERT INTO tbl_user (username,kode, pass, hak_akses) VALUE ('".strtolower($_POST['email'])."','".$perwakilan_kode."','".$pass."','3')");
		if($inuser){
			$insert = mysqli_query($con, "INSERT INTO tbl_perwakilan (kode_perwakilan, kode_area, nama_kaper, email, alamat_perwakilan, status) VALUE ('".$perwakilan_kode."','".$_POST['kode_area']."', '".$_POST['nama']."', '".strtolower($_POST['email'])."','".$_POST['alamat_perwakilan']."', 'Aktif')");
			if($insert){
				$_SESSION['notif']='berhasil';
				$_SESSION['pesan'] = 'Penambahan Data Berhasil!';
	    		header('Location:../addkaper.php');
			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Penambahan Data Gagal!';
	    		header('Location:../addkaper.php');
			}
		}else{
			$_SESSION['notif']='gagal';
			$_SESSION['pesan'] = 'Penambahan Data Gagal!';
    		header('Location:../addkaper.php');
		}		
	}else{
	    $angka=array();
		$sql = mysqli_query($con, "SELECT kode_perwakilan FROM tbl_perwakilan WHERE kode_area='".$_POST['kode_area']."'");
		while($data = mysqli_fetch_array($sql)){
		    $kode = explode('.', $data['kode_perwakilan']);
		    $tambah = $kode[2];
		    Array_push($angka,$tambah);
		}
		if(max($angka)== null){
			$perwakilan_kode = $_POST['kode_area'].".1";
		}else{
		    $tambah = max($angka)+1;
			$perwakilan_kode = $_POST['kode_area'].".".$tambah;
		} 
		$nama = explode(" ",$_POST['nama']);
		$pass =base64_encode(strtolower('12345'));

		if ($_POST['status']=="Aktif"){
			$upuser = mysqli_query($con, "UPDATE tbl_user SET kode='".$perwakilan_kode."', pass='".$pass."',username ='".strtolower($_POST['email'])."' WHERE kode='".$_POST['kode_perwakilan']."'");
			if($upuser){
				$update = mysqli_query($con, "UPDATE tbl_perwakilan SET kode_perwakilan='".$perwakilan_kode."',kode_area='".$_POST['kode_area']."', nama_kaper='".$_POST['nama']."',email ='".strtolower($_POST['email'])."',alamat_perwakilan= '".$_POST['alamat_perwakilan']."', status = 'Aktif' WHERE kode_perwakilan='".$_POST['kode_perwakilan']."'");
				if($update){
					$_SESSION['notif']='berhasil';
					$_SESSION['pesan'] = 'Perubahan Data Berhasil!';
		    		header('Location:../addkaper.php');
				}else{
					$_SESSION['notif']='gagal';
					$_SESSION['pesan'] = 'Perubahan Data Gagal!';
		    		//header('Location:../addkaper.php');
				}
			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Perubahan Data Gagal!';
	    		//header('Location:../addkaper.php');
			}
			
			
		}else if ($_POST['status']=="Tidak Aktif"){
			$inuser = mysqli_query($con, "INSERT INTO tbl_user (username,kode, pass, hak_akses) VALUE ('".strtolower($_POST['email'])."','".$_POST['kode_perwakilan']."','".$pass."','3')");
			if($inuser){
				$update = mysqli_query($con, "UPDATE tbl_perwakilan SET kode_area='".$_POST['kode_area']."', nama_kaper='".$_POST['nama']."',email ='".strtolower($_POST['email'])."',alamat_perwakilan= '".$_POST['alamat_perwakilan']."', status = 'Aktif' WHERE kode_perwakilan='".$_POST['kode_perwakilan']."'");
				if($update){
					$_SESSION['notif']='berhasil';
					$_SESSION['pesan'] = 'Perubahan Data Berhasil!';
		    		header('Location:../addkaper.php');
				}else{
					$_SESSION['notif']='gagal';
					$_SESSION['pesan'] = 'Perubahan Data Gagal!';
		    		header('Location:../addkaper.php');
				}

			}else{
				$_SESSION['notif']='gagal';
				$_SESSION['pesan'] = 'Perubahan Data Gagal!';
	    		header('Location:../addkaper.php');
			}
		}
	}
} else if ($aksi == "resign"){
	$update = mysqli_query($con, "UPDATE tbl_perwakilan SET nama_kaper='', email ='', status ='Tidak Aktif' WHERE kode_perwakilan='".$_GET['kode_perwakilan']."'");
	if($update){
		$deluser=mysqli_query($con, "DELETE FROM tbl_user WHERE kode='".$_GET['kode_perwakilan']."'");
		if($deluser){
			$_SESSION['notif']='berhasil';
			$_SESSION['pesan'] = 'Data Berhasil Berstatus Resign!';
			header('Location:../addkaper.php');
		}
	}
}
?>