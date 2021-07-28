
<header class="main-header">
  <!-- Logo -->
  <a href="/" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">  <img style="width:45px" src="/assets/image/admin.png" alt="">
    </span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"> <img style="width: 37px;
      padding: 0px !important;
  " src="/assets/image/admin.png" alt=""><b style="vertical-align: middle">DMIN</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
      
        <!-- Notifications: style can be found in dropdown.less -->
     
        <!-- Tasks: style can be found in dropdown.less -->
       <li class="dropdown tasks-menu">
        <!-- <div class="lang-menu">
          <div class="selected-lang vn">
            
          </div>
          <ul>
              <li>
                  <a href="#" class="vn">Tiếng Việt</a>
              </li>
              <li>
                  <a href="" class="en">English</a>
              </li>
           
          </ul>
          
      </div> -->
        </li> 
        <!-- User Account: style can be found in dropdown.less -->
        <?php
        if(isset($_SESSION['user']))
        ?>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 10px !important">
            <img style="width: 36px !important ; height : 36px !important" src="<?= json_decode($_SESSION['user'], true)[0]['image'] ?>" class="user-image" alt="User Image">
            <span class="hidden-xs">Xin chào <b><?= json_decode($_SESSION['user'], true)[0]['lastname'] ?></b></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?= json_decode($_SESSION['user'], true)[0]['image'] ?>" class="img-circle" alt="User Image">

              <p>
              <?= json_decode($_SESSION['user'], true)[0]['email'] ?>
              </p>
            </li>
            <!-- Menu Body -->
          
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="?controller=setting&action=index&type=admin" class="btn btn-default btn-flat">Thông tin </a>
              </div>
              <div class="pull-right">
                <a href="?controller=auth&type=admin&action=logout" class="btn btn-default btn-flat">Đăng xuất</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
       
      </ul>
    </div>
  </nav>
</header>