<?php
include("../koneksi.php");
date_default_timezone_set("Asia/Jakarta");
$nas = mysqli_query($con, "SELECT * FROM tbl_presensimnasional");
while($data_nas=mysqli_fetch_array($nas)){
	$tanggal= date('d-m-Y', strtotime('-10 days', strtotime( date('d-m-Y') )));
	if($data_nas['tanggal']<$tanggal){
		for($x=1; $x<=5; $x++){
			if(file_exists("../images/".$data_nas['foto_'.$x].".jpg")){
				unlink("../images/".$data_nas['foto_'.$x].".jpg");
			}
		}
		mysqli_query($con, "DELETE FROM tbl_presensimnasional WHERE kode_nas='".$data_nas['kode_nas']."' AND tanggal='".$data_nas['tanggal']."'");
	}
}
$area = mysqli_query($con, "SELECT * FROM tbl_presensimarea");
while($data_area=mysqli_fetch_array($area)){
	$tanggal= date('d-m-Y', strtotime('-10 days', strtotime( date('d-m-Y') )));
	if($data_area['tanggal']<$tanggal){
		for($x=1; $x<=5; $x++){
			if(file_exists("../images/".$data_area['foto_'.$x].".jpg")){
				unlink("../images/".$data_area['foto_'.$x].".jpg");
			}
		}
		mysqli_query($con, "DELETE FROM tbl_presensimarea WHERE kode_area='".$data_area['kode_area']."' AND tanggal='".$data_area['tanggal']."'");
	}
}
$kaper = mysqli_query($con, "SELECT * FROM tbl_presensiperwakilan");
while($data_kaper=mysqli_fetch_array($kaper)){
	$tanggal= date('d-m-Y', strtotime('-10 days', strtotime( date('d-m-Y') )));
	if($data_kaper['tanggal']<$tanggal){
		for($x=1; $x<=5; $x++){
			if(file_exists("../images/".$data_kaper['foto_'.$x].".jpg")){
				unlink("../images/".$data_kaper['foto_'.$x].".jpg");
			}
		}
		mysqli_query($con, "DELETE FROM tbl_presensiperwakilan WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."' AND tanggal='".$data_kaper['tanggal']."'");
	}
}
$sales = mysqli_query($con, "SELECT * FROM tbl_presensisales");
while($data_sales=mysqli_fetch_array($sales)){
	$tanggal= date('d-m-Y', strtotime('-10 days', strtotime( date('d-m-Y') )));
	if($data_sales['tanggal']<$tanggal){
		for($x=1; $x<=5; $x++){
			if(file_exists("../images/".$data_sales['foto_'.$x].".jpg")){
				unlink("../images/".$data_sales['foto_'.$x].".jpg");
			}
		}
		mysqli_query($con, "DELETE FROM tbl_presensisales WHERE kode_sales='".$data_sales['kode_sales']."' AND tanggal='".$data_sales['tanggal']."'");
	}
}
?>