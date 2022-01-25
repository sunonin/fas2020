<?php
session_start();
date_default_timezone_set('Asia/Manila');

require '../../manager/PR_Manager.php';
$pr = new PR_Manager();
$today = new DateTime();
$conn = mysqli_connect("localhost", "fascalab_2020", "w]zYV6X9{*BN", "fascalab_2020");

// $view_ta = $ta->fetchTAinfo($_GET['cn']);
// $i_rated = $ta->countRated();

$pr_no = $_GET['pr_no'];
$type = $_GET['type'];
$pr_date = date('Y-m-d', strtotime($_GET['pr_date']));
$target_date = date('Y-m-d', strtotime($_GET['target_date']));
$purpose = $_GET['purpose'];
$office = $_GET['pmo'];

$unit = setUnit(($_GET['unit1']));
$pr->insertPR($pr_no, $office, $purpose, $pr_date, $type, $target_date);

for ($i = 0; $i < count($_GET['items1']); $i++) {
    $item_title =   $_GET['item_title'][$i];
    $abc        =   $_GET['abc1'][$i];
    $description =   $_GET['description1'][$i];
    $unit       =   $_GET['unit1'][$i];
    $qty        =   $_GET['qty1'][$i];
    $total      =   $_GET['grand_total'][$i];
    $items      =   $_GET['items1'][$i];

    $select_app_id = mysqli_query($conn, "SELECT id,sn FROM app WHERE id = $items");
    $rowAI = mysqli_fetch_array($select_app_id);
    $snAi = $rowAI['sn'];

    $insert_items = mysqli_query($conn, 'INSERT INTO pr_items(pr_no,items,description,unit,qty,abc)
      VALUES("' . $pr_no . '","' . $_GET['app_items'][$i] . '","' . $_GET['description1'][$i] . '","' . $unit[$i] . '","' . $_GET['qty1'][$i] . '","' . $_GET['abc1'][$i] . '")');

    $update_minus = mysqli_query($conn, 'UPDATE app_items SET qty_original = qty_original - ' . $_GET['qty1'][$i] . ' WHERE pmo_id = ' . $office . ' AND sn = "' . $snAi . '" ');
}



function office($pmo_val)
{
    $office = [
        'ALL' => 0,
        'ORD' => 1,
        'LGMED' => 2,
        'LGCDD' => 3,
        'FAD' => 4,
        'LGCDD-PDMU' => 5,
        'LGMED-MBRTG' => 6,
        'CAVITE' => 7,
        'LAGUNA' => 8,
        'BATANGAS' => 9,
        'RIZAL' => 10,
        'QUEZON' => 11,
        'LUCENA CITY' => 12
    ];
    if (array_key_exists($pmo_val, $office)) {
        echo  $office[$pmo_val];
    }
    return $office;
}
function setUnit($unit_val)
{
    $unit = [
        'bottle' => 11,
        'box' => 2,
        'bundle' => 14,
        'can' => 10,
        'cart' => 21,
        'crtg' => 6,
        'dozen' => 18,
        'gallon' => 20,
        'jar' => 13,
        'lot' => 4,
        'pack' => 7,
        'pad' => 15,
        'pair' => 19,
        'piece' => 1,
        'pouch' => 17,
        'ream' => 3,
        'roll' => 9,
        'set' => 12,
        'tube' => 8,
        'unit' => 5,
        'pax' => 22,
        'liters' => 23,
        'meters' => 24
    ];
}
