<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_ics.xlsx");
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$styleTop = array(
  'borders' => array(
    'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
  ),
);

$styleLeft = array(
  'borders' => array(
    'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
  ),
);

$styleRight = array(
  'borders' => array(
    'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
  ),
);

$stylebottom = array(
  'borders' => array(
    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
  ),
);

$styleHeader = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

 $styleLabel = array('font'  => array('size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT * FROM rpci WHERE id = '$id' ");
$row = mysqli_fetch_array($sql);
$article = $row['article'];
$description = $row['description'];
$stock_number = $row['stock_number'];
$unit = $row['unit'];
$amount = $row['amount'];
$opc = $row['opc'];
$yrs = $row['yrs'];

$objPHPExcel->setActiveSheetIndex()->setCellValue('A11',$opc);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B11',$unit);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C11',$amount);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D11',$amount);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E11',$article);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E12',$description);
$objPHPExcel->setActiveSheetIndex()->setCellValue('G11',$stock_number);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H1',$yrs);





$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_ics.xlsx');

?>