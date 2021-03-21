<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12 col-xs-12">

      <div id="messages"></div>



      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?php if (isset($title)) echo "UPDATE PRODUCT";
                                else echo "ADD PRODUCT" ?></h3>
        </div>
        <form role="form" action="<?php if (isset($action)) echo "?controller=category&action=update&type=admin";
                                  else echo "?controller=category&action=insert&type=admin" ?>" onsubmit="return validate();" method="post" enctype="multipart/form-data">
                                
          <div class="box-body">
          <input type="hidden" value="<?php if(isset($action)) echo $data[0]->id ?>" class="form-control" id="id" name="id" placeholder="Enter group name" autocomplete="off" required>

            <?php
            if (isset($action)) {
            ?>
              <div class="form-group">
                <label>Image Preview: </label>
                <img src="<?= $data[0]->image ?>" width="150" height="150" class="img-circle" >
              </div>
            <?php } ?>
            <div class="form-group">

              <label for="product_image">Image</label>
              <div class="kv-avatar">
                <div class="file-loading">
                  <input id="product_image" name="product_image" type="file" <?php if(isset($action)) echo "title = 'das'" ?>>

                </div>
              </div>
              <p id="err_product_image" class="hide-elm text-danger">The Store name field is required.</p>

            </div>

            <div class="form-group">
              <label for="product_name">Product name</label>
              <input type="text" class="form-control" id="product_name" value="<?php if (isset($action)) echo $data[0]->name ?>" name="product_name" placeholder="Enter product name" autocomplete="off" value="" />
              <p id="err_product_name" class="hide-elm text-danger">The Store name field is required.</p>

            </div>

            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" class="form-control" id="price" value="<?php if (isset($action)) echo $data[0]->price ?>" name="price" placeholder="Enter price" autocomplete="off" value="" />
              <p id="err_price" class="hide-elm text-danger">The Store name field is required.</p>

            </div>

            <div class="form-group">
              <label for="description">Description</label>
              <textarea type="text" class="form-control" id="description"   name="description" placeholder="Enter 
                  description" autocomplete="off"><?php if (isset($action)) echo $data[0]->description ?></textarea>

            </div>

            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control select_group" id="category"  name="category" multiple="multiple">
                <option value="1" <?php  if (isset($action) and $data[0]->category_id == "1")echo "selected"?>>1</option>
                <option value="2" <?php  if (isset($action) and $data[0]->category_id == "2")echo "selected"?>>2</option>

              </select>
              <p id="err_category" class="hide-elm text-danger">The Store name field is required.</p>

            </div>

            <div class="form-group">
              <label for="store">Store</label>
              <select class="form-control select_group" id="store"  name="store" multiple="multiple">
                <option value="1" <?php  if (isset($action) and $data[0]->store_id == "1") echo "selected" ?>>1</option>
                <option value="2" <?php if (isset($action) and $data[0]->store_id == "2") echo "selected" ?>>2</option>
              </select>
              <p id="err_store" class="hide-elm text-danger">The Store name field is required.</p>

            </div>

            <div class="form-group">
              <label for="store">Active</label>
              <select class="form-control" id="active" name="active" value="<?php $data[0]->active ?>" >
                <option value="1">Yes</option>
                <option value="2">No</option>
              </select>
              <p id="err_active" class="hide-elm text-danger">The Store name field is required.</p>

            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="?controller=category&action=index&type=admin" class="btn btn-warning">Back</a>
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
<script src="assets/admin/dist/js/product.js"></script>