<?php 
require_once("db_connect/dbconnect.php");
$dbConnect = new dbConnect();
error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ThyssenKrupp Engine Components India. Pvt. Ltd.</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include("links.php") ?>
</head>
<?php 
session_start();
$user = $_SESSION['username'];
$userID = $_SESSION['userid'];
if(!empty($user)) {

    $querymfg = "SELECT * FROM manufacturer WHERE status = '1'";  
    $resultmfg = $dbConnect->NoOfRecords($querymfg);

    $querymodel = "SELECT * FROM car_model WHERE status = '1'";  
    $resultmodel = $dbConnect->NoOfRecords($querymodel);

?>

<body class="hold-transition skin-blue fixed sidebar-mini" onunload="ajaxFunction()">
<div class="wrapper">
<?php include("header.php"); ?>
<?php 
 include("nav_bar.php"); ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <!-- <small>Version 2.0</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content" >
   
 <div class="row"S >
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $resultmfg;?></h3>

              <p>Total Car Manufacturers</p>
            </div>
            <div class="icon">
              <i class="fa fa-cogs"></i>
            </div>
            <a href="add_manufacturer.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $resultmodel;?></h3>

              <p>Total Car Models</p>
            </div>
            <div class="icon">
              <i class="fa fa-cogs"></i>
            </div>
            <a href="add_model.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $resultmodel;?></h3>

              <p>Total Inventory Records</p>
            </div>
            <div class="icon">
              <i class="fa fa-cogs"></i>
            </div>
            <a href="view_inventory.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
     
</section>
   <!--  <br>
      <br>
      <div class="row" align="center">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
            <a href="">
            <div class="info-box-content">
              <span class="info-box-text">Services</span>
               <span class="info-box-number">00</span> 
            </div></a>
          </div>
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user-o"></i></span>
            <a href="">
            <div class="info-box-content">
              <span class="info-box-text">Customers</span>
              <span class="info-box-number">00</span>
            </div></a>
          </div>
        </div>
        <div class="clearfix visible-sm-block"></div>
      </div>
      <div class="row">
      </div>
    </section> -->

<!-- <section class="content">
      <div class="row" align="center">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
            <a href="">
            <div class="info-box-content">
              <span class="info-box-text">Employees</span>
               <span class="info-box-number">00</span> 
            </div></a>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
            <a href="#">
            <div class="info-box-content">
              <span class="info-box-text">Todays Schedule</span>
              <span class="info-box-number">00</span>
            </div></a>
            </div>
          </div>
        <div class="clearfix visible-sm-block"></div>
      </div>
      <div class="row">
      </div>
    </section> -->


    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
<?php include("footer.php") ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->
</body>
<?php }
else{
header('Location: index.php');
  }
   ?>
  </html>

