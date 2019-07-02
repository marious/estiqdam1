<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Safety</b> Point</span>
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
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= site_url('assets/admin/img/user.png') ?>" class="img-circle" alt="User Image" width="40" height="30">

                <span class="hidden-xs"><?= $_SESSION['username'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">

                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php if (get_current_front_lang() == 'ar') {echo site_url('dashboard/lang/en'); } else {
                      echo site_url('dashboard/lang/ar');
                  } ?>" class="btn btn-default btn-flat"><?php echo get_current_front_lang() == 'ar' ? 'en' : 'ar';  ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?= site_url('auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>