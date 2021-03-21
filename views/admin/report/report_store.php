<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-md-12 col-xs-12">
          <form class="form-inline" action="http://localhost/restaurant/reports/storewise" method="POST">
            <div class="form-group">
              <label for="date">Year</label>
              <select class="form-control" name="select_year" id="select_year">
                              </select>
            </div>
            <div class="form-group">
              <label for="date">Store</label>
              <select class="form-control" name="select_store" id="select_store">
                <option value="">Select store</option>
                                  <option value="7" selected="selected">n</option>
                                  <option value="6" >j</option>
                                  <option value="5" >2</option>
                                  <option value="4" >21</option>
                                  <option value="3" >s</option>
                                  <option value="2" >nb</option>
                                  <option value="1" >n</option>
                              </select>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>

        <br /> <br />


        <div class="col-md-12 col-xs-12">

          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total Paid Orders - Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total Paid Orders - Report Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Month - Year</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>

                                      <tr>
                      <td>2021-01</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-02</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-03</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-04</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-05</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-06</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-07</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-08</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-09</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-10</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-11</td>
                      <td>&#36; 0</td>
                    </tr>
                                      <tr>
                      <td>2021-12</td>
                      <td>&#36; 0</td>
                    </tr>
                                    
                </tbody>
                <tbody>
                  <tr>
                    <th>Total Amount</th>
                    <th>
                      &#36; 0                                          </th>
                  </tr>
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