<?php

function my_constants(){
	$url = 'http://' . $_SERVER['HTTP_HOST'] . "/Presensi_MDT/";
	$path = $_SERVER['DOCUMENT_ROOT'] . '/Presensi_MDT/';
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
                $nasional = mysqli_query($con, "SELECT kode_nas, nama_nasional FROM tbl_mnasional WHERE posisi='".$_SESSION['tombol']."'");
                while($data_nasional=mysqli_fetch_array($nasional)){
                  $pre_nasional= mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan_1,keterangan_2,keterangan_3,keterangan_4,keterangan_5, tanggal, jam_1, jam_2, jam_3, jam_4, jam_5 FROM tbl_presensimnasional WHERE kode_nas='".$data_nasional['kode_nas']."' AND tanggal='".$tanggal."'");
                  $num_nasional = mysqli_num_rows($pre_nasional);
                  if($num_nasional==1){
                    $data_pre_nasional = mysqli_fetch_array($pre_nasional);
                    if($data_pre_nasional['foto_1']!=''){
                          	$gambar1 =  $imagePath .  $data_pre_nasional['foto_1'];
                          }else{
                          	$gambar1 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_nasional['foto_2']!=''){
                          	$gambar2 =  $imagePath .  $data_pre_nasional['foto_2'];
                          }else{
                          	$gambar2 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_nasional['foto_3']!=''){
                          	$gambar3 =  $imagePath .  $data_pre_nasional['foto_3'];
                          }else{
                          	$gambar3 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_nasional['foto_4']!=''){
                          	$gambar4 =  $imagePath .  $data_pre_nasional['foto_4'];
                          }else{
                          	$gambar4 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_nasional['foto_5']!=''){
                          	$gambar5 =  $imagePath .  $data_pre_nasional['foto_5'];
                          }else{
                          	$gambar5 ='errrrroooorrrr.jpg';
                          }
                    array_push($reportdetails, array('Tanggal' => $data_pre_nasional['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => "------",'Nama' => $data_nasional['nama_nasional'],'Perwakilan' => "-------",'------Kegiatan 1------' => $gambar1,'------Kegiatan 2------' => $gambar2,'------Kegiatan 3------' =>$gambar3,'------Kegiatan 4------' => $gambar4,'------Kegiatan 5------' => $gambar5, 'keterangan_1' => $data_pre_nasional['keterangan_1'], 'keterangan_2' => $data_pre_nasional['keterangan_2'], 'keterangan_3' => $data_pre_nasional['keterangan_3'], 'keterangan_4' => $data_pre_nasional['keterangan_4'], 'keterangan_5' => $data_pre_nasional['keterangan_5'], 'jam_1' => $data_pre_nasional['jam_1'], 'jam_2' => $data_pre_nasional['jam_2'], 'jam_3' => $data_pre_nasional['jam_3'], 'jam_4' => $data_pre_nasional['jam_4'], 'jam_5' => $data_pre_nasional['jam_5']));
                    $no++;
                  }
                  $area =mysqli_query($con, "SELECT kode_area, nama_area FROM tbl_marea WHERE kode_nas='".$data_nasional['kode_nas']."'");
                  while($data_area=mysqli_fetch_array($area)){
                    $pre_area = mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan_1,keterangan_2,keterangan_3,keterangan_4,keterangan_5, tanggal,jam_1, jam_2, jam_3, jam_4, jam_5 FROM tbl_presensimarea WHERE kode_area='".$data_area['kode_area']."' AND tanggal='".$tanggal."'");
                    $num_area=mysqli_num_rows($pre_area);
                    if($num_area==1){
                      $data_pre_area = mysqli_fetch_array($pre_area);
                      if($data_pre_area['foto_1']!=''){
                          	$gambar1 =  $imagePath .  $data_pre_area['foto_1'];
                          }else{
                          	$gambar1 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_area['foto_2']!=''){
                          	$gambar2 =  $imagePath .  $data_pre_area['foto_2'];
                          }else{
                          	$gambar2 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_area['foto_3']!=''){
                          	$gambar3 =  $imagePath .  $data_pre_area['foto_3'];
                          }else{
                          	$gambar3 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_area['foto_4']!=''){
                          	$gambar4 =  $imagePath .  $data_pre_area['foto_4'];
                          }else{
                          	$gambar4 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_area['foto_5']!=''){
                          	$gambar5 =  $imagePath .  $data_pre_area['foto_5'];
                          }else{
                          	$gambar5 ='errrrroooorrrr.jpg';
                          }
                      array_push($reportdetails, array('Tanggal' => $data_pre_area['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Nama' => $data_area['nama_area'],'Perwakilan' => "-------",'------Kegiatan 1------' => $gambar1,'------Kegiatan 2------' => $gambar2,'------Kegiatan 3------' => $gambar3,'------Kegiatan 4------' => $gambar4,'------Kegiatan 5------' => $gambar5, 'keterangan_1' => $data_pre_area['keterangan_1'], 'keterangan_2' => $data_pre_area['keterangan_2'], 'keterangan_3' => $data_pre_area['keterangan_3'], 'keterangan_4' => $data_pre_area['keterangan_4'], 'keterangan_5' => $data_pre_area['keterangan_5'], 'jam_1' => $data_pre_area['jam_1'], 'jam_2' => $data_pre_area['jam_2'], 'jam_3' => $data_pre_area['jam_3'], 'jam_4' => $data_pre_area['jam_4'], 'jam_5' => $data_pre_area['jam_5']));
                      $no++;
                    }
                    $kaper = mysqli_query($con, "SELECT kode_perwakilan, nama_kaper, alamat_perwakilan FROM tbl_perwakilan WHERE kode_area='".$data_area['kode_area']."'" );
                    while($data_kaper=mysqli_fetch_array($kaper)){
                      $pre_kaper = mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan_1,keterangan_2,keterangan_3,keterangan_4,keterangan_5, tanggal, jam_1, jam_2, jam_3, jam_4, jam_5 FROM tbl_presensiperwakilan WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."' AND tanggal='".$tanggal."'");
                      $num_kaper = mysqli_num_rows($pre_kaper);
                      if($num_kaper==1){
                        $data_pre_kaper = mysqli_fetch_array($pre_kaper);
                        if($data_pre_kaper['foto_1']!=''){
                          	$gambar1 =  $imagePath .  $data_pre_kaper['foto_1'];
                          }else{
                          	$gambar1 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_kaper['foto_2']!=''){
                          	$gambar2 =  $imagePath .  $data_pre_kaper['foto_2'];
                          }else{
                          	$gambar2 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_kaper['foto_3']!=''){
                          	$gambar3 =  $imagePath .  $data_pre_kaper['foto_3'];
                          }else{
                          	$gambar3 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_kaper['foto_4']!=''){
                          	$gambar4 =  $imagePath .  $data_pre_kaper['foto_4'];
                          }else{
                          	$gambar4 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_kaper['foto_5']!=''){
                          	$gambar5 =  $imagePath .  $data_pre_kaper['foto_5'];
                          }else{
                          	$gambar5 ='errrrroooorrrr.jpg';
                          }
                        array_push($reportdetails, array('Tanggal' => $data_pre_kaper['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Nama' => $data_kaper['nama_kaper'],'Perwakilan' => $data_kaper['alamat_perwakilan'],'------Kegiatan 1------' =>$gambar1,'------Kegiatan 2------' => $gambar2,'------Kegiatan 3------' => $gambar3,'------Kegiatan 4------' =>$gambar4,'------Kegiatan 5------' => $gambar5, 'keterangan_1' => $data_pre_kaper['keterangan_1'], 'keterangan_2' => $data_pre_kaper['keterangan_2'], 'keterangan_3' => $data_pre_kaper['keterangan_3'], 'keterangan_4' => $data_pre_kaper['keterangan_4'], 'keterangan_5' => $data_pre_kaper['keterangan_5'], 'jam_1' => $data_pre_kaper['jam_1'], 'jam_2' => $data_pre_kaper['jam_2'], 'jam_3' => $data_pre_kaper['jam_3'], 'jam_4' => $data_pre_kaper['jam_4'], 'jam_5' => $data_pre_kaper['jam_5']));
                        $no++;
                      }
                      $sales = mysqli_query($con, "SELECT kode_sales, nama_sales FROM tbl_sales WHERE kode_perwakilan='".$data_kaper['kode_perwakilan']."'" );
                      while($data_sales=mysqli_fetch_array($sales)){
                        $pre_sales = mysqli_query($con, "SELECT foto_1, foto_2, foto_3, foto_4, foto_5, keterangan_1,keterangan_2,keterangan_3,keterangan_4,keterangan_5, tanggal, jam_1,jam_2, jam_3, jam_4, jam_5 FROM tbl_presensisales WHERE kode_sales='".$data_sales['kode_sales']."' AND tanggal='".$tanggal."'");
                        $num_sales=mysqli_num_rows($pre_sales);
                        if($num_sales==1){
                          $data_pre_sales = mysqli_fetch_array($pre_sales);
                          if($data_pre_sales['foto_1']!=''){
                          	$gambar1 =  $imagePath .  $data_pre_sales['foto_1'];
                          }else{
                          	$gambar1 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_sales['foto_2']!=''){
                          	$gambar2 =  $imagePath .  $data_pre_sales['foto_2'];
                          }else{
                          	$gambar2 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_sales['foto_3']!=''){
                          	$gambar3 =  $imagePath .  $data_pre_sales['foto_3'];
                          }else{
                          	$gambar3 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_sales['foto_4']!=''){
                          	$gambar4 =  $imagePath .  $data_pre_sales['foto_4'];
                          }else{
                          	$gambar4 ='errrrroooorrrr.jpg';
                          }
                          if($data_pre_sales['foto_5']!=''){
                          	$gambar5 =  $imagePath .  $data_pre_sales['foto_5'];
                          }else{
                          	$gambar5 ='errrrroooorrrr.jpg';
                          }
                          array_push($reportdetails, array('Tanggal' => $data_pre_sales['tanggal'],'No' => $no,'Manager Nasional' => $data_nasional['nama_nasional'],'Manager Area' => $data_area['nama_area'],'Nama' => $data_sales['nama_sales'],'Perwakilan' => $data_kaper['alamat_perwakilan'],'------Kegiatan 1------' => $gambar1,'------Kegiatan 2------' => $gambar2,'------Kegiatan 3------' => $gambar3,'------Kegiatan 4------' => $gambar4,'------Kegiatan 5------' => $gambar5, 'keterangan_1' => $data_pre_sales['keterangan_1'], 'keterangan_2' => $data_pre_sales['keterangan_2'], 'keterangan_3' => $data_pre_sales['keterangan_3'], 'keterangan_4' => $data_pre_sales['keterangan_4'], 'keterangan_5' => $data_pre_sales['keterangan_5'], 'jam_1' => $data_pre_sales['jam_1'], 'jam_2' => $data_pre_sales['jam_2'], 'jam_3' => $data_pre_sales['jam_3'], 'jam_4' => $data_pre_sales['jam_4'], 'jam_5' => $data_pre_sales['jam_5']));
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
	$cell = 2;
	$cell1 = 3;

	// Sheet cells
	$cell_definition = array(
		'A' => 'Tanggal',
		'B' => 'No',
		'C' => 'Manager Nasional',
		'D' => 'Manager Area',
		'E' => 'Perwakilan',
		'F' => 'Nama',
		'G' => '------Kegiatan 1------',
		'H' => '------Kegiatan 2------',
		'I' => '------Kegiatan 3------',
		'J' => '------Kegiatan 4------',
		'K' => '------Kegiatan 5------'
	);

	// Build headers
	foreach( $cell_definition as $column => $value )
	{
		$objPHPExcel->getActiveSheet()->getColumnDimension("{$column}")->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->setCellValue( "{$column}1", $value ); 
	}

	// Build cells
	while( $rowCount < count($reportdetails) ){ 
		
		foreach( $cell_definition as $column => $value ) {

			$objPHPExcel->getActiveSheet()->getRowDimension($rowCount + 2)->setRowHeight(100); 
			
			switch ($value) {
				case 'Tanggal':
					$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount][$value] );
				    break;
			    case 'No':
			    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount][$value] ); 
			    	break;
			    case 'Manager Nasional':
			    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount][$value] ); 
			    	break;
			    case 'Manager Area':
			    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount][$value] ); 
			    	break;
			    case 'Perwakilan':
			    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount][$value] ); 
			    	break;
			    case 'Nama':
			    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount][$value] );
			    	break;
			    case '------Kegiatan 1------':
			    	if (file_exists($reportdetails[$rowCount][$value])) {
				        $objDrawing = new PHPExcel_Worksheet_Drawing();
				        $objDrawing->setName('Customer Signature');
				        $objDrawing->setDescription('Customer Signature');
				        //Path to signature .jpg file
				        $signature = $reportdetails[$rowCount]['------Kegiatan 1------'];    
				        $objDrawing->setPath($signature);
				        $objDrawing->setOffsetX(25);                     //setOffsetX works properly
				        $objDrawing->setOffsetY(10);                     //setOffsetY works properly
				        $objDrawing->setCoordinates($column.$cell);             //set image to cell 
				        $objDrawing->setWidth(70);  
				        $objDrawing->setHeight(70);                     //signature height  
				        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save 
                $objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount]['jam_1']." => ".$reportdetails[$rowCount]['keterangan_1']);
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, "" ); 
				    }
				    
			    	break;
				case '------Kegiatan 2------':
			    	if (file_exists($reportdetails[$rowCount][$value])) {
				        $objDrawing = new PHPExcel_Worksheet_Drawing();
				        $objDrawing->setName('Customer Signature');
				        $objDrawing->setDescription('Customer Signature');
				        //Path to signature .jpg file
				        $signature = $reportdetails[$rowCount]['------Kegiatan 2------'];    
				        $objDrawing->setPath($signature);
				        $objDrawing->setOffsetX(25);                     //setOffsetX works properly
				        $objDrawing->setOffsetY(10);                     //setOffsetY works properly
				        $objDrawing->setCoordinates($column.$cell);             //set image to cell 
				        $objDrawing->setWidth(70);  
				        $objDrawing->setHeight(70);                     //signature height  
				        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save
                $objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount]['jam_2']." => ".$reportdetails[$rowCount]['keterangan_2']);
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, "" ); 
				    }
			    	break;
			    case '------Kegiatan 3------':
			    	if (file_exists($reportdetails[$rowCount][$value])) {
				        $objDrawing = new PHPExcel_Worksheet_Drawing();
				        $objDrawing->setName('Customer Signature');
				        $objDrawing->setDescription('Customer Signature');
				        //Path to signature .jpg file
				        $signature = $reportdetails[$rowCount]['------Kegiatan 3------'];    
				        $objDrawing->setPath($signature);
				        $objDrawing->setOffsetX(25);                     //setOffsetX works properly
				        $objDrawing->setOffsetY(10);                     //setOffsetY works properly
				        $objDrawing->setCoordinates($column.$cell);             //set image to cell 
				        $objDrawing->setWidth(70);  
				        $objDrawing->setHeight(70);                     //signature height  
				        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save 
                $objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount]['jam_3']." => ".$reportdetails[$rowCount]['keterangan_3']);
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, "" ); 
				    }
			    	break;
			    case '------Kegiatan 4------':
			    	if (file_exists($reportdetails[$rowCount][$value])) {
				        $objDrawing = new PHPExcel_Worksheet_Drawing();
				        $objDrawing->setName('Customer Signature');
				        $objDrawing->setDescription('Customer Signature');
				        //Path to signature .jpg file
				        $signature = $reportdetails[$rowCount]['------Kegiatan 4------'];    
				        $objDrawing->setPath($signature);
				        $objDrawing->setOffsetX(25);                     //setOffsetX works properly
				        $objDrawing->setOffsetY(10);                     //setOffsetY works properly
				        $objDrawing->setCoordinates($column.$cell);             //set image to cell 
				        $objDrawing->setWidth(70);  
				        $objDrawing->setHeight(70);                     //signature height  
				        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save 
                $objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount]['jam_4']." => ".$reportdetails[$rowCount]['keterangan_4']);
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, "" ); 
				    }
			    	break;
			   case '------Kegiatan 5------':
			    	if (file_exists($reportdetails[$rowCount][$value])) {
				        $objDrawing = new PHPExcel_Worksheet_Drawing();
				        $objDrawing->setName('Customer Signature');
				        $objDrawing->setDescription('Customer Signature');
				        //Path to signature .jpg file
				        $signature = $reportdetails[$rowCount]['------Kegiatan 5------'];    
				        $objDrawing->setPath($signature);
				        $objDrawing->setOffsetX(25);                     //setOffsetX works properly
				        $objDrawing->setOffsetY(10);                     //setOffsetY works properly
				        $objDrawing->setCoordinates($column.$cell);             //set image to cell 
				        $objDrawing->setWidth(70);  
				        $objDrawing->setHeight(70);                     //signature height  
				        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save 
                $objPHPExcel->getActiveSheet()->setCellValue($column.$cell, $reportdetails[$rowCount]['jam_5']." => ".$reportdetails[$rowCount]['keterangan_5']);
				    } else {
				    	$objPHPExcel->getActiveSheet()->setCellValue($column.$cell, "" ); 
				    }
			    	break;
			}

		}
			
	    $rowCount++;
	    $cell=$cell+1;  
	} 

	$fileName = $_SESSION['tombol']."_"."Kehadiran_" . $_SESSION['tanggal'] . ".xlsx";

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="'.$fileName.'"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
    die();
}


?>