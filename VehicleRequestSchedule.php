<?php session_start();
date_default_timezone_set('Asia/Manila');

if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username1 = $_SESSION['username'];
}
$division = $_GET['division'];
require_once 'calendar/sample/bdd.php';
require_once 'calendar/sample/dbaseCon.php';
require_once 'calendar/sample/sql_statements.php';



$sql = "SELECT * from vr";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();

function viewEvents()
{
        ?>
            <form method = "POST" action = "calendar/add-event.php">
                <input  type = "hidden" name = "eventid" id = "eventid">
                <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assined Date</td>
                            <td class="col-md-5"><input readonly required type = "text" class = "form-control" name = "assigneddate" id = "assigneddate"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Time</td>
                            <td class="col-md-5">
                                <input readonly required type="text" class = "form-control " name = "assignedtime" id="assignedtime" value = ""   required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Dispatcher</td>
                            <td class="col-md-5">
                                <input  readonly type = "text"  class = "form-control datepicker2" id = "dispatcher" name = "dispatcher"    autocomplete = off /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">No. of Vehicles</td>
                            <td class="col-md-5"><input readonly  type = "text" class = "form-control" name = "nov" id = "nov" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Vehicle</td>
                            <td class="col-md-5"><input readonly required type = "text" class = "form-control" name = "av" id= "av" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Driver</td>
                            <td class="col-md-5"><input readonly required type = "number" min = "" name = "ad" id= "ad" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Plate</td>  
                            <td class="col-md-5">
                            <input readonly required type = "text" class = "form-control" name = "plate" id= "plate" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Remarks</td>
                            <td class="col-md-5">                              
                            <input readonly  type = "text"  class = "form-control" id= "vremarks"  name = "vremarks" />
                                    </td>
                                        </tr>
                
                    
                </table>
                <!-- <input type = "submit" name = "submit" style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-success" value = "Save">  -->

            </form>
        <?php
    
}

function getCurrentID()
{
    include 'connection.php';
    $sqlQuery = "SELECT ID FROM `vr`  ORDER BY ID DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlQuery);
    if ($row = mysqli_fetch_array($result)) {
        echo $row['ID'];
    }
}

function viewEvents2()
{
  ?>

    <form method = "POST" action = "calendar/edit-event.php" id = "edit_act">
    <input  type = "hidden" name = "eventid" id = "eventid">
<?php 


  ?>
  <input  type = "hidden" name = "eventid" id = "eventid">
                <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assined Date</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "assigneddate" id = "assigneddate"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Time</td>
                            <td class="col-md-5">
                                <input required type="text" class = "form-control " name = "assignedtime" id="assignedtime" value = ""   required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Dispatcher</td>
                            <td class="col-md-5">
                                <input  type = "text"  class = "form-control datepicker2" id = "dispatcher" name = "dispatcher"    autocomplete = off /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">No. of Vehicles</td>
                            <td class="col-md-5"><input  type = "text" class = "form-control" name = "nov" id = "nov" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Vehicle</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "ac" id= "av" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Driver</td>
                            <td class="col-md-5"><input required type = "number" min = "" name = "ad" id= "ad" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Plate</td>  
                            <td class="col-md-5">
                            <input required type = "text" class = "form-control" name = "plate" id= "plate" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Remarks</td>
                            <td class="col-md-5">                              
                            <input  type = "text"  class = "form-control" id= "vremarks"  name = "vremarks" />
                                    </td>
                                        </tr>
                
                    
                </table>
  


              
               <?php 
                
             
                  // echo ' <a id = "edit"  style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-primary"> Edit</a>';
                  // echo ' <input id = "save"  type = "submit" name = "submit" style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-success" value = "Save Changes"> ';
                

               ?>

            </form>
  <?php
}
?>
  
  <!DOCTYPE html>
<html>
  <head>
  <link rel="shortcut icon" type="image/png" href="dilg.png">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FAS | Calendar</title>
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
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="calendar/fullcalendar/fullcalendar.min.css" />
    <script src="calendar/fullcalendar/lib/jquery.min.js"></script>
    <script src="calendar/fullcalendar/lib/moment.min.js"></script>
    <script src="calendar/fullcalendar/fullcalendar.min.js"></script>
   
    <style>
  
  #calendar {
      width: 100%;
      padding:10px;
      margin: 0 auto;
      background-color:#ECEFF1;
  }

  
  
  .response {
      height: 60px;
  }
  
  .success {
      background: #cdf3cd;
      padding: 10px 60px;
      border: #c3e6c3 1px solid;
  }
    </style>
 <?php 

if ($username == 'charlesodi' || $username == 'itdummy1' || $username == 'mmmonteiro' || $username == 'jamonteiro' || $username == 'rlsegunial' || $username == 'masacluti' || $username == 'cvferrer' || $username == 'seolivar' || $username == 'magonzales') {

      include('test1.php');
}else{
  include('sidebar2.php');

}
 
  
 ?>
<?php include 'connection.php';?>

  <div class="content-wrapper">
    <section class="content-header">
    <br>
      <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">GSS</li>
        <li class="active">Vehicle Request</li>
        <li class="active">Trip Schedule</li>
      </ol><br>
    
      <?php
if($_GET['flag'] == 1)
{
    ?>
    <script>
    $(document).ready(function(){
        displayMessage('Data has been successfully updated.');
      
    });</script>
    <?php
}
?>
  
<div id="openviewWeather">
      <!-- <a class="weatherwidget-io" href="https://forecast7.com/en/12d88121d77/philippines/" data-label_1="Philippines" data-label_2="Weather" data-font="Roboto" data-icons="Climacons Animated" data-theme="original" data-accent="rgba(1, 1, 1, 0.0)"></a> -->
  </div>
  
  <script>
  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
  </script>
    <?php include 'vehicle_calendar.php';?>
 &nbsp;
 &nbsp;
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
          <?php 
          if($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial')
          {
            echo  '<label id ="title">View Assigned Drivers</label>';
          }else{
            echo  '<label id ="title" >View Assigned Drivers</label>';
          }
          ?>  
         </h4>
         
          <button type="button" class="close" data-dismiss="modal">&times; 
          </button>
        </div>
        <div class="modal-body">
          <?php echo viewEvents2();?>
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Activity</h4>
          <button type="button" class="close" data-dismiss="modal">&times; 
          </button>
        </div>
        <div class="modal-body">
          <?php echo viewEvents();?>
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>


        
    <br>

    </section>
  </div>


  <footer class="main-footer">
  <br>

    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>DILG IV-A Regional Information and Communications Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
  </footer>
  <br>

  <div class="control-sidebar-bg"></div>
</div>

<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>

$(document).ready(function() {
    

  
  //WEATHER GRAMATICALLY
  
  function retira_acentos(str) {
    var com_acento = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝRÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿr";
    var sem_acento = "AAAAAAACEEEEIIIIDNOOOOOOUUUUYRsBaaaaaaaceeeeiiiionoooooouuuuybyr";
    var novastr="";
    for(i=0; i<str.length; i++) {
      troca=false;
      for (a=0; a<com_acento.length; a++) {
        if (str.substr(i,1)==com_acento.substr(a,1)) {
          novastr+=sem_acento.substr(a,1);
          troca=true;
          break;
        }
      }
      if (troca==false) {
        novastr+=str.substr(i,1);
      }
    }
    return novastr.toLowerCase().replace( /\s/g, '-' );
  }
  
  //WEATHER THEMES
  
  document.getElementById('switchWeatherTheme').addEventListener('change', function(){
    
    var valueTheme = $(this).val();
    var widget = document.querySelector('.weatherwidget-io');
    widget.setAttribute('data-theme', valueTheme);
    __weatherwidget_init();
    
  });
  
  //WEATHER LOCATION
  var input = document.getElementById('searchTextField');
  var autocomplete = new google.maps.places.Autocomplete(input);
  
  google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    var latitude = place.geometry.location.lat();
    var longitude = place.geometry.location.lng();
    var newPlace = retira_acentos(place.name);
    
    var urlDataWeather = 'https://forecast7.com/en/'+ latitude.toFixed(2).replace(/\./g,'d').replace(/\-/g,'n') + longitude.toFixed(2).replace(/\./g,'d').replace(/\-/g,'n') + '/'+ newPlace +'/';
    
    alert(urlDataWeather);
    
    var weatherWidget = document.querySelector('.weatherwidget-io');
    weatherWidget.href = urlDataWeather;
    weatherWidget.dataset.label_1 = place.name;
    __weatherwidget_init();
    
    //document.getElementById('city2').value = place.name;
    //document.getElementById('cityLat').value = place.geometry.location.lat();
    //document.getElementById('cityLng').value = place.geometry.location.lng();
    //alert("This function is working!");
    //alert(place.name);
    // alert(place.address_components[0].long_name);

  });
  
});


</script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
<script>

$(document).ready(function()
{
 
$( "#all" ).prop( "checked", true );
$( "#ReynaldoParale" ).prop( "checked", true );
$( "#LouieBlanco" ).prop( "checked", true );
$( "#JoachimLacdang" ).prop( "checked", true );
$( "#MedelSaturno" ).prop( "checked", true );
$( "#DanielNarciso" ).prop( "checked", true );
      

});
$(document).ready(function() {

  $("#all").click(function(){
    $('#all').not(this).prop('checked', this.checked);
    $('#ReynaldoParale').not(this).prop('checked', this.checked);
    $('#LouieBlanco').not(this).prop('checked', this.checked);
    $('#JoachimLacdang').not(this).prop('checked', this.checked);
    $('#MedelSaturno').not(this).prop('checked', this.checked);
    $('#DanielNarciso').not(this).prop('checked', this.checked);
   
});


          if($('input[id=ReynaldoParale]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=LouieBlanco]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=JoachimLacdang]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=MedelSaturno]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=DanielNarciso]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }
          if($('input[id=ReynaldoParale]').is(':checked') && 
            $('input[id=LouieBlanco]').is(':checked') && 
            $('input[id=JoachimLacdang]').is(':checked') &&
            $('input[id=MedelSaturno]').is(':checked')&&
            $('input[id=DanielNarciso]').is(':checked')
            )
            
            {
            $( "#all" ).prop( "checked", true );
            }
            else{
              $( "#all" ).prop( "checked", false )

            }

});  
</script>

</body>
</html>
