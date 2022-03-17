<?php include 'GSS/controller/RFQController.php'; ?>
<?php require_once 'GSS/controller/PurchaseRequestController.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Abstract of Quotation</h1>

        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Procurement</a></li>
            <li class="active">Abstract of Quotation</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <?php include('_panel/box.html.php'); ?>
        </div>

        <div class="row">
                <?php include 'GSS/views/RFQ/form/tabpanel_awarding.php'; ?>
        </div>
        <div>
    </section>
</div>
<script src="GSS/views/backend/js/custom.js"></script>
<script src="GSS/views/backend/js/rfq_custom.js"></script>