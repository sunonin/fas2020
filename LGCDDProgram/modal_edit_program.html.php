<div class="modal fade" id="modal-edit-program">
  <div class="modal-dialog" style="width:40%">
    <div class="modal-content">
      <div class="box direct-chat direct-chat-primary box-chatchat">
        <div class="box-header with-border">
          
          <h3 class="box-title"><i class="icon fa fa-edit"></i> Edit Program</h3>
          <div class="box-tools pull-right">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          </div>

        </div>

        <form method="POST" action="LGCDDProgram/entity/edit_program.php" >
        <div class="box-body">
            <?php echo input_hidden('progid','progid','progid',''); ?>

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-12">

                  <!-- code -->
                  <?php echo group_text('Code','code','', '',1, false,'code'); ?>
                </div> 
                <div class="col-md-12">
                  <!-- name -->
                  <?php echo group_text('Name','name','', '',1, false,'name'); ?>
                  
                </div>
                
              </div>
            </div>
        </div>

        <div class="box-footer">
           <div class="row pull-right">
            <div class="col-md-12">
              <div class="margin">
                
                <div class="btn-group">
                  <a class="btn btn-block btn-default" data-dismiss="modal"><i class="fa fa-chevron-left"></i> Cancel</a>
                </div>

                <div class="btn-group">
                  <button type="submit" name="submit" value="" class="btn btn-block btn-primary" id="submit_btn"><i class="fa fa-save"></i> Save</button>  
                </div>
                
              </div>
              
            </div>
          </div> 
        </div>
        </form>  


      </div>
  </div>
  </div>
</div>
