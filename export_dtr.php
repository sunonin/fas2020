<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_dtr.xlsx");

$styleTop = array(
  'borders' => array(
    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
  ),
  'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
);

$styleLeft = array(
  'borders' => array(
    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
  ),
  'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
);

$styleRight = array(
  'borders' => array(
    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
  ),
  'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
);

$stylebottom = array(
  'borders' => array(
    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
  ),
  'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
);

$styleContent = array('font'  => array('size'  => 8, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$styleContent2 = array('font'  => array('size'  => 8, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$styleContent3 = array('font'  => array('size'  => 8, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$styleHeader = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$styleHeader2 = array('font'  => array('size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));



$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$username = $_GET['username'];
$month = $_GET['month'];
$year = $_GET['year'];

$this_date = $year.'-'.$month;

$sql = mysqli_query($conn, "SELECT concat(LAST_M,',',FIRST_M,' ',MIDDLE_M) as FNAME FROM tblemployeeinfo WHERE UNAME = '$username'");
$row = mysqli_fetch_array($sql);
$FNAME = $row['FNAME'];


$objPHPExcel->setActiveSheetIndex()->setCellValue('A6',$FNAME);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A8','For the Month of '.date('F Y',strtotime($this_date)));

$sql_items = mysqli_query($conn, "SELECT * FROM dtr WHERE UNAME = '$username' AND  `date_today` LIKE '%$this_date%'");


$row = 14;
$row2 = 16;
$row3 = 18;
$row4 = 20;
$row5 = 22;
$row6 = 23;
if (mysqli_num_rows($sql_items)>0) {

  while($excelrow = mysqli_fetch_assoc($sql_items) ){

    $time_in = $excelrow['time_in'];
    $lunch_in = $excelrow['lunch_in'];
    $lunch_out = $excelrow['lunch_out'];
    $time_out = $excelrow['time_out'];

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,date('F d, Y',strtotime($excelrow['date_today'])));
    if ($time_in == NULL) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,'');
    }else{
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,date('h:i A',strtotime($time_in)));
    }
    if ($lunch_in == NULL) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,'');
    }else{
      $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,date('h:i A',strtotime($lunch_in)));
    }
    if ($lunch_out == NULL) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,'');
    }else{
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,date('h:i A',strtotime($lunch_out)));
    }
    if ($time_out == NULL) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,'');
    }else{
      $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,date('h:i A',strtotime($time_out)));
    }

    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);


    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);

    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleRight);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($stylebottom);

    $row++;
    $row2++;
    $row3++;
    $row4++;
    $row5++;
    $row6++;
  }

  $objPHPExcel->getActiveSheet()->mergeCells('A'.$row2.':G'.$row2);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row2)->applyFromArray($styleContent);
  $objPHPExcel->getActiveSheet()->getRowDimension($row2)->setRowHeight(30);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row2,'I certify on my honor that the above is a true and correct report of the hours of work performed, record of which was made daily at the time of arrival and departure from office');
  $objPHPExcel->getActiveSheet()->mergeCells('C'.$row3.':E'.$row3);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row3.':E'.$row3)->applyFromArray($stylebottom);

  $objPHPExcel->getActiveSheet()->getStyle('A'.$row4)->applyFromArray($styleContent3);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row4,'VERIFIED as to the prescribed office hours:');

  $objPHPExcel->getActiveSheet()->mergeCells('C'.$row5.':E'.$row5);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row5.':E'.$row5)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row5)->applyFromArray($styleHeader);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row5,'DR. CARINA S. CRUZ');
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row5.':E'.$row5)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row6)->applyFromArray($styleHeader2);
  $objPHPExcel->getActiveSheet()->mergeCells('C'.$row6.':E'.$row6);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row6,'In Charge');
}



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_dtr.xlsx');

?>