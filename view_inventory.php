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
	</script>
	<title>Technical Task</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php include("links.php") ?>
	 <script src="ckeditor/ckeditor.js"></script>
   <script type="text/javascript" src="js/jquery.js"></script>
	<style>
		.color-palette {
			height: 35px;
			line-height: 35px;
			text-align: center;
		}
		
		.color-palette-set {
			margin-bottom: 15px;
		}
		
		.color-palette span {
			display: none;
			font-size: 12px;
		}
		
		.color-palette:hover span {
			display: block;
		}
		
		.color-palette-box h4 {
			position: absolute;
			top: 100%;
			left: 25px;
			margin-top: -40px;
			color: rgba(255, 255, 255, 0.8);
			font-size: 12px;
			display: block;
			z-index: 7;
		}

    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
    td:hover{
 cursor: pointer;
}

	</style>
</head>
<?php 
session_start();
  $user = $_SESSION['username'];
  $userID = $_SESSION['userid'];
  $currentDate = date("Y-m-d h:i:sa"); 
if(!empty($user)) {

  //--------start code for detete--------------------//
      if(!empty($_GET['id']))  {
          $sold_id = $_GET['id'];
       
		  $sql_sold = "UPDATE car_model SET status ='0' WHERE model_pk = '$sold_id'";	  
		    $retval_del = $dbConnect->UpdateRecord($sql_sold);
      
             if(! $retval_del ) {

                //echo("<div align='center'; style ='font:18px Arial,tahoma,sans-serif;color:#ff0000;'> Could not Deleted data </div>" . mysql_error());
             }
             else{
            echo "<script type=\"text/javascript\">";
		              echo "alert(\"Car Successfully Add in Sold List...\");";
		             // echo "window.location.href = \"view_inventory.php\";";
		              echo "</script>";
                 }
    }
    //----------end detete code------------------//

//query for view list
          $query = "SELECT model_pk, manufacturer_name, model_name, color, fuel, manufacturer_year, registration_year,carcount, note, car_picture1, car_picture2 FROM car_model
          LEFT JOIN manufacturer ON manufacturer.manufacturer_pk = car_model.manufacturer_fk 
           WHERE car_model.status = '1' ORDER BY model_name Asc";
		  $result = $dbConnect->FetchRecordsLarge($query);

?>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include("header.php"); ?>
		<?php include("nav_bar.php"); ?>
		<!-- Left side column. contains the logo and sidebar -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
        <!-- View Manufacturer -->
        <!-- <small>Preview of UI elements</small> -->
      </h1>
			
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a>
					</li>
					<li><a>Car Inventory</a>
					</li>
					<li><a>View Car Inventory</a>
					</li>
					<!-- <li class="active">General</li> -->
				</ol>
        <br><br>
			</section>
			<!-- Main content -->
			<section class="content">
				
				<div class="row">

					<div class="col-md-12">
						<div class="box box-default box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">List of Car Inventory</h3>

								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
								</div>
								<!-- /.box-tools -->
							</div>
							<!-- /.box-header -->


							<div class="box-body">

                 <span></span>
								<div class="box">
									<table id="example3" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Sr. No.</th>
												<th>Manufacturer Name</th>
												<th>Model Name</th>
											 <th>Count</th>
												<!-- <th>Action</th> -->
											</tr>
										</thead>
										<tbody>
											<?php 
											$sr_no =1;
											if ($result > 0) {

											while($row = $result->fetch_assoc()){	

                        $model_id = $row['model_pk'];

												?>
											    <tr data-toggle="modal" data-target="#Inventory<?php echo $row['model_pk'];?>">
                          
											    <td>
												   <?php echo $sr_no;?>
												</td>	
												<td>
													<?php echo $row['manufacturer_name'];?>
												</td>
												<td>
													<?php echo $row['model_name'];?>
												</td>
											 <td><?php echo $row['carcount'];?></td>
											</tr>

                      <div id="Inventory<?php echo $row['model_pk'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #000">Car Details</h4>
      </div>
      <div class="modal-body" style="color: #000">
        <p><b>Car Manufacturer :</b> <?php echo $row['manufacturer_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Car Model :</b> <?php echo $row['model_name'];?></p>
         <p><b>Car Color :</b> <?php echo $row['color'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Car Fuel :</b> <?php echo $row['fuel'];?></p>
          <p><b>Manufacturer Year :</b> <?php echo $row['manufacturer_year'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Registration Year :</b> <?php echo $row['registration_year'];?></p>
          <p><b>Note :</b> <?php echo $row['note'];?></p>
 <p><b>Car Picture 1 :</b> <img src="Upload_Files/<?php if(isset($row['car_picture1'])) { echo $car_picture1 = $row['car_picture1']; } else { echo $car_picture1 = ""; } ?>" alt="" width="25%" height="25%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Car Picture 2 :</b> <img src="Upload_Files/<?php if(isset($row['car_picture2'])) { echo $car_picture2 = $row['car_picture2']; } else { echo $car_picture2 = ""; } ?>" alt="" width="25%" height="25%"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" style="text-align: center;"><a href="view_inventory.php?id=<?php echo $row['model_pk'];?>" style="color: #fff"> Sold</a></button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

											<?php
											$sr_no+=1; }  
										}
										else { ?>

											 <td colspan="8">
												   <b><span style="text-align: center;"> Records Not Found...</span></b>
												</td>

										 <?php }
										?>
										</tbody>

									</table>

								</div>
								<!-- /.box-body -->
							</div>

						</div>
						<!-- /.box -->
					</div>

				</div>
				<!-- /.row -->
				<!-- END CUSTOM TABS -->
				 <script type="text/javascript">
    CKEDITOR.replace('note');
  </script>
			</section>
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
<?php
   }
else {
header( 'Location: index.php' );
}
?>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="http://malsup.github.com/jquery.form.js"></script> 
 
    <script> 
$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        alert(rowid);
        die();
        $.ajax({
            type : 'post',
            url : 'view_inventory.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
            }
        });
     });
});
    </script> 