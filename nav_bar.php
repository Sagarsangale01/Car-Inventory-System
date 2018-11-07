<?php

$currentPage = basename( $_SERVER[ 'REQUEST_URI' ] );
// echo "$currentPage"."<br>";
$cpage = explode( '?', $currentPage );
$name2 = $cpage[ 0 ];
//echo $name2 . "<br>";
//$role = $_SESSION['role'];
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="dist/img/user2-160x160.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>
					<?php echo  $user; ?>
				</p>
				<!-- <small>
					<?php //echo $res['designation']; ?>
				</small> -->
			</div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<!-- <li class="header">MAIN NAVIGATION</li> -->
			<?php //if ($userID !== 0)  {  ?>
			<li <?php if ($name2=='dashboard.php' ) { ?> class="active"
				<?php }?>>
				<a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </li>

        <?php //}
        // if ($userID !== 0)  {  ?>
	
<!-- -----------------------------------add_manufacturer Menu------------------------------------- -->
        	<li <?php if ($name2=='add_manufacturer.php') { ?> class="treeview active"
				<?php } else { ?> class="treeview"
				<?php }?>>
				<a href="#">
            <i class="fa fa-hdd-o"></i>
            <span>Manufacturers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
			
				<ul class="treeview-menu">
					<li <?php if ($name2=='add_manufacturer.php'){ ?> class="active"
						<?php }?>><a href="add_manufacturer.php"><i class="fa fa-edit"></i> Add Manufacturers</a>
					</li>
				
				</ul>
			</li>

<!-- ---------------------------------Model------------------------------------------------------ -->
<li <?php if ($name2=='add_model.php' ) { ?> class="treeview active"
				<?php } else { ?> class="treeview"
				<?php }?>>
				<a href="#">
            <i class="fa fa-hdd-o"></i>
            <span>Car Models</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
			
				<ul class="treeview-menu">
					<li <?php if ($name2=='add_model.php'){ ?> class="active"
						<?php }?>><a href="add_model.php"><i class="fa fa-edit"></i> Add Models</a>
					</li>
				
				</ul>
			</li>

<!-- ----------------------------------Inventory------------------------------------------------------- -->
<li <?php if ($name2=='view_inventory.php') { ?> class="treeview active"
				<?php } else { ?> class="treeview"
				<?php }?>>
				<a href="#">
            <i class="fa fa-hdd-o"></i>
            <span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
			
				<ul class="treeview-menu">
					<li <?php if ($name2=='view_inventory.php'){ ?> class="active"
						<?php }?>><a href="view_inventory.php"><i class="fa fa-edit"></i> View Inventory</a>
					</li>
				
				</ul>
			</li>

	</section>
	<!-- /.sidebar -->
</aside>