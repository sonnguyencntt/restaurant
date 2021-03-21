
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div id="messages">
        <?php
      $message = '';
      $status= '';
      $action = 'hide-elm';
      if (isset($_SESSION['message-fail-uid'])) 
      {
        $status = 'danger';
        $message =  MyFunction::get_message('message-fail-uid');
        $action = 'show-elm';
      }

      if(isset($_SESSION['message-success-uid']))
      {
        $status = 'success';
        $message =  MyFunction::get_message('message-success-uid');
        $action = 'show-elm';
      }


  ?>
        <div class="alert alert-<?= $status ?> alert-dismissible <?= $action ?>" role="alert" >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button
        ><strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong><?= $message; ?></div>
      </div>
    
      <a href="?controller=group&type=admin&action=create" class="btn btn-primary <?= $access['insert'] ?>">Add Group</a>
      <br /> <br />

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Manage Groups</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="groupTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th></th>
                <th>Group Name</th>
                <th  class="<?= $access['td_action'] ?>">Action</th>
              </tr>
            </thead>
            <tbody>

              <?php
              foreach ($data as $value) {
              ?>
                <tr>
                  <td></td>
                  <td><?= $value->group_name ?></td>

                  <td  class="<?= $access['td_action'] ?>">
                    <a href="?controller=group&action=edit&type=admin&id_group=<?= $value->id ?>" class="btn btn-default <?=  $access['update']?>"><i class="fa fa-edit"></i></a>
                    <button type="button" class="btn btn-default <?=  $access['delete'] ?>" onclick="removeFunc(<?= $value->id ?>)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- col-md-12 -->
  </div>
  <!-- /.row -->


</section>
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Remove Group</h4>
            
          </div>
          <form role="form" action="?controller=group&action=delete&type=admin" method="post" id="removeForm">
            <div class="modal-body"> 
            <input type="hidden" name="remove_id_group">  
          
              <div class="alert-remove">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<script src="assets/admin/dist/js/group.js"></script>