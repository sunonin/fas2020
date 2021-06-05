<div class="tab-pane" id="tab_settings">
  <form method="POST" action="ActivityPlanner/entity/save_settings.php">
    <div class="box-body box-profile">
      <?php echo input_hidden('event_planner_id','event_planner_id','event_planner_id',$_GET['event_planner_id']) ?>
      
      <div class="row">
        <div class="form-group col-md-12">
          <!-- <h3>Access Control List</h3> -->
        </div>
      </div>
      <div class="row" style="min-height: 543px !important;">
        <div class="form-group col-md-12">
          <table id="acl_list" class="table table-striped table-bordered table-responsive table-hover">
            <tr style="background-color: #007a95; height: 60px;">
              <th style="text-align:center; vertical-align: middle; color:white;">Name</th>
              <th style="text-align:center; vertical-align: middle; color:white;">OPR</th>
              <th style="text-align:center; vertical-align: middle; color:white;">ADD</th>
              <th style="text-align:center; vertical-align: middle; color:white;">EDIT</th>
              <th style="text-align:center; vertical-align: middle; color:white;">DELETE</th>
              <!-- <th style="text-align:center; vertical-align: middle; color:white;">SAVE</th> -->
              <th style="text-align:center; vertical-align: middle; color:white;">START</th>
              <th style="text-align:center; vertical-align: middle; color:white;">POST</th>
              <th style="text-align:center; vertical-align: middle; color:white;">APPROVE</th>
            </tr>
            
            <?php $counter = 0; ?>
            <?php foreach ($collaborators1 as $key => $person): ?>
              <?php $counter = $counter + 1; ?>
              <tr>
                <td style="vertical-align: middle">
                  <b><?php echo $counter .'. ' .$person['name']; ?></b>
                  <?php echo input_hidden('clb_id','clb_id[]','clb_id',$key) ?>
                     
                </td>
                <td style="text-align: center">
                  <?php echo group_input_checkbox('OPR', 'opr', 'opr['.$key.'][]', 'opr', $person['acl']->opr, 0, 2, $person['acl']->opr); ?>
                </td>
                <td style="text-align: center">
                  <?php echo group_input_checkbox('Add', 'add', 'add['.$key.'][]', 'collab add', $person['acl']->add, 0, 2, $person['acl']->add); ?>
                </td>
                <td style="text-align: center">
                  <?php echo group_input_checkbox('Edit', 'edit', 'edit['.$key.'][]', 'collab edit', $person['acl']->edit, 0, 2, $person['acl']->edit); ?>
                </td>
                <td style="text-align: center">
                  <?php echo group_input_checkbox('Delete', 'delete', 'delete['.$key.'][]', 'collab delete', $person['acl']->delete, 0, 2, $person['acl']->delete); ?>
                </td>
                <td class="hidden" style="text-align: center">
                  <?php echo group_input_checkbox('Save', 'save', 'save['.$key.'][]', 'collab save', $person['acl']->save, 0, 2, $person['acl']->save); ?>
                </td>
                <td style="text-align: center">
                  <?php echo group_input_checkbox('To Do', 'todo', 'todo['.$key.'][]', 'collab todo', $person['acl']->todo, 0, 2, $person['acl']->todo); ?>
                </td>
                <td style="text-align: center">
                  <?php echo group_input_checkbox('Post', 'post', 'post['.$key.'][]', 'collab post', $person['acl']->post, 0, 2, $person['acl']->post); ?>
                </td>
                <td style="text-align: center">
                  <?php echo group_input_checkbox('Approve', 'approve', 'approve['.$key.'][]', 'collab approve', $person['acl']->approve, 0, 2, $person['acl']->approve); ?>
                </td>
              </tr>
            <?php endforeach ?>        
          </table>               
        </div>
      </div>
    </div>
    <div class="box-footer">
      <div class="row pull-right">
        <div class="margin">

          <div class="btn-group">
            <a href="base_activity_planner.html.php?division=<?php echo $_SESSION["division"];?>" class="btn btn-block btn-default"><i class="fa fa-chevron-left"></i> Back</a>
          </div>
          
          <?php if ($is_opr OR in_array('save', $access_list)): ?>
          <div class="btn-group">
            <button type="submit" name="submit" value="" class="btn btn-block btn-primary" id="submit_btn"><i class="fa fa-save"></i> Save Changes</button>  
          </div>
          <?php endif?>
        </div>
      </div>
    </div>
  </form>
</div>      

<style type="text/css">
  #acl_list {
      box-shadow: 0 1px 2px rgb(0 0 0 / 15%);
    }
</style>

<script type="text/javascript">

  $(document).ready(function(){
    
    $(document).on('click','.opr', function(){
      let is_checked = $(this).is(':checked');
      let grp = $(this).closest('tr');
      let box = ['add', 'edit', 'delete', 'save', 'todo', 'post', 'approve'];

      $.each(box, function(key, item){
        let el = grp.find('.'+item);
        el.prop('checked', is_checked);
      });

    });

    $(document).on('click','.collab', function(){
      // let is_checked = $(this).is(':checked');
      let grp = $(this).closest('tr');
      let opr = grp.find('.opr');
      let box = ['add', 'edit', 'delete', 'save', 'todo', 'post', 'approve'];
      let checker = true;

      $.each(box, function(key, item){
        let el = grp.find('.'+item);
        if (!el.is(':checked')) {
          checker = el.is(':checked');
        }  
      });

      opr.prop('checked', checker);
      
    });

  });
</script>