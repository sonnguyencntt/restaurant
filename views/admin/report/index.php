<?php
//  var_dump($resultForDataFromYear);
?>
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

        <div class="col-md-12 col-xs-12">
            <form class="form-inline" action="http://localhost/restaurant/reports/storewise" method="POST">
                <div class="form-group">
                    <label for="date">Year</label>
                    <select class="form-control" name="select_year" id="select_year">
                    <option value="">Select year</option>
                    <?php
                        if(count($resultForDateTime) <= 0)
                        echo '<option value="" disabled>Không có dữ liệu</option>';
                        else
                        {
                            foreach($resultForDateTime as $key => $value){
                        ?>
                        <option value="<?= $value ?>" <?php if($key == 0) echo "selected" ?>><?= $value?></option>
                        <?php }} ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Store</label>
                    <select class="form-control" name="select_store" id="select_store">

                        <option value="">Select store</option>
                        <?php
                         if(count($resultForSelectStore) <= 0)
                         echo '<option value="" disabled>Không có dữ liệu</option>';
                         else{
                            foreach($resultForSelectStore as $key => $value){
                        ?>
                        <option value="<?= $value->store->id_store ?>" <?php if($key == 0) echo "selected" ?>><?= $value->store->name ?></option>
                        <?php }} ?>
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
                                <?php 
                                $total = 0;
                                foreach($resultForDataFromYear as $value){
                                    $total +=  $value['sum'];
                                ?>
                            <tr>
                                <td><?= $value['date_time'] ?> </td>
                                <td> <?= number_format($value['sum'], 0, ',', '.') ?> VNĐ</td>
                            </tr>
                            <?php }?>
                           

                        </tbody>
                        <tbody>
                            <tr>
                                <th>Total Amount</th>
                                <th>
                                    <?= number_format($total, 0, ',', '.') ?> VNĐ</th>
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
<script src="assets/admin/dist/js/user.js"></script>
<script src="assets/admin/dist/js/report.js"></script>



<script>
    $(document).ready(function() {
        chartData(<?php echo "JSON.parse('" . json_encode($resultForChart) . "')" ?>);
    })
</script>