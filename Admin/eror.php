<?php
		$imagePath = "../images/";

	$reportdetails = array();
		include('../koneksi.php');
		$tanggal= $_POST['tanggal_download'];
		 $no =1;
                $nasional = mysqli_query($con, "SELECT kode_nas, nama_nasional FROM tbl_mnasional");
                while($data_nasional=mysqli_fetch_array($nasional)){
                  $pre_nasional= mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan_1,keterangan_2,keterangan_3,keterangan_4,keterangan_5, tanggal FROM tbl_presensimnasional WHERE kode_nas='".$data_nasional['kode_nas']."' AND tanggal='".$tanggal."'");
                  $num_nasional = mysqli_num_rows($pre_nasional);
                  if($num_nasional==1){
                    $data_pre_nasional = mysqli_fetch_array($pre_nasional);
                    array_push($reportdetails, array('Tanggal' => $data_pre_nasional['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => "------",'Nama' => $data_nasional['nama_nasional'],'Perwakilan' => "-------",'------Kegiatan 1------' => $imagePath . $data_pre_nasional['foto_1'],'------Kegiatan 2------' => $imagePath .  $data_pre_nasional['foto_2'],'------Kegiatan 3------' => $imagePath .  $data_pre_nasional['foto_3'],'------Kegiatan 4------' => $imagePath . $data_pre_nasional['foto_4'],'------Kegiatan 5------' => $imagePath .  $data_pre_nasional['foto_5'], 'keterangan_1' => $data_pre_nasional['keterangan_1'], 'keterangan_2' => $data_pre_nasional['keterangan_2'], 'keterangan_3' => $data_pre_nasional['keterangan_3'], 'keterangan_4' => $data_pre_nasional['keterangan_4'], 'keterangan_5' => $data_pre_nasional['keterangan_5']));
                    $no++;
                  }
                  $area =mysqli_query($con, "SELECT kode_area, nama_area FROM tbl_marea WHERE kode_nas='".$data_nasional['kode_nas']."'");
                  while($data_area=mysqli_fetch_array($area)){
                    $pre_area = mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan_1,keterangan_2,keterangan_3,keterangan_4,keterangan_5, tanggal FROM tbl_presensimarea WHERE kode_area='".$data_area['kode_area']."' AND tanggal='".$tanggal."'");
                    $num_area=mysqli_num_rows($pre_area);
                    if($num_area==1){
                      $data_pre_area = mysqli_fetch_array($pre_area);
                      array_push($reportdetails, array('Tanggal' => $data_pre_area['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Nama' => $data_area['nama_area'],'Perwakilan' => "-------",'------Kegiatan 1------' => $imagePath . $data_pre_area['foto_1'],'------Kegiatan 2------' => $imagePath .  $data_pre_area['foto_2'],'------Kegiatan 3------' => $imagePath .  $data_pre_area['foto_3'],'------Kegiatan 4------' => $imagePath . $data_pre_area['foto_4'],'------Kegiatan 5------' => $imagePath .  $data_pre_area['foto_5'], 'keterangan_1' => $data_pre_area['keterangan_1'], 'keterangan_2' => $data_pre_area['keterangan_2'], 'keterangan_3' => $data_pre_area['keterangan_3'], 'keterangan_4' => $data_pre_area['keterangan_4'], 'keterangan_5' => $data_pre_area['keterangan_5']));
                      $no++;
                    }
                    $kaper = mysqli_query($con, "SELECT kode_perwakilan, nama_kaper, alamat_perwakilan FROM tbl_perwakilan WHERE kode_area='".$data_area['kode_area']."'" );
                    while($data_kaper=mysqli_fetch_array($kaper)){
                      $pre_kaper = mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan_1,keterangan_2,keterangan_3,keterangan_4,keterangan_5, tanggal FROM tbl_presensiperwakilan WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."' AND tanggal='".$tanggal."'");
                      $num_kaper = mysqli_num_rows($pre_kaper);
                      if($num_kaper==1){
                        $data_pre_kaper = mysqli_fetch_array($pre_kaper);
                        array_push($reportdetails, array('Tanggal' => $data_pre_kaper['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Nama' => $data_kaper['nama_kaper'],'Perwakilan' => $data_kaper['alamat_perwakilan'],'------Kegiatan 1------' => $imagePath . $data_pre_kaper['foto_1'],'------Kegiatan 2------' => $imagePath .  $data_pre_kaper['foto_2'],'------Kegiatan 3------' => $imagePath .  $data_pre_kaper['foto_3'],'------Kegiatan 4------' => $imagePath . $data_pre_kaper['foto_4'],'------Kegiatan 5------' => $imagePath .  $data_pre_kaper['foto_5'], 'keterangan_1' => $data_pre_kaper['keterangan_1'], 'keterangan_2' => $data_pre_kaper['keterangan_2'], 'keterangan_3' => $data_pre_kaper['keterangan_3'], 'keterangan_4' => $data_pre_kaper['keterangan_4'], 'keterangan_5' => $data_pre_kaper['keterangan_5']));
                        $no++;
                      }
                      $sales = mysqli_query($con, "SELECT kode_sales, nama_sales FROM tbl_sales WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."'" );
                      while($data_sales=mysqli_fetch_array($sales)){
                        $pre_sales = mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan_1,keterangan_2,keterangan_3,keterangan_4,keterangan_5, tanggal FROM tbl_presensisales WHERE kode_sales='".$data_sales['kode_sales']."' AND tanggal='".$tanggal."'");
                        $num_sales=mysqli_num_rows($pre_sales);
                        if($num_sales==1){
                          $data_pre_sales = mysqli_fetch_array($pre_sales);
                          array_push($reportdetails, array('Tanggal' => $data_pre_sales['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Nama' => $data_sales['nama_sales'],'Perwakilan' => $data_kaper['alamat_perwakilan'],'------Kegiatan 1------' => $imagePath . $data_pre_sales['foto_1'],'------Kegiatan 2------' => $imagePath .  $data_pre_sales['foto_2'],'------Kegiatan 3------' => $imagePath .  $data_pre_sales['foto_3'],'------Kegiatan 4------' => $imagePath . $data_pre_sales['foto_4'],'------Kegiatan 5------' => $imagePath .  $data_pre_sales['foto_5'], 'keterangan_1' => $data_pre_sales['keterangan_1'], 'keterangan_2' => $data_pre_sales['keterangan_2'], 'keterangan_3' => $data_pre_sales['keterangan_3'], 'keterangan_4' => $data_pre_sales['keterangan_4'], 'keterangan_5' => $data_pre_sales['keterangan_5']));
                          $no++;
                        }
                        
                      }
                    }
                  }
                }
	print_r($reportdetails) ;
  ?>