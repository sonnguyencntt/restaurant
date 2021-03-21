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

      <button class="btn btn-primary <?= $insert ?>" data-toggle="modal" data-target="#addModal">Add Store</button>
      <br /> <br />


      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Manage Stores</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="manageTable" class="table table-bordered table-striped">
            <thead>
              <tr>
              <th></th>
              <th>Id store</th>

                <th>Store name</th>
                <th>Status</th>
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
  <td><?= $value->id_store ?></td>

  <td><?= $value->name ?></td>
  <td><span class="label label-success"><?= $value->active ?></span></td>
  <td><button type="button" class="btn btn-default" onclick="editFunc(<?php echo '\'' . $value->id_store . '\'' ?>, this)" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-default" onclick="removeFunc(<?php echo '\'' . $value->id_store . '\'' ?>, this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button></td>
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
            <h4 class="modal-title">Add Store</h4>
            <div class="progress hide-elm" id="progress" style="margin-bottom: 0px !important;">
              <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                0%
              </div>
            </div>
          </div>

          <form role="form" action="#" method="post" id="createForm">

            <div class="modal-body">

              <div class="form-group">
                <label for="brand_name">Store Name</label>
                <input type="text" class="form-control" id="store_name" name="store_name" placeholder="Enter store name" autocomplete="off">
                <p id="err_store_name" class="hide-elm text-danger">The Store name field is required.</p>
              </div>
              <div class="form-group"  >
                <label for="active">Status</label>
                <select class="form-control" id="active" name="active">
                  <option value="" selected>Choose</option>
                  <option value="1">Active</option>
                  <option value="2">Inactive</option>
                </select>
                
                <p id="err_active" class="hide-elm text-danger">The Store name field is required.</p>
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
            <h4 class="modal-title">Edit Store</h4>
            <div class="progress hide-elm" id="progress-edit" style="margin-bottom: 0px !important;">
              <div class="progress-bar progress-bar-striped active" id="progress-bar-edit" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                0%
              </div>
            </div>
          </div>
          <form role="form" action="stores/update" method="post" id="updateForm">
            <div class="modal-body">
              <div id="messages"></div>
              <input type="hidden" id="edit_id_store" name="edit_id_store">
              <div class="form-group">
                <label for="brand_name">Store Name</label>
                
                <input type="text" class="form-control  load-data" id="edit_store_name" name="edit_store_name" value="1" placeholder="Enter store name" autocomplete="off">
                <div class="loader hide-elm" id="loader">
                  </div>
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
            <h4 class="modal-title">Remove Store</h4>
            <div class="progress hide-elm" id="progress-remove" style="margin-bottom: 0px !important;">
              <div class="progress-bar progress-bar-striped active" id="progress-bar-remove" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                0%
              </div>
            </div>
          </div>
          <form role="form" action="#" method="post" id="removeForm">
            <div class="modal-body"> 
            <input type="hidden" name="remove_id_store">  
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
<script  src="assets/admin/dist/js/store.js"></script>
