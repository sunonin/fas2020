<?php 
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['complete_name'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}

        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .   $_SERVER['REQUEST_URI']; 
        function getDivision()
        {
        include 'connection.php';
        $sqlUsername = mysqli_query($conn,"SELECT * FROM tblpersonneldivision where DIVISION_N =".$_SESSION['division']."");
        $row = mysqli_fetch_array($sqlUsername);
        echo  $row['DIVISION_M']; 
        }
        ?>

    </style>
    <style>
  th{
    color:blue;
  }
  
  </style>
<body class=" hold-transition skin-red-light sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="home.php?division=<?php echo $_SESSION['division'];?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src = "images/logo.png"/></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><img src = "images/logo1.png"/></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <img src="dilg.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['complete_name'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dilg.png" class="img-circle" alt="User Image">

                <p><b>
                <?php echo $_SESSION['complete_name'];?></b>
                  <small><?php echo getDivision();?></small>
                </p>
              </li>
             
              <li class="user-footer">
                <div class="pull-left">
                  <a href="UpdateAccount.php?id=<?php echo  $_SESSION['currentuser'];?>&username=<?php echo  $_SESSION['username'];?>" class="btn btn-default btn-flat"><i class = "fa fa-cogs"></i>Profile</a>
                </div>
                <div class="pull-right">
                  <a href="index.php" class="btn btn-default btn-flat"><i class = "fa fa-sign-out"></i> Log out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar"  style = "background-color:#f6cdd0;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dilg.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['username'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li <?php if($link == 'http://fas.calabarzon.dilg.gov.ph/home.php?division='.$_SESSION['division'].''){ echo 'class = "active"';}?>>
          <a href="home1.php?division=<?php echo $_GET['division']; ?>" >
            <i class="fa fa-dashboard" style = "color:#black;"></i> <span style = "color:#black;font-weight:normal;">Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
       
      </li>
      
        <li  <?php 
              if( $link == 'http://fas.calabarzon.dilg.gov.ph/ViewPR1.php'.$_GET['division'].'' )
                {
                   echo 'active';
                }
              ?>
              ">
              <a  href="ViewPr1.php?division=<?php echo $_SESSION['division'];?>">
              <i class="fa fa-cart-arrow-down " style = "color:#black;"></i>
                <span  style = "color:#black;font-weight:normal;">Procurement</span>
                <span class="pull-right-container"></span>
              </a>
        </li>
     
        <li class="treeview">
          <a href="#" <?php if($link == 'http://localhost/fas/ViewDV.php' || $link == 'http://localhost/fas/ViewBURS.php?division='.$_SESSION['division'].''){ echo 'class = "active"';}?>  >
          <i class="fa fa-money"></i>
          <span  style = "color:#black;font-weight:normal;">Financial</span>

            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
          <li><a href="ViewBURS.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> ORS/BURS</a></li>
        <li><a href="ViewDV.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> DV</a></li>
          </ul>
        </li>
          
        <li class="treeview
        <?PHP 
        if(
          $link == 'http://fas.calabarzon.dilg.gov.ph/requestForm.php?division='.$_GET['division'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/techassistance.php?division='.$_GET['division'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/allTickets.php?division='.$_GET['division'].'&ticket_id=' 
        ){
          echo 'active';
        }
        ?>"
        >
            <a href="" >
                <i class="fa fa-users" style = "color:#black;"></i>
                <span  style = "color:#black;font-weight:normal;">ICT Technical Assistance</span>
                <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="requestForm.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>Create Request</a>
             
              <li>
              <a href="techassistance.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>Monitoring 
              <span>
              <small class="label  bg-blue" id = "ta_request"></small>
            </span></a>
            </ul>
        </li>
      
        <li class="treeview <?PHP 
        if(
          $link == 'http://fas.calabarzon.dilg.gov.ph/Accounts.php' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/_editRequestTA.php?division='.$_GET['division'].'&id='.$_GET['id'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/Approval.php' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/UpdateAccount.php?id='.$_GET['id'].'&username='.$_SESSION['username'].'' 
          
        ){
          echo 'active';
        }
        ?>" tyle="background-color: lightgray;">
          <a href="" >
            <i class="fa fa-cogs" style = "color:#black;"></i>
            <span  style = "color:#black;font-weight:normal;">Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a  href="Accounts.php"><i class = "fa fa-fw fa-user-md" style = "color:#black;"></i>User Management</li>
            <li><a  href="Approval.php"><i class = "fa fa-fw fa-check-square-o" style = "color:#black;"></i>For Approval</li>

          </ul>
      
        </li>
        <li>
            <a href="index.php">
              <i class="fa fa-sign-out " style = "color:#black;"></i> 
              <span  style = "color:#black;font-weight:normal;">Log out</span>
            </a>
        </li>        
        
       

    </section>
    <!-- /.sidebar -->
  </aside>
  
<script>
  setInterval(function(){
$('#ta_request').load('_countTA.php');
$('#on_going').load('_countOngoing.php');
}, 1000); /* time in milliseconds (ie 2 se  conds)*/
  </script>