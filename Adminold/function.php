<?php

function my_constants(){
	$url = 'http://' . $_SERVER['HTTP_HOST'] . "/";
	$path = $_SERVER['DOCUMENT_ROOT'] . '/';
	define('SITEURL', $url);
	define('SITEPATH', str_replace('\\', '/', $path));
}

function report_details($display = null) {
	
	if($display){
		$imagePath = SITEURL . "images/";
	} else {
		$imagePath = SITEPATH . "images/";
	}	

	$reportdetails = array();
		include('../koneksi.php');
		$tanggal= $_SESSION['tanggal'];
		 $no =1;
                $nasional = mysqli_query($con, "SELECT kode_nas, nama_nasional FROM tbl_mnasional");
                while($data_nasional=mysqli_fetch_array($nasional)){
                  $pre_nasional= mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan, tanggal FROM tbl_presensimnasional WHERE kode_nas='".$data_nasional['kode_nas']."' AND tanggal='".$tanggal."'");
                  $num_nasional = mysqli_num_rows($pre_nasional);
                  if($num_nasional==1){
                    $data_pre_nasional = mysqli_fetch_array($pre_nasional);
                    array_push($reportdetails, array('Tanggal' => $data_pre_nasional['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => "------",'Nama' => $data_nasional['nama_nasional'],'Perwakilan' => "-------",'Kegiatan' => $data_pre_nasional['keterangan'],'------Foto_1------' => $imagePath . $data_pre_nasional['foto_1'].".jpg",'------Foto_2------' => $imagePath .  $data_pre_nasional['foto_2'].".jpg",'------Foto_3------' => $imagePath .  $data_pre_nasional['foto_3'].".jpg",'------Foto_4------' => $imagePath . $data_pre_nasional['foto_4'].".jpg",'------Foto_5------' => $imagePath .  $data_pre_nasional['foto_5'].".jpg"));
                    $no++;
                  }
                  $area =mysqli_query($con, "SELECT kode_area, nama_area FROM tbl_marea WHERE kode_nas='".$data_nasional['kode_nas']."'");
                  while($data_area=mysqli_fetch_array($area)){
                    $pre_area = mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan, tanggal FROM tbl_presensimarea WHERE kode_area='".$data_area['kode_area']."' AND tanggal='".$tanggal."'");
                    $num_area=mysqli_num_rows($pre_area);
                    if($num_area==1){
                      $data_pre_area = mysqli_fetch_array($pre_area);
                      array_push($reportdetails, array('Tanggal' => $data_pre_area['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Nama' => $data_area['nama_area'],'Perwakilan' => "-------",'Kegiatan' => $data_pre_area['keterangan'],'------Foto_1------' => $imagePath . $data_pre_area['foto_1'].".jpg",'------Foto_2------' => $imagePath .  $data_pre_area['foto_2'].".jpg",'------Foto_3------' => $imagePath .  $data_pre_area['foto_3'].".jpg",'------Foto_4------' => $imagePath . $data_pre_area['foto_4'].".jpg",'------Foto_5------' => $imagePath .  $data_pre_area['foto_5'].".jpg"));
                      $no++;
                    }
                    $kaper = mysqli_query($con, "SELECT kode_perwakilan, nama_kaper, alamat_perwakilan FROM tbl_perwakilan WHERE kode_area='".$data_area['kode_area']."'" );
                    while($data_kaper=mysqli_fetch_array($kaper)){
                      $pre_kaper = mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan, tanggal FROM tbl_presensiperwakilan WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."' AND tanggal='".$tanggal."'");
                      $num_kaper = mysqli_num_rows($pre_kaper);
                      if($num_kaper==1){
                        $data_pre_kaper = mysqli_fetch_array($pre_kaper);
                        array_push($reportdetails, array('Tanggal' => $data_pre_kaper['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Nama' => $data_kaper['nama_kaper'],'Perwakilan' => $data_kaper['alamat_perwakilan'],'Kegiatan' => $data_pre_kaper['keterangan'],'------Foto_1------' => $imagePath . $data_pre_kaper['foto_1'].".jpg",'------Foto_2------' => $imagePath .  $data_pre_kaper['foto_2'].".jpg",'------Foto_3------' => $imagePath .  $data_pre_kaper['foto_3'].".jpg",'------Foto_4------' => $imagePath . $data_pre_kaper['foto_4'].".jpg",'------Foto_5------' => $imagePath .  $data_pre_kaper['foto_5'].".jpg"));
                        $no++;
                      }
                      $sales = mysqli_query($con, "SELECT kode_sales, nama_sales FROM tbl_sales WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."'" );
                      while($data_sales=mysqli_fetch_array($sales)){
                        $pre_sales = mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan, tanggal FROM tbl_presensisales WHERE kode_sales='".$data_sales['kode_sales']."' AND tanggal='".$tanggal."'");
                        $num_sales=mysqli_num_rows($pre_sales);
                        if($num_sales==1){
                          $data_pre_sales = mysqli_fetch_array($pre_sales);
                          array_push($reportdetails, array('Tanggal' => $data_pre_sales['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Nama' => $data_sales['nama_sales'],'Perwakilan' => $data_kaper['alamat_perwakilan'],'Kegiatan' => $data_pre_sales['keterangan'],'------Foto_1------' => $imagePath . $data_pre_sales['foto_1'].".jpg",'------Foto_2------' => $imagePath .  $data_pre_sales['foto_2'].".jpg",'------Foto_3------' => $imagePath .  $data_pre_sales['foto_3'].".jpg",'------Foto_4------' => $imagePath . $data_pre_sales['foto_4'].".jpg",'------Foto_5------' => $imagePath .  $data_pre_sales['foto_5'].".jpg"));
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
		'A' => 'Tanggal',
		'B' => 'No',
		'C' => 'Manager Nasional',
		'D' => 'Manager Area',
		'E' => 'Perwakilan',
		'F' => 'Nama',
		'G' => 'Kegiatan',
		'H' => '------Foto_1------',
		'I' => '------Foto_2------',
		'J' => '------Foto_3------',
		'K' => '------Foto_4------',
		'L' => '------Foto_5------'
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

			$objPHPExcel->getActiveSheet()->getRowDimension($rowCount + 2)->setRowHeight(70); 
			
			switch ($value) {
				case '------Foto_1------':
					if (file_exists($reportdetails[$rowCount][$value])) {
				        $objDrawing = new PHPExcel_Worksheet_Drawing();
				        $objDrawing->setName('Customer Signature');
				        $objDrawing->setDescription('Customer Signature');
				        //Path to signature .jpg file
				        $signature = $reportdetails[$rowCount][$value];    
				        $objDrawing->setPath($signature);
				        $objDrawing->setOffsetX(25);                     //setOffsetX works properly
				        $objDrawing->setOffsetY(10);                     //setOffsetY works properly
				        $objDrawing->setCoordinates($column.$cell);             //set image to cell 
				        $objDrawing->setWidth(70);  
				        $objDrawing->setHeight(70);                     //signature height  
				        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save 
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, "" ); 
				    }
				    break;
				case '------Foto_2------':
					if (file_exists($reportdetails[$rowCount][$value])) {
				        $objDrawing = new PHPExcel_Worksheet_Drawing();
				        $objDrawing->setName('Customer Signature');
				        $objDrawing->setDescription('Customer Signature');
				        //Path to signature .jpg file
				        $signature = $reportdetails[$rowCount][$value];    
				        $objDrawing->setPath($signature);
				        $objDrawing->setOffsetX(25);                     //setOffsetX works properly
				        $objDrawing->setOffsetY(10);                     //setOffsetY works properly
				        $objDrawing->setCoordinates($column.$cell);             //set image to cell 
				        $objDrawing->setWidth(70);  
				        $objDrawing->setHeight(70);                     //signature height  
				        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save 
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, "" ); 
				    }
				    break;
			    case '------Foto_3------':
					if (file_exists($reportdetails[$rowCount][$value])) {
				        $objDrawing = new PHPExcel_Worksheet_Drawing();
				        $objDrawing->setName('Customer Signature');
				        $objDrawing->setDescription('Customer Signature');
				        //Path to signature .jpg file
				        $signature = $reportdetails[$rowCount][$value];    
				        $objDrawing->setPath($signature);
				        $objDrawing->setOffsetX(25);                     //setOffsetX works properly
				        $objDrawing->setOffsetY(10);                     //setOffsetY works properly
				        $objDrawing->setCoordinates($column.$cell);             //set image to cell 
				        $objDrawing->setWidth(70);  
				        $objDrawing->setHeight(70);                     //signature height  
				        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save 
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, "" ); 
				    }
				    break;
			    case '------Foto_4------':
					if (file_exists($reportdetails[$rowCount][$value])) {
				        $objDrawing = new PHPExcel_Worksheet_Drawing();
				        $objDrawing->setName('Customer Signature');
				        $objDrawing->setDescription('Customer Signature');
				        //Path to signature .jpg file
				        $signature = $reportdetails[$rowCount][$value];    
				        $objDrawing->setPath($signature);
				        $objDrawing->setOffsetX(25);                     //setOffsetX works properly
				        $objDrawing->setOffsetY(10);                     //setOffsetY works properly
				        $objDrawing->setCoordinates($column.$cell);             //set image to cell 
				        $objDrawing->setWidth(70);  
				        $objDrawing->setHeight(70);                     //signature height  
				        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save 
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, "" ); 
				    }
				    break;
			    case '------Foto_5------':
					if (file_exists($reportdetails[$rowCount][$value])) {
				        $objDrawing = new PHPExcel_Worksheet_Drawing();
				        $objDrawing->setName('Customer Signature');
				        $objDrawing->setDescription('Customer Signature');
				        //Path to signature .jpg file
				        $signature = $reportdetails[$rowCount][$value];    
				        $objDrawing->setPath($signature);
				        $objDrawing->setOffsetX(25);                     //setOffsetX works properly
				        $objDrawing->setOffsetY(10);                     //setOffsetY works properly
				        $objDrawing->setCoordinates($column.$cell);             //set image to cell 
				        $objDrawing->setWidth(70);  
				        $objDrawing->setHeight(70);                     //signature height  
				        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save 
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, "" ); 
				    }
				    break;
				default:
					$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount][$value] ); 
					break;
			}

		}
			
	    $rowCount++; 
	} 

	$fileName = "Kehadiran_" . $_SESSION['tanggal'] . ".xlsx";

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="'.$fileName.'"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
    die();
}

/**
* Create excel by from ajax request
*/


?>