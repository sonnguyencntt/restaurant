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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Update Information</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="?controller=setting&action=update&type=admin" method="POST" onsubmit = "return validate();">
              <div class="box-body">

                
              <input type=hidden class="form-control" id="id_user" name="id_user" placeholder="Username" value="<?= $data[0]->id_user ?>" autocomplete="off">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $data[0]->username ?>" autocomplete="off">
                  <p id="err_username" class="hide-elm text-danger">The Store name field is required.</p>

                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $data[0]->email ?>" autocomplete="off">
                  <p id="err_email" class="hide-elm text-danger">The Store name field is required.</p>

                </div>                

                <div class="form-group">
                  <label for="fname">First name</label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?= $data[0]->fristname ?>" autocomplete="off">
                  <p id="err_fname" class="hide-elm text-danger">The Store name field is required.</p>

                </div>

                <div class="form-group">
                  <label for="lname">Last name</label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?= $data[0]->lastname ?>" autocomplete="off">
                  <p id="err_lname" class="hide-elm text-danger">The Store name field is required.</p>

                </div>

                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?= $data[0]->phone ?>" autocomplete="off">
                  <p id="err_phone" class="hide-elm text-danger">The Store name field is required.</p>

                </div>

                <div class="form-group">
                  <label for="gender">Gender</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" class="male" id="male" value="1" <?php if($data[0]->gender == 1) echo "checked" ?>>
                      Male
                    </label>
                    <label>
                      <input type="radio" name="gender" class="male" id="female" value="2" <?php if($data[0]->gender == 2) echo "checked" ?>>
                      Female
                    </label>
                  </div>
                  <p id="err_male" class="hide-elm text-danger">The Store name field is required.</p>

                </div>

                <div class="form-group">
                  <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      Leave the password field empty if you don't want to change.
                  </div>

                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="setting_password" name="password" placeholder="Password" autocomplete="off">
                  <p id="err_setting_password" class="hide-elm text-danger">The Store name field is required.</p>

                </div>

                <div class="form-group">
                  <label for="cpassword">Confirm password</label>
                  <input type="password" class="form-control" id="setting_cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
                  <p id="err_setiing_cpassword" class="hide-elm text-danger">The Store name field is required.</p>

                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary <?= $access['update'] ?>">Save Changes</button>
                <a href="?controller=profile&action=index&type=admin" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
       
      </div>
      <!-- /.row -->
      

    </section>
    <script src="assets/admin/dist/js/profile.js"></script>