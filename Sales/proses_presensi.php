<?php
session_start();
if (empty($_SESSION['kode'])){
    header("location: ../index.php");
}
include('../koneksi.php');
$folder = "../images/";
date_default_timezone_set("Asia/Jakarta");
$kode_presensi = $_POST['kode_presensi'];
$keterangan = $_POST['keterangan'];
$tgl =$_POST['tanggal'];
$jam=date('H-i-s');
$jam1=date('H:i:s');
$angka = $_POST['angka'];
if(empty($kode_presensi)){//insert
	    $kode=$tgl."_".$_SESSION['kode'];
        $upload_image = $_FILES["uploadImage"]['name'];
        $width_size = 1000;
        $filesave = $folder . $upload_image;
        move_uploaded_file($_FILES["uploadImage"]['tmp_name'], $filesave);
        list( $width, $height ) = getimagesize($filesave);
        $k = $width / $width_size;
        $newwidth = $width / $k;
        $newheight = $height / $k;
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source =  @ImageCreateFromJpeg($filesave);
        if(! $source){
            $temp = explode(".", $_FILES["uploadImage"]["name"]);
            $nama_baru =$tgl."_".$jam."_".$_SESSION['kode']."_".$angka .'.' . end($temp);
            rename ($filesave, $folder . $nama_baru);
        }else{
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $temp = explode(".", $_FILES["uploadImage"]["name"]);
            $nama_baru =$tgl."_".$jam."_".$_SESSION['kode']."_".$angka . '.' . end($temp);
            imagejpeg($thumb, $folder. $nama_baru);
            imagedestroy($thumb);
            imagedestroy($source);
            unlink($filesave);
        }
        $insert = mysqli_query($con, "INSERT INTO tbl_presensisales (kode_presensi, kode_sales, keterangan_1, tanggal, jam_1, foto_1) VALUE ('".$kode."','".$_SESSION['kode']."','".$keterangan."','".$tgl."','".$jam1."','".$nama_baru."')");

    	if ($insert){
        	$_SESSION['notif']='berhasil';
        	$_SESSION['pesan'] = 'Presensi Berhasil Masuk!';
        	header('Location:presensi.php');
    	}else{
    	    $_SESSION['notif']='gagal';
        	$_SESSION['pesan'] = 'Presensi Gagal Masuk!';
        	header('Location:presensi.php');
    	}
    
}else{
        $upload_image = $_FILES["uploadImage"]['name'];
        $width_size = 1000;
        $filesave = $folder . $upload_image;
        move_uploaded_file($_FILES["uploadImage"]['tmp_name'], $filesave);
        list( $width, $height ) = getimagesize($filesave);
        $k = $width / $width_size;
        $newwidth = $width / $k;
        $newheight = $height / $k;
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source =  @ImageCreateFromJpeg($filesave);
        if(! $source){
            $temp = explode(".", $_FILES["uploadImage"]["name"]);
            $nama_baru =$tgl."_".$jam."_".$_SESSION['kode']."_".$angka .'.' . end($temp);
            rename ($filesave, $folder . $nama_baru);
        }else{
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $temp = explode(".", $_FILES["uploadImage"]["name"]);
            $nama_baru =$tgl."_".$jam."_".$_SESSION['kode']."_".$angka .'.' . end($temp);
            imagejpeg($thumb, $folder. $nama_baru);
            imagedestroy($thumb);
            imagedestroy($source);
            unlink($filesave);
        }
        $update = mysqli_query($con, "UPDATE tbl_presensisales SET keterangan_$angka='$keterangan', jam_$angka='$jam1', foto_$angka='$nama_baru' WHERE kode_presensi='$kode_presensi'");

	
    	if ($update){
        	$_SESSION['notif']='berhasil';
            $_SESSION['pesan'] = 'Presensi Berhasil Di Update!';
            header('Location:presensi.php');
    	}else{
    	    $_SESSION['notif']='gagal';
        	$_SESSION['pesan'] = 'Presensi Gagal Di Update!';
        	header('Location:presensi.php');
    	}

}

?>