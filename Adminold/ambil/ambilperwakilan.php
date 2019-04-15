<?php
include('../../koneksi.php');
$kode_area = $_GET['kode_area'];
$kelas = mysqli_query($con, "SELECT kode_perwakilan, alamat_perwakilan FROM tbl_perwakilan WHERE kode_area= '".$kode_area."'");
echo "<option>--Pilih Daerah Perwakilan--</option>";
while($k = mysqli_fetch_array($kelas)){
   echo "<option value=\"".$k['kode_perwakilan']."\">".$k['alamat_perwakilan']."</option>\n";
}
?>