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
        
      <a href="?controller=product&type=admin&action=create" class="btn btn-primary <?= $access['insert'] ?>">Add Product</a>
          
        
        
        <br /> <br />

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Products</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th></th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Status</th>
                                  <th class="<?= $access['td_action'] ?>">Action</th>
                              </tr>
              </thead>
              <tbody>
              <?php
foreach ($data as $key => $value) 
{
?>
  <tr role="row" class="odd">
  <td></td>
  <td><img style="width: 150px;
    height: 100px;" src="<?= $value->image ?>" alt="" ></td>

  <td><?= $value->name ?></td>
  <td><?= $value->price ?></td>
  <td><span class="label label-success"><?= $value->active ?></span></td>
  <td class="<?= $access['td_action'] ?>"><a type="button" class="btn btn-default <?= $access['update'] ?>" href = "?controller=product&type=admin&action=edit&id=<?= $value->id ?>"><i class="fa fa-pencil"></i></a> <button type="button" class="btn btn-default <?= $access['delete'] ?>" onclick="removeFunc(<?= $value->id ?>)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button></td>
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
    <!-- /.row -->
    

  </section>
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModal" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Remove Product</h4>
            
          </div>
          <form role="form" action="?controller=product&action=delete&type=admin" method="post" id="removeForm">
            <div class="modal-body"> 
            <input type="hidden" name="remove_id_product">  
          
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
  <script src="assets/admin/dist/js/product.js?ver=01"></script>