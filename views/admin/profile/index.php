<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Profile XXX</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-condensed table-hovered">
                <tr>
                  <th>Username</th>
                  <td><?= $data[0]->username ?></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><?= $data[0]->email ?></td>
                </tr>
                <tr>
                  <th>First Name</th>
                  <td><?= $data[0]->fristname ?></td>
                </tr>
                <tr>
                  <th>Last Name</th>
                  <td><?= $data[0]->lastname ?></td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td><?php if($data[0]->gender == 1) echo "Male"; else echo "Female"; ?></td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td><?= $data[0]->phone ?></td>
                </tr>
                <tr>
                  <th>Group</th>
                  <td><span class="label label-info"><?= $data[0]->table_group->group_name ?></span></td>
                </tr>
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