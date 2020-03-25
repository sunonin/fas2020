<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");

$id = $_GET['id'];
$id2 = $_GET['id2'];

function app($connect)
{ 
  $output = '';
  $query = "SELECT * FROM `app` ORDER BY procurement ASC";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["id"].'">'.$row["procurement"].'</option>';
  }
  return $output;
}

// $query = mysqli_query($conn,"SELECT rfq_items.id,rfq_id,rfq_items.pr_no,app_id,description,unit_id,abc,qty,app.procurement,rfq.rfq_no,pr.purpose,pr.pr_date,pr.pmo FROM rfq_items 
//   LEFT JOIN app ON app.id = rfq_items.app_id 
//   LEFT JOIN pr ON pr.pr_no = rfq_items.pr_no
//   LEFT JOIN rfq ON rfq.id = rfq_items.rfq_id WHERE rfq_items.id = '$id' ");

$query = mysqli_query($conn,"SELECT pr.id,pr.pr_no,a.procurement,pr.description,pr.unit,pr.abc,pr.qty FROM pr_items pr  left join app a on a.id = pr.items WHERE pr.id = '$id'");
$row = mysqli_fetch_array($query);

$procurement = $row['procurement'];
$description = $row['description'];
$qty = $row['qty'];
$unit = $row['unit'];
$abc = $row['abc'];
$pr_no = $row['pr_no'];

$query2 = mysqli_query($conn,"SELECT purpose,pmo,pr_date FROM pr where pr_no = '$pr_no'");
$row2 = mysqli_fetch_array($query2);
$pmo = $row2['pmo'];
$purpose = $row2['purpose'];
$pr_date = $row2['pr_date'];

if ($unit == "1") {
  $unit = "piece";
}

if ($unit == "2") {
  $unit = "box";
}

if ($unit == "3") {
  $unit = "ream";
}

if ($unit == "4") {
  $unit = "lot";
}

if ($unit == "5") {
  $unit = "unit";
}

if ($unit == "6") {
  $unit = "crtg";
}

if ($unit == "7") {
  $unit = "pack";
}
if ($unit == "8") {
  $unit = "tube";
}

if ($unit == "9") {
  $unit= "roll";
}

if ($unit == "10") {
  $unit = "can";
}

if ($unit == "11") {
  $unit = "bottle";
}

if ($unit == "12") {
  $unit = "set";
}

if ($unit == "13") {
  $unit = "jar";
}

if ($unit == "14") {
  $unit = "bundle";
}

if ($unit == "15") {
  $unit = "pad";
}

if ($unit == "16") {
  $unit = "book";
}

if ($unit == "17") {
  $unit = "pouch";
}

if ($unit == "18") {
  $unit = "dozen";
}

if ($unit== "19") {
  $unit = "pair";
}

if ($unit == "20") {
  $unit = "gallon";
}

if ($unit == "21") {
  $unit = "cart";
} 
if (isset($_POST['submit'])) {

  $qty1 = $_POST['qty'];
  $abc1 = $_POST['abc'];
  $items1 = $_POST['items1'];
  $description1 = $_POST['description'];
  $unit1 = $_POST['unit'];

  // echo $procurement; exit();


  $UpdateItems = mysqli_query($conn,"UPDATE pr_items set  unit = '$unit1', description = '$description1', qty ='$qty1', abc = '$abc1' WHERE id = '$id' ");

  
  if ($UpdateItems) {
    echo '<div class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Successfuly Updated!  </p> </div></div>  ';
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Updated!')
    window.location.href = 'ViewRFQdetails.php?id=$id2';
    </SCRIPT>");
    
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspUpdate Purchase Request</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><?php echo '<a href="ViewRFQdetails.php?id='.$id2.'" style="color:white;text-decoration: none;">Back</a>' ?> </li>

      <br>
      <br>
      <form method="POST" >
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>PR No.</label>
                  <input class="form-control" type="text" name="pr_no" readonly id="pr_no" value="<?php echo $pr_no ?>">
                </div>
                <div class="form-group">
                  <label>Office</label>
                  <input type="text" class="form-control" readonly name="pmo" value="<?php echo $pmo;?>">
                </div>


              </div>
              <div class="col-md-6">

                <div class="form-group">
                  <label>PR Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" readonly name="pr_date" id="pr_date" value="<?php echo $pr_date?>">
                  </div>
                </div>

                <div class="form-group">
                  <label>Purpose</label>
                  <textarea class="form-control" type="text" id="purpose" readonly name="purpose"><?php echo $purpose ?> </textarea> 
                  <!-- <input type="text" name="purpose" value="<?php echo isset($_POST['purpose']) ? $_POST['purpose'] : '' ?>" /> -->

                </div>


                <!-- /.box-body -->
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <div class="panel panel-success" id="item_table">
           <?php
           $output = '';
           ?>
           <div class="panel-heading">
            <i class="fa fa-list-alt"></i> Item(s)
            <div class="clearfix"></div>
          </div>
          <div class="panel-body container-items">
            <div class=""><!-- widgetBody -->

              <div class="row">
                <div class="col-md-6" style="padding-left: 30px;padding-top:10px;">
              <!--   <input type="text" class="form-control" name="search_text" id="search_text" autocomplete="off" placeholder="Search Item" class="" />
                <table class="table table-striped table-hover" id="main" style="border-style: solid;border-top-style: none;">
                  <tbody id="result">
                  </tbody>
                </table> -->




                <label>Item </label>

                <!-- <input type="text" readonly name="items1" id="app_items" class="form-control" value="<?php echo $procurement ?>" /> -->
                 <select class="form-control select2" style="width: 100%;" name="items1" id="app_items" >
                    <option><?php echo $procurement;?></option>
                    <?php echo app($connect);?>
                    
                    
                  </select> 
                <br>
                <br>
                <div hidden>
                  <input type="text" name="id" id="id" class="form-control"/>
                  
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" rows="3" name="description"><?php echo $description ?></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <p></p>
                
                <div class="form-group">
                  <label>QTY</label>
                  <input class="form-control" type="number" id="qty" name="qty" value="<?php echo $qty ?>">
                </div>
                <div class="form-group">
                  <label>Unit</label>
                  <!-- <input type="text" name="unit" id="unit" value="<?php echo $unit ?>" readonly  class="form-control"> -->
                  <?php if ($unit == ""): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "piece"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "box"): ?>
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="2">box</option>
                      <option value="1">piece</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                   <?php if ($unit == "ream"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="3">ream</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                    <?php if ($unit == "lot"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="4">lot</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                   <?php if ($unit == "unit"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="5">unit</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                   <?php if ($unit == "crtg"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="6">crtg</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "pack"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="7">pack</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                   <?php if ($unit == "tube"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="8">tube</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "roll"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="9">roll</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "can"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="10">can</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "bottle"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="11">bottle</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "set"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="12">set</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "jar"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="13">jar</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "bundle"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="14">bundle</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "pad"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="15">pad</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "book"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="16">book</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>


                  <?php if ($unit == "pouch"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="17">pouch</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "dozen"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="18">dozen</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "pair"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "gallon"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="20">gallon</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="21">cart</option>
                    </select>
                  <?php endif ?>

                  <?php if ($unit == "cart"): ?>
                    
                  <select class="form-control select2" style="width: 100%;" name="unit">
                      <option value="21">cart</option>
                      <option value="1">piece</option>
                      <option value="2">box</option>
                      <option value="3">ream</option>
                      <option value="4">lot</option>
                      <option value="5">unit</option>
                      <option value="6">crtg</option>
                      <option value="7">pack</option>
                      <option value="8">tube</option>
                      <option value="9">roll</option>
                      <option value="10">can</option>
                      <option value="11">bottle</option>
                      <option value="12">set</option>
                      <option value="13">jar</option>
                      <option value="14">bundle</option>
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="17">pouch</option>
                      <option value="18">dozen</option>
                      <option value="19">pair</option>
                      <option value="20">gallon</option>
                    </select>
                  <?php endif ?>

                </div>
                <div class="form-group">
                  <label>Unit Cost</label>
                  <input class="form-control" type="text" id="current_price" value="<?php echo $abc ?>"  name="abc">
                </div>

                <!-- /.box-body -->
              </div>
            </div>
          </div>
        </div>
      </div>  
      <button class="btn btn-primary"  type="submit" name="submit" onclick="return confirm('Are you sure you want to update?');">Update</button>

      <br>
      <br>
      <br>
    </form>
  </div>  
</div>  
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>  
<br>
</body>

