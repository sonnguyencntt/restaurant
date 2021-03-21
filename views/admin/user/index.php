<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12 col-xs-12">
    <div id="messages">
      </div>
      <button class="btn btn-primary <?= $access['insert'] ?>" data-toggle="modal"  data-target="#addModal">Add User</button>
      <br /> <br />


      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Manage Users</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="userTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th></th>
                <th>Id User</th>
                <th>Username</th>
                <th>Email</th>
                <th>Frist Name</th>
                <th>Last Name</th>

                <th>Phone</th>
                <th>Gender</th>
                <th>Group</th>

                <th class="<?= $access['td_action'] ?>">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($data as $key => $value) {
              ?>
                <tr role="row" class="odd">
                  <td></td>
                  <td><?= $value->id_user ?></td>

                  <td><?= $value->username ?></td>
                  <td><?= $value->email ?></td>
                  <td><?= $value->fristname ?></td>
                  <td><?= $value->lastname ?></td>
                  <td><?= $value->phone ?></td>
                  <td><?= $value->gender ?></td>
                  <td><?= $value->table_group->id ?></td>



                  <td class="<?= $access['td_action'] ?>"><button type="button" class="btn btn-default <?= $access['update'] ?>" onclick="editFunc(<?php echo '\'' . $value->id_user . '\'' ?>, this)" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-default <?= $access['delete'] ?>" onclick="removeFunc(<?php echo '\'' . $value->id_user . '\'' ?>, this)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button></td>

                </tr>

              <?php }; ?>
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

        <div class="modal-body" style="overflow-y: scroll;
    max-height: 560px;">

          <div class="form-group">
            <label for="groups">Groups</label>
            <select class="form-control" id="groups" name="groups">
            <option value="">Select Groups</option>
              <option value="1">Super Admin</option>

              <option value="2">Staff</option>
              <option value="3">Members</option>
            </select>
            <p id="err_groups" class="hide-elm text-danger">The Store name field is required.</p>

          </div>

          <div class="form-group">
            <label for="groups">Store</label>
            <select class="form-control" id="store" name="store">
              <option value="">Select store</option>
              <option value="2">MVP</option>

            </select>
            <p id="err_store" class="hide-elm text-danger">The Store name field is required.</p>

          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off">
            <p id="err_username" class="hide-elm text-danger">The Store name field is required.</p>

          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
            <p id="err_email" class="hide-elm text-danger">The Store name field is required.</p>

          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
            <p id="err_password" class="hide-elm text-danger">The Store name field is required.</p>

          </div>

          <div class="form-group">
            <label for="cpassword">Confirm password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
            <p id="err_cpassword" class="hide-elm text-danger">The Store name field is required.</p>

          </div>

          <div class="form-group">
            <label for="fname">First name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" autocomplete="off">
            <p id="err_fname" class="hide-elm text-danger">The Store name field is required.</p>

          </div>

          <div class="form-group">
            <label for="lname">Last name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" autocomplete="off">
            <p id="err_lname" class="hide-elm text-danger">The Store name field is required.</p>

          </div>

          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" autocomplete="off">
            <p id="err_phone" class="hide-elm text-danger">The Store name field is required.</p>

          </div>

          <div class="form-group">
            <label for="gender">Gender</label>
            <div class="radio">
              <label>
                <input type="radio" name="gender" class="male" id="male" value="1">
                Male
              </label>
              <label>
                <input type="radio" name="gender" class="male" id="female" value="2">
                Female
              </label>
            </div>
            <p id="err_male" class="hide-elm text-danger">The Store name field is required.</p>


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
        <div class="modal-body"  style="overflow-y: scroll;
    max-height: 560px;">
          <div id="messages"></div>
          <input type="hidden" id="edit_id_user" name="edit_id_user">
          <div class="form-group">
            <label for="groups">Groups</label>
            <select class="form-control" id="edit_groups" name="edit_groups">
              <option value="">Select Groups</option>
              <option value="1">Super Admin</option>

              <option value="2">Staff</option>
              <option value="3">Members</option>
            </select>
            <p id="err_edit_groups" class="hide-elm text-danger">The Store name field is required.</p>
            <div class="loader hide-elm" id="loader"></div>

          </div>

          <div class="form-group">
            <label for="groups">Store</label>
            <select class="form-control" id="edit_store" name="edit_store">
              <option value="">Select store</option>
              <option value="2">MVP</option>

            </select>
            <p id="err_edit_store" class="hide-elm text-danger">The Store name field is required.</p>
            <div class="loader hide-elm" id="loader"></div>

          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="edit_username" name="edit_username" placeholder="Username" autocomplete="off">
            <p id="err_edit_username" class="hide-elm text-danger">The Store name field is required.</p>
            <div class="loader hide-elm" id="loader"></div>

          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="edit_email" name="edit_email" placeholder="Email" autocomplete="off">
            <p id="err_edit_email" class="hide-elm text-danger">The Store name field is required.</p>
            <div class="loader hide-elm" id="loader"></div>

          </div>


          <div class="form-group">
            <label for="fname">First name</label>
            <input type="text" class="form-control" id="edit_fname" name="edit_fname" placeholder="First name" autocomplete="off">
            <p id="err_edit_fname" class="hide-elm text-danger">The Store name field is required.</p>
            <div class="loader hide-elm" id="loader"></div>

          </div>

          <div class="form-group">
            <label for="lname">Last name</label>
            <input type="text" class="form-control" id="edit_lname" name="edit_lname" placeholder="Last name" autocomplete="off">
            <p id="err_edit_lname" class="hide-elm text-danger">The Store name field is required.</p>
            <div class="loader hide-elm" id="loader"></div>

          </div>

          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="edit_phone" name="edit_phone" placeholder="Phone" autocomplete="off">
            <p id="err_edit_phone" class="hide-elm text-danger">The Store name field is required.</p>
            <div class="loader hide-elm" id="loader"></div>

          </div>
          <div class="form-group">
                  <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                      Leave the password field empty if you don't want to change.
                  </div>
                </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="edit_password" name="edit_password" placeholder="Password" autocomplete="off">
            <p id="err_edit_password" class="hide-elm text-danger">The Store name field is required.</p>
            <div class="loader hide-elm" id="loader"></div>

          </div>
          
          <div class="form-group">
            <label for="cpassword">Confirm password</label>
            <input type="password" class="form-control" id="edit_cpassword" name="edit_cpassword" placeholder="Confirm Password" autocomplete="off">
            <p id="err_edit_cpassword" class="hide-elm text-danger">The Store name field is required.</p>
            <div class="loader hide-elm" id="loader"></div>

          </div>

          <div class="form-group">
            <label for="gender">Gender</label>
            <div class="radio" id = "edit_radio">
              <label>
                <input type="radio" name="edit_gender" class="edit_male" id="edit_male" value="1">
                Male
              </label>
              <label>
                <input type="radio" name="edit_gender" class="edit_male" id="edit_female" value="2">
                Female
              </label>
            </div>
            <p id="err_edit_male" class="hide-elm text-danger">The Store name field is required.</p>
            <div class="loader hide-elm" id="loader"></div>


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
          <input type="hidden" name="remove_id_user">
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
<script src="assets/admin/dist/js/user.js"></script>