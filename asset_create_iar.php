<?php include('base_call_connect.php'); ?> 
<?php include('connection.php'); ?> 
<?php require_once 'bower_components/phpti-master/src/ti.php'; ?>

<link href='GSS/views/backend/css/buttons.css' rel='stylesheet' type='text/css'>

<?php require_once 'menu_checker.php'; ?> 
<?php $menuchecker = menuChecker('rfq');
?> 

<?php include 'base_menu.html.php'; ?>

<?php startblock('title'); ?>
  Procurement
<?php endblock('title'); ?>

<?php startblock('content'); ?>

<?php include ('GSS/views/AssetManagement/form/form_iar_create.php'); ?>
<?php include ('macro/macro.php'); ?>
<?php endblock(); ?>
<script  src="GSS/views/backend/js/iar_custom.js"></script>

