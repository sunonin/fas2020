<?php
session_start();
date_default_timezone_set('Asia/Manila');

require_once "../../Model/Connection.php";
require_once "../../Model/Obligation.php";
require_once '../manager/BudgetManager.php';
require_once "../../ActivityPlanner/manager/Notification.php";

$ob = new Obligation();
$bm = new BudgetManager();
$notif = new Notification();

$user = $_SESSION['currentuser'];
$fund_source = isset($_POST['fund_source']) ? $_POST['fund_source'] : '';

$dd = [
	'type' 			=> $_POST['ob_type'],
	'is_dfund' 		=> isset($_POST['dfunds']) ? true : false,
	'serial_no' 	=> $_POST['serial_no'],
	'po_id' 		=> isset($_POST['po_no']) ? $_POST['po_no'] : '',
	'supplier' 		=> $_POST['supplier'],
	'address' 		=> $_POST['address'],
	'amount' 		=> isset($_POST['po_no']) ? $bm->removeComma($_POST['po_amount']) : $bm->removeComma($_POST['total_amount']),
	'purpose' 		=> $_POST['particulars'],
	'created_by'	=> $user
]; 

$id = $ob->post($dd);

if (!empty($fund_source)) {
	foreach ($fund_source as $key => $source) {
		$entry = [
			'ob_id' 		=> $id,
			'fund_source' 	=> $source,
			'mfo_ppa'		=> $_POST['ppa'][$key],
			'uacs'			=> $_POST['uacs'][$key],
			'amount'		=> $bm->removeComma($_POST['amount'][$key])
		];
		
		$ob->postEntries($entry);
	}
}

$_SESSION['toastr'] = $notif->addFlash('success', 'Successfully created new obligation', 'Add New');

if (isset($_POST['save'])) {
	header('location:../../budget_obligation_edit.php?id='.$id);
} else {
	header('location:../../budget_create_obligation.php');
}
