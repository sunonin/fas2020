
<?php
error_reporting(0);
ini_set('display_errors', 0);
include 'connection.php';
include 'travelclaim_functions.php';
?>

<!DOCTYPE html>
<html>
<head>
  <script src="jquery.min.js"></script>
  <style>
  table{
    margin-left:auto; margin-right:auto;
  }
  </style>
<?php
// PHP FUNCTION

function aa($id)
{
    include 'connection.php';
    $query = "SELECT distinct(DATE) from tbltravel_claim_info";
    $result = mysqli_query($conn, $query);
    $date = array();
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $date = $row['DATE'];
            $query1 = "SELECT *,tbltravel_claim_info.ID AS 'PID'FROM tbltravel_claim_info 
            INNER JOIN tbltravel_claim_ro on tbltravel_claim_info.RO = tbltravel_claim_ro.ID 
            WHERE tbltravel_claim_info.`RO` = '".$id."' and tbltravel_claim_info.`DATE` = '".$date."' ORDER BY DATE";
            $result1 = mysqli_query($conn, $query1);
            $saved = array();
    
            if(mysqli_num_rows($result1) > 0)
            {
                while($row1 = mysqli_fetch_array($result1))
                {
                    $saved[] = $row1["DATE"]; // you are missing []
                    $TOT =sprintf("%.2f",$row1['TOTAL_AMOUNT']);

                  if($row1['DATE'] == $row1['DATE'])
                  {
                      if($row1['DATE'] == $saved[1])
                      {
                          echo '<td></td>';
                      }else
                      {
                          ?>
                              <td style = "width:9.8%;"><input readonly id = "travel_date" type = "text" class = "form-control" style = "width:100%;" value = "<?php echo date('F d, Y', strtotime($row1['DATE']));?>"/></td>
                          <?php
                      }   
                      
                  }else{
                  ?>
                  
                  <tr style =" display:table; table-layout:fixed; width:100%;">
                      <?php }?>
                      <td ><textarea readonly cols = 13 style = "resize:none;background:#ECEFF1;border:1px solid #CFD8DC;"><?php echo $row1['PLACE'];?></textarea></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo date('g:i A',strtotime($row1['ARRIVAL']));?>"/></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo date('g:i A',strtotime($row1['DEPARTURE']));?>"/></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo $row1['MOT'];?>"/></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo sprintf("%.2f",$row1['TRANSPORTATION']);?>"/></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo sprintf("%.2f",$row1['PERDIEM']);?>"/></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo $row1['OTHERS'];?>"/></td>
                      <td><input readonly type = "text" class = "form-control" style = "width:100%%;" value = "<?php echo sprintf("%.2f",$row1['TOTAL_AMOUNT']);?>"/></td>
                                                <?php 
                          if(basename($_SERVER['PHP_SELF']) == 'ViewTravelClaim.php')
                          {
                          }
                          else{
                          ?>
                                      <td style = "width:10%;text-align:center;">
                                        <!-- <span class = "btn btn-sm btn-primary"><i class = "fa fa-edit"></i>&nbsp;Edit</span> -->
                                        <span class = "btn btn-md btn-danger"  id = "btnids<?php echo $row1['PID']; ?>" data-id = "<?php echo $row1['PID'];?>" value = "<?php echo $row1['PID'];?>"><i class = "fa fa-trash"></i>&nbsp;Delete</span>
                                      </td>

                          <?php
                          }
                          ?>

        </tr>
        
        <?php
        $row1['DATE'] = '';
        ?>
        <script>
          $(document).ready(function(){
              $( "#btnids<?php echo $row1['PID'];?>" ).click(function() {
                swal({
                      title: "Are you sure?",
                      text: "Your will not be able to recover this travel date!",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonClass: "btn btn-danger",
                      confirmButtonText: "Yes, delete it!",
                      closeOnConfirm: false
                      },
                      function(){
                      swal("Deleted!", "Your travel date  has been deleted.", "success");
                          $.ajax({
                              url:"travelclaim_functions.php",
                              method:"POST",
                              data:{
                              'action': 'deleteTravelOrder',
                              "id": <?php echo $row1['PID'];?>,
                          },
                          success:function(data)
                          {
                      
                                setTimeout(function () {
                                window.location = "CreateTravelClaim.php?step=1&ro=<?php echo $_GET['ro'];?>&ui=1username=<?php echo $_GET['username'];?>&division=<?php echo $_GET['division'];?>";
                                }, 1000);
                            
                          }
                          });

                      }
                      );
              });
          });
        </script>
      <?php
                }
            }
        }
    }
}
function showData()
{
  include 'connection.php';
        
  $query = "SELECT * FROM `tbltravel_claim_info2`
  INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
  INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
  WHERE  `RO_TO_OB`= '".$_GET['ro']."'
  GROUP by tbltravel_claim_info.RO ";
  
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)    
        {
          $rnums = mysqli_num_rows($result);
          ?>
              <thead style =" display:table; table-layout:fixed; width:100%;">
                <tr>
                  <th class = "table-header" style = "text-align:center;width:11%;" rowspan = 2> Date </th>
                  <th class = "table-header" style = "text-indent:10px;text-align:center;" rowspan = 2>Places to be visited (Destination)</th>
                  <th class = "table-header" style = "text-indent:10px;text-align:center;" colspan = 2>Time</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Means of Transportation</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Transportation</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Per Diem</th>
                  <th class = "table-header" style = "text-indent:10px;text-align:center;" rowspan = 2>Others</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Total Amount</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan =3>Action</th>
                </tr>
                <tr>
                  <th class = "table-header"  style = "text-align:center;">Arrival</th>
                  <th class = "table-header"  style = "text-align:center;">Departure</th>
                </tr>
              </thead>
          <?php
          if($rnums>0){
            rowCount();
          }else{rowCount();}
          ?>

            
          <?php
            while($row = mysqli_fetch_array($result))
            {
              
            ?>
            <tr>
                <td colspan = 10 style = "background-color:#B0BEC5;"><?php echo '<b>'.$row['RO_OT_OB'].'</b>'; ?> </td>
            </tr>
            
            
            <?php
            aa($row['ID']);
            }
            ?>
           </tbody>

            <?php
        }else{
            $query = "SELECT * FROM tbltravel_claim_info2 WHERE `NAME` = '".$_GET['username']."'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                  
                    ?>

                  <tr>    
                      
                  </tr>
            <tr>
            </tr>
        
            <?php
                }
            }
            ?>
          

            <?php
        }

    
}

function rowCount(){
  
  include 'connection.php';
  $query1 = "SELECT * FROM tbltravel_claim_info2 INNER JOIN tbltravel_claim_info on tbltravel_claim_info2.ID = tbltravel_claim_info.TC_ID";
  $result1 = mysqli_query($conn, $query1);
  $row_cnt = $result1->num_rows;
  if($row_cnt == 0)
  {
  
    }  else if($row_cnt == 1)
  {
    ?>
              <tbody class = "scroll" style ="height:90px;">
    <?php
  }else if($row_cnt == 2) {
    ?>
              <tbody class = "scroll" style ="height:180px;">
    <?php
  }else if($row_cnt == 3) {
    ?>
              <tbody class = "scroll" style ="height:270px;">
    <?php
  }else if($row_cnt == 4) {
    ?>
              <tbody class = "scroll" style ="height:360px;">
    <?php
  }else if($row_cnt == 5) {
    ?>
              <tbody class = "scroll" style ="height:200px;">
    <?php
  }else{
    ?>
              <tbody style ="height: 300px;display:block; overflow:auto;">
    <?php

  }
}
function isSubmit()
{
  include 'connection.php';
  $name = '';
  $query0 = "SELECT PURPOSE FROM `tbltravel_claim_info2` inner join tbltravel_claim on tbltravel_claim_info2.RO_TO_OB = tbltravel_claim.PURPOSE";
  $result0 = mysqli_query($conn, $query0);
  if($row0 = mysqli_fetch_array($result0))
  {
    $PURPOSE = $row0['PURPOSE'];


  $query1 = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
  $result1 = mysqli_query($conn, $query1);
  if($row1 = mysqli_fetch_array($result1))
  {
      $name = ucwords(strtoupper($row1['FIRST_M'])).' '.ucfirst(strtoupper($row1['LAST_M']));
        $query = "SELECT * FROM `tbltravel_claim` WHERE `IS_SUBMIT` = 1 AND `NAME` ='".$name."' AND `PURPOSE` = '".$PURPOSE."' order by DATE_OF_TRAVEL DESC  LIMIT 1";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)    
        {

            
          }else{
            showData();
            
          }
        }
      }
    }

?>
</head>


<div class="box">
  <div class="box-body">
    <h1 align="">&nbsp<b>Create Itinerary</b></h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i><a href="CreateTravelClaim.php?username=<?php echo $username;?>&division=<?php echo $_SESSION['division'];?>" style="color:white;text-decoration: none;">Back</a></li>
    <br>
    <br>
        <div class="box-body">
            <div class="well" style = "padding:20px;">
            <button class="gototab btn btn-lg btn-success pull-left" onclick="goToTabByDelta(-1)">Previous</button> 
	<button class="gototab btn btn-lg btn-success pull-right" style = "margin-left:5%;width:6%;" onclick="goToTabByDelta(+1)">Next</button>
<br><br>

            
                


<script>
// Global var to store active tab index
var activeTabIndex = 1;
var numberOfTabs;

window.onload=function() {
  // get tab container
  var container = document.getElementById("tabContainer");
  // this adds click event to tabs
  var tabs = container.getElementsByTagName("li");
  // dynamic calculation of number of tab
  numberOfTabs = tabs.length;
  // attache on each tab header click event
  tabs[0].onclick=displayPage1;
  tabs[1].onclick=displayPage2;
  tabs[2].onclick=displayPage3;
  // active first tab by default
  goToTabByIndex(1);
};
	

// Tab 1 on-click
function displayPage1(event) {
  goToTabByIndex(1);
}

// Tab 2 on-click
function displayPage2(event) {
  goToTabByIndex(2);
}

// Tab 3 on-click
function displayPage3(event) {
  goToTabByIndex(3);
} 
 
/**
 * Use to display a particular tab
 */ 
function displayTab(tabIndex) {
  document.getElementById("tabHeader_" + tabIndex).setAttribute("class","tabActiveHeader");
  document.getElementById("tabpage_" + tabIndex).setAttribute("style", "display: block");
}
 
/**
 * Use to hide a particular tab
 */ 
function hideTab(tabIndex) {
  document.getElementById("tabHeader_" + tabIndex).removeAttribute("class","tabActiveHeader");
  document.getElementById("tabpage_" + tabIndex).setAttribute("style", "display: none");
}
 
/**
 * Use by previous / next button
 */
function goToTabByDelta(deltaIndex) {
  // Get previous/next tab 
  activeTabIndex = activeTabIndex + deltaIndex;
  if (activeTabIndex > numberOfTabs) { activeTabIndex = 1; }
  if (activeTabIndex < 1) { activeTabIndex = numberOfTabs ; }
  // Loop over every tab 
  for (var i=1; i<=numberOfTabs; i++) {
    if (i == activeTabIndex) {
      displayTab(i);
    } else {
      hideTab(i); 
    }
  }
}

/**
 * Use by tab on-click
 */
function goToTabByIndex(newActiveTabIndex) {
  activeTabIndex = newActiveTabIndex
  // Loop over every tab 
  for (var i=1; i<=numberOfTabs; i++) {
    if (i == newActiveTabIndex) {
      displayTab(i);
    } else {
      hideTab(i); 
    }
  }
}
</script>
<style>
body {
	font-family: arial;
}
.tabContainer  {
 
	padding:15px;
	-moz-border-radius: 4px;
	border-radius: 4px; 
}
.tabs{
	overflow:hidden;
}
.tabs > ul{
	font: 1em;
	list-style:none;
}
.tabs > ul > li {
	margin:0 2px 0 0;
	padding:7px 10px;
	display:block;
	float:left;
	color:#333;
	-webkit-user-select: none;
	-moz-user-select: none;
	user-select: none;
	-moz-border-radius-topleft: 4px;
	-moz-border-radius-topright: 4px;
	-moz-border-radius-bottomright: 0px;
	-moz-border-radius-bottomleft: 0px;
	border-top-left-radius:4px;
	border-top-right-radius: 4px;
	border-bottom-right-radius: 0px;
	border-bottom-left-radius: 0px; 
	
	background: #FFFFFF; /* old browsers */
	background: -moz-linear-gradient(top, #FFFFFF 0%, #F3F3F3 10%, #F3F3F3 50%, #FFFFFF 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FFFFFF), color-stop(10%,#F3F3F3), color-stop(50%,#F3F3F3), color-stop(100%,#FFFFFF)); /* webkit */
	cursor:pointer;
	border: 1px #ccc solid;
}
.tabs > ul > li:hover {
	color:#ccc;
	background: #C9C9C9; /* old browsers */
	background: -moz-linear-gradient(top, #0C91EC 0%, #257AB6 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0C91EC), color-stop(100%,#257AB6)); /* webkit */
}
.tabs > ul > li.tabActiveHeader {
	color:#FFF;
	color: #333background: #C9C9C9; /* old browsers */
	background: -moz-linear-gradient(top, #0C91EC 0%, #257AB6 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0C91EC), color-stop(100%,#257AB6)); /* webkit */
}
.tabscontent {
	-moz-border-radius-topleft: 0px;
	-moz-border-radius-topright: 4px;
	-moz-border-radius-bottomright: 4px;
	-moz-border-radius-bottomleft: 4px;
	border-top-left-radius: 0px;
	border-top-right-radius: 4px;
	border-bottom-right-radius: 4px;
	border-bottom-left-radius: 4px; 
	padding:10px 10px 25px;
	background: #FFFFFF; /* old browsers */
	background: -moz-linear-gradient(top, #FFFFFF 0%, #FFFFFF 90%, #e4e9ed 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FFFFFF), color-stop(90%,#FFFFFF), color-stop(100%,#e4e9ed)); /* webkit */
	margin:0;
	color:#333;
	border: 1px #ccc solid;
}
/* .gototab {
	cursor: pointer;
	background: green;
	color: #fff;
	padding: 10px;
	height: 30px;
	line-height: 30px;
	width: 100px;
	text-align: center;
	float: left;
	margin: 10px;
} */

</style>
<div id="tabContainer" class="tabContainer">
    <div class="tabs" id="tabs">
	<ul class="nav nav-tabs">
        <li id="tabHeader_1">Itinerary</li>
        <li id="tabHeader_2">ORS</li>
        <li id="tabHeader_3">DV</li>
      </ul>
    </div>
    <div id="tabscontent" class="tab-content">
      <div class="tabpage" id="tabpage_1">
        <h2 style = "text-align:center;">Itinerary of Travel</h2>
        <p style = "text-align:center;">Appendix 45</p>
          <form method = "POST" action = "travelclaim_functions.php?action=add">
              <table  cellpadding="0" cellspacing="0" width="80%" border="1">
                <thead>
                  <tr>
                      <td class = "label-text">
                        <label>Entity Name: 
                          </td>
                            <td colspan = 10  >
                          <input type = "text" class = "form-control" value = "DILG Region IV-A" readonly name = "entity_name"/>
                        </td>
                    </tr>
            
                
                  <tr>
                    <td class = "label-text">
                      <label>Fund Cluster:</label>
                        </td>
                          <td colspan = "4">
                        <input type = "text" class = "form-control" readonly name = "fund_cluster" />
                      </td>
                    <td class = "label-text" colspan = 2>
                      <label>No:</label>
                        </td>
                          <td colspan = 4>
                        <input type = "text" class = "form-control" readonly name = "numero"/>
                      </td>
                  </tr>
                  <tr>
                    <td class = "label-text">
                      <label>Name: 
                        </td>
                    <td colspan = 4><input type = "text" class = "form-control" style = "font-weight:bold;"value = "<?php echo getCompleteName();?>" readonly name = "complete_name"/></td>
                    <td colspan = 2 class = "label-text"><label>Date of Travel: <label style="color: Red;" >*</label> </label></td>
                    <td colspan = 4><input type = "text" class = "form-control datepicker1" id = "datepicker1" value = "<?php echo date('F d, Y');?>" name = "date_of_travel"/></td>
                  </tr>
                  <tr>
                    <td class = "label-text">  <label>Position:</label></td>
                      <td colspan = 4 ><input type = "text" class = "form-control" value = "<?php echo getPosition();?>" readonly name = "position"/></td>
                        <td colspan = 5 rowspan = 2>
                          <label>Purpose of Travel:</label> <label style="color: Red;" >*</label><textarea rows = 4 col=10 style = "width:100%;resize:none;" id = "or" ><?php if($_GET['ro'] == 'null'){ }else{echo $_GET['ro'];}?></textarea>
                          <input type = "hidden" value="<?php echo getPurposeTravel($_GET['username']);?>" name = "purpose_of_travel"/>
                          </td>
                  </tr>
                  <tr>
                    <td class = "label-text">  <label>Official Station: </label></td>
                    <td colspan = 4> <?php echo getOffice(); ?> </td>
                  </tr>
                </thead>
              </table>
              <table class="equalDivide" cellpadding="0" cellspacing="0" width="80%" border="1" >
                <?php echo showData();?>
              </table>
              <table class="equalDivide" cellpadding="0" cellspacing="0" width="80%" border="1">
                <tr>
                    <td colspan = 10>
                        <button type = "button" class = "btn btn-success btn-md" style = "width:10.5%;font-family:Arial;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                        <button type = "button" class = "btn btn-primary btn-md" style = "font-family:Arial" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button>
                    </td>
                </tr>
                <tr>
                    <td colspan = 10>TOTAL <?php getTotal(); ?></td>
                  </tr>
                <tr>
                    <td rowspan = 5 colspan = 5 style = "text-align:justify;"> 
                    I certify that : (1) I have reviewed the foregoing  itinerary,    (2)  the  travel  is necessary to  the service, (3) the period covered   is   reasonable   and   (4)  the expenses claimed are proper.   
                    <CENTER><br>_____________________________________________<br>
                    <b>DR. CARINA S. CRUZ</b></CENTER>
                    </td>
                    <br>
                    <td colspan = 5 rowspan = 2>Prepared by:
                    <CENTER><br>_____________________________________________<br>
                    <?php echo '<b>'.getCompleteName().'</b>';?></CENTER>
                    </td>
                  
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                    <td colspan = 5 rowspan = 2>Approved By <CENTER><br>_____________________________________________<br> <b> ARIEL O. IGLESIA	</b> </CENTER> </td>
                  </tr>
                  <tr>
                  
                  </tr>
              
                  
              </table>
          </form>
      </div>
      <div class="tabpage" id="tabpage_2" style="display:none;">
        <h2 style = "text-align:center;">ORS</h2>
        <p style = "text-align:center;">Appendix 11</p>

        <table  cellpadding="0" cellspacing="0" width="80%" border="1" style = "border:1px solid black;">
          <tr>
            <td style = "width:60%;">
              <h3 style = "text-align:center;font-family:Times New Roman;font-weight:bold;">
                OBLIGATION REQUEST AND STATUS<br><u>DILG IV-A</u><br><span style = "font-size:20px;font-family:Times New Roamn;">Entity Name</span>
              </h3>
            </td>
            <td style = "background-color:#B0BEC5;font-family:Times New Roman;font-family:Times New Roman;font-weight:bold;">Serial No:<br>Date:<br>Fund Cluster:</td>
          </tr>
        </table>
        <table  cellpadding="0" cellspacing="0" width="80%" border="1" style = "font-family:Times New Roamn;border:1px solid black;">
          <tr>
            <td style = "background-color:#B0BEC5;font-weight:bold;">&nbsp;</td>
            <td colspan = 8><?php echo $_SESSION['complete_name'];?></td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;font-weight:bold;">Office</td>
            <td colspan = 8><?php echo getDivision();?></td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;font-weight:bold;">Address</td>
            <td colspan = 8><?PHP echo getAddress2();?></td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;font-weight:bold;">Responsibility Center</td>
            <td colspan = 4 style = "background-color:#B0BEC5;font-weight:bold;">Particulars</td>
            <td style = "background-color:#B0BEC5;font-weight:bold;">MFO/PAP</td>
            <td style = "background-color:#B0BEC5;font-weight:bold;">UACS Object Code</td>
            <td style = "background-color:#B0BEC5;font-weight:bold;" >Amount</td>
          </tr>
          <tr>
            <td><input type="text" name="q" class="form-control" disabled></td>
            <td colspan = 4>
            <textarea style = "resize:none" rows = "4" cols = "70"></textarea>
            </td>
            <td><input type="text" name="q" class="form-control" disabled></td>
            <td><input type="text" name="q" class="form-control" disabled></td>
            <td><input type="text" name="q" class="form-control" value = "<?PHP ECHO getOrsTotal();?>"></td>
          </tr>
          <tr>
            <td colspan = 3>
              <span style = "font-family: Times New Roman;margin-right:15px;font-weight:bold;">A.</span> 
              <span style = "font-style:justify;font-family: Times New Roman; text-margin:3px;"><b>Certified:</b> 
              Changes to appropriation/allotment are necessary, lawful and under 
              my direct supervision; and supporting documents valid, proper and legal 
              </span>
              <br>
              <br>
              Signature: _________________________________________________<br>
              Printed Name: <b>DR. CARINA S. CRUZ</b><br><br>
              Position: Chief, FAD
              <BR>
              <BR>
              Date: ________________________________________________________
            </td>
            <td colspan = 5>
            <span style = "font-family: Times New Roman;margin-right:15px;font-weight:bold;">B.</span> 
              <span style = "font-style:justify;font-family: Times New Roman; text-margin:3px;"><b>Certified:</b> 
              Allotment available and obligated for the purpose/adjustment necessary as indicared above 
              </span>
              <br>
              <br>
              Signature: _________________________________________________<br>
              Printed Name: <b>JORIELYN S. CUBIO</b><br><br>
              Position: OIC, Budget Section
              <BR>
              <BR>
              Date: ________________________________________________________
            </td>
          </tr>
          <tr>
          <td colspan = 8></td>
          </tr>
          <tr>
            <td style = "font-weight:bold;font-family:Times New Roman;">C.</td>
            <td colspan = 7 style = "text-align:center;font-weight:bold;"> STATUS OF OBLIGATION</td>
          </tr>
          <tr>
          <td  colspan = 2 style = "background-color:#B0BEC5;text-align:center;font-weight:bold;font-family: Times New Roman;"> Reference </td>
          <td colspan = 8 style = "background-color:#B0BEC5;text-align:center;font-weight:bold;font-family: Times New Roman;"> Amount </td>
          </tr>
          <tr>
          <td rowspan = 2 style = "width:20%;">Date</td>
          <td rowspan = 2>Particulars</td>
          <td rowspan = 2>ORS/JEV/Check/ADA/TRA No.</td>
          <td>Obligation</td>
          <td>Payable</td>
          <td>Payment</td>
          <td  colspan = 2 style = "text-align:center;">Balance</td>
          </tr>
          <tr>
          <td>(a)</td>
          <td>(b)</td>
          <td>(c)</td>
          <td>Not Yet Due</td>
          <td>Due and Demandable</td>
          </tr>
          <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          </tr>


        </table>  

      </div>
      <div class="tabpage" id="tabpage_3" style="display:none;">
      <h2 style = "text-align:center;">DISBURSEMENT VOUCHER</h2>
        <p style = "text-align:center;">Appendix 32</p>
        <table  cellpadding="0" cellspacing="0" width="80%" border="1" style = "border:1px solid black;">
            <tr>
              <td style = "width:60%;" rowspan = 3>
                <h3 style = "text-align:center;font-family:Times New Roman;font-weight:bold;">
                  <u>DILG IV-A<br></u><span style = "font-size:20px;font-family:Times New Roamn;">Entity Name</span><br>DISBURSEMENT VOUCHER
                </h3>
              </td>
              <td style = "background-color:#B0BEC5;font-family:Times New Roman;font-family:Times New Roman;font-weight:bold;">Fund Cluster:</td>
             
            </tr>
            <tr>
              <td style = "background-color:#B0BEC5;font-family:Times New Roman;font-family:Times New Roman;font-weight:bold;">Date:</td>
            </tr>
            <tr>
              <td style = "background-color:#B0BEC5;font-family:Times New Roman;font-family:Times New Roman;font-weight:bold;">DV No:</td>
            </tr>
        </table>
        <table  cellpadding="0" cellspacing="0" width="80%" border="1" style = "font-family:Times New Roamn;border:1px solid black;">
          <tr>
            <td style = "background-color:#B0BEC5;font-weight:bold;">Mode of Payment</td>
            <td colspan = 8>
            <input type = "checkbox"/> MDS Check &nbsp;&nbsp;&nbsp;
            <input type = "checkbox"/> Commercial Check &nbsp;&nbsp;&nbsp;
            <input type = "checkbox"/> ADA &nbsp;&nbsp;&nbsp;
            <input type = "checkbox"/> Others (Please specify)
            </td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;font-weight:bold;">Payee:</td>
            <td colspan = 2><?php echo $_SESSION['complete_name'];?></td>
            <td colspan = 3>TIN/Employee No.:</td>
            <td colspan = 2>ORS/BURS No.:</td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;font-weight:bold;">Address</td>
            <td colspan = 8><?PHP echo getAddress2();?></td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;font-weight:bold;">Particulars</td>
            <td colspan = 2 style = "background-color:#B0BEC5;font-weight:bold;">Responsibility Center</td>
            <td colspan = 4 style = "background-color:#B0BEC5;font-weight:bold;">MFO/PAP</td>
            <td colspan = 4 style = "background-color:#B0BEC5;font-weight:bold;" >Amount</td>
          </tr>
          <tr>
            <td>
            <textarea style = "resize:none" rows = "4" cols = "70">
              Payment for the travelling incurred for 
              authorized travels for February 2020,, in the amount of..........													

              Please refer to attached documents 

              *ORS
              *Signed Certificate of Travel Completed
              *Signed Itinerary of Travel
              *Department/Regional/Travel Order
              *Certificate of Appearance
              *Official Reciept
            </textarea>
            </td>
            <td colspan = 2>
            <input type="text" name="q" class="form-control" disabled>
          
            </td>
            <td colspan = 4><input type="text" name="q" class="form-control" disabled></td>
            <td><input type="text" name="q" class="form-control" value = "<?PHP ECHO getOrsTotal();?>"></td>
          </tr>
          <tr>
            <td style = "text-align:center;">Amount</td>
            <td colspan = 8><?php echo getTotal();?></td>
          </tr>
          <tr>
            <td style= "width:10%;font-weight:bold;" colspan = 16>
              A. Certified:  Expenses/Cash Advance necessary,  lawful and  incurred under my direct supervision.
            </td>
           
          </tr>
          <tr>
            <td colspan = 8 style = "text-align:center;"><br><br>
              <b>DR. CARINA S. CRUZ</b><br>
              Chief, FAD
              </td>
          </tr>
          <tr>
            <td style= "width:10%;font-weight:bold;" colspan = 16>
              B. Accounting Entry
            </td>
          </tr>
          <tr style = "background-color:#B0BEC5;font-weight:bold;" >
            <td>Account Title</td>
            <td colspan = 2>UACS Code</td>
            <td colspan = 4>Debit</td>
            <td colspan = 2>Credit</td>
          </tr>
          <tr>
            <td ></td>
            <td colspan = 2 ></td>
            <td colspan = 4 ></td>
            <td colspan = 2 ></td>
          </tr>
          <tr style = "height:10%;">
          <td ></td>
            <td colspan = 2 >&nbsp;</td>
            <td colspan = 4 >&nbsp;</td>
            <td colspan = 2 >&nbsp;</td>
          </tr>
          <tr style = "height:10%;">
          <td ></td>
            <td colspan = 2 >&nbsp;</td>
            <td colspan = 4 >&nbsp;</td>
            <td colspan = 2 >&nbsp;</td>
          </tr>
          
        
          <tr>
            <td style = "font-weight:bold;font-family:Times New Roman;">C. Certified</td>
            <td colspan = 7 style = "text-align:left;font-weight:bold;">D. Approved for Payment</td>
          </tr>
          <tr>
            <td>
              <input type = "checkbox" />&nbsp; Cash Available<br>
              <input type = "checkbox" />&nbsp; Subject to Authority to Debit Account (when applicable)<br>
              <input type = "checkbox" />&nbsp; Supporting documents complete and amount claimed
            </td>
            <td colspan = 8></td>

          </tr>
         
        
        


        </table> 

        <table cellpadding="0" cellspacing="0" width="80%" border="1" style = "border:1px solid black;">
        <tr>
          <td style = "width:10%;">Signature</td>
          <td>&nbsp;</td>
          <td style = "width:10%;">Signature</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style = "width:10%;">Printed Name</td>
          <td>AGNES S. SANGEL</td>
          <td style = "width:10%;">Printed Name</td>
          <td>NOEL R. BARTOLABAC, CESO V</td>
        </tr>
        <tr>
          <td style = "width:10%;">Position</td>
          <td>OIC-Regional Accountant</td>
          <td style = "width:10%;">Position</td>
          <td>Assistant Regional Director</td>
        </tr>
        <tr>
          <td style = "width:10%;">Date</td>
          <td></td>
          <td style = "width:10%;">Date</td>
          <td></td>
        </tr>
        </table>
        <table cellpadding="0" cellspacing="0" width="80%" border="1" style = "border:1px solid black;">
        <tr>
          <td colspan = 14>E. Receipt of Payment</td>
          <td rowspan = 4>JEV No.</td>
        </tr>
        <tr>
          <td style = "width:10%;">Check/ADA No. :</td>
          <td style = "width:36%;"></td>
          <td style = "width:10%;">Date</td>
          <td style = "width:36%;">Bank Name & Account Number:</td>
        </tr>
        <tr>
          <td style = "width:10%;">Signature:</td>
          <td style = "width:36%;"></td>
          <td style = "width:10%;">Date</td>
          <td style = "width:36%;">Printed Name:</td>
          <td rowspan = 4></td>


         
        </tr>
        <tr>
        <td colspan= 16>Official Receipt No. & Date/Other Documents</td>
        </tr>
        </table>
      </div>
    </div>
	</div>
	
</div>  
</div>  

	
	<div style="clear:both;">&nbsp;<div>
	
	<p style="margin-top: 150px;"></p>
</body>
<!-- ================= add travel =================== -->
<div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add Travel</h4>
                <span type="span" class="close" data-dismiss="modal">&times; 
                </span>
                </div>
                <div class="modal-body">
                <form method = "POST" action = "addTravelData.php">
                        <table class="table table-bordered" style = "width:100%;"> 
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">RO/TO/OB No.<span style = "color:red;">*</span></td>
                                    <td class="col-md-5"><input  type = "text" class = "form-control" name = "rto" id = "ro_txt"    /></td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">No. of Travel Days<span style = "color:red;">*</span></td>
                                    <td class="col-md-5">
                                        <input  type="text" class = "form-control" name = "ntd" autocomplete = off  >
                                            </td>
                                                </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Start Date<span style = "color:red;">*</span></td>
                                    <td class="col-md-5">
                                        <input  type = "text"  class = "form-control datepicker2" id = "datepicker2" name = "start"  placeholder="mm/dd/yyyy"   autocomplete = off /></td>
                                            </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">End Date</td>
                                    <td class="col-md-5"><input  type = "text"  class = "form-control datepicker3" id = "datepicker3" name = "end"  placeholder="mm/dd/yyyy"   autocomplete = off /></td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Origin<span style = "color:red;">*</span></td>
                                    <td class="col-md-5">
                                      <input type="text" class="form-control" id="search_input" name = "origin" placeholder="Type address..." />
                                    
                                    </td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Destination<span style = "color:red;">*</span></td>
                                    <td class="col-md-5">
                                    <input type="text" class="form-control" id="search_input2" name = "destination" placeholder="Type address..." />
                                    
                                    </td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Venue<span style = "color:red;">*</span></td>  
                                    <td class="col-md-5">
                                    <input  type = "text" class = "form-control" name = "venue" alue = "" />
                                        </td>
                                            </tr>
                        
                        </table>
                        <input type = "submit" class = "pull-right btn btn-success btn-md" value = "Save" name = "submit"/>
                </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
      </div>
      <!-- ================ travel dates ============== -->
      <div class="modal fade" id="add_travel_dates">
        <div class="modal-dialog" style = "width:50%;">
          <div class="modal-content" >
            <div class="modal-header">
              <h4 class="modal-title">Add Travel Dates</h4>
                <span type="span" class="close" data-dismiss="modal">&times; </span>
            </div>
            <div class="modal-body" style = " max-height: calc(100vh - 200px); overflow-y: auto;">
              <div class="box-body">
              <form method = "POST" action = "saveTravelInfo.php">
            <input type = "hidden" name = "hidden_ro" value = "<?php echo $_GET['ro'];?>" />

                <div class="well box box-success myTemplate2" style = "padding:10px;background:#ECEFF1">

                  <div class="box-body ">
                    <div class = "row">
                      <div class = "col-sm-12 col-md-12 col-lg-12">
                          <div class = "col-sm-6 col-md-6 col-lg-6">
                          <div class="col-md-12">
                                <div class="form-group">
                                  <label>Activity Title</label>
                                 <?php showActivityTitle();?>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Date</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name = "date[]" class="form-control datepicker4" data-inputmask="'alias': 'dd/mm/yyyy'" id = "datepicker4" data-mask required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <!-- <label>Time Going to Venue</label> -->
                                  <label>Departure</label>
                                    <input type = "time" name = "from1" class = "form-control "/>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Arrival</label>
                                  <input type = "time" name = "to1" class = "form-control"/>
                                </div>
                              </div>
                              <!-- <div class="col-md-6">
                                <div class="form-group">
                                  <label style = "font-size:13px;">Time Going Home or back to Official Station</label>
                                    <input type = "time" name = "from2" class = "form-control"/>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>&nbsp;</label>
                                  <input type = "time" name = "to2" class = "form-control" style = "margin-top:15px;"/>
                                </div>
                              </div> -->
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Others</label>
                                    <input type="text" name = "others" class="form-control" >
                                </div>
                              </div>
                          </div>
                          <div class = "col-sm-6 col-md-6 col-lg-6">

                            <div class="col-md-12 well perdiem">
                              <div>
                                
                                  <div class="form-group" id = "perdiem"><br>
                                    <label>
                                      Per Diem
                                    </label>
                                    <label class = "pull-right">
                                      <input type ="hidden" name = "distance" value = "<?php echo getDistance();?>" class = "distance"/> Distance: <?php echo getDistance(). 'km.';?>
                                    </label>
                                  </div>
                                  <div class="form-group">
                                    <input class="toggle-event" type="checkbox"><span class = "wpd">With Perdiem</span><br><br>
                                    <label> Meals </label><br>

                                    <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1 cb1"> <b>Will Claim Meals</b><br>
                                    <input style = "margin-left:14px" type="checkbox" name="breakfast[]" class="minimal-red checkboxgroup breakfast" value = "breakfast"> Breakfast
                                    <input type="checkbox" name="lunch[]" class="minimal-red checkboxgroup lunch" value = "lunch"> Lunch
                                    <input type="checkbox" name="dinner[]"  class="minimal-red checkboxgroup dinner" value = "dinner"> Dinner
                                    <br>
                                    <label>
                                    Accomodation
                                    </label><br>
                                    <input type="checkbox"   class="minimal-red wa" value = "With Accomodation accomodation_chkbox"><b> Will Claim Accomodation</b><br>
                                    <input style = "margin-left:14px" type="checkbox"  name = "with_receipt[]" class="minimal-red receipt wr" value ="With Receipt"> With Receipt
                                    <input type="text" disabled name="wor_txt[]"  class = "borderless wor_txt" style = "width:50%;"/>
                                    <br>
                                    <input style = "margin-left:14px"type="checkbox"  name = "wor_txt[]" class="minimal-red receipt wor" value ="Without Receipt"> Without Receipt
                                  
                                  </div>

                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div style = "padding:10px;" >
                    <div class="box-body ">
                      <div class="row ">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>From</label>
                              <input type="text" name = "from3[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>To</label>
                              <input type = "text" name = "to3[]" class = "form-control"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Means of Transportation</label>
                              
                              <input type="text" name = "mot[]" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Transportation Fare</label>
                              <input type = "text" name = "transpo_fare[]" class = "form-control"  />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    </div>



                  </div>

            

                  <div  style = "padding:10px;" id = "travelPanel">
                  </div>
                  <span class = "btn btn-primary btn-md pull-right" id= "add_fare" style = "margin-left:10px;"><i class = "fa fa-plus"></i>&nbsp;Add Fare</span>
                  

                  <button type = "submit" class = "btn btn-success btn-md pull-right"><i class = "fa fa-save"></i>&nbsp;Save </button>
                  <script src="js/jquery.min.js"></script>

              </form>
                  </div>
                </div>
                 
              </div>
              
            </div>
          
          
        </div>
      </div>
    </div>
    


<script>
  
  
$(document).ready(function(){

  $('#or').prop('required',true);
  $("#editbtn").prop('disabled',true);
    if($("#or").val() != '')
    {
      $('#travelbtn').attr('disabled', false);
    }
  $( "#or" ).keyup(function() 
  {
    $("#editbtn").prop('disabled',false);
    if($('#or').val() != '')
    {
      $('#editbtn').attr('disabled', false);
    } else
    {
      $('#editbtn').attr('disabled', true);
    }
  });
})
   var myCounter = 1;
  
  
   $('#add_fare').click(function(){
     
      $('.myTemplate2')
     .clone()
     .removeClass("myTemplate2")
     .addClass("additionalDate")
     .show()
     .appendTo('#travelPanel');
     
    myCounter++;
       
    $(".datepicker4").on('focus', function(){
        var $this = $(this);
        if(!$this.data('datepicker')) {
         $this.removeClass("hasDatepicker");
         $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
         $this.datepicker("show");
        }
    }); 
  
    // $(".datepicker5").on('focus', function(){
    //     var $this = $(this);
    //     if(!$this.data('datepicker')) {
    //      $this.removeClass("hasDatepicker");
    //      $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    //      $this.datepicker("show");
    //     }
    // }); 
  
  
  });
  $(document).on('click','#editbtn',function(e){
   
  
  var purpose = $('#or').val();
  $('#ro_txt').val(purpose);
  if(purpose == '' || purpose == null)
  {
    
    alert('Required Field:All fields with * are required!.');
  $('#editModal').modal().hide();
  
  }else{
  
  }
  });
  
  
  
      
    $("body").on('click', '.cb1', enable_cb1);
    $("body").on('click', '.wa', enable_cb2);
    $("body").on('click', '.wor', disableTxt1);
    $("body").on('click', '.wr', disableTxt2);
    $("body").on('change', '.receipt', groupCheck);
    $("body").on('change', '.toggle-event', controlPD_on);
    $("body").on('click', '.wo_pdiem', controlPD_off);

    function controlPD_on()
      {
        const cb1 = $(this).siblings('.cb1');
        const wa = $(this).siblings('.wa');

        const bf = $(this).siblings('.breakfast');
        const ln = $(this).siblings('.lunch');
        const dn = $(this).siblings('.dinner');
        const withpd = $(this).siblings('.wpd');
        const wr = $(this).siblings('.wr');
        const wor = $(this).siblings('.wor');

      
        
        cb1.prop('disabled', this.checked);
        wa.prop('disabled', this.checked);
        bf.prop('disabled', this.checked);
        ln.prop('disabled', this.checked);
        dn.prop('disabled', this.checked);
        wr.prop('disabled', this.checked);
        wor.prop('disabled', this.checked);

        cb1.attr('disabled', !this.checked);
        wa.attr('disabled', !this.checked);
        bf.attr('disabled', !this.checked);
        ln.attr('disabled', !this.checked);
        dn.attr('disabled', !this.checked);
        wr.attr('disabled', !this.checked);
        wor.attr('disabled', !this.checked);

        wor.attr('checked', !this.checked);
        cb1.attr('checked', !this.checked);
        wa.attr('checked', !this.checked);
        bf.attr('checked', !this.checked);
        ln.attr('checked', !this.checked);
        dn.attr('checked', !this.checked);
        wr.attr('checked', !this.checked);





        if($(this).is(':checked')) {
        $(this).next('.wpd').text('With Per Diem');
        }else{
        $(this).next('.wpd').text('Without Per Diem');
        }
      }
  
    function controlPD_off()
    {
      const bf = $(this).siblings('.breakfast');
            const ln = $(this).siblings('.lunch');
            const dn = $(this).siblings('.dinner');
            const wr = $(this).siblings('.wr');
            const wor = $(this).siblings('.wor');

            wr.prop('disabled', true);
            wor.prop('disabled', true);
            bf.prop('disabled', true);
            ln.prop('disabled', true);
            dn.prop('disabled', true); 

    }
    function  groupCheck(){
        const receipt = $(this).siblings('.receipt');
        receipt.not(this).prop('checked', false);  
    }
    function enable_cb1() {
        
        const bf = $(this).siblings('.breakfast');
        const ln = $(this).siblings('.lunch');
        const dn = $(this).siblings('.dinner');

        bf.prop('checked', this.checked);
        ln.prop('checked', this.checked);
        dn.prop('checked', this.checked);

        bf.attr('disabled', !this.checked);
        ln.attr('disabled', !this.checked);
        dn.attr('disabled', !this.checked);
    }
    function disableTxt1() {
        const wor_txt = $(this).siblings('.wor_txt');

        wor_txt.prop('disabled', false);
        wor_txt.attr('disabled', true);
        wor_txt.val('');

    }
   
    function disableTxt2() {
        const wor_txt = $(this).siblings('.wor_txt');

        wor_txt.prop('disabled', true);
        wor_txt.attr('disabled', false);   
    }
    function enable_cb2()
    {
        const wr = $(this).siblings('.wr');
        const wor = $(this).siblings('.wor');

        wr.prop('checked', this.checked);

        wor.prop('checked', this.checked);

        wr.attr('disable', !this.checked);
        wor.attr('disable', !this.checked);
    }
    disabledDIV();

    function disabledDIV()
    {
     var distance =  $('.distance').val();
     distance = distance.replace('km', '');

        if(distance > 50)
     {
     
  $('.toggle-event').attr('checked',true)
     }else{
  
      $(".breakfast").attr("disabled", true);
        $(".lunch").attr("disabled", true);
        $(".dinner").attr("disabled", true);
        $(".cb1").attr("disabled", true);
        $(".wa").attr("disabled", true);
        $(".wor").attr("disabled", true);
        $(".wr").attr("disabled", true);
        $('.perdiem').addClass('border-disabled');
     }
  
    }
</script>  

<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="js/bootstrap-toggle.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCivQZ8zHOKTj3mi7L7pzmebaWY0FF_yr0"></script>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <script>
    if("<?php echo $_GET['step']?>" == "1")
    {
      $('#travelbtn').prop('disabled',true);
    }else{
      $('#travelbtn').prop('disabled',false);
      
    }
    </script>
    <script>
    var searchInput = 'search_input';
    var searchInput2 = 'search_input2';

    $(document).ready(function () {
        var autocomplete;
        var autocomplete2;
        autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
            types: ['geocode'],
            /*componentRestrictions: {
                country: "USA"
            }*/
        });

        autocomplete2 = new google.maps.places.Autocomplete((document.getElementById(searchInput2)), {
            types: ['geocode'],
            /*componentRestrictions: {
                country: "USA"
            }*/
        });
        
        
    });  
    </script>

