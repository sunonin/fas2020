<div class="pull-right">
	<div class="btn-group">
    	<a href='TemplateGenerator/entity/download_template.php?&username=<?php echo $_SESSION['username']; ?>&division=<?php echo $_GET['division']; ?>&emp_id=<?php echo $_SESSION['currentuser']; ?>' class="btn btn-block btn-danger"><i class="fa fa-download"></i> Download Template</a>
    </div>
</div>
<h4>Activity Details</h4>
<hr>
<form id="cform-cert_details" method="POST" enctype="multipart/form-data" action="TemplateGenerator/entity/template.php" >
	<div class="row">
		<div class="col-md-12">
			<?php echo group_newtextarea('Activity Title', 'activity_title', '', 2); ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<?php echo group_select('OPR','opr', $offices, '','', 1, false); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo group_text('Activity Venue','activity_venue','', '',1, false,''); ?>
		</div>
		<div class="col-md-6">
			<?php echo group_daterange3('Activity Date', 'activity_date', 'activity_date', '', '', 'daterange ', 1, false); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo group_text('Issued Place','issued_place','', '',1, false,''); ?>
		</div>
		<div class="col-md-6">
			<?php echo group_date('Issued Date','date_given','date_given', '',1, false,''); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo group_select('Certificate Type','certificate_type',['cop'=>'CERTIFICATE OF PARTICIPATION', 'coa'=>'CERTIFICATE OF APPRECIATION', 'coc'=>'CERTIFICATE OF COMPLETION', 'coap'=>'CERTIFICATE OF APPEARANCE'], '','', 1, false); ?>
		</div>

		<div class="col-md-6">
			<label>Signature Type:</label>
			<div class="form-group">
				<div class="col-md-6">
					<div class="radio">
						<label>
							<input type="radio" class="signature_type" name="signature_type" id="cform-single_type" value="manual"/>
							Manual
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="radio">
						<label>
							<input type="radio" class="signature_type" name="signature_type" id="cform-multiple_type" value="esignature"/>
							E-signature
						</label>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-6">
			<label>Participants Type:</label>
			<div class="form-group">
				<div class="col-md-6">
					<div class="radio">
						<label>
							<input type="radio" class="attendee_type" name="attendee_type" id="cform-single_type" value="single"/>
							Single
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="radio">
						<label>
							<input type="radio" class="attendee_type" name="attendee_type" id="cform-multiple_type" value="multiple"/>
							Multiple
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo group_text('Single Participant','attendee','', '',1, false,'', '',false); ?>
		</div>
		<div class="col-md-6">
			<?php echo group_text('Position','position','', '',1, false,'', '',false); ?>
		</div>	
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo group_text('Office','office','', '',1, false,'', '',false); ?>
		</div>
		<div class="col-md-6">
			<?php echo group_text('Email','email','', '',1, false,'', '',false); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group attendee">
				<label>Multiple Participants:</label>
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-primary">
							Browse&hellip; <input type="file" name="uploadfile" style="display: none;">
						</span>
					</label>
					<input type="text" id="uploadtxt" class="form-control" readonly>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<hr>
			<br>
			<div class="btn-group" style="width:20%;">
		    	<a href="base_template_generator.html.php?division=<?php echo $_SESSION["division"];?>" class="btn btn-block btn-default"><i class="fa fa-chevron-left"></i> Back</a>
		    </div>
			<div class="pull-right">
				<div class="btn-group">
					<button type="submit" name="submit" value="" class="btn btn-block btn-success" id="submit_btn"><i class="fa fa-download"></i> Generate</button>
				</div>
			</div>
		</div>
	</div>
</form>

