  <?php 
  include "config.php";
  include "dbaseCon.php";
  $DBConn = dbConnect();
  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
  $connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
  function tblpersonnel($connect)
  { 
    $output = '';
    $query = "SELECT DIVISION_N,DIVISION_M FROM `tblpersonneldivision` WHERE DIVISION_M IS NOT NULL ORDER BY DIVISION_M ASC ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output .= '<option text="text" value="'.$row["DIVISION_N"].'">'.$row["DIVISION_M"].'</option>';
    }
    return $output;
  }

  function tbldilgposition($connect)
  { 
    $output = '';
    $query = "SELECT POSITION_ID,POSITION_M FROM `tbldilgposition` ORDER BY POSITION_M ASC ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output .= '<option text="text" value="'.$row["POSITION_ID"].'">'.$row["POSITION_M"].'</option>';
    }
    return $output;
  }

  function tbldesignation($connect)
  { 
    $output = '';
    $query = "SELECT DESIGNATION_ID,DESIGNATION_M FROM `tbldesignation` ORDER BY DESIGNATION_M ASC ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output .= '<option text="text" value="'.$row["DESIGNATION_ID"].'">'.$row["DESIGNATION_M"].'</option>';
    }
    return $output;
  }

  if (isset($_POST['submit'])) {
    $region          = '04';
    $province        = $_POST["province"];
    $municipality    = $_POST["municipality"];
    $employeeid      = "";
    $employee_number = $_POST["employee_number"];
    $fname           = strtoupper($_POST["fname"]);
    $mname           = strtoupper($_POST["mname"]);
    $lname           = strtoupper($_POST["lname"]);
    $gender          = $_POST["gender"];  
    $designation     = $_POST["designation"];
    $position        = $_POST["position"];
    $division        = $_POST["division"];
    $office          = $_POST["office"];
    $birthdate1      = $_POST["birthdate"];               
    $birthdate      = date('Y-m-j H:i:s',strtotime($birthdate1));               
    $email           = $_POST["email"]; 
    $alter_email     = "";           
    $contact         = $_POST["contact"]; 
    $username        = $_POST["username"];  
    $password        = $_POST["password"];  
    $repassword      = $_POST["repassword"];  
    $cluster         = "";       
    $access         = "";       
    $cellphone       = $_POST["cellphone"];

    $sqlUsername =  "SELECT * FROM tblemployee WHERE md5(UNAME) = '".md5($username)."' LIMIT 1";    
    $sqlEMP_N =  "SELECT EMP_NUMBER FROM tblemployee WHERE EMP_NUMBER = '".$employee_number."' LIMIT 1";    
    if (!ifRecordExist($sqlEMP_N)){
      if (!ifRecordExist($sqlUsername)){
        if ($password == $repassword){

          $sql_insert_query     = "INSERT INTO tblemployee (
          EMP_NUMBER,
          LAST_M, FIRST_M, MIDDLE_M, BIRTH_D, SEX_C,
          REGION_C, PROVINCE_C, CITYMUN_C,
          POSITION_C, DESIGNATION, 
          MOBILEPHONE, EMAIL, ALTER_EMAIL, AGENCY_EMP_NO, 
          CODE, UNAME, PSWORD, DATE_CREATED,
          CLUSTER, LANDPHONE, OFFICE_STATION, DIVISION_C, ACCESSLIST, ACCESSTYPE)
          VALUES (    ?, ?, ?, ?, ?, 
          ?, ?, ?, ?, 
          ?, ?, 
          ?, ?, ?, ?, 
          ?, ?, ?, ?,
          ?, ?, ?, ?, '".$access."', 'user')";


          if ($insertSQL = $DBConn->prepare($sql_insert_query)) 
          { 

           $date_created   = date("Y-m-j H:i:s");
           $code     = substr(str_replace('+', '.', base64_encode(pack('N4', mt_rand(), mt_rand(), mt_rand(), mt_rand()))), 0, 22);
           $password   = crypt($password, '$2a$10$'.$code.'$');
           $insertSQL->bind_param("ssssssddddsssssssssssss", $employee_number,$lname, $fname, $mname, $birthdate, $gender, $region, $province, $municipality, $position, $designation, $cellphone, $email, $alter_email, $employee_number, $code, $username, $password, $date_created, $cluster, $contact, $office, $division);
           /* execute query */
           $insertSQL->execute();

           $sql1 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
           VALUES (NULL,$employee_number,'-',null,null,null,'0000-00-00')";
           $connect->prepare($sql1)->execute([$employee_number]); 

           $sql2 = mysqli_query($conn,"INSERT INTO `hris_personnal_information`(
             `ID`, 
             `EMP_ID`,
             `SEX`, 
             `DOB`, 
             `POB`, 
             `HEIGHT`, 
             `WEIGHT`, 
             `BLOOD_TYPE`,
             `CIVIL_STATUS`, 
             `MOB_NO`, 
             `TEL_NO`, 
             `EMAIL`, 
             `GSIS_NO`, 
             `PAGIBIG_NO`, 
             `PHILHEALTH_NO`, 
             `SSS_NO`, 
             `TIN_NO`, 
             `DILG_NO`, 
             `HOUSE_NO`, 
             `STREET`, 
             `SUBDIVISION`, 
             `BARANGAY`, 
             `MUNICIPALITY`, 
             `PROVINCE`,
             `ZIP_CODE`) 
             VALUES (null,'$employee_number','-','0000-00-00','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-')");
           $connect->prepare($sql1)->execute([$employee_number]);

           echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Successfuly Saved!')
            window.location.href = 'index.php?';
            </SCRIPT>");

         }else{
           echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Error Occured Uppon Saving!');
            </SCRIPT>");
         }
       }else{
         echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.alert('Password Does Not Match!');
          </SCRIPT>");
       }
     }else{
       echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Username Already Exist!');
        </SCRIPT>");
     }
   }else{
     echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Employee Number Already Exist!');
      </SCRIPT>");
   }
}

   ?>


   <script src="jquery-1.12.0.min.js" type="text/javascript"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script type="text/javascript">
    $(document).ready(function(){

      $("#sel_depart").change(function(){
        var deptid = $(this).val();

        $.ajax({
          url: 'getUsers.php',
          type: 'post',
          data: {depart:deptid},
          dataType: 'json',
          success:function(response){

            var len = response.length;

            $("#sel_user").empty();
            for( var i = 0; i<len; i++){
              var id = response[i]['citymun_c'];
              var name = response[i]['citymun_m'];

              $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");

            }
          }
        });
      });

    });
  </script>

  <div class="box box-success">
    <div class="box-header with-border">
     <h1 align="center" style="font-family: Cambria;">FAS IV-A Registration</h1>
     <div class="box-header with-border">
     </div>
     <br>
     <br>
     <form method="POST" >
      <div class="well">
        <div class="box-header with-border">
          <h3 class="box-title">Please Fill up Required Fields <font style="color:red;">(*)</font></h3>
        </div>
        <div class="box-body">
          <div class="row" id="boxed">
            <div class="col-xs-4">
              <label>Employee No. <font style="color:red;">*</font></label>
              <input required type="text" class="form-control demoInputBox" placeholder="Employee No." name="employee_number" id="employee_number"onBlur="checkAvailability()"><span id="user-email-availability-status"></span>
            </div>
            <div class="col-xs-4">
              <label>Designation<font style="color:red;">*</font></label>
              <select required class="form-control select2" style="width: 100%;" name="designation" id="" >
                <option disabled selected></option>
                <?php echo tbldesignation($connect)?>
              </select>
            </div>
            <div class="col-xs-4">
              <label>Gender<font style="color:red;">*</font></label>
              <select class="form-control select2" name="gender">
                <option required selected disabled>Select Gender</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
              </select>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="col-xs-4">
              <label>Office Station<font style="color:red;">*</font></label>
              <select required id="mySelect2" class="form-control" name="office">
                <option disabled selected></option>
                <option value="1">Regional Office</option>
                <option value="2">Provincial Office</option>
                <option value="3">Cluster Office</option>
                <option value="4">City Municipality Office</option>
              </select>
              <div hidden>
                <select  class="form-control select2" style="width: 100%;" id="mySelect2"   placeholder="Office Station" hidden >
                  <option disabled selected>Select Office Stations</option>
                  <option value="1">Regional Office</option>
                  <option value="2">Provincial Office</option>
                  <option value="3">Cluster Office</option>
                  <option value="4">City Municipality Office</option>
                </select>
              </div>
            </div>
            <div class="col-xs-4">
              <label>Position<font style="color:red;">*</font></label>
              <select required class="form-control select2" style="width: 100%;" name="position" id="" >
                <option disabled selected></option>
                <?php echo tbldilgposition($connect)?>
              </select>
            </div>
            <div class="col-xs-4">
              <label>Birth Date<font style="color:red;">*</font></label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input required type="text" name="birthdate" class="form-control pull-right" id="datepicker" placeholder="Birth Date">
              </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="col-xs-4">
              <label>Province</label>
              <input type="text" name="province" hidden>
              <select disabled class="form-control select2" style="width: 100%;" name="province" id="sel_depart" >
                <option disabled selected></option>
                <option value="10">Batangas</option>
                <option value="21">Cavite</option>
                <option value="34">Laguna</option>
                <option value="56">Quezon</option>
                <option value="58">Rizal</option>
              </select>
              <div class="clear"></div>
            </div>
            <div class="col-xs-4">
              <label>First Name<font style="color:red;">*</font></label>
              <input required type="text" name="fname" class="form-control" placeholder="First Name">
            </div>
            <div class="col-xs-4">
              <label>Email</label>
              <input type="text" name="email" class="form-control" placeholder="ex. charlesodi1324@gmail.com (optional)">
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="col-xs-4">
              <label>Municipality</label>
              <input type="text" name="municipality" hidden>
              <select disabled id="sel_user" name="municipality" class="form-control select2">
                <option value="0"></option>
              </select>
            </div>
            <div class="col-xs-4">
              <label>Middle Name<font style="color:red;">*</font></label>
              <input required type="text" name="mname" class="form-control" placeholder="Middle Name">
            </div>
            <div class="col-xs-4">
              <label>Mobile <font style="color:red;">*</font></label>
              <input required type="text" name="cellphone" class="form-control" placeholder="ex. +63995-2647-434">
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="col-xs-4">
              <label>Division<font style="color:red;">*</font></label>
              <select required class="form-control select2" style="width: 100%;" name="division" id="" >
                <option disabled selected></option>
                <?php echo tblpersonnel($connect)?>
              </select>
            </div>
            <div class="col-xs-4">
              <label>Last Name<font style="color:red;">*</font></label>
              <input required type="text" name="lname" class="form-control" placeholder="Last Name">
            </div>
            <div class="col-xs-4">
              <label>Landline</label>
              <input type="text" name="contact" class="form-control" placeholder="ex. 501-0842 (optional)">
            </div>
            <br>
            <br>
            <br>
            <br>
          </div>
        </div>
        <!-- username and pw -->
      </div>
      <div class="well">
        <div class="box-header with-border">
          <h3 class="box-title">Username and Password</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-4">
              <label>Username<font style="color:red;">*</font> </label>
              <input required type="text" name="username" id="username" class="form-control demoInputBox" placeholder="Username"onBlur="checkUsernameAvailability()"><span id="user-username-availability-status"></span>

            </div>
            <div class="col-xs-4">
              <label>Password<font style="color:red;">*</font> </label>
              <input required type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="col-xs-4">
              <label>Re-type Password<font style="color:red;">*</font></label>
              <input required type="password" name="repassword" class="form-control" placeholder="Re-type Password">
            </div>

          </div>
        </div>
      </div>  
      <div class="row">
        <div class="col-xs-12" align="center" >
          <button class="btn btn-block btn-success" name="submit" type="submit" id="submit" style="width: 800px;font-stretch: ultra-expanded;font-size-adjust: 1;"><font size="3">Create</font></button>
        </div>
      </div>
    </div>
  </form>
</div>  
</div>  
<script>
  $('#mySelect2').on('change', function() {
    var value = $(this).val();
    if (value != '1') {
      document.getElementById("sel_depart").disabled=false;
      document.getElementById("sel_user").disabled=false;
    }
    else {
     $('#sel_depart').find('option').remove().end().append('<option disabled selected></option><option value="10">Batangas</option><option value="21">Cavite</option><option value="34">Laguna</option><option value="56">Quezon</option>  <option value="58">Rizal</option>') ;
     $('#sel_user').find('option').remove().end().append('<option disabled selected></option>') ;
     document.getElementById("sel_depart").disabled=true;
     document.getElementById("sel_user").disabled=true;
   }
 });

</script>
<script>
  function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
      url: "ch1.php",
      data:'employee_number='+$("#employee_number").val(),
      type: "POST",
      success:function(data){
        $("#user-email-availability-status").html(data);
        $("#loaderIcon").hide();
      },
      error:function (){}
    });
  }

  function checkUsernameAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
      url: "ch1.php",
      data:'username='+$("#username").val(),
      type: "POST",
      success:function(data){
        $("#user-username-availability-status").html(data);
        $("#loaderIcon").hide();
      },
      error:function (){}
    });
  }
</script>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'mm/dd/yyyy' })
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

