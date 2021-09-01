<?php

  $office_id = $_SESSION['office_id'];
  $sql = "SELECT COUNT(a.transaction_id) as pending_cnt FROM tbl_requests a LEFT JOIN tbl_offices b ON a.transaction_office_id = b.id WHERE b.id = '$office_id' AND a.remarks = 'Pending' ORDER BY a.transaction_date ASC";
  $query = $conn->query($sql);
  $row = $query->fetch_assoc();
  $pending_cnt = $row["pending_cnt"];
?>

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
          <a><i class="fa fa-circle text-success"></i> Office</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MANAGE</li>
        <li class="">
          <a href="office_module.php">
            <i class="fa fa-circle-o"></i>
            <span>Transaction Requests</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red"><?php echo $pending_cnt; ?></small>
            </span>
          </a>
        </li>
        <li class=""><a href="office_accepted_transactions.php"><i class="fa fa-circle-o"></i> <span>Accepted Transactions</span></a></li>
        <li class=""><a href="office_declined_transactions.php"><i class="fa fa-circle-o"></i> <span>Declined Transactions</span></a></li>
        <!--<li class=""><a href="office_completed_transactions.php"><i class="fa fa-circle-o"></i> <span>Transactions Table</span></a></li>-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>