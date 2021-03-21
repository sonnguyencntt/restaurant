<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Users</title>
  <base href="http://localhost/My_Project/" >
    <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/admin/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="assets/admin/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="assets/admin/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="assets/admin/bower_components/select2/select2.full.min.css">
  <link rel="stylesheet" href="assets/admin/plugins/fileinput/fileinput.min.css">
  <script src="assets/admin/bower_components/jquery/dist/jquery.min.js"></script>

  <script src="assets/admin/bower_components/select2/select2.full.min.js"></script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <!-- jQuery UI 1.11.4 -->

  <!-- Bootstrap 3.3.7 -->
  <script src="assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="assets/admin/bower_components/chart/chart.js"></script>
  <script src="http://localhost/restaurant/assets/plugins/fileinput/fileinput.min.js"></script>

  <!-- Morris.js charts -->
  <!-- AdminLTE App -->
  <script src="assets/admin/dist/js/adminlte.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="assets/admin/dist/js/demo.js"></script>



  <!-- DataTables -->
  <script src="assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="assets/admin/dist/js/function.js"></script>




</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include('header.php') ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php
    if(isset($error_404))
    include('sidebar_error.php');
    else
    include('sidebar.php');

     ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Manage
          <small><?= $title_content ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Stores</li>
        </ol>
      </section>

      <!-- Main content -->

      <?= $content; ?>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- create brand modal -->

    <?php include('footer.php')?>
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
</body>
<script  src="assets/admin/dist/js/callajax.js"></script>

<script  src="assets/admin/dist/js/chart.js"></script>


</html>