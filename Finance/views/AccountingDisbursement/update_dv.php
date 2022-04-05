<?php 
include 'connection.php';
function getNta()
    {
        include 'connection.php';
        $query = "SELECT particular from nta  order by id desc" ;
        $result = mysqli_query($conn, $query);
        echo '<option VALUE = "">NTA/NCA No.</option>';
        while($row = mysqli_fetch_array($result))
        {
            echo '<option>'.$row['particular'].'</option>';
            
        }

    }

$ors = $_GET['ors'];    
$flag = $_GET['flag'];

    if($flag=='BURS'){
        $view_burs = mysqli_query($conn, "SELECT sum(amount) as amount, payee, particular, datereleased from saroobburs where burs = '$ors'");
        $row1 = mysqli_fetch_array($view_burs);
        $bursdatereleased = $row1["datereleased"]; 
        $burspayee = $row1["payee"]; 
        $bursparticular = $row1["particular"]; 
        $bursamount = $row1["amount"]; 
        /* echo $bursget; */
        
        }
        else if ($flag=='ORS'){
        $view_burs = mysqli_query($conn, "SELECT sum(amount) as amount, payee, particular, datereleased from saroob where burs = '$ors'");
        $row1 = mysqli_fetch_array($view_burs);
        $orsdatereleased = $row1["datereleased"]; 
        $orspayee = $row1["payee"]; 
        $orsparticular = $row1["particular"]; 
        $orsamount = $row1["amount"]; 
        }

	$sql = "SELECT 
	    ob.id as id,
	    ob.type as type,
	    ob.serial_no as serial_no,
	    ob.po_id as po_id,
	    ob.address as address,
	    ob.purpose as purpose,
	    ob.amount as amount,
	    ob.remarks as remarks,
	    ob.status as status,
	    DATE_FORMAT(ob.date_created, '%m/%d/%Y') as date_created,
	    e.UNAME as created_by,
	    DATE_FORMAT(ob.date_updated, '%m/%d/%Y') as date_updated,
	    DATE_FORMAT(ob.date_submitted, '%m/%d/%Y') as date_submitted,
	    DATE_FORMAT(ob.date_received, '%m/%d/%Y') as date_received,
	    DATE_FORMAT(ob.date_obligated, '%m/%d/%Y') as date_obligated,
	    DATE_FORMAT(ob.date_returned, '%m/%d/%Y') as date_returned,
	    DATE_FORMAT(ob.date_released, '%m/%d/%Y') as date_released,
	    ob.designation as designation,
	    po.po_no as po_code,
	    s.supplier_title as supplier,
	    dv.dv_number as dv_number,
	    dv.tax as tax,
	    dv.gsis as gsis,
	    dv.pagibig as pagibig,
	    dv.philhealth as philhealth,
	    dv.other as other,
	    dv.total as total,
	    dv.net_amount as net_amount,
	    dv.remarks as dv_remarks,
	    dv.status as dv_status,
	    DATE_FORMAT(dv.date_received, '%m/%d/%Y') as dv_date_received,
	    DATE_FORMAT(dv.date_process, '%m/%d/%Y') as dv_date_process,
	    DATE_FORMAT(dv.date_released, '%m/%d/%Y') as dv_date_released,
	    dv.dv_date as dv_date
	    FROM tbl_obligation ob
	    LEFT JOIN po po ON po.id = ob.po_id
	    LEFT JOIN supplier s ON s.id = ob.supplier
	    LEFT JOIN tblemployeeinfo e ON e.EMP_N = ob.created_by
	    LEFT JOIN tbl_dv_entries dv ON dv.obligation_id = ob.id
	    WHERE ob.id = ".$ors."
	    ";

	$exec = $conn->query($sql);
	$row = $exec->fetch_array();


	if (isset($_POST['form_disbursed'])) 
	{
		$dv_number = $_POST['dv_number'];
		$dv_date = $_POST['dv_date'];
		$tax = $_POST['tax'];
		$gsis = $_POST['gsis'];
		$pagibig = $_POST['pagibig'];
		$philhealth = $_POST['philhealth'];
		$other = $_POST['other'];
		$remarks = $_POST['remarks'];

		$total = $tax + $gsis + $pagibig + $philhealth + $other;
		$net_amount = $row['amount'] - $total;


		$update = ' UPDATE `tbl_dv_entries` SET `dv_number` = "'.$dv_number.'", `dv_date` = "'.$dv_date.'", `tax` = '.$tax.', `gsis` = '.$gsis.', `pagibig` = '.$pagibig.', `philhealth` = '.$philhealth.', `other` = '.$other.', `total` = '.$total.',`net_amount` = '.$net_amount.',`remarks` = '.$remarks.',`status` = "Disbursed", `date_process` = NOW(), `date_released` = NOW() WHERE `obligation_id` = '.$ors.' ';

		$conn->query($update);

		echo "<script>alert('Successfully Updated!'); window.location = 'accounting_disbursement.php';</script>";
	}


 ?>

<div class="col-md-12">
	<div class="box dropbox">
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="btn-group">
						<li class="btn btn-warning"><a href="accounting_disbursement.php" style="color:white;text-decoration: none;"><i class="fa fa-arrow-left"></i> Back</a></li>
					</div>
				</div>
				<div class="col-md-6">
  					<div class="pull-right">
						<div class="btn-group">
	        				<!-- <li class="float-right" style="list-style-type: none;"><button class="btn btn-success" onclick="$('#form_disbursed').submit();" name="btn_post"><i class="fa fa-edit"></i> Save</button></li> -->
	        				<!-- <li class="float-right" style="list-style-type: none;"><button class="btn btn-success" onclick="$('#form_disbursed').click();" name="btn_post"><i class="fa fa-edit"></i> Save</button></li> -->
						</div>
  					</div>
				</div>
			</div>
	        
			<!-- end box body -->
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="box box-primary dropbox">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-info-circle"></i> Information</h3>
		</div>
  		<div class="box-body">
  			<div class="row">
  				<div class="col-md-12">

  					<div class="row">
		  				<div class="col-md-4">
		  					<b>Obligation Type:</b>
		  					<select class="form-control" disabled="">
		  						<option value="1"<?php if ($flag == 'ORS') {echo 'selected'; } ?>>ORS</option>
		  						<option value="2"<?php if ($flag == 'BURS') {echo 'selected'; } ?>>BURS</option>
		  					</select>
		  				</div>
		  				<div class="col-md-4">
		  					<?php if ($flag == 'ORS') : ?>
		  						<b>ORS Number:</b>
		  						<input type="" name="" class="form-control" disabled="" value="<?php echo $row['serial_no']; ?>">
	  						<?php else : ?>
		  						<b>BURS Number:</b>
		  						<input type="" name="" class="form-control" disabled="" value="<?php echo $row['serial_no']; ?>">
		  					<?php endif ?>
		  				</div>
		  				<div class="col-md-4">
		  					<?php if ($flag == 'ORS') : ?>
		  						<b>ORS Date:</b>
		  						<input type="text" name="" class="form-control" disabled="" value="<?php echo $row['date_created']; ?>">
	  						<?php else : ?>
		  						<b>BURS Date:</b>
		  						<input type="text" name="" class="form-control" disabled="" value="<?php echo $row['date_created']; ?>">
		  					<?php endif ?>
		  				</div>
  					</div>

  					<div class="row" style="margin-top: 10px;">
  						<div class="col-md-12">
  							<b>Payee:</b>
  							<input type="" name="" class="form-control" disabled="" value="<?php echo $row['supplier']; ?>">
  						</div>
  					</div>

  					<div class="row">
  						<div class="col-md-12">
  							<b>Particular:</b>
  							<textarea type="" name="" class="form-control" disabled="" value="<?php echo $row['purpose']; ?>"></textarea> 
  						</div>
  					</div>

  					<div class="row">
  						<div class="col-md-12">
  							<b>Obligated Amount:</b>
  							<input type="" name="" class="form-control" disabled="" value="<?php echo currencyFormat($row['amount']); ?>">
  						</div>
  					</div>

  					<div class="row">
  						<div class="col-md-12">
  							<b>Total Deductions:</b>
  							<input type="" name="" class="form-control" disabled="" value="<?php echo currencyFormat($row['total']); ?>">
  						</div>
  					</div>

  					<div class="row">
  						<div class="col-md-12">
  							<b>Net Amount:</b>
  							<input type="" name="" class="form-control" disabled="" value="<?php echo currencyFormat($row['net_amount']); ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<br>
  		</div>
  	</div>	
</div>


<div class="col-md-6">
	<div class="box box-success dropbox">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-edit"></i> DV and Deductions</h3>
		</div>
  		<div class="box-body">
  			<div class="row">

				<form action="" method="post">
	  				<div class="col-md-12">

	  					<div class="row">
			  				<div class="col-md-7">
			  					<b>DV Number:</b>
			  					<input type="" class="form-control" name="dv_number" value="<?php echo $row['dv_number']; ?>" disabled>
			  				</div>
			  				<div class="col-md-5">
			  					<b>DV Date:</b>
			  					<input type="date" class="form-control" name="dv_date" value="<?php echo strftime('%Y-%m-%d',strtotime($row['dv_date'])); ?>" disabled>
			  				</div>
	  					</div>

	  					<div class="row" style="margin-top: 10px;">
			  				<div class="col-md-12">
			  					<b>TAX:</b>
			  					<input type="text" class="form-control" name="tax" value="<?php echo currencyFormat($row['tax']); ?>" disabled>
			  				</div>
			  			</div>
	  					<div class="row" style="margin-top: 5px;">
			  				<div class="col-md-12">
			  					<b>GSIS</b>
			  					<input type="text" class="form-control" name="gsis" value="<?php echo currencyFormat($row['gsis']); ?>" disabled>
			  				</div>
			  			</div>
	  					<div class="row" style="margin-top: 5px;">
			  				<div class="col-md-12">
			  					<b>PAGIBIG:</b>
			  					<input type="text" class="form-control" name="pagibig" value="<?php echo currencyFormat($row['pagibig']); ?>" disabled>
			  				</div>
			  			</div>
	  					<div class="row" style="margin-top: 5px;">
			  				<div class="col-md-6">
			  					<b>PHILHEALTH</b>
			  					<input type="text" class="form-control" name="philhealth" value="<?php echo currencyFormat($row['philhealth']); ?>" disabled>
			  				</div>
			  				<div class="col-md-6">
			  					<b>OTHER PAYABLES</b>
			  					<input type="text" class="form-control" name="other" value="<?php echo currencyFormat($row['other']); ?>" disabled>
			  				</div>
			  			</div>


	  					<div class="row" style="margin-top: 5px;">
			  				<div class="col-md-12">
			  					<b>Remarks</b>
			  					<textarea type="number" class="form-control" name="remarks" disabled><?php echo $row['dv_remarks']; ?></textarea> 
			  				</div>
	  					</div>
	  					<button type="submit" name="form_disbursed" id="form_disbursed" style="display: none;">aa</button>
	  				</div>
  				</form>

  			</div>
  		</div>
  	</div>	
</div>

<div class="col-md-12">
	<div class="box box-danger dropbox">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-list"></i> NTA/NCA Summary</h3>
		</div>
		<div class="box-body">
			<div class="row">
			<div class="col-md-12">
			<!-- Table of Uacs -->
			<table id="example" class="table table-bordered " style="background-color: white; width:100%; text-align:left">
			<thead>
			<tr>
			<th width='500'>NTA/NCA NO.</th>
			<th width='500'>PARTICULAR</th>
			<th width='500'>TOTAL AMOUNT</th>
			<th width='500'>NTA BALANCE </th>
			<th width='500'>DISBURSE AMOUNT</th>


			</thead>

			<tbody>
			<?php 
			$sql = "SELECT  
					n.id AS id,
					n.dv_id AS dv_id,
					n.ors_id AS ors_id,
					n.nta_id AS nta_id,
					n.disbursed_amount AS disbursed_amount,
					t.id AS t_id,
					t.nta_number AS t_nta_number,
					t.particular AS t_particular,
					t.quarter AS t_quarter,
					t.amount AS t_amount,
					t.obligated AS t_obligated,
					t.balance AS t_balance
					FROM tbl_nta_entries n
					LEFT JOIN tbl_nta t ON t.id = n.nta_id
					WHERE ors_id = $ors
			";
			$exec = $conn->query($sql);
			while ($list = $exec->fetch_assoc()){
			?>
			<tr>
			<td><?php echo $list['t_nta_number']; ?></td>
			<td><?php echo $list['t_particular']; ?></td>
			<td><?php echo currencyFormat($list['t_amount']); ?></td>
			<td><?php echo currencyFormat($list['t_balance']); ?></td>
			<td><?php echo currencyFormat($list['disbursed_amount']); ?></td>
			</tr>
			<?php } ?>
			</tbody>

			</table>

			<!-- Table of Uacs -->
			</div>
			</div>

		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="box box-warning dropbox">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-list"></i> Summary</h3>
		</div>
		<div class="box-body">
			<div class="row">
			<div class="col-md-12">
			<!-- Table of Uacs -->
			<table id="example" class="table table-bordered " style="background-color: white; width:100%; text-align:left">
			<thead>
			<tr style="background-color: #A9A9A9;  text-align:left; border-style: groove; " >
			<th width='500'>FUND SOURCE</th>
			<th width='500'>PPA </th>
			<th width='500'>UACS </th>
			<th width='500'>AMOUNT </th>


			</thead>

			<tbody>
			<?php 
			// $sql = "SELECT `id`, `ob_id`, `fund_source`, `mfo_ppa`, `uacs`, `amount` FROM `tbl_obentries` WHERE `ob_id` = ".$ors." ";
			$sql = "SELECT
			oe.fund_source,
			oe.amount,
			fe.uacs as uacs,
			oe.amount as amount,
            fs.ppa as mfo_ppa,
			fs.source as fund_source
			FROM tbl_obentries oe
			LEFT JOIN tbl_obligation ob ON ob.id = oe.ob_id
			LEFT JOIN tbl_fundsource_entry fe ON fe.id = oe.uacs
			LEFT JOIN tbl_fundsource fs ON fs.id = fe.source_id
			LEFT JOIN supplier s ON s.id = ob.supplier
			WHERE oe.ob_id = $ors";
			$exec = $conn->query($sql);
			while ($list = $exec->fetch_assoc()){
			?>
			<tr>
			<td><?php echo $list['fund_source']; ?></td>
			<td><?php echo $list['mfo_ppa']; ?></td>
			<td><?php echo $list['uacs']; ?></td>
			<td><?php echo currencyFormat($list['amount']); ?></td>
			</tr>
			<?php } ?>
			</tbody>

			</table>

			<!-- Table of Uacs -->
			</div>
			</div>

		</div>
	</div>
</div>