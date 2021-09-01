<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($client['photo'])) ? '../../images/'.$client['photo'] : '../../images/logo_pnu-01.png'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $client['lastname'].' '.$client['firstname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Client</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MANAGE</li>
        <li class=""><a href="home.php"><i class="fa fa-circle-o"></i> <span>Pending Transactions</span></a></li>
        <li class=""><a href="accepted_transaction.php"><i class="fa fa-circle-o"></i> <span>Accepted Transactions</span></a></li>
        <li class=""><a href="declined_transaction.php"><i class="fa fa-circle-o"></i> <span>Declined Transactions</span></a></li>
        <!-- <li class=""><a href="index2.php"><i class="fa fa-circle-o"></i> <span>Transactions With Balance</span></a></li>
        <li class=""><a href="index3.php"><i class="fa fa-circle-o"></i> <span>Complete Transactions</span></a></li> -->
        <li class=""><a href="../../index.php"><i class="fa fa-circle-o"></i> <span>Back to Home Screen</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>