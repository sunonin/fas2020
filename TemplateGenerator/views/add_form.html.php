<?php 
  require_once 'TemplateGenerator/controller/TemplateGeneratorController.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
          Certificate Generator
        </h1>
        
        <?php include('ActivityPlanner/views/alert_message.html.php'); ?>

        <ol class="breadcrumb"> 
          <li>
            <a href="home.php">
              <i class="fa fa-dashboard"></i> 
              Home
            </a>
          </li> 
          <li>
            <a href="base_template_generator.html.php?division=<?php echo $_SESSION['division'];?>">
            	Certificate Generator
            </a>
          </li>
          <li class="active">
            Generate New
          </li>
          
        </ol> 
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-7">
        	<div class="row">
				<div class="col-md-12 border-right">
	        		<div class="box box-primary dropbox">
						<div class="box-body">
					        <?php include('certificate_details.html.php'); ?>
				    	</div>
					</div>
				</div> 
        	</div>
        </div> 
		
    	<div class="col-md-5">
        	<div class="row">
    			<div class="col-md-12">
    				<?php include('instructions.html.php'); ?>
    			</div>
    		</div>

      	</div> 
    </section>
</div>

<style type="text/css">
textarea {
    resize: none;
}

#count_message {
  background-color: smoke;
  margin-top: -20px;
  margin-right: 5px;
}

	.dropbox {
    	box-shadow: 0 1px 2px rgb(0 0 0 / 50%);
	}

	#list_table {
	    box-shadow: 0 1px 2px rgb(0 0 0 / 15%);
	}

	.btn-file {
	  position: relative;
	  overflow: hidden;
	}

	.btn-file input[type=file] {
	  position: absolute;
	  top: 0;
	  right: 0;
	  min-width: 100%;
	  min-height: 100%;
	  font-size: 100px;
	  text-align: right;
	  filter: alpha(opacity=0);
	  opacity: 0;
	  outline: none;
	  background: white;
	  cursor: inherit;
	  display: block;
	}

	.callout {
	    border-radius: 5px;
	    margin: 0 0 20px 0;
	    padding: 15px 30px 15px 15px;
	    border-left: 20px solid #eee;
	    border-top: 1px solid;
	    border-right: 1px solid;
		border-bottom: 1px solid;
	}
</style>

<script type="text/javascript">
		$(document).ready( function() {
    	$('#activity_date').daterangepicker({opens: 'right'});
    	$('#datepicker').datepicker({
	      autoclose: true
	    });

	    $('#cform-selected_dates').datepicker({
	       startDate: new Date(),
        multidate: true,
        format: "mm/dd/yyyy",
	    });

	    $("#datepicker").datepicker().datepicker("setDate", new Date());
		$('.attendee').addClass('hidden');
		$('#cgroup-attendee').addClass('hidden');
		$('#cgroup-position').addClass('hidden');
		$('#cgroup-office').addClass('hidden');
		$('#cgroup-email').addClass('hidden');

		var text_max = 500;
		$('#count_message').html('0 / ' + text_max );

		$(document).on('keyup', '#cform-activity_title', function() {
		  var text_length = $('#cform-activity_title').val().length;
		  var text_remaining = text_max - text_length;
		  
		  $('#count_message').html(text_length + ' / ' + text_max);
		});

		
		$(document).on('change', ':file', function() {
		  var input = $(this);
		  var numFiles = input.get(0).files ? input.get(0).files.length : 1;
		  var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		  
		  input.trigger('fileselect', [numFiles, label]);
		  $('#uploadtxt').val(label);
		});

		$(document).on('change', '.attendee_type', function(){
			let selected = $(this).val();

			if (selected == 'single') {
				$('#cgroup-attendee').removeClass('hidden');
				$('#cgroup-position').removeClass('hidden');
				$('#cgroup-office').removeClass('hidden');
				$('#cgroup-email').removeClass('hidden');
				$('.attendee').addClass('hidden');
			} else {
				$('#cgroup-attendee').addClass('hidden');
				$('#cgroup-position').addClass('hidden');
				$('#cgroup-office').addClass('hidden');
				$('#cgroup-email').addClass('hidden');
				$('.attendee').removeClass('hidden');
			}
		});

		$(document).on('change', '.date_type', function(){
			let selected = $(this).val();

			if (selected == 'selected') {
				$('#cform-selected_dates').removeClass('hidden');
				$('.input-group-daterange').addClass('hidden');
			} else {
				$('#cform-selected_dates').addClass('hidden');
				$('.input-group-daterange').removeClass('hidden');
			}
		});

		$(document).on('click', '#preview_btn', function() {
			let form_details = $('#cform-cert_details').serialize();
 
	    	$.ajax({
	        	url: "TemplateGenerator/entity/preview_template.php",
	        	type: "POST",
	        	data: form_details,
	        	success:function(data){
	          		window.open("base_template_preview.html.php", "_blank", "toolbar=no,scrollbars=no,resizable=no,top=500,left=500,width=400,height=400");
	        	}
	      	});
	    });

	});
</script>




