<?php 
 $type_permission = $userGroup[$GLOBALS['TYPE']][$GLOBALS['CONTROLLER']];
 if(isset($type_permission['insert']['isLogin']) and $type_permission['insert']['isLogin'])
 $insert = null; 
 else $insert = "hide-elm";
 if(isset($type_permission['update']['isLogin']) and $type_permission['update']['isLogin'])
 $update = null;
 else  $update = "hide-elm";
 if(isset($type_permission['delete']['isLogin']) and $type_permission['delete']['isLogin'])
 $delete = null; 
 else $delete = "hide-elm";
 if($update === 'hide-elm' and $delete === 'hide-elm')
 $td_action = "hide-elm";
 else
 $td_action = null;

?>


<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12 col-xs-12">

      <div id="messages">
      </div>

      <button class="btn btn-primary <?= $insert ?>" data-toggle="modal" data-target="#addModal">Add Table</button>
      <br /> <br />


      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Manage Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="manageTable" class="table table-bordered table-striped">
            <thead>
              <tr>
              <th></th>
              <th>Id Table</th>

                <th>Table name</th>
                <th>Status</th>
                <th>Id Area</th>

                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
foreach ($data as $key => $value) 
{
?>
  <tr role="row" class="odd">
  <td></td>
  <td><?= $value->id_table ?></td>

  <td><?= $value->table_name ?></td>
  <td><span class="label label-success"><?= $value->active ?></span></td>
  <td><?= $value->store_id ?></td>

  <td><button type="button" class="btn btn-default <?= $update ?>" onclick="editFunc(<?php echo '\'' . $value->id_table . '\'' ?>, this)" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-default <?= $delete ?>" onclick="removeFunc(<?php echo '\'' . $value->id_table . '\'' ?>, this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button></td>
</tr>

<?php };?>             
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- col-md-12 -->
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="addModal" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Table</h4>
            <div class="progress hide-elm" id="progress" style="margin-bottom: 0px !important;">
              <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                0%
              </div>
            </div>
          </div>

          <form role="form" action="#" method="post" id="createForm">

            <div class="modal-body">

              <div class="form-group">
                <label for="brand_name">Table Name</label>
                <input type="text" class="form-control" id="table_name" name="table_name" placeholder="Enter Table name" autocomplete="off">
                <p id="err_table_name" class="hide-elm text-danger">The Table name field is required.</p>
              </div>
              <div class="form-group">
                <label for="brand_name">Area Id</label>
                <select class="form-control" id="store_id" name="store_id">
                  <option value="" selected>Choose Area</option>
                  <?php
                if (count($list_store) > 0) {
                  foreach ($list_store as $key => $value) {
                ?>
                    <option value="<?= $value->id ?>"><?= $value->name ?></option>

                <?php
                  }
                }
                ?>
                </select>                
                <p id="err_store_id" class="hide-elm text-danger">The Table name field is required.</p>
              </div>
              <div class="form-group"  >
                <label for="active">Status</label>
                <select class="form-control" id="active" name="active">
                  <option value="" selected>Choose</option>
                  <option value="1">Active</option>
                  <option value="2">Inactive</option>
                </select>
                
                <p id="err_active" class="hide-elm text-danger">The Table name field is required.</p>
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
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Table</h4>
            <div class="progress hide-elm" id="progress-edit" style="margin-bottom: 0px !important;">
              <div class="progress-bar progress-bar-striped active" id="progress-bar-edit" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                0%
              </div>
            </div>
          </div>
          <form role="form" method="post" id="updateForm">
            <div class="modal-body">
              <div id="messages"></div>
              <input type="hidden" id="edit_id_table" name="edit_id_table">
              <div class="form-group">
                <label for="brand_name">Table Name</label>
                
                <input type="text" class="form-control  load-data" id="edit_table_name" name="edit_table_name" value="1" placeholder="Enter Table name" autocomplete="off">
                <div class="loader hide-elm" id="loader">
                  </div>
              </div>
              <div class="form-group">
                <label for="brand_name">Area Id</label>
                <select class="form-control" id="edit_store_id" name="edit_store_id">
                  <option value="" selected>Choose Area</option>
                  <?php
                if (count($list_store) > 0) {
                  foreach ($list_store as $key => $value) {
                ?>
                    <option value="<?= $value->id ?>"><?= $value->name ?></option>

                <?php
                  }
                }
                ?>
                </select>                
                <p id="err_store_id" class="hide-elm text-danger">The Table name field is required.</p>
              </div>
              <div class="form-group">
                <label for="active">Status</label>
                <select class="form-control  load-data" id="edit_active" name="edit_active">
                  <option value="1">Active</option>
                  <option value="2">Inactive</option>
                </select>
                <div class="loader hide-elm" id="loader1">
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="submit-edit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Remove Table</h4>
            <div class="progress hide-elm" id="progress-remove" style="margin-bottom: 0px !important;">
              <div class="progress-bar progress-bar-striped active" id="progress-bar-remove" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                0%
              </div>
            </div>
          </div>
          <form role="form" action="#" method="post" id="removeForm">
            <div class="modal-body"> 
            <input type="hidden" name="remove_id_table">  
            <input type="hidden" name="remove_td">            
          
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
</section>
<script  src="assets/admin/dist/js/table.js?ver=02"></script>
