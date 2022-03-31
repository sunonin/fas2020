<?php
define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
include 'Model/Connection.php';
require_once 'GSS/controller/RFQController.php';
require_once 'GSS/controller/PurchaseRequestController.php';
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/procurement_export_po.xlsx");
$styleBorder = array(
     'borders' => array(
          'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
     ),
);
$toLeft = array(
     'alignment' => array(
          'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
     )
);
$toCenter = array(
     'alignment' => array(
          'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
     )
);
function group_array($array)
{
     $val = array_unique($array);
     return $val;
}



$objPHPExcel->setActiveSheetIndex()->setCellValue('C7',$supp_opts['supplier_title']);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C8',$supp_opts['supplier_address']);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F7',$po_opts['po_no']);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F8',$po_opts['po_date']);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E10',$pr_data['type']);
$item_row = 17;
foreach ($po_items as $key => $data) {
    $objPHPExcel->getActiveSheet()->getStyle("C" . $item_row . "")->applyFromArray($toLeft);
    $objPHPExcel->getActiveSheet()->getStyle("E" . $item_row . "")->applyFromArray($toLeft);
    $objPHPExcel->getActiveSheet()->getStyle("F" . $item_row . "")->applyFromArray($toLeft);
    $objPHPExcel->getActiveSheet()->getStyle("G" . $item_row . "")->applyFromArray($toLeft);
    $objPHPExcel->getActiveSheet()->getRowDimension($item_row)->setRowHeight(60);


    $objPHPExcel->setActiveSheetIndex()->setCellValue('A' . $item_row, $data['sn']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_row, $data['unit']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $item_row, $data['items'] . "\n" . $data['description']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E' . $item_row, $data['qty']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F' . $item_row, '₱'.number_format($data['total'],2));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G' . $item_row, '₱'.number_format($data['ppu'],2));
    $total_abc += $data['ppu'];
  
    $item_row++;
}

$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$item_row,'(Total Amount in Words)    pesos only');
$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$item_row,'₱'.number_format($total_abc,2));
$objPHPExcel->setActiveSheetIndex()->mergeCells('A'.$item_row . ':' . 'F'.$item_row);
$objPHPExcel->getActiveSheet()->getRowDimension($item_row)->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getStyle("G" . $item_row . "")->applyFromArray($toLeft);
$objPHPExcel->getActiveSheet()->getStyle("A" . $item_row . "")->applyFromArray($toCenter);
$objPHPExcel->getActiveSheet()->getStyle('A'.$item_row . ':' . 'G'.$item_row)->applyFromArray($styleBorder);



					


// // S U P P L I E R   I T E M S
// $item_row = 12;
// $count_supp_item = 0;
// foreach ($rfq_items as $key => $item) {
//      $objPHPExcel->setActiveSheetIndex()->setCellValue('A' . $item_row, $no);
//      $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_row, $item['item'] . '' . $item['description']);
//      $objPHPExcel->getActiveSheet()->getStyle('B' . '' . $item_row)->getAlignment()->setWrapText(true);
//      $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $item_row, $item['cost']);
//      $objPHPExcel->setActiveSheetIndex()->setCellValue('D' . $item_row, $item['qty']);
//      $objPHPExcel->setActiveSheetIndex()->setCellValue('E' . $item_row, $item['unit']);
//      $item_row++;
//      $no++;
//      $count_supp_item++;
// }

// $item_info_row = $item_row + 1;
// $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(60);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'REF');
// $objPHPExcel->getActiveSheet()->getStyle("B" . $item_info_row . "")->applyFromArray($toLeft);


// foreach ($rfq_report_multi_opt as $key => $data) {
//      $pr_no[] = $data['pr_no'];
// }
// $pr_no =  implode("/", group_array($pr_no));


// $item_info_row += 1;
// $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(60);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'PR No. ' . $pr_no . '                                                                           Date received: ' . date('F d, Y', strtotime($rfq_details['rfq_date'] . '')));
// $objPHPExcel->getActiveSheet()->getStyle("B" . $item_info_row . "")->applyFromArray($toLeft);
// $objPHPExcel->getActiveSheet()->getStyle('B' . '' . $item_info_row)->getAlignment()->setWrapText(true);
// $objPHPExcel->getActiveSheet()->getRowDimension($item_info_row)->setRowHeight(43);




//     $item_info_row += 1;
//     $objPHPExcel->getActiveSheet()->getRowDimension($item_info_row)->setRowHeight(100);
//     $objPHPExcel->getActiveSheet()->getStyle('B' . '' . $item_info_row)->getAlignment()->setWrapText(true);
//     $objPHPExcel->getActiveSheet()->getStyle("B" . $item_info_row . "")->applyFromArray($toLeft);
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'PUR:' . $rfq_details['purpose']);

//     $item_info_row += 1;

//     $objPHPExcel->getActiveSheet()->getStyle('B' . $item_info_row)->getAlignment()->setWrapText(true);
//     $objPHPExcel->getActiveSheet()->getStyle('B' . $item_info_row)->getFont()->setBold(true);

//     $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'ELIGIBILITY REQUIREMENTS');
//     $item_info_row += 2;
//     foreach ($abs_req_opt as $key => $item) {
//         $objPHPExcel->getActiveSheet()->getStyle('B' . $item_info_row)->getAlignment()->setWrapText(true);
//         $objPHPExcel->getActiveSheet()->getStyle("B" . $item_info_row . "")->applyFromArray($toLeft);
        
//         if ($item['id'] == 1) {
//             $objPHPExcel->getActiveSheet()->getRowDimension($item_info_row)->setRowHeight(60);
//         }if ($item['id'] == 2) {
//             $objPHPExcel->getActiveSheet()->getRowDimension($item_info_row)->setRowHeight(72);
//         }if ($item['id'] == 3) {
//             $objPHPExcel->getActiveSheet()->getRowDimension($item_info_row)->setRowHeight(50);
//         }
//         if ($item['id'] == 4) {
//             $objPHPExcel->getActiveSheet()->getRowDimension($item_info_row)->setRowHeight(30);
//         }
//         if ($item['id'] == 5) {
//             $objPHPExcel->getActiveSheet()->getRowDimension($item_info_row)->setRowHeight(60);
//         }
//         if ($item['id'] == 6) {
//             $objPHPExcel->getActiveSheet()->getRowDimension($item_info_row)->setRowHeight(40);
//         }


//         $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, $item['content']);
//         $objPHPExcel->setActiveSheetIndex()->setCellValue('F' . $item_info_row, $item['remarks']);
//         $objPHPExcel->setActiveSheetIndex()->setCellValue('G' . $item_info_row, $item['remarks']);
//         $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $item_info_row, $item['remarks']);
//         $item_info_row++;
//     }

//     $item_info_row += 1;
//     $objPHPExcel->getActiveSheet()->getStyle("B" . $item_info_row . "")->applyFromArray($toLeft);
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'REMARKS:');
//     $item_info_row += 1;
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'Award is hereby recommended to be given to '.$supp_opts['supplier_title'].' which  has the lowest calculated and responsive bids');


//     // S U P P L I E R header
//     $count_supplier = 0;
//     foreach ($supplier_winner as $key => $item) {
//         $count_supplier++;
//         $supplier_title = $item['supplier'];
//         // SUPPLIER HEADER FORMATTING
//         $objPHPExcel->getActiveSheet()->getColumnDimension($supplier_col)->setWidth(20);
//         $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(43);
//         $objPHPExcel->getActiveSheet()->getStyle("A9:" . $supplier_col . "26")->applyFromArray($styleBorder);
//         $objPHPExcel->setActiveSheetIndex()->setCellValue($supplier_col . '' . $supplier_row, $item['supplier']);
//         $objPHPExcel->getActiveSheet()->getStyle($supplier_col . '' . $supplier_row)->getAlignment()->setWrapText(true);
//         $objPHPExcel->setActiveSheetIndex(0)->mergeCells($supplier_col . '9' . ':' . $supplier_col . '11');

//         if ($item['winner'] == 1) {
//             // winner is
//             $objPHPExcel
//                 ->getActiveSheet()
//                 ->getStyle($supplier_col . '' . $supplier_row)
//                 ->getFill()
//                 ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//                 ->getStartColor()->setRGB('B3E5FC');
//             $objPHPExcel->getActiveSheet()->getStyle($supplier_col . '' . $supplier_row)->getFont()->setBold(true);
//         } else {
//             $objPHPExcel
//                 ->getActiveSheet()
//                 ->getStyle($supplier_col . '' . $supplier_row)
//                 ->getFill()
//                 ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//                 ->getStartColor()->setRGB('FFFFFF');
//             $objPHPExcel->getActiveSheet()->getStyle($supplier_col . '' . $supplier_row)->getFont()->setBold(false);
//         }
//         $item_row = 12;
//         foreach ($supplier_item_total[$key] as $i => $data) {
//             $objPHPExcel->setActiveSheetIndex()->setCellValue($supplier_col . '' . $item_row, $data['price_per_unit']);
//             if ($data['winner'] == 1) {
//                 $objPHPExcel
//                         ->getActiveSheet()
//                         ->getStyle($supplier_col . '' . $item_row)
//                         ->getFill()
//                         ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//                         ->getStartColor()->setRGB('B3E5FC');
//             }
//             $item_row++;
//         }
//         $supplier_col++;
//     }

//     // SIGNATORIES
//     $item_info_row += 2;
//     $objPHPExcel->getActiveSheet()->getStyle("B" . $item_info_row . "")->applyFromArray($toLeft);
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'OTHERS:');

//     $item_info_row += 2;
//     $objPHPExcel->getActiveSheet()->getStyle("B" . $item_info_row . "")->applyFromArray($toCenter);
//     $objPHPExcel->getActiveSheet()->getStyle('B'.$item_info_row)->getFont()->setBold(true);
//     $objPHPExcel->getActiveSheet()->getStyle('H'.$item_info_row)->getFont()->setBold(true);
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'DR. CARINA S. CRUZ');
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $item_info_row, 'DON AYER A. ABRAZALDO');

//     $item_info_row += 1;
//     $objPHPExcel->getActiveSheet()->getStyle("B" . $item_info_row . "")->applyFromArray($toCenter);
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'BAC Chairman');
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $item_info_row, 'BAC Member');

//     $item_info_row += 1;
//     $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$item_info_row . ':' . 'F'.$item_info_row);

//     $objPHPExcel->getActiveSheet()->getStyle("C" . $item_info_row . "")->applyFromArray($toCenter);
//     $objPHPExcel->getActiveSheet()->getStyle('C'.$item_info_row)->getFont()->setBold(true);
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $item_info_row, 'ATTY. JORDAN V. NADAL');

//     $item_info_row += 1;
//     $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$item_info_row . ':' . 'F'.$item_info_row);
//     $objPHPExcel->getActiveSheet()->getStyle("C" . $item_info_row . "")->applyFromArray($toCenter);
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('C' . $item_info_row, 'BAC Vice Chairman');

//     $item_info_row += 2;
//     $objPHPExcel->getActiveSheet()->getStyle("B" . $item_info_row . "")->applyFromArray($toCenter);
//     $objPHPExcel->getActiveSheet()->getStyle('B'.$item_info_row)->getFont()->setBold(true);
//     $objPHPExcel->getActiveSheet()->getStyle('H'.$item_info_row)->getFont()->setBold(true);
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'GILBERT L. TUMAMAC');
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('H' . $item_info_row, 'JAY-AR T. BELTRAN');

//     $item_info_row += 1;
//     $objPHPExcel->getActiveSheet()->getStyle("B" . $item_info_row . "")->applyFromArray($toCenter);
//     $objPHPExcel->setActiveSheetIndex()->setCellValue('B' . $item_info_row, 'BAC Member');




$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: procurement_export_po.xlsx');