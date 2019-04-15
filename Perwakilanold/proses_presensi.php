<?php
session_start();
include('../koneksi.php');
$ganbar = "uploadImage";
$folder = "../images/";
date_default_timezone_set("Asia/Jakarta");
$kode_perwakilan = $_POST['kode_perwakilan'];
$keterangan = $_POST['keterangan'];
$tgl =$_POST['tanggal'];
$jam=date('H-i-s');
if(empty($kode_perwakilan)){
	$insert = mysqli_query($con, "INSERT INTO tbl_presensiperwakilan (kode_perwakilan, keterangan, tanggal) VALUE ('".$_SESSION['kode']."','".$keterangan."','".$tgl."')");

	for($x=1; $x<=5; $x++){
		if(!empty($_FILES["uploadImage".$x]['name'])){
			$nama = $tgl."_".$jam."_".$_SESSION['kode']."_".$x;
			mysqli_query($con, "UPDATE tbl_presensiperwakilan SET foto_".$x."='".$nama."' WHERE kode_perwakilan='".$_SESSION['kode']."' AND tanggal='".$tgl."'");
			$upload_image = $_FILES["uploadImage".$x]['name'];
			$width_size = 700;
			$filesave = $folder . $upload_image;
			move_uploaded_file($_FILES["uploadImage".$x]['tmp_name'], $filesave);
			$resize_image = $folder .$nama.".jpg";
			list( $width, $height ) = getimagesize($filesave);
			$k = $width / $width_size;
			$newwidth = $width / $k;
			$newheight = $height / $k;
			$thumb = imagecreatetruecolor($newwidth, $newheight);
			$source = imagecreatefromjpeg($filesave);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagejpeg($thumb, $resize_image);
			imagedestroy($thumb);
			imagedestroy($source);
			unlink($filesave);
		}
	
	}
	$_SESSION['notif']='berhasil';
	$_SESSION['pesan'] = 'Presensi Berhasil Masuk!';
	header('Location:presensi.php');
}else{
	$update = mysqli_query($con, "UPDATE tbl_presensiperwakilan SET keterangan='".$keterangan."' WHERE kode_perwakilan='".$kode_perwakilan."'");
	for($x=1; $x<=5; $x++){
		if(!empty($_FILES["uploadImage".$x]['name'])){
			mysqli_query($con, "UPDATE tbl_presensiperwakilan SET foto_".$x."='".$nama."' WHERE kode_perwakilan='".$_SESSION['kode']."' AND tanggal='".$tgl."'");

			$fot = mysqli_query($con, "SELECT foto_".$x." FROM tbl_presensiperwakilan WHERE kode_perwakilan='".$_SESSION['kode']."' AND tanggal='".$tgl."'");

			$foto=mysqli_fetch_array($fot);

			unlink($folder.$foto['foto_'.$x].".jpg");

			$nama = $tgl."_".$jam."_".$_SESSION['kode']."_".$x;
			mysqli_query($con, "UPDATE tbl_presensiperwakilan SET foto_".$x."='".$nama."' WHERE kode_perwakilan='".$_SESSION['kode']."' AND tanggal='".$tgl."'");

			$upload_image = $_FILES["uploadImage".$x]['name'];
			$width_size = 700;
			$filesave = $folder . $upload_image;
			move_uploaded_file($_FILES["uploadImage".$x]['tmp_name'], $filesave);
			$resize_image = $folder .$nama.".jpg";
			list( $width, $height ) = getimagesize($filesave);
			$k = $width / $width_size;
			$newwidth = $width / $k;
			$newheight = $height / $k;
			$thumb = imagecreatetruecolor($newwidth, $newheight);
			$source = imagecreatefromjpeg($filesave);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagejpeg($thumb, $resize_image);
			imagedestroy($thumb);
			imagedestroy($source);
			unlink($filesave);
		}
	
	}
	$_SESSION['notif']='berhasil';
	$_SESSION['pesan'] = 'Presensi Berhasil Di Update!';
	header('Location:presensi.php');
}

?>