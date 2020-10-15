<?php 
session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];

}
?>
<!DOCTYPE html>
<html>
<title>FAS | Update Obligation</title>
<!-- Getting Values from database to input -->
<?php

$getid = $_GET['getid'];
//echo $id;

$servername = "localhost";

$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";

$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";

$database = "fascalab_2020";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
function app($connect)
{ 
  $output = '';
  $query = "SELECT sarogroup FROM `saro` Group BY sarogroup ASC";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["sarogroup"].'">'.$row["sarogroup"].'</option>';
  }
  return $output;
}


// Getting values from id

    
    $d1 = "";
    $d2 = "";
    $d3 = "";
    $d4 = "";

$query = mysqli_query($conn,"SELECT * FROM saroobburs where id = '$getid' ");
    while ($row = mysqli_fetch_assoc($query)) 
    {
    $id = $row["id"]; 

    /*$datereceived = $_GET['datereceived'];
    $d1 = date('dd/mm/YYYY', strtotime($datereceived));
    echo ($datereceived);
    exit();
    
    $datereprocessed = $_GET['datereprocessed'];
    $d2 = date('dd/mm/YYYY', strtotime($datereprocessed));
    
    $datereturned = $_GET['datereturned'];
    $d3 = date('dd/mm/YYYY', strtotime($datereturned));
    
    $datereleased = $_GET['datereleased'];
    $d4 = date('dd/mm/YYYY', strtotime($datereleased)); */


    $ors = $row["burs"];
    $ponum = $row["ponum"];
    $payee = $row["payee"];
    //$supplier = $row["supplier"];
    $particular = $row["particular"];
    $saronumber = $row["saronumber"];
    $ppa = $row["ppa"];
    $uacs = $row["uacs"];
    $amount = $row["amount"];
    $remarks = $row["remarks"];
    $sarogroup = $row["sarogroup"];

    $datereceived = $row["datereceived"];
    $datereceived11 = date('m/d/Y', strtotime($datereceived));

    $datereprocessed = $row["datereprocessed"];
    $datereprocessed11 = date('m/d/Y', strtotime($datereprocessed));

    $datereturned="";
    $datereturned = $row["datereturned"];
   
    if($datereturned=='0000-00-00'){
    $datereturned11 = date('m/d/Y');
    }
    else{
    $datereturned11 = date('m/d/Y', strtotime($datereturned));
    }

    $datereleased = $row["datereleased"];
    $datereleased11 = date('m/d/Y', strtotime($datereleased));


    }
?>


<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="dilg.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">
  <?php include('test1.php');?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="../frontend/web/"><i class=""></i> Home</a></li>
        <li class="active">Budget</li>
        <li class="active">Update Obligation</li>
      </ol>
      <br>
      <br>
        
    <!-- Start Panel -->
    <div class="box" style="border-style:groove">
        <br>
      
            <h1 align="">&nbspUpdate BURS at ID: <label for=""><?php echo $getid;?></h1>
             <div class="box-header with-border">
    
        <br>
      <li class="btn btn-warning"><a href="ObligationBURS.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <!-- Start form -->
  <form class="" method='POST' action="@Functions/obupdatefunction1.php" >
        <!-- Start Menu -->
        
        <!-- getting ID for update function -->
        <input type="hidden" name="requestid" value = "<?php echo $getid;?>" >
        <!-- getting ID for update function -->

        
        <div class="class-bordered well" >
            <div class="row">
                <div class="col-md-6">
                      <label>BURS Serial Number</label>
                      <input style="border-style: groove;  type="text" class="form-control" style="height: 35px;" id="burs" placeholder="Enter ORS Number" name="burs"  value="<?php echo $ors;?>">
                      
                      <br>
                    
                      <label>PO NO.</label>
                      <input style="border-style: groove;  type="text" class="typeahead form-control" style="height: 35px;" id="ponum" placeholder="Search PO Number" name="ponum"  value="<?php echo $ponum;?>">
                      <br>
                    
                </div>    
                
                <div class="col-md-6">
                    <label>Date Received</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input style="border-style: groove; type="text" class="form-control pull-right" id="datepicker1" placeholder='Enter Date' name="datereceived" value="<?php echo $datereceived11;?>" required>
                    </div>
                    <br>
                    
                    
                    <label>Date Processed</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input style="border-style: groove; type="text" class="form-control pull-right" id="datepicker2" placeholder='Enter Date' name="datereprocessed" value="<?php echo $datereprocessed11;?>" required>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="class well">
             <!-- ORS -->
            <div class="row">
                <div class="col-md-6">
                    <label>Payee/Supplier</label>
                    <input style="border-style: groove;"  type="text" class="form-control" style="height: 35px;" id="payee" placeholder="Payee" name="payee" value="<?php echo $payee;?>">
                    <br>
<!-- 
                    <label>Supplier</label>
                    <input  type="text"  class="form-control" style="height: 35px;" id="supplier" placeholder="Supplier" name="supplier">
                    <br>
                    <table class="table table-striped table-hover" id="main4">
                      <tbody id="result4">
                      </tbody>
                      </table>
 -->

                    <label>Particular/Purpose</label>
                    <input style="border-style: groove;"  type="text" readonly  class="form-control" style="height: 35px;" id="particular" placeholder="Particular" name="particular" value="<?php echo $particular;?>">
                    
                </div>


<!-- 
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script type="text/javascript">
              $(document).ready(function(){
                function load_data(query)
                {
                  $.ajax({
                    url:"@obsupplier.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                      $('#result4').html(data);
                    }
                  });
                }
                $('#supplier').keyup(function(){
                  var search = $(this).val();
                  if(search != '')
                  {
                    load_data(search);
                  }
                  else
                  {

                    load_data();
                    document.getElementById('supplier').value = "";
                   
                    $("#main4").show();
                    
                  }
                });
              });
              function showRow4(row)
              {
                var x=row.cells;
                document.getElementById("supplier").value = x[0].innerHTML;
                
                
              }
            </script> -->
                <div class="col-md-6">
                <label>Date Returned</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input style="border-style: groove;" type="text" class="form-control pull-right" id="datepicker3" placeholder='Enter Date' name="datereturned" value="<?php echo $datereturned11;?>" >
                    </div>
                    <br>
                    
                    <label>Date Released</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input style="border-style: groove;" type="text" class="form-control pull-right" id="datepicker4" placeholder='Enter Date' name="datereleased" value="<?php echo $datereleased11;?>" required>
                        <br>
                    </div>
                   
                </div>
                <!-- @Funtions/obsearchvalue.php -->
               
            </div>
           
             <br>
            <!-- SARO -->
                <div class="row">
                <div class="col-md-3">
                    <label>Fund Source</label>
                    <input style="border-style: groove;" type="text"  class="form-control" style="height: 40px;" id="saronum" placeholder="Fund Source" name="saronum" value="<?php echo $saronumber;?>" class="typeahead"/>
                    <!-- <input type="text" name="txtCountry" id="txtCountry" class="typeahead"/> -->
                      <table class="table table-striped table-hover" id="main1">
                      <tbody id="result1">
                      </tbody>
                      </table>
                </div>
                
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                  <script>
        $(document).ready(function(){
          $("#result1").click(function(){
            $("#main1").hide();
          });
        });
        </script>
                  <script type="text/javascript">
                  $(document).ready(function(){
                  function load_data(query)
                  {
                    $.ajax({
                      url:"@obsarosearch.php",
                      method:"POST",
                      data:{query:query},
                      success:function(data)
                      {
                        $('#result1').html(data);
                      }
                    });
                  }
                  $('#saronum').keyup(function(){
                    var search = $(this).val();
                    if(search != '')
                    {
                      load_data(search);
                    }
                    else
                    {
                      
                    $("#main1").show();
                      load_data();
                      document.getElementById('saronum').value = "";
                      document.getElementById("main1").value="";
                      document.getElementById("sarogroup").value = "";
                      document.getElementById("ppa").value = "";
                      document.getElementById("uacs").value = "";
                      
                    }
                  });
                });
                function showRow1(row)
                {
                  var x=row.cells;
                  document.getElementById("saronum").value = x[0].innerHTML;
                  document.getElementById("sarogroup").value = x[5].innerHTML;
                  document.getElementById("ppa").value = x[2].innerHTML;
                  document.getElementById("uacs").value = x[1].innerHTML;
                  
                  
                }
              </script>
                <div class="col-md-3">
                    <label>PPA</label>
                    <input style="border-style: groove;" type="text"  class="form-control" style="height: 40px;" id="ppa" placeholder="PPA" name="ppa" value="<?php echo $ppa;?>">
                </div>
                <div class="col-md-2">
                    <label>UACS Code</label>
                    <input style="border-style: groove;" type="text"  class="form-control" style="height: 40px;" id="uacs" placeholder="UACS Code" name="uacs" value="<?php echo $uacs;?>"> 
                </div>
                <div class="col-md-2">
                    <label>Amount</label>
                    <input style="border-style: groove;" type="text"  class="form-control" style="height: 40px;" id="" placeholder="Amount" name="amount" value="<?php echo $amount;?>" readonly>
                </div>
                <div class="col-md-2">
                    <label>New Amount</label>
                    <input style="border-style: groove;" type="text"  class="form-control" style="height: 40px;" id="" placeholder="New Amount" name="newamount" value="" required>
                </div>
            </div>
            
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label>Remarks</label>
                    <textarea style="border-style: groove;" style="width: 100%; height: 40px;" class="form-control" placeholder="Remarks" name="remarks"  ><?php echo $remarks;?></textarea> 
                </div>

                <div class="col-md-4">
                    <label>Group</label>
                    <!-- <textarea class="form-control" placeholder="Remarks" name="remarks" ></textarea> --> 
                    <!-- <select class="form-control select" style="width: 100%; height: 40;" name="sarogroup" id="sarogroup" required >
                    <option>Select Group</option>
                    <?php echo app($connect);?>
                    </select> -->
                    <input style="border-style: groove;" type="text"  class="form-control" style="height: 40px;" id="sarogroup" placeholder="" name="sarogroup" value="<?php echo $sarogroup;?>" readonly>
                </div>

                <div class="col-md-4">
                    <label>Status</label>
                    <!-- <textarea class="form-control" placeholder="Remarks" name="remarks" ></textarea> --> 
                    <select style="border-style: groove;" class="form-control select" style="width: 100%; height: 40px;" name="status" id="status" required >
                 
                    <option value = "Obligated">Obligated</option>
                    <option value = "Pending">Pending</option>
                    <!-- <option>Select Status</option> -->

                    
                    </select>
                </div>
            </div>
            <!-- END SARO -->
            <br>
            
        </div>
        <!-- End Menu -->
    <!-- End Panel -->
    <!-- Submit -->
    </div>
    &nbsp&nbsp&nbsp<button type="submit" name="submit" style="width: %;" class="btn btn-primary mb-4">Save</button>
    <br>
    <br>
    
    </div>
  </form>
    <!--End Submit -->
  </div>
  <footer class="main-footer">
    <br>
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>DILG IV-A Regional Information and Communications Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
    </footer>
    <br>
    </section>
  </div>
 
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
  $(document).ready(function(){
    $('#datepicker1').datepicker({
      autoclose: true
    })

    $('#datepicker2').datepicker({
      autoclose: true
    })
    $('#datepicker3').datepicker({
      autoclose: true
    })
    $('#datepicker4').datepicker({
      autoclose: true
    })
  })
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker,


    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>


</body>
</html>