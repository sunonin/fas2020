<div class="modal fade" id="modal-upload_docs" tabindex="-1" role="dialog" aria-labelledby="modal-add_task_modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 30%;">
    <div class="modal-content modal-dialog-centered" style="border-radius: 5px;">
      

        <!-- action="ActivityPlanner/entity/save_subtasks.php" -->
    
        <div class="row">  
          <div class="col-md-12">
            <br>
            <form method="POST" action="ActivityPlanner/entity/save_external_link.php">

            <!-- CUSTOM BLOCKQUOTE -->
            <blockquote class="blockquote blockquote-custom bg-white p-5 shadow rounded">
                <div class="blockquote-custom-icon-task bg-info shadow-sm">
                  <i class="fa fa-link text-white" style="font-size: 38pt; color:#ffb123;"></i>
                </div>

                <div class="col-md-12 pull-right" style="position: absolute; top: 7px; left: -7%;">
                  <div class="row">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="row" style="margin-bottom: 3%;  border-bottom: 1px solid lightgray;">
                    <h2 class="text-center" style="color:#ffb123;"><b>UPLOAD DOCUMENT</b></h2>
                  </div>
                </div>
                
                <?php echo input_hidden('event_id','event_id', 'event_id', $_GET['event_planner_id']); ?>
                <?php echo input_hidden('event_program','event_program', 'event_program', $event_data['event_program']); ?>
                <?php echo input_hidden('current_user','current_user', 'current_user', $event_data['current_user']); ?>
                <?php echo input_hidden('task_id','task_id', 'task_id', ''); ?>
                <?php echo input_hidden('code','code', 'code', ''); ?>


                <?php echo group_text('External Link','external_link', $event_data['external_link'], '',1, false,''); ?>
                
                <div class="row exlink-container hidden">
                  <div class="col-md-12">
                    <a href="" class="btn btn-warning btn-lg btn-block btn-open-exlink" name="submit" value=""><span class="fa fa-external-link"></span> Open Link</a>
                  </div>
                  
                </div>
                
                <hr>
                <div class="row">
                  
                  <div class="col-md-6">
                    <button type="button" class="btn btn-secondary btn-lg btn-block" data-dismiss="modal"><span class="fa fa-close"></span> Cancel</button>
                  </div>
                  
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value=""><span class="fa fa-save"></span> Save Changes</button>
                  </div>
                </div>
            </blockquote><!-- END -->
            </form>
          </div>
        </div>
      
    </div>
  </div>
</div>

<style type="text/css">
  .modal-dialog {
  vertical-align: middle;
}
  /*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/
.blockquote {
    padding: 10px 20px;
    margin: 0 0 20px;
    font-size: 17.5px;
     border-left: 0px; 
}

.blockquote-custom-icon-task {
    width: 75px;
    height: 75px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: -18px;
    background-color: white;
    color: #346e8c;

     left: 44%; 
}



/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/
body {
  background: #eff0eb;
  /*background-image: url('https://i.postimg.cc/MTbfnkj6/bg.png');*/
  background-size: cover;
  background-repeat: no-repeat;
}
  
</style>
