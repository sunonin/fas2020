<?php include('base_call_connect.php'); ?> 
<?php include('connection.php'); ?> 
<?php require_once 'bower_components/phpti-master/src/ti.php'; ?>

<?php require_once 'menu_checker.php'; ?>
<?php $menuchecker = menuChecker('nta_obligation'); ?>

<?php include 'base_menu.html.php'; ?>

<?php startblock('title') ?>
  Paid Payment
<?php endblock('title') ?>

<?php startblock('content') ?>
  <?php include('Finance/views/CashPayment/paid_payment.php'); ?>
<?php endblock() ?>
