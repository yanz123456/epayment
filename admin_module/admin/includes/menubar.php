<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../../images/'.$user['photo'] : '../../images/logo_pnu-01.png'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Admin</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MANAGE</li>
        <li class=""><a href="home.php"><i class="fa fa-circle-o"></i> <span>Transactions</span></a></li>
        <li class=""><a href="offices.php"><i class="fa fa-circle-o"></i> <span>Offices</span></a></li>
        <li class=""><a href="transaction_management.php"><i class="fa fa-circle-o"></i> <span>Transactions Management</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>