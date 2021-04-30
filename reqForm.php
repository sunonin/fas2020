<?php
$username = $_SESSION['username'];
require_once('_includes/setting.php');
require_once('_includes/dbaseCon.php');
require_once('_includes/library.php');
require_once('_includes/sql_statements.php');

function fillTableInfo()
{
    include 'connection.php';
    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
    $query = "SELECT EMP_N,FIRST_M,MIDDLE_M, LAST_M, MOBILEPHONE, EMAIL,DIVISION_N, DIVISION_M , POSITION_M FROM tblpersonneldivision 
    INNER JOIN tblemployeeinfo on tblpersonneldivision.DIVISION_N = tblemployeeinfo.DIVISION_C 
    INNER JOIN tbldilgposition on tblemployeeinfo.POSITION_C = tbldilgposition.POSITION_ID
    where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
    $result = mysqli_query($conn, $query);
    $val = array();
    if($row = mysqli_fetch_array($result))
      {
        $f = $row['FIRST_M'];
        $m = $row['MIDDLE_M'][0];
        $l= $row['LAST_M'];
        $firstname = ucwords(strtolower($f));

        $lname = ucfirst($l);             // HELLO WORLD!
        $lastname = ucfirst(strtolower($lname));
          ?>
                                  <input required type = "hidden" name = "curuser" value = "<?php echo $row['EMP_N'];?>" id = "selectedUser" />
                              

               <table  border = 1 class = "center-text" style = "width:100%;">
                            <tbody>
                                <tr>
                                    <td colspan = 4 class = "label-text" style = "text-align:center;"> <h2><b>ONLINE ICT TECHNICAL ASSISTANCE REQUEST FORM</b></h2></span></td>
                                    <td class = "label-text left-text">Control<br>Number:<span style = "color:red;">*</span></td>
                                    <td colspan = 2 style = "padding:5px 5px 5px 5px;background-color:#CFD8DC;">
                                    <?php echo countCN();?>
                                      </td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Requested Date:<span style = "color:red;">*</span></td>
                                    <td style = "width:15%;padding:5px 5px 5px 5px;">
                                    <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input disabled  type="text" name = "request_date1" class="datePicker1" value="<?php echo date('m/d/y');?>"  >
                                            <input hidden  type="text" name = "request_date" class="datePicker1" value="<?php echo date('m/d/y');?>"  >
                                        </div>
                                    </td>
                                    <td style = "width:15%;"class = "label-text">Requested Time:<span style = "color:red;">*</span></td>
                                    <td style = "width:15%;  padding:5px 5px 5px 5px;">
                                    <input readonly style = "text-align:left;" placeholder = "Request Time" type = "text" name = "request_time" class = "sizeMax alphanum subtxt" value ="<?php echo date("h:i:s A");?>"/>
                                    </td>
                                    <!-- date("H:i A",strtotime(date("h:m A"))) -->
                                    <td colspan = 4 class = "label-text" style = "text-align:center;">HARDWARE INFORMATION (if applicable)</td>
                                </tr>
                                <tr>
                                    <td colspan = 4 class = "label-text">END-USER INFORMATION </td>
                                    <td class = "label-text left-text">Equipment</td>
                                    <td colspan = 3 class = "left-text " style = "padding:5px 5px 5px 5px;">
                                      <input style ="width:100%;" type = "text" name = "equipment_type" class = "alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Requested By:<span style = "color:red;">*</span></td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;">
                                      <input required type = "hidden"  name="requested_by" value = "<?php $row['EMP_N'];?>" />
                                      <input readonly type = "text" class = "sizeMax alphanum subtxt" value = "<?php echo $firstname.' '.$row['MIDDLE_M'][0].'. '.$lastname.' ';?>" >
                                    <td class = "label-text left-text">Brand Model:</td>
                                    <td colspan =3 style = "  padding:5px 5px 5px 5px;"><input  type = "text" name = "brand_model" class = "sizeMax alphanum subtxt" value = ""/></td>
                                </tr>
                                <tr>
                                    <td class = "label-text left-text">Office:<span style = "color:red;">*</span></td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input readonly  id = "office" placeholder = "Office" type = "text" name = "office" class = "sizeMax alphanum subtxt" value = "<?php echo $row['DIVISION_M'];?>" /></td>
                                    <td class = "label-text left-text">Property Number:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input type = "text" name = "property_no" class = "sizeMax alphanum subtxt" value = "" /> </td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Position/Designation:<span style = "color:red;">*</span></td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input readonly id = "position"  placeholder = "Position/Designation" type = "text" name = "position" class = "sizeMax alphanum subtxt" value = "<?php echo $row['POSITION_M'];?>"  /></td>
                                    <td class = "label-text left-text">Serial Number:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input type = "text" name = "serial_no" class = "sizeMax alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Contact Number:<span style = "color:red;">*</span></td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input readonly id = "phone" placeholder = "Contact Number" type = "text" name = "contact_no" class = "sizeMax alphanum subtxt" value = "<?php echo $row['MOBILEPHONE'];?>"  /></td>
                                    <td class = "label-text left-text">IP Address:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input    type = "text" name = "ip_address" class = "sizeMax alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Email Address:<span style = "color:red;">*</span></td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input readonly id = "email" placeholder = "Email Address" type = "text" name = "email_address" class = "sizeMax alphanum subtxt" value = "<?php echo $row['EMAIL'];?>"/></td>
                                    <td class = "label-text left-text">MAC Address:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input  type = "text" name = "mac_address" class = "sizeMax alphanum subtxt" value = ""/></td>
                                </tr>
                            </tbody>
                        </table>
          <?php
      }
}

function countCN()
{
                                    include 'connection.php';
                                    if(mysqli_connect_errno()){echo mysqli_connect_error();}  

                                                  $query = "SELECT count(*) as 'count' from tbltechnical_assistance ";
                                                  $result = mysqli_query($conn, $query);
                                                  $val = array();
                                                  if($row = mysqli_fetch_array($result))
                                                  {
                                                    $count= $row['count']+1;
                                                    if($count > 100)
                                                    {
                                                      echo '<input required style = "text-align:center;color:red;font-weight:bold;" type = "text"  readonly  placeholder = "Control No."  name = "control_no" class = "sizeMax alphanum subtxt" value=2021-0'.$count.' />';

                                                    }else{
                                                      echo '<input required style = "text-align:center;color:red;font-weight:bold;" type = "text"  readonly  placeholder = "Control No."  name = "control_no" class = "sizeMax alphanum subtxt" value=2021-00'.$count.' />';

                                                    }

                                                  }
}
function showUser()
{
  $position_c = '';
  echo '<select class="form-control select2" style="width: 100%;" name="requested_by" id="type" >';
  include 'connection.php';
  if(mysqli_connect_errno()){echo mysqli_connect_error();}  
  
  $query = "SELECT * FROM `tblpersonneldivision` 
  LEFT JOIN tblemployeeinfo ON tblpersonneldivision.DIVISION_N = tblemployeeinfo.DIVISION_C 
  WHERE tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
  $result = mysqli_query($link, $query);
  $val = array();
  while($row = mysqli_fetch_array($result))
    {
          echo '<option value = '.$row['EMP_N'].'>'.$row['FIRST_M'].' '.$row['MIDDLE_M'].' '.$row['LAST_M'].'</option>';
    }
  echo '</select>';
  // echo '<input required type = "text" value = '.$position_c.' />';
  }

?>
    <style>
    
 



/* Styling Checkbox Starts */
.checkbox-label {
    display: block;
    position: relative;
    margin: auto;
    cursor: pointer;
    font-size: 22px;
    line-height: 24px;
    height: 24px;
    width: 24px;
    clear: both;
}

.checkbox-label input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.checkbox-label .checkbox-custom {
    position: absolute;
    top: 0px;
    left: 0px;
    height: 24px;
    width: 24px;
    background-color: transparent;
    border-radius: 5px;
    transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    border: 2px solid black;
}


.checkbox-label input:checked ~ .checkbox-custom {
    background-color: black;
    border-radius: 5px;
    -webkit-transform: rotate(0deg) scale(1);
    -ms-transform: rotate(0deg) scale(1);
    transform: rotate(0deg) scale(1);
    opacity:1;
    border: 2px solid black;
}


.checkbox-label .checkbox-custom::after {
    position: absolute;
    content: "";
    left: 12px;
    top: 12px;
    height: 0px;
    width: 0px;
    border-radius: 5px;
    border: solid #009BFF;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(0deg) scale(0);
    -ms-transform: rotate(0deg) scale(0);
    transform: rotate(0deg) scale(0);
    opacity:1;
    transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
}


.checkbox-label input:checked ~ .checkbox-custom::after {
  -webkit-transform: rotate(45deg) scale(1);
  -ms-transform: rotate(45deg) scale(1);
  transform: rotate(45deg) scale(1);
  opacity:1;
  left: 8px;
  top: 3px;
  width: 6px;
  height: 12px;
  border: solid #fff;
  border-width: 0 2px 2px 0;
  background-color: transparent;
  border-radius: 0;
}



/* For Ripple Effect */
.checkbox-label .checkbox-custom::before {
    position: absolute;
    content: "";
    left: 10px;
    top: 10px;
    width: 0px;
    height: 0px;
    border-radius: 5px;
    border: 2px solid #FFFFFF;
    -webkit-transform: scale(0);
    -ms-transform: scale(0);
    transform: scale(0);  
}

.checkbox-label input:checked ~ .checkbox-custom::before {
    left: -3px;
    top: -3px;
    width: 24px;
    height: 24px;
    border-radius: 5px;
    -webkit-transform: scale(3);
    -ms-transform: scale(3);
    transform: scale(3);
    opacity:0;
    z-index: 999;
    transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
}




/* Style for Circular Checkbox */
.checkbox-label .checkbox-custom.circular {
    border-radius: 50%;
    border: 2px solid black;
}

.checkbox-label input:checked ~ .checkbox-custom.circular {
    background-color: #FFFFFF;
    border-radius: 50%;
    border: 2px solid black;
}
.checkbox-label input:checked ~ .checkbox-custom.circular::after {
    border: solid #0067FF;
    border-width: 0 2px 2px 0;
}
.checkbox-label .checkbox-custom.circular::after {
    border-radius: 50%;
}

.checkbox-label .checkbox-custom.circular::before {
    border-radius: 50%;
    border: 2px solid #FFFFFF;
}

.checkbox-label input:checked ~ .checkbox-custom.circular::before {
    border-radius: 50%;
}
    </style>
<style> 
.collapsible {
  background-color: #ff5252;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.activecollap, .collapsible:hover {
  background-color: #c62828;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
  overflow-y: scroll;
  height: 110px;

}
th{ color:#a9242d; text-align:center; } td{ text-align:left; } .center-text{ text-align:center; } .left-text{ text-align:left; } .borderless{ border: none; } .sizeMax{ width:100%; } td.label-text{ background-color:#B0BEC5; padding:5px 5px 5px 5px; } input[type=checkbox] { /* Double-sized Checkboxes */ -ms-transform: scale(1); /* IE */ -moz-transform: scale(1); /* FF */ -webkit-transform: scale(1); /* Safari and Chrome */ -o-transform: scale(1); /* Opera */ transform: scale(1); padding: 10px; } .setDateIcon{ background-image:url(images/cal.gif); background-repeat: no-repeat; background-position: 90px 5px; } .disabletxtarea{ pointer-events: none; } </style>    
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="box-body">      
                    <div> <h1>ICT Technical Assistance</h1><br> </div>
                    <form method="POST" enctype="multipart/form-data" class="myformStyle" action = "JASPER/sample/sample1.php" >    
                        <?php echo fillTableInfo(); ?>
                        <input required type = "hidden" name = "division" value = "<?php echo $_GET['division'];?>" />
                        <br>
                        <u style = "margin-top:20px;" class = "label-text">TYPE OF REQUEST<span style = "color:red;">*</span></u>
                        
                        <table style = "margin-top:20px;width:100%;">
                          <tr>
                              <td>
                                  <input  type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g1" class = "checkbox_group" value = "DESKTOP/LAPTOP"> <b>DESKTOP/LAPTOP</b><br>
                                  <div style = "margin-left:30px;padding-top:10px;" >
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" id = "cb1" value ="Hardware Error"> Hardware Error<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Software Error"> Software Error<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Computer Assembly"> Computer Assembly<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Parts Replacement"> Parts Replacement<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Virus Scanning"> Virus Scanning
                                  </div>
                              </td> 
                              <td><br>
                                  <input style = "margin-left:180px;" type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g2" class = "checkbox_group" value = "INTERNET CONNECTIVITY"><b>&nbsp;INTERNET CONNECTIVITY</b><br>
                                  <div style = "margin-left:210px;padding-top:10px;" >
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" id = "cb2" value = "New Connection(Wired or Wireless)"> New Connection(Wired or Wireless)<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" id = "cb2_2" value = "No Internet (Cross or Exclamation)"> No Internet (Cross or Exclamation)<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" id = "cb2_3"  value = "Access to Blocked Site:"> Access to Blocked Site:
                                      <input  type = "text" name = "site" id = "site" value = "" style = "width:30%;border:none;border-bottom:1px solid black;" /><br>
                                      <i style = "margin-left:5%;">Purpose</i>:<input  type = "text" name = "purpose" id = "purpose" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" id= "cb2_4" value = "Internet for Personal Phone/Tablet/Laptop"> Internet for Personal Phone/Tablet/Laptop<br>
                                      <i style = "margin-left:5%;">Purpose</i>:<input  type = "text" name = "purpose2" id =  "purpose2" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                                  </div>
                              </td>  
                              <td style = "width:35%;"><br>
                                  <input  style = "margin-left:120px;" type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g3" class = "checkbox_group" value = "SOFTWARE/SYSTEM"> <b>SOFTWARE/SYSTEM</b><br>
                                  <div style = "margin-left:140px;padding-top:10px;" >
                                      <input  style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" id = "cb3" value = "Operating System, Office, Anti-Virus"> Operating System, Office, Anti-Virus<br>
                                      <input  style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" id = "cb3_2" value = "Records Tracking System"> Records Tracking System<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" id = "cb3_3" value = "Google Drive"> Google Drive<br>
                                      <input  style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" id = "cb3_4" value = "DILG Portals/Systems"> DILG Portals/Systems<br>
                                      <input  style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" id ="cb3_5" value = "Other software/s (please specify)"> Other software/s (please specify)
                                      <br>
                                      <input  type = "text" name = "softwares" id = "softwares" value = "" style = "margin-left:20px;border:none;border-bottom:1px solid black;"/><br>
                                      <input  type = "text" name = "softwares2" id = "softwares" value = "" style = "margin-left:20px;border:none;border-bottom:1px solid black;"/>
                                  
                                    </div>
                              </td> 
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                          <td>
                          <input  type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g4" class = "checkbox_group" value = "PRINTER/SCANNER"> <b>PRINTER/SCANNER</b><br>

                          <div style = "margin-left:30px;padding-top:10px;" >

                          <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g4" id = "cb4" value = "Installation"> Installation<br>
                          <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g4" value = "Troubleshooting"> Troubleshooting<br>
                          <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g4" value = "Sharing/Networking"> Sharing/Networking<br>
                          </div>
                          </td> 
                          <td>
                            <input  style = "margin-left:180px;"  type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g5" class = "checkbox_group" value ="GOVMAIL" > <b>GOVMAIL</b><br>
                            <div style = "margin-left:210px;padding-top:10px;">
                            <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]"  class = "checkboxgroup_g5" id = "cb5" value = "New Account"> New Account<br>
                            <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]"  class = "checkboxgroup_g5" id = "cb5_2" value = "Change Account to"> Change Account to 
                            <input  type = "text" id = "changeaccount" name = "changeaccount" value = "" style = "width:30%;border:none;border-bottom:1px solid black;" /><br>
                            <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]"  class = "checkboxgroup_g5" id = "cb5_3" value = "Password Reset"> Password Reset<br>
                          </div>
                          </td> 
                          <td>
                          <input  style = "margin-left:120px;"   type = "checkbox" name = "req_type_category[]"  id = "checkboxgroup_g6" class = "checkbox_group"  value = "OTHERS"><b>OTHERS (please specify)</b><br>
                          <div style = "margin-left:140px; padding-top:10px;">
                          <input   type = "text" name = "others1" id = "others1" class = "checkboxgroup_g6" value = "" style = "margin-left:20px;border:none;border-bottom:1px solid black;"/><br>
                          <input   type = "text" name = "others2" id = "others2" class = "checkboxgroup_g6" value = "" style = "margin-left:20px;border:none;border-bottom:1px solid black;"/><br>
                          <input   type = "text" name = "others3" id = "others3" class = "checkboxgroup_g6"value = "" style = "margin-left:20px;border:none;border-bottom:1px solid black;"/><br>
                        </div>                          
                      </td> 

                          </tr>
                          </table>
                          <table border = 1 style = "margin-top:20px;width:100%;">
                            <tr>
                              <td colspan = 4 class = "center-text label-text" style = "width:50%;"><i>END-USER</i></td>
                                <td colspan = 4 class = "center-text label-text"><i>RICTU</i></td>
                                  </tr>
                          <tr>
                            <td colspan = 4 class = "label-text">ISSUE/PROBLEM/ERROR DETAILS:<span style = "color:red;">*</span></td>
                              <td colspan = 4 class = "label-text">FINDINGS AND RESOLUTION/RECOMMENDATION</td>
                                </tr>
                          <tr>
                              <td colspan = 4 >
                                <textarea required rows="23" name = "issue" cols="56"  style ="border:1px solid white;resize:none;width:100%;text-align:left;" >
                                </textarea>
                              </td>

                              <td colspan = 4 rowspan= 2>
                                <textarea rows="25" cols="56" style ="border:1px solid white;resize:none;width:100%;text-align:left;background-color:#EEEEEE;" name = "status" class = "disabletxtarea">
                                </textarea>
                              </td>
                             
                          </tr>
                          <tr>
                          <td colspan = 4 class = "label-text">ACCEPTANCE OF ICT TECHNICAL ASSISTANCE RENDERED:</td>
                         
                          </tr>
                          <tr>
                          <td colspan = 4 STYLE = "text-align:center;background-color:#EEEEEE;"><u><?php echo $_SESSION['complete_name'];?></u><br><span class = "label-text">Signature over Printed Name</span></td>

                         
                          <td colspan=2 class = "label-text"><input type = "checkbox" disabled />&nbsp;&nbsp;&nbsp;&nbsp;Resolved</td>
                          <td colspan=2 class = "label-text">
                          <input type = "checkbox" disabled />&nbsp;&nbsp;&nbsp;&nbsp;Defective(to be referred to GSS for repair)
                          </td>
              
                          <tr> 
                          <td colspan = 4 class = "label-text" style = "background-color:#EEEEEE;">DEAR END USER, YOUR FEEDBACK IS IMPORTANT TO US:</td>

                   
            
                          <td style = "width:12.5%;" class = "label-text">Started Date:</td>
                          <td style = "width:12.5%;" >
                          <div class="input-group date">
                          <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                          </div>
                          <!-- class="datePicker1"  -->
                          <input required disabled type="text" name = "started_date" placeholder = "Started Date" value="<?php echo date('F d, Y');?>" required>
                          </div>
                          </td>
                          <td style = "width:12.5%;" class = "label-text">Completed Date:</td>
                          <td style = "width:12.5%;">
                          <div class="input-group date">
                          <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                          </div>
                          <input required disabled type="text" name = "completed_time"  value="" required>
                          </div>
                          </td>

                          </tr>
                          <tr>
                          <td colspan = 4>
                          <td style = "width:12.5%;" class = "label-text">Started Time:</td>
                          <td style = "width:12.5%;">
                          <div class="input-group date">
                          <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                          </div>
                          <input required disabled type="text" name = "started_time"  value="<?php echo date('H:i A');?>">
                          </div>
                          </td>
                          <td style = "width:12.5%;" class = "label-text">Completed Time:</td>
                          <td style = "width:12.5%;">
                          <div class="input-group date">
                          <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                          </div>
                          <input required disabled type="text" name = "completed_time"  value="" required>
                          </div>
                          </td>
                          </tr>
                          <tr>
                          <td colspan =4 style = "background-color:#EEEEEE;">
                          <ol>
                            <li class = "label-text">Timeliness
                            <p style = "font-weight:normal;">Was the ICT Staff able to provide immediate assistance within three (3) hours or agreed timeline?(Yes/No) ___________________________ </p>
                            </li>
                            <li class = "label-text">Quality
                            <p style = "font-weight:normal;">At a rating scale of 1 to 5, kindly rate the service rendered?<br>(5-Outstanding, 4- Very Satisfactory, 3 - Satisfactory, 2 - Unsatisfactory, 1 - Poor) ____________
                            </li>
                          </ol>
                          </td>
                          <td colspan = 4 style = "text-align:center;background-color:#EEEEEE;">
                          _____________________________________________________
                          <p class = "label-text">Signature over Printer Name</p>
                          
                          </td>
                          </tr>






                          </table><br>

                      <input id = 'submit' style ="float:right;" type = "submit" value = "Submit" class="btn btn-primary btn-s sweet-14" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 </body>
</html>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
      <div class="side-menu fl">
        <div class="box box-solid">
            
        <button type="button" class="collapsible"><img src = "images/logo.png" width="40" height="40"/> INTRANET SYSTEM</button>
        <div class="content">
          <?php
          
          function setIntra()
          {
            $a = array(
              "GAD" => 1,
              "SUBAYBAYAN" => 2,
              "LTIA" => 3,
              "ADAC FMS" => 4,
              "DMS" => 5
          );
          
          foreach ($a as $id => $val) {
              ?>
              <tr>
                <td style="width:10%;">
                  <div class="checkbox-container">
                    <label class="checkbox-label" >
                        <input type="checkbox">
                        <span class="checkbox-custom rectangular"></span> 
                    </label>
                  </div>
                </td>
                <td style="width:10%;">
                  <h4> <?php echo '&nbsp'.$id;?></h4>
                </td>
                <td>
                  <textarea id = "check"   cols = "60" style="resize:none;">Issue's/Concerns:</textarea>
                </td>
              </tr>
              <?php
          }
          }
          ?>
          <table style = "width:100%;margin-top:20px;">
            <?php setIntra();?>
          </table>
        </div>
        <button type="button" class="collapsible"><img src = "images/logo.png" width="40" height="40"/> LOOP SYSTEM</button>
        <div class="content" style = "text-align:center;">
        <div class = "row">
          <div class = "col-lg-6">
            <table border = 1 style = "width:20%;margin-top:20px;">
              <tr><td style = "padding:10px;"><button class="btn btn-lg btn-success" style = "width:100%;">Change Password</button></td></tr>
              <tr><td style = "padding:10px;"><button class="btn btn-lg btn-success">Retrieval of Account</button></td></tr>
              <tr><td style = "padding:10px;"><button class="btn btn-lg btn-success" style = "width:100%;">Activation of Account</button></td></tr>
            </table>
          </div>
          <div class = "col-lg-6">
            <table border = 1 style = "width:20%;margin-top:20px;">
              <tr><td style = "padding:10px;"><button class="btn btn-lg btn-success" style = "width:100%;">Creation of Account</button></td></tr>
              <tr><td style = "padding:10px;"><button class="btn btn-lg btn-success" style = "width:100%;">Change of Division</button></td></tr>
              <tr><td style = "padding:10px;"><button class="btn btn-lg btn-success" style = "width:100%;font-size:15px;">Problem on uploading a file</button></td></tr>
            </table>
          </div>
        </div>
      
        
         
        </div>
        <button type="button" class="collapsible"><img src = "images/logo.png" width="40" height="40"/> FAS SYSTEM</button>
        <div class="content">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
          </div>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
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
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script>
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

    //Date picker
    $('#datepicker').datepicker({
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
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("activecollap");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
$('#submit').click(function(){
 
  var cb1 = document.getElementById("checkboxgroup_g1").checked;
  var cb2 = document.getElementById("checkboxgroup_g2").checked;
  var cb3 = document.getElementById("checkboxgroup_g3").checked;
  var cb4 = document.getElementById("checkboxgroup_g4").checked;
  var cb5 = document.getElementById("checkboxgroup_g5").checked;
  var cb6 = document.getElementById("checkboxgroup_g6").checked;


if(cb1 == '' && cb2 == '' && cb3 == '' && cb4 == '' && cb5 == '' && cb6 == '' )
{  alert('Required Field:Choose at least one Type of Request');
  return false;
}
return true;
})

</script>




<script>
   
  $(function () {

    //Date picker,
    $( ".datePicker1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    $(".datePicker1").datepicker().datepicker("setDate", new Date());


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
</script>

<script type = "text/javascript">
$(document).ready(function() {
  var ckbox1 = $("#checkboxgroup_g1");
  var ckbox = $("#checkboxgroup_g5");
  var ckbox2 = $("#checkboxgroup_g2");
  var ckbox3 = $("#checkboxgroup_g3");
  var ckbox4 = $("#checkboxgroup_g6");
  var ckbox_printer = $("#checkboxgroup_g4");

  var chkId = '';
  var chkId2 = '';
  var chkId3 = '';
  var chkId4 = '';
  $('input').on('click', function() {
    // DESKTOP/LAPTOP
    if(ckbox1.is(':checked')){
      $("#site").prop('required',false);
        $("#purpose").prop('required',false);
        $("#purpose2").prop('required',false);
        $("#changeaccount").prop('required',false);
        $("#softwares").prop('required',false);

   
    }
    if(ckbox_printer.is(':checked'))
    {
      $("#site").prop('required',false);
        $("#purpose").prop('required',false);
        $("#purpose2").prop('required',false);
        $("#changeaccount").prop('required',false);
        $("#softwares").prop('required',false);
    }
    if (ckbox.is(':checked')) {

      $("#checkboxgroup_g5:checked").each ( function() {
   			chkId = $(this).val() + ",";
        chkId = chkId.slice(0, -1);
 	    });
       if($(this).val() == "Change Account to")
       {
        $("#changeaccount").prop('required',true);

       }else if($(this).val() == "New Account"){
        $("#changeaccount").prop('required',false);
      }else if($(this).val() == "Password Reset"){
        $("#changeaccount").prop('required',false);
      }
       
    } 
    if (ckbox2.is(':checked')) {
      $("#changeaccount").prop('required',false);
        $("#softwares").prop('required',false);
      $("#checkboxgroup_g2:checked").each ( function() {
   			chkId2 = $(this).val() + ",";
        chkId2 = chkId2.slice(0, -1);
 	    });
       if($(this).val() == "Access to Blocked Site:")
       {
        $("#site").prop('required',true);
        $("#purpose").prop('required',true);
       }else if($(this).val() == "New Connection(Wired or Wireless)"){
        $("#site").prop('required',false);
        $("#purpose").prop('required',false);
       }else if($(this).val() == "No Internet (Cross or Exclamation)"){
        $("#site").prop('required',false);
        $("#purpose").prop('required',false);
      } else if($(this).val() == "Internet for Personal Phone/Tablet/Laptop"){
        $("#purpose2").prop('required',true);
        $("#site").prop('required',false);
        $("#purpose").prop('required',false);
      }else{
     
      }
    }
    if (ckbox3.is(':checked')) {
      $("#site").prop('required',false);
        $("#purpose").prop('required',false);
        $("#purpose2").prop('required',false);
        $("#changeaccount").prop('required',false);

      $("#checkboxgroup_g3:checked").each ( function() {
   			chkId3 = $(this).val() + ",";
        chkId3 = chkId3.slice(0, -1);
 	    });
       if($(this).val() == "Other software/s (please specify)")
       {
        $("#softwares").prop('required',true);
       }else if($(this).val() == "Operating System, Office, Anti-Virus")
       {
        $("#softwares").prop('required',false);
       }else if($(this).val() == "Records Tracking System")
       {
        $("#softwares").prop('required',false);
       }else if($(this).val() == "Google Drive")
       {
        $("#softwares").prop('required',false);
       }else if($(this).val() == "DILG Portals/Systems")
       {
        $("#softwares").prop('required',false);
       }

       
      
       
    } 
    if (ckbox4.is(':checked')) {
      $("#checkboxgroup_g5:checked").each ( function() {
   			chkId4 = $(this).val() + ",";
        chkId4 = chkId4.slice(0, -1);
       });
       if($('#others1').val() != '')
       {
       $("#others1").prop('required',true);

       }else{
       $("#others1").prop('required',true);

       
       }
      
      
       
    }
    

    
  });
  // ==========================================
  
});





  $(function() {
    document.getElementById("site").disabled = true;
    document.getElementById("purpose").disabled = true;
    document.getElementById("purpose2").disabled = true; 
    document.getElementById("softwares").disabled = true;
    document.getElementById("changeaccount").disabled = true; 
    document.getElementById("others1").disabled = true ; 
    document.getElementById("others2").disabled = true; 
    document.getElementById("others3").disabled = true; 
    

      enable_cb1();
      enable_cb2();
      enable_cb3();
      enable_cb4();
      enable_cb5();
      enable_cb6();
      enable_cb6();
    $("#checkboxgroup_g1").click(enable_cb1);
    $("#checkboxgroup_g2").click(enable_cb2);
    $("#checkboxgroup_g3").click(enable_cb3);
    $("#checkboxgroup_g4").click(enable_cb4);
    $("#checkboxgroup_g5").click(enable_cb5);
    $("#checkboxgroup_g6").click(enable_cb6);

    $('#cb2_3').click(cb2func);
    $('#cb2_2').click(cb4func);
    $('#cb2_4').click(cb3func);
    $('#cb2').click(cb1func);
    $('#cb5_2').click(cb5_2func);
    $('#cb5').click(cb5_1func);
    $('#cb5_3').click(cb5_3func);
    $('#cb3_5').click(cb3_5func);
    $('#cb3').click(cb3_1func);
    $('#cb3_2').click(cb3_2func);
    $('#cb3_3').click(cb3_3func);
    $('#cb3_4').click(cb3_4func);
    
    
  });
  $('#cb3_5').on('change', function(e){
   if(e.target.checked){
    //  $('#myModal').modal();
   }
});
    function cb3_4func()
    {
      if (this.checked) {
        $('#softwares').val('');
        }else{
      }
    }

    function cb3_3func()
    {
      if (this.checked) {
        $('#softwares').val('');
      

      }else{
    
    
      } 
    }

    function cb3_2func()
    {
        if (this.checked) {
          $('#softwares').val('');
        

      }else{
      
      
      }
    }

  function cb3_1func()
  {
    if (this.checked) {
      $('#softwares').val('');
    

  }else{
  
  
  }
  }
function cb3_5func()
{
  if (this.checked) {
    

}else{
  $('#softwares').val('');


}
}
  function cb5_3func()
  {
    if (this.checked) {
  $('#changeaccount').val('');


}else{

}
  }
  function cb5_1func()
  {
    if (this.checked) {
  $('#changeaccount').val('');


}else{

}
  }
  function cb5_2func()
  {
    if (this.checked) {

  }else{
    $('#changeaccount').val('');

  }
  }
  function cb4func()
  {
  if (this.checked) {
    $('#site').val('');
    $('#purpose').val('');
    $('#purpose2').val('');
  }else{

  }
  }
  function cb1func()
  {
  if (this.checked) {
    $('#site').val('');
    $('#purpose').val('');
    $('#purpose2').val('');
  }else{

  }
  }
function cb2func(){
  if (this.checked) {
    $('#purpose2').val('');

  }else{
    $('#site').val('');
    $('#purpose').val('');
  }
}

function cb3func()
{
  if (this.checked) {
    $('#site').val('');
    $('#purpose').val('');
}else{
  $('#purpose2').val('');
}
}


































  function enable_cb1() {
    if (this.checked) {
      if($('.checkboxgroup_g1').val() == 'Hardware Error')
      {
        $('#cb1').not(this).prop('checked', true);  
      }
      $('#site').val('');
      $('#purpose').val('');
      $('#purpose2').val('');
      $('#softwares').val('');
      $('#changeaccount').val('');
      $('#others1').val('');
      $('#others2').val('');
      $('#others3').val('');

  

      $(".checkboxgroup_g1").removeAttr("disabled");
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);
      $(".checkboxgroup_g6").attr("disabled", true);

      $('.checkboxgroup_g2').not(this).prop('checked', false);  
      $('.checkboxgroup_g3').not(this).prop('checked', false);  
      $('.checkboxgroup_g4').not(this).prop('checked', false);  
      $('.checkboxgroup_g5').not(this).prop('checked', false);  
      $('.checkboxgroup_g6').not(this).prop('checked', false);  
      
 


    } else {

      $('.checkboxgroup_g1').not(this).prop('checked', false);  


      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);
      $(".checkboxgroup_g6").attr("disabled", true);
      
    }
  }
  function enable_cb2() {
    if (this.checked) {
      if($('.checkboxgroup_g2').val() == 'New Connection(Wired or Wireless)')
      {
        $('#cb2').not(this).prop('checked', true);  
      }
    
      $('#site').val('');
      $('#purpose').val('');
      $('#purpose2').val('');
      $('#softwares').val('');
      $('#changeaccount').val('');
      $('#others1').val('');
      $('#others2').val('');
      $('#others3').val('');


      $(".checkboxgroup_g2").removeAttr("disabled");
      document.getElementById("site").disabled = false; 
      document.getElementById("purpose").disabled = false; 
      document.getElementById("purpose2").disabled = false; 
      $('.checkboxgroup_g1').not(this).prop('checked', false);  

      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);
      $(".checkboxgroup_g6").attr("disabled", true);

      $('.checkboxgroup_g3').not(this).prop('checked', false);  
      $('.checkboxgroup_g4').not(this).prop('checked', false);  
      $('.checkboxgroup_g5').not(this).prop('checked', false);  
      $('.checkboxgroup_g6').not(this).prop('checked', false);  
    } else {
      $('#site').val('');
      $('#purpose').val('');
      $('#purpose2').val('');

      $('.checkboxgroup_g2').not(this).prop('checked', false);  

      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);
      $(".checkboxgroup_g6").attr("disabled", true);


      document.getElementById("site").disabled = true; 
      document.getElementById("purpose").disabled = true; 
      document.getElementById("purpose2").disabled = true; 
    }
  }
  function enable_cb3() {
    if (this.checked) {
      if($('.checkboxgroup_g3').val() == 'Operating System, Office, Anti-Virus')
      {
        $('#cb3').not(this).prop('checked', true);  
      }
      $('#site').val('');
      $('#purpose').val('');
      $('#purpose2').val('');
      $('#softwares').val('');
      $('#changeaccount').val('');
      $('#others1').val('');
      $('#others2').val('');
      $('#others3').val('');

      $(".checkboxgroup_g3").removeAttr("disabled");
      document.getElementById("softwares").disabled = false; 
      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);
      $(".checkboxgroup_g6").attr("disabled", true);

      $('.checkboxgroup_g1').not(this).prop('checked', false);  
      $('.checkboxgroup_g2').not(this).prop('checked', false);  
      $('.checkboxgroup_g4').not(this).prop('checked', false);  
      $('.checkboxgroup_g5').not(this).prop('checked', false);  
      $('.checkboxgroup_g6').not(this).prop('checked', false);  

    } else {
      document.getElementById("softwares").disabled = true; 

    $('#softwares').val('');
      $('.checkboxgroup_g3').not(this).prop('checked', false);  

      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);
      $(".checkboxgroup_g6").attr("disabled", true);


    }
  }
  function enable_cb4() {
    if (this.checked) {
      if($('.checkboxgroup_g4').val() == 'Installation')
      {
        $('#cb4').not(this).prop('checked', true);  
      }
      $('#site').val('');
      $('#purpose').val('');
      $('#purpose2').val('');
      $('#softwares').val('');
      $('#changeaccount').val('');
      $('#others1').val('');
      $('#others2').val('');
      $('#others3').val('');

      $(".checkboxgroup_g4").removeAttr("disabled");
      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);
      $(".checkboxgroup_g6").attr("disabled", true);
      
      $('.checkboxgroup_g1').not(this).prop('checked', false);  
      $('.checkboxgroup_g2').not(this).prop('checked', false);  
      $('.checkboxgroup_g3').not(this).prop('checked', false);  
      $('.checkboxgroup_g5').not(this).prop('checked', false);  
      $('.checkboxgroup_g6').not(this).prop('checked', false);  
    } else {
      $('.checkboxgroup_g4').not(this).prop('checked', false);  

      
      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);
      $(".checkboxgroup_g6").attr("disabled", true);
    }
  }
  function enable_cb5() {
    if (this.checked) {
      document.getElementById("changeaccount").disabled = false; 
      if($('.checkboxgroup_g5').val() == 'New Account')
      {
        $('#cb5').not(this).prop('checked', true);  
      }
      $('#site').val('');
      $('#purpose').val('');
      $('#purpose2').val('');
      $('#softwares').val('');
      $('#changeaccount').val('');
      $('#others1').val('');
      $('#others2').val('');
      $('#others3').val('');



      $(".checkboxgroup_g5").removeAttr("disabled");
      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g6").attr("disabled", true);

      $('.checkboxgroup_g1').not(this).prop('checked', false);  
      $('.checkboxgroup_g2').not(this).prop('checked', false);  
      $('.checkboxgroup_g3').not(this).prop('checked', false);  
      $('.checkboxgroup_g4').not(this).prop('checked', false);  
      $('.checkboxgroup_g6').not(this).prop('checked', false);  

    } else {
      document.getElementById("changeaccount").disabled = true; 
      $('#changeaccount').val('');
      $('.checkboxgroup_g5').not(this).prop('checked', false);  

      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);
      $(".checkboxgroup_g6").attr("disabled", true);

      

    }
  }

  function enable_cb6(){
    if (this.checked) {
      $('#site').val('');
      $('#purpose').val('');
      $('#purpose2').val('');
      $('#softwares').val('');
      $('#changeaccount').val('');


      $(".checkboxgroup_g6").removeAttr("disabled");
      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);

      $('.checkboxgroup_g1').not(this).prop('checked', false);  
      $('.checkboxgroup_g2').not(this).prop('checked', false);  
      $('.checkboxgroup_g3').not(this).prop('checked', false);  
      $('.checkboxgroup_g4').not(this).prop('checked', false);  
      $('.checkboxgroup_g5').not(this).prop('checked', false);  
      $('.checkboxgroup_g6').not(this).prop('checked', false);  

    }else{
      $('#others1').val('');
      $('#others2').val('');
      $('#others3').val('');
      

      $(".checkboxgroup_g6").attr("disabled", true);
      $(".checkboxgroup_g1").attr("disabled", true);
      $(".checkboxgroup_g2").attr("disabled", true);
      $(".checkboxgroup_g3").attr("disabled", true);
      $(".checkboxgroup_g4").attr("disabled", true);
      $(".checkboxgroup_g5").attr("disabled", true);

    }
  }
  $('.checkboxgroup_g1').on('change', function() {
      $('.checkboxgroup_g1').not(this).prop('checked', false);  
  });
  $('.checkboxgroup_g2').on('change', function() {
      $('.checkboxgroup_g2').not(this).prop('checked', false);  
  });
  $('.checkboxgroup_g3').on('change', function() {
      $('.checkboxgroup_g3').not(this).prop('checked', false);  
  });
  $('.checkboxgroup_g4').on('change', function() {
      $('.checkboxgroup_g4').not(this).prop('checked', false);  
  });
  $('.checkboxgroup_g5').on('change', function() {
      $('.checkboxgroup_g5').not(this).prop('checked', false);  
  });
  $('.checkboxgroup_g6').on('change', function() {
      $('.checkboxgroup_g6').not(this).prop('checked', false);  
  });


  $('.checkbox_group').on('change', function() {
      $('.checkbox_group').not(this).prop('checked', false);  
  });

  // DATE PICKER
  $(function() {
  $( ".datePicker1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
  $( ".datePicker2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
  $( ".datePicker3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});

      
  });
</script>

