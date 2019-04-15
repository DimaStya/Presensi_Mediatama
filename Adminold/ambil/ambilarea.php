<?php
include('../../koneksi.php');
$kode_nas = $_GET['kode_nas'];
$kelas = mysqli_query($con, "SELECT kode_area, nama_area FROM tbl_marea WHERE kode_nas= '".$kode_nas."'");
echo "<option>--Pilih Nama Manajer Area--</option>";
while($k = mysqli_fetch_array($kelas)){
   echo "<option value=\"".$k['kode_area']."\">".$k['nama_area']."</option>\n";
}
?>