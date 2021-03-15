<?php
    require_once 'FiveSMonitoringForm/controller/FiveSMonitoringController.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
          5S Add Form
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
            <a href="base_fives_monitoring_form.html.php?division=<?php echo $_SESSION['division'];?>">
            	5S Monitoring Form
            </a>
          </li>
          <li class="active">
            Add Form
          </li>
          
        </ol> 
    </section>
    <section class="content">
      <div class="row">
    	<div class="col-md-12">
    		<?php include('driver_details.html.php'); ?>
    	</div>
      </div> 
    </section>
</div>


<style type="text/css">

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
		$('input').iCheck({
		    checkboxClass: 'icheckbox_square-red',
		    radioClass: 'iradio_square-red',
		    increaseArea: '20%' // optional
		  });

		$('#activity_date').daterangepicker();
    	$('#datepicker').datepicker({
	      autoclose: true
	    });

	    $("#datepicker").datepicker().datepicker("setDate", new Date());
		$('.attendee').addClass('hidden');
		$('#cgroup-attendee').addClass('hidden');

		$(document).on('change', ':file', function() {
		  let input = $(this);
		  let numFiles = input.get(0).files ? input.get(0).files.length : 1;
		  let label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		  
		  input.trigger('fileselect', [numFiles, label]);
		  $('#uploadtxt').val(label);
		});

		$(document).on('change', '.attendee_type', function(){
			let selected = $(this).val();

			if (selected == 'single') {
				$('#cgroup-attendee').removeClass('hidden');
				$('.attendee').addClass('hidden');
			} else {
				$('#cgroup-attendee').addClass('hidden');
				$('.attendee').removeClass('hidden');
			}
		});

	});
</script>




