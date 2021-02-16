<div class="box">
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				
				<div class="margin" style="position:absolute; margin:0px">
					<div class="btn-group">
						<a class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-add-program">Add Program</a>
					</div>
				</div>
				<table id="list_table" class="table table-striped table-bordered table-responsive table-hover" role="grid">
					<thead>
						<tr>
							<th>Code</th>
		                	<th>Name</th>
		                	<th style = "text-align:center; vertical-align: middle; width:21%"></th>         
		                </tr>
		                
					</thead>
					<tbody id="list_body">
						<?php foreach ($programs as $key => $program): ?>
							<tr>
								<td>
									<?php echo input_hidden('progid','progid','progid',$key); ?>
									<?php echo input_hidden('code','code','code',$program['code']); ?>
									<?php echo input_hidden('name','name','name',$program['name']); ?>

									<?php echo $program['code']; ?>	
								</td>
								<td>
									<?php echo $program['name']; ?>
								</td>
								<td>
									<div class="btn-group">
										<a class="btn btn-block btn-primary edit-program" data-toggle="modal" data-target="#modal-edit-program">Edit</a>
									</div>
									<div class="btn-group">
										<a class="btn btn-block btn-danger remove_program">Delete</a>
									</div>
								</td>
							</tr>
							
						<?php endforeach ?>
						
					</tbody>
				</table>
			</div>
				
		</div>
		
	</div>	
</div>

<style type="text/css">
	
</style>

<script type="text/javascript">
	

	// $(document).ready(function(){
	// 	$('#list_table2').DataTable( {
	//       'paging'      : true,  
	//       'lengthChange': false,
	//       'searching'   : true,
	//       'ordering'    : false,
	//       'info'        : false,
	//       'autoWidth'   : false,
	//     } );

	//     // $(document).on('change', '.program_code', function(){
	//     // 	let program = $(this).val();	    	
	    	
	//     // 	$('#list_body').empty();

	//     // 	$.ajax({
	// 	   //      url:"../../fas/ActivityPlanner/entity/filter_events.php",
	// 	   //      type:"GET",
	// 	   //      data:{program: program},
	// 	   //      success:function(data){
	// 	   //  		$('#list_table').DataTable().clear().destroy();

	// 	   //      	let row = generateTable(JSON.parse(data));
	// 	   //      	$('#list_body').append(row);

	// 	   //      	$('#list_table').DataTable( {
	// 			 //      // 'paging'      : true,  
	// 			 //      'lengthChange': false,
	// 			 //      'searching'   : true,
	// 			 //      'ordering'    : false,
	// 			 //      'info'        : false,
	// 			 //      'autoWidth'   : false,
	// 			 //    } );
	// 	   //      }
	// 	   //    });
	//     // });
	// });
</script>