<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12 col-xs-12">

            <div id="messages"></div>


            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">UPDATE USER</h3>
                </div>
                <form role="form" action="?controller=user&action=update&type=admin" onsubmit="return validate_update();" method="post" enctype="multipart/form-data">
                <input type="hidden" name="edit_id_user" value="<?= $data[0]->id_user ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Image Preview: </label>
                            <img src="<?= $data[0]->image ?>" width="150" height="150" class="img-circle">
                        </div>

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
                            <select class="form-control" id="edit_groups" name="edit_groups">
                                <option value="">Select Groups</option>

                                <?php
                                if (count($list_group) > 0) {
                                    foreach ($list_group as $key => $value) {
                                ?>
                                        <option value="<?= $value->id ?>"
                                        <?php
                                        if((int)$value->id ===(int)$data[0]->table_group->id){
                                            echo "selected";
                                        }
                                         ?>
                                        ><?= $value->group_name ?></option>

                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <p id="err_edit_groups" class="hide-elm text-danger">The Store name field is required.</p>
                            <div class="loader hide-elm" id="loader"></div>

                        </div>
                           
                        <div class="form-group">
                            <label for="groups">Store</label>
                            <select class="form-control" id="edit_store" name="edit_store">
                                <option value="">Select store</option>
                                <?php
                                if (count($list_store) > 0) {
                                    foreach ($list_store as $key => $value) {
                                ?>
                                        <option value="<?= $value->id ?>" 
                                        <?php
                                        if((int)$value->id ===(int)$data[0]->store){
                                            echo "selected";
                                        }
                                         ?>
                                        ><?= $value->name ?></option>

                                <?php
                                    }
                                }
                                ?>

                            </select>
                            <p id="err_edit_store" class="hide-elm text-danger">The Store name field is required.</p>
                            <div class="loader hide-elm" id="loader"></div>

                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="edit_username" name="edit_username" placeholder="Username" value="<?= $data[0]->username ?>" autocomplete="off">
                            <p id="err_edit_username" class="hide-elm text-danger">The Store name field is required.</p>
                            <div class="loader hide-elm" id="loader"></div>

                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="edit_email" name="edit_email" placeholder="Email" value="<?= $data[0]->email ?>" autocomplete="off">
                            <p id="err_edit_email" class="hide-elm text-danger">The Store name field is required.</p>
                            <div class="loader hide-elm" id="loader"></div>

                        </div>


                        <div class="form-group">
                            <label for="fname">First name</label>
                            <input type="text" class="form-control" id="edit_fname" name="edit_fname" placeholder="First name" value="<?= $data[0]->fristname ?>" autocomplete="off">
                            <p id="err_edit_fname" class="hide-elm text-danger">The Store name field is required.</p>
                            <div class="loader hide-elm" id="loader"></div>

                        </div>

                        <div class="form-group">
                            <label for="lname">Last name</label>
                            <input type="text" class="form-control" id="edit_lname" name="edit_lname" placeholder="Last name" value="<?= $data[0]->lastname ?>" autocomplete="off">
                            <p id="err_edit_lname" class="hide-elm text-danger">The Store name field is required.</p>
                            <div class="loader hide-elm" id="loader"></div>

                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="edit_phone" value="<?= $data[0]->phone ?>" name="edit_phone" placeholder="Phone" autocomplete="off">
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
                            <div class="radio" id="edit_radio">
                                <label>
                                    <input type="radio" name="edit_gender" class="edit_male" id="edit_male" <?php if ($data[0]->gender == 1) echo "checked" ?> value="1">
                                    Male
                                </label>
                                <label>
                                    <input type="radio" name="edit_gender" class="edit_male" id="edit_female" <?php if ($data[0]->gender == 2) echo "checked" ?> value="2">
                                    Female
                                </label>
                            </div>
                            <p id="err_edit_male" class="hide-elm text-danger">The Store name field is required.</p>
                            <div class="loader hide-elm" id="loader"></div>


                        </div>
                    </div>
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
<script src="assets/admin/dist/js/user.js?ver=02"></script>