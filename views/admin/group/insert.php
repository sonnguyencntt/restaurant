<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php if(isset($title)) echo "UPDATE GROUP"; else echo "ADD GROUP" ?></h3>
            </div>
            <form role="form" action="<?php if(isset($action)) echo "?controller=group&action=update&type=admin";else echo "?controller=group&action=insert&type=admin" ?>" method="post">
              <div class="box-body">

                
                <div class="form-group">

                  <label for="group_name">Group Name</label>
                  <input type="hidden" value="<?php if(isset($id_group))echo $id_group ?>" class="form-control" id="id_group" name="id_group" placeholder="Enter group name" autocomplete="off" required>

                  <input type="text" value="<?php if(isset($name_group))echo $name_group ?>" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th><h4><strong>ADMIN</strong></h4></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php 
                foreach($data['admin'] as $key => $value){
                  if($key === "page" || $key === "auth"){
                    continue;
                  }
                 
                
                ?>

                      <tr>
                        <td><?= ucfirst($key) ?></td>
                        <td><?php if(isset($value['insert'])){ ?>
                        <input type="checkbox" name="<?php echo "admin_".$key."_insert_isLogin" ?>" id="permission" value="1" <?php if(isset($value['insert']['isLogin']) && $value['insert']['isLogin']) echo "checked" ?> >
                        <?php }
                        else{
                          echo "-";
                        }
                         ?>
                         </td>
                         <td><?php if(isset($value['update'])){ ?>
                        <input type="checkbox" name="<?php echo "admin_".$key."_update_isLogin" ?>" id="permission" value="1" <?php if(isset($value['update']['isLogin']) && $value['update']['isLogin']) echo "checked" ?>>
                        <?php }
                        else{
                          echo "-";
                        }
                         ?>
                         </td>
                         <td><?php if(isset($value['index'])){ ?>
                        <input type="checkbox" name="<?php echo "admin_".$key."_index_isLogin" ?>" id="permission" value="1" <?php if(isset($value['index']['isLogin']) && $value['index']['isLogin']) echo "checked" ?>>
                        <?php }
                        else{
                          echo "-";
                        }
                         ?>
                         </td>
                         <td><?php if(isset($value['delete'])){ ?>
                        <input type="checkbox" name="<?php echo "admin_".$key."_delete_isLogin" ?>" id="permission" value="1" <?php if(isset($value['delete']['isLogin']) && $value['delete']['isLogin']) echo "checked" ?>>
                        <?php }
                        else{
                          echo "-";
                        }
                         ?>
                         </td>
                              </tr>
                      <?php };?>


           
                    </tbody>
                  </table>
           
                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th><h4><strong>USER</strong></h4></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php 
                foreach($data['user'] as $key => $value){
                  if($key === "page" || $key === "auth"){
                    continue;
                  }

                 
                
                ?>

                      <tr>
                        <td><?= ucfirst($key) ?></td>
                        <td><?php if(isset($value['insert'])){ ?>
                        <input type="checkbox" name="<?php echo "user_".$key."_insert_isLogin" ?>" id="permission" value="1" <?php if(isset($value['insert']['isLogin']) && $value['insert']['isLogin']) echo "checked" ?>  >
                        <?php }
                        else{
                          echo "-";
                        }
                         ?>
                         </td>
                         <td><?php if(isset($value['update'])){ ?>
                        <input type="checkbox" name="<?php echo "user_".$key."_update_isLogin" ?>" id="permission" value="1"<?php if(isset($value['update']['isLogin']) && $value['update']['isLogin']) echo "checked" ?> >
                        <?php }
                        else{
                          echo "-";
                        }
                         ?>
                         </td>
                         <td><?php if(isset($value['index'])){ ?>
                        <input type="checkbox" name="<?php echo "user_".$key."_index_isLogin" ?>" id="permission" value="1" <?php if(isset($value['index']['isLogin']) && $value['index']['isLogin']) echo "checked" ?>>
                        <?php }
                        else{
                          echo "-";
                        }
                         ?>
                         </td>
                         <td><?php if(isset($value['delete'])){ ?>
                        <input type="checkbox" name="<?php echo "user_".$key."_delete_isLogin" ?>" id="permission" value="1" <?php if(isset($value['delete']['isLogin']) && $value['delete']['isLogin']) echo "checked" ?>>
                        <?php }
                        else{
                          echo "-";
                        }
                         ?>
                         </td>
                              </tr>
                      <?php };?>


           
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="?controller=group&type=admin&action=index" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>