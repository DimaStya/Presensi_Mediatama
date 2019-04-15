<?php

function my_constants(){
	$url = 'http://' . $_SERVER['HTTP_HOST'] . "/Presensi_MDT/";
	$path = $_SERVER['DOCUMENT_ROOT'] . '/Presensi_MDT/';
	define('SITEURL', $url);
	define('SITEPATH', str_replace('\\', '/', $path));
}

function report_details($display = null) {

	$reportdetails = array();
	include('../koneksi.php');
	$tanggal= $_SESSION['tanggal'];
		$no =1;
                $nasional = mysqli_query($con, "SELECT status, kode_nas, nama_nasional FROM tbl_mnasional WHERE posisi='".$_SESSION['tombol']."'");
                while($data_nasional=mysqli_fetch_array($nasional)){
                  if($data_nasional['status']=='Aktif'){
                    $pre_nasional= mysqli_query($con, "SELECT tbl_mnasional.status FROM tbl_presensimnasional, tbl_mnasional WHERE tbl_presensimnasional.kode_nas='".$data_nasional['kode_nas']."' AND tbl_presensimnasional.tanggal='".$tanggal."'");
                    $num_nasional = mysqli_num_rows($pre_nasional);
                    if($num_nasional==0){
                      $data_pre_nasional = mysqli_fetch_array($pre_nasional);
                      array_push($reportdetails, array('No' => $no,'Nama' => $data_nasional['nama_nasional'],'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => "------",'Alamat_perwakilan' =>"------",'Tanggal' => $tanggal));
                      $no++;
                    }
                  }
                  
                  $area =mysqli_query($con, "SELECT status, kode_area, nama_area FROM tbl_marea WHERE kode_nas='".$data_nasional['kode_nas']."'");
                  while($data_area=mysqli_fetch_array($area)){
                    if($data_area['status']=='Aktif'){
                      $pre_area = mysqli_query($con, "SELECT tbl_marea.status FROM tbl_presensimarea, tbl_marea WHERE tbl_marea.status='Aktif' AND tbl_presensimarea.kode_area='".$data_area['kode_area']."' AND tbl_presensimarea.tanggal='".$tanggal."'");
                      $num_area=mysqli_num_rows($pre_area);
                      if($num_area==0){
                        $data_pre_area = mysqli_fetch_array($pre_area);
                        array_push($reportdetails, array('No' => $no,'Nama' => $data_area['nama_area'],'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Alamat_perwakilan' =>"------",'Tanggal' => $tanggal));
                        $no++;
                      }
                    }
                    
                    $kaper = mysqli_query($con, "SELECT status, kode_perwakilan, nama_kaper, alamat_perwakilan FROM tbl_perwakilan WHERE kode_area='".$data_area['kode_area']."'" );
                    while($data_kaper=mysqli_fetch_array($kaper)){
                      if($data_kaper['status']=='Aktif' ){
                        $pre_kaper = mysqli_query($con, "SELECT tbl_presensiperwakilan.kode_perwakilan, tbl_perwakilan.status FROM tbl_presensiperwakilan, tbl_perwakilan WHERE tbl_perwakilan.kode_perwakilan=tbl_presensiperwakilan.kode_perwakilan AND tbl_presensiperwakilan.kode_perwakilan='".$data_kaper['kode_perwakilan']."' AND tbl_presensiperwakilan.tanggal='".$tanggal."'");
                        $num_kaper = mysqli_num_rows($pre_kaper);
                        if($num_kaper==0  && $_SESSION['tombol'] == 'Management'){
                          $data_pre_kaper = mysqli_fetch_array($pre_kaper);
                          array_push($reportdetails, array('No' => $no,'Nama' => $data_kaper['nama_kaper'],'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Alamat_perwakilan' =>$data_kaper['alamat_perwakilan'],'Tanggal' => $tanggal));
                          $no++;
                        }
                      }
                      
                      $sales = mysqli_query($con, "SELECT kode_sales, nama_sales FROM tbl_sales WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."'" );
                      while($data_sales=mysqli_fetch_array($sales)){
                        $pre_sales = mysqli_query($con, "SELECT  tanggal FROM tbl_presensisales WHERE kode_sales='".$data_sales['kode_sales']."' AND tanggal='".$tanggal."'");
                        $num_sales=mysqli_num_rows($pre_sales);
                        if($num_sales==0){
                          $data_pre_sales = mysqli_fetch_array($pre_sales);
                          array_push($reportdetails, array('No' => $no,'Nama' => $data_sales['nama_sales'],'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Alamat_perwakilan' =>$data_kaper['alamat_perwakilan'],'Tanggal' => $tanggal));
                          $no++;
                        }
                        
                      }
                    }
                  }
                }
	return $reportdetails;

}
/**
* Create excel by from direct request
*/
function xlscreation_direct() {

	$reportdetails = report_details();

	require_once SITEPATH . 'PHPExcel/Classes/PHPExcel.php';

 	$objPHPExcel = new PHPExcel(); 
	$objPHPExcel->getProperties()
			->setCreator("user")
    		->setLastModifiedBy("user")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Test result file");

	// Set the active Excel worksheet to sheet 0
	$objPHPExcel->setActiveSheetIndex(0); 

	// Initialise the Excel row number
	$rowCount = 0; 

	// Sheet cells
	$cell_definition = array(
		'A' => 'No',
		'B' => 'Nama',
		'C' => 'Manager Nasional',
		'D' => 'Manager Area',
		'E' => 'Alamat_perwakilan',
		'F' => 'Tanggal'
	);

	// Build headers
	foreach( $cell_definition as $column => $value )
	{
		$objPHPExcel->getActiveSheet()->getColumnDimension("{$column}")->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->setCellValue( "{$column}1", $value ); 
	}

	// Build cells
	while( $rowCount < count($reportdetails) ){ 
		$cell = $rowCount + 2;
		foreach( $cell_definition as $column => $value ) {

			$objPHPExcel->getActiveSheet()->getRowDimension($rowCount + 2)->setRowHeight(15); 
			
			switch ($value) {
				default:
					$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount][$value] ); 
					break;
			}

		}
			
	    $rowCount++; 
	} 

	
	
	$fileName = $_SESSION['tombol']."_" ."Tidak_hadir_" . $_SESSION['tanggal'] . ".xlsx";

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="'.$fileName.'"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
    die();
}


?>