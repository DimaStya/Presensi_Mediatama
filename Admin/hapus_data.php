<?php
include("../koneksi.php");
date_default_timezone_set("Asia/Jakarta");
$tanggal= date('d-m-Y', strtotime('-10 days', strtotime( date('d-m-Y') )));
$filter = $tanggal;
$folder = '../images/';
$proses = new RecursiveDirectoryIterator("$folder");
foreach(new RecursiveIteratorIterator($proses) as $file)
{
  if (!((strpos(strtolower($file), $filter)) === false) || empty($filter))
  {
    unlink($file);
  }
}

$nas = mysqli_query($con, "SELECT * FROM tbl_presensimnasional");
while($data_nas=mysqli_fetch_array($nas)){
	if(strtotime($data_nas['tanggal'])<strtotime($tanggal)){
		mysqli_query($con, "DELETE FROM tbl_presensimnasional WHERE kode_nas='".$data_nas['kode_nas']."' AND tanggal='".$data_nas['tanggal']."'");
	}
}
$area = mysqli_query($con, "SELECT * FROM tbl_presensimarea");
while($data_area=mysqli_fetch_array($area)){
	if(strtotime($data_area['tanggal'])<strtotime($tanggal)){
		mysqli_query($con, "DELETE FROM tbl_presensimarea WHERE kode_area='".$data_area['kode_area']."' AND tanggal='".$data_area['tanggal']."'");
	}
}
$kaper = mysqli_query($con, "SELECT * FROM tbl_presensiperwakilan");
while($data_kaper=mysqli_fetch_array($kaper)){
	if(strtotime($data_kaper['tanggal'])<strtotime($tanggal)){
		mysqli_query($con, "DELETE FROM tbl_presensiperwakilan WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."' AND tanggal='".$data_kaper['tanggal']."'");
	}
}
$sales = mysqli_query($con, "SELECT * FROM tbl_presensisales");
while($data_sales=mysqli_fetch_array($sales)){
	if(strtotime($data_sales['tanggal'])<strtotime($tanggal)){
		mysqli_query($con, "DELETE FROM tbl_presensisales WHERE kode_sales='".$data_sales['kode_sales']."' AND tanggal='".$data_sales['tanggal']."'");
	}
}
?>