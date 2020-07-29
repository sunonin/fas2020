<?php 
session_start();

     include 'connection.php';
     ?>
<style>
th{
    font-family: Arial;
    color:black;
}
span{
    font-family:'Arial';

  }
  table tr{ 
    font-family:'Cambria';
  }
  .table-header{
    color:black;
    background-color:#B0BEC5; 

  }
  td.label-text{ 
    background-color:#B0BEC5; 

  }
  @media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	

	

	
	/*
	Label the data
	*/

}
.border-disabled{
  border: 2px solid gray;
}
  </style>
<script src="edittravelclaim.js"></script>  

     <?php



    
     $query = "SELECT * FROM `tbltravel_claim_info` 
          INNER JOIN `tbltravel_claim_info2` on `tbltravel_claim_info`.TC_ID = `tbltravel_claim_info2`.ID 
          INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID

     WHERE `TC_ID` ='".$_POST['ro']."' ";
     $result = mysqli_query($conn, $query);
     if(mysqli_num_rows($result) > 0)    
     {
        while($row1 = mysqli_fetch_array($result))
        {
            $places = preg_split("/[\s]+/", $row1['PLACE']);
            list($from, $number2,$to) = $places;
         ?>
                <div class="well box-success box myTemplate2" style = "padding:10px;background:#ECEFF1;">
                  <div class="box-body">
                    <div class = "row">
                      <div class = "col-sm-12 col-md-12 col-lg-12">
                        <div class = "col-sm-6 col-md-6 col-lg-6">

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Activity Title</label>
                              <input type = "text" name = "ro" class = "form-control " value = "<?php echo $row1['RO_OT_OB']?>" required/>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Date</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name = "date" class="form-control datepicker4" value = "<?php echo $row1['DATE'];?>" data-inputmask="'alias': 'dd/mm/yyyy'" id = "datepicker4" data-mask required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Departure</label>
                                <input type = "time" name = "from1" class = "form-control " value = "<?php echo $row1['DEPARTURE'];?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Arrival</label>
                              <input type = "time" name = "to1" class = "form-control" value = "<?php echo $row1['ARRIVAL'];?>"/>
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
                                <input type="text" name = "others" value = "<?php echo $row1['OTHERS'];?>" class="form-control" >
                            </div>
                          </div>
                          <div class="col-md-12"> 
                              <div class="form-group">
                                <label>From</label>
                                  <input type = "text" name = "from1" class = "form-control " value = "<?php echo $places[0];?>"/>
                              </div>
                          </div>
                          <div class="col-md-12"> 
                              <div class="form-group">
                                <label>Means of Transportation</label>
                                  <input type = "text" name = "from1" class = "form-control " value = "<?php echo $places[0];?>"/>
                              </div>
                          </div>
                          </div>
                          <div class = "col-sm-6 col-md-6 col-lg-6">
                            <div class="col-md-12 well perdiem">
                              <div>
                                <div class="form-group">
                                    <label> Per Diem </label>
                                    <label class = "pull-right">
                                    <input type ="hidden" value = "<?php echo $row1['DISTANCE'];?>" class = "distance"/>
                                    <?php echo $row1['DISTANCE'];?>
                                    </label>
                                </div>
                                <div class="form-group">
                                  <label> Meals </label><br>
                                  <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1 cb1"> <b>Will Claim Meals</b><br>
                                  <input style = "margin-left:14px" type="checkbox" name="breakfast" class="minimal-red checkboxgroup breakfast"  value = "breakfast"> Breakfast
                                  <input type="checkbox" name="lunch" class="minimal-red checkboxgroup lunch"  value = "lunch"> Lunch
                                  <input type="checkbox" name="dinner"  class="minimal-red checkboxgroup dinner"  value = "dinner"> Dinner
                                </div>
                                <div class="form-group">
                                  <label>
                                  Accomodation
                                  </label><br>
                                  <input type="checkbox"  name = "accomodation" class="minimal-red wa"  value = "With Accomodation accomodation_chkbox "><b> Will Claim Accomodation</b><br>
                                  <input style = "margin-left:14px" type="checkbox"  name = "with_receipt" class="minimal-red receipt wr" value ="With Receipt"> With Receipt
                                  <input type="text" disabled name="wor_txt"  class = "borderless wor_txt" style = "width:50%;"/>
                                  <br>
                                  <input style = "margin-left:14px"type="checkbox"  name = "wor_txt" class="minimal-red receipt wor" value ="Without Receipt"> Without Receipt
                                </div>
                              </div>
                            </div>
                            
                         
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>To</label>
                              <input type = "text" name = "to1" class = "form-control"  value = "<?php echo $places[2];?>"/>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Transportation Fare</label>
                                <input type="text" name = "others" value = "<?php echo $row1['TRANSPORTATION'];?>" class="form-control" >
                            </div>
                          </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div  style = "padding:10px;" id = "travelPanel">
                  </div>
         <?php
        }
        
    }
      
 
?>

<!-- <div class="well" style = "padding:10px;">
                  <div class="box-body">
                      <div style = "padding:10px;" >
                      <div class="box-body myTemplate2">
                        <div class="row ">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>From</label>
                                <input type="text" name = "from3[]" class="form-control" value = "<?php echo $from;?>">
                              </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>To</label>
                                <input type = "text" name = "to3[]" class = "form-control" value = "<?php echo $to; ?>"/>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Means of Transportation</label>
                                
                                <input type="text" name = "mot[]" class="form-control" value = "<?php echo $row['MOT'];?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Transportation Fare</label>
                                <input type = "text" name = "transpo_fare[]" class = "form-control"  value = "<?php echo $row['TRANSPORTATION'];?>" />
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                  </div>
                </div>


                echo '<table border =1 style = "width:100%;" class="table table-hover" >';
        echo '<thead class="table-header">';
        echo '<th>FROM</th>';
        echo '<th>TO</th>';
        echo '<th>MEANS OF TRANSPORTATION</th>';
        echo '<th>TRANPORTATION FARE</th>';
        echo '</thead>';

        
        while($row = mysqli_fetch_array($result))
        {
            // $parts = explode('to', $row['PLACE']);
            // $filename_arr = $data['my_slider'];
            // $file_coma = implode(',', $filename_arr);
            $places = preg_split("/[\s]+/", $row['PLACE']);
            list($from, $number2,$to) = $places;
            

            ?>
            <tr>
              <td><?php echo $places[0];?></td>
              <td><?php echo $places[2];?></td>
              <td><?php echo $row['MOT'];?></td>
              <td><?php echo $row['TRANSPORTATION'];?></td>
            </tr>
             
            <?php
        // }
        // echo '</table>';
        //         -->
        