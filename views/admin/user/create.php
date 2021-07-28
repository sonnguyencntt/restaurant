<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12 col-xs-12">

      <div id="messages"></div>


      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?php if (isset($title)) echo "UPDATE USER";
                                else echo "ADD USER" ?></h3>
        </div>
        <form role="form" action="<?php if (isset($action)) echo "?controller=user&action=update&type=admin";
                                  else echo "?controller=user&action=insert&type=admin" ?>" onsubmit="return validate();" method="post" enctype="multipart/form-data">

          <div class="box-body">
            <input type="hidden" value="<?php if (isset($action)) echo $data[0]->id ?>" class="form-control" id="id" name="id" placeholder="Enter group name" autocomplete="off" required>

            <?php
            if (isset($action)) {
            ?>
              <div class="form-group">
                <label>Image Preview: </label>
                <img src="<?= $data[0]->image ?>" width="150" height="150" class="img-circle">
              </div>
            <?php } ?>
            <div class="form-group">

              <label for="product_image">Image</label>
              <div class="kv-avatar">
                <div class="file-loading">
                  <input id="product_image" name="product_image" type="file" <?php if (isset($action)) echo "title = 'das'" ?>>

                </div>
              </div>
              <p id="err_product_image" class="hide-elm text-danger">The Store name field is required.</p>

            </div>
            <div class="form-group">
              <label for="groups">Groups</label>
              <select class="form-control" id="groups" name="groups">
                <option value="">Select Groups</option>

                <?php
                if (count($list_group) > 0) {
                  foreach ($list_group as $key => $value) {
                ?>
                    <option value="<?= $value->id ?>"><?= $value->group_name ?></option>

                <?php
                  }
                }
                ?>
              </select>
              <p id="err_groups" class="hide-elm text-danger">The Store name field is required.</p>

            </div>

            <div class="form-group">
              <label for="groups">Store</label>
              <select class="form-control" id="store" name="store">
                <option value="">Select store</option>
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
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="?controller=user&action=index&type=admin" class="btn btn-warning">Back</a>
          </div>
        </form>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- col-md-12 -->
  </div>
  <!-- /.row -->


</section>
<script src="assets/admin/dist/js/user.js?ver=01"></script>