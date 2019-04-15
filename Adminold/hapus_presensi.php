<?php
session_start();
if(!empty($_SESSION['username'])){
  if($_SESSION['akses'] != '10'){
    header("location: ../blank");
  }
}
include('../koneksi.php');
$query = mysqli_query($con, "DELETE FROM tbl_presensisales");
$query1 = mysqli_query($con, "DELETE FROM tbl_presensiperwakilan");
$files = glob('../images/*'); 
foreach($files as $file){ 

  if(is_file($file))

    unlink($file);

}
$_SESSION['pesan'] = 'Data Presensi Telah terhapus';
header('Location:presensi.php');

?>