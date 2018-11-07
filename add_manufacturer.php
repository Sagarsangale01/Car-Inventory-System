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
	</style>
</head>
<?php 
session_start();
  $user = $_SESSION['username'];
  $userID = $_SESSION['userid'];
  $currentDate = date("Y-m-d h:i:sa"); 
if(!empty($user)) {

 if(!empty($_POST) && $_POST['updateID'] == 0 && $_POST['manufacturerId'] == 0)  {
                
                if(isset($_REQUEST['manufacturerName'])) { $manufacturerName = $_REQUEST['manufacturerName']; } else { $manufacturerName = ""; }
                if(isset($_REQUEST['status'])) { $status = $_REQUEST['status']; } else { $status = 1; }
                $sql = "INSERT INTO manufacturer "."(manufacturer_name,created_date,status) "."VALUES "."('$manufacturerName','$currentDate','$status')";
                 // $retval = mysql_query( $sql);
                $retval = $dbConnect->InsertRecord($sql);
        }

  //--------start code for detete--------------------//
      if(!empty($_GET['del_id']))  {
         $delete_id = $_GET['del_id'];
        
		 $sql_del = "UPDATE manufacturer SET status ='0' WHERE manufacturer_pk = '$delete_id'";	  
		   $retval_del = $dbConnect->UpdateRecord($sql_del);
      
            if(! $retval_del ) {

               echo("<div align='center'; style ='font:18px Arial,tahoma,sans-serif;color:#ff0000;'> Could not Deleted data </div>" . mysql_error());
            }
            else{
           echo "<script type=\"text/javascript\">";
		             echo "alert(\"Record Deleted successfully...\");";
		             echo "window.location.href = \"add_manufacturer.php\";";
		             echo "</script>";
                }
       }
    //----------end detete code------------------//

  //----------------start update------------------------------------------
if ($_POST['updateID'] == 1 && $_POST['manufacturerId'] != 0) {
	  if(isset($_REQUEST['manufacturerName'])) { $manufacturerName = $_REQUEST['manufacturerName']; } else { $manufacturerName = ""; }
                if(isset($_REQUEST['manufacturerId'])) { $manufacturerId = $_REQUEST['manufacturerId']; } else { $manufacturerId = 0; }

                 $sql_update = "UPDATE manufacturer SET manufacturer_name ='$manufacturerName' WHERE manufacturer_pk = '$manufacturerId'";	  
		   $retval_del = $dbConnect->UpdateRecord($sql_update);
      }

if(!empty($_GET['id']))  {
         $update_id = $_GET['id'];
         $updateID = 1;
          $query = "SELECT manufacturer_pk,manufacturer_name,created_date FROM manufacturer WHERE  manufacturer_pk = '$update_id' AND status = '1'";
		  $UpdateResult = $dbConnect->FetchRecords($query);
		}

//---------------end update--------------------------------------------------

//query for view list
          $query = "SELECT manufacturer_pk,manufacturer_name,created_date FROM manufacturer WHERE status = '1' ORDER BY manufacturer_pk Desc";
		  $result = $dbConnect->FetchRecordsLarge($query);
		 
		 // echo $query;
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
					<li><a>manufacturer</a>
					</li>
					<li><a>Add manufacturer</a>
					</li>
					<!-- <li class="active">General</li> -->
				</ol>
			</section>

			<section class="content">
<br>
<br>
      <div class="row">
        
 <div class="col-md-12">
          <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Add Manufacturer</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <!-- form start -->
            <form class="form-horizontal" id="Manufacturer" action="add_manufacturer.php" method="post">
              <div class="box-body">
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">Manufacturer Name<span style="color:#ff0000;">*</span></label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="manufacturerName" name="manufacturerName" value='<?php if(isset($UpdateResult[0]['manufacturer_name'])) { echo $manufacturer_name = $UpdateResult[0]['manufacturer_name']; } else { echo $manufacturer_name = ""; } ?>' required="required" tabindex="1" autofocus="autofocus">
                  </div>
                </div>
                    <input type="hidden" name="updateID" id="updateID" value='<?php if(isset($updateID)){ echo "$updateID" ; } else { echo "0"; } ?>'>
                     <input type="hidden" name="manufacturerId" id="manufacturerId" value='<?php if(isset($UpdateResult[0]['manufacturer_pk'])) { echo $manufacturer_pk = $UpdateResult[0]['manufacturer_pk']; } else { echo $manufacturer_pk = "0"; } ?>'>                  
                </div>
              <!-- /.box-body -->
              <div class="box-footer subtn" align="center">
                <button type="submit" class="btn btn-info">Submit</button>
               <button class="btn btn-default"><a href="add_manufacturer.php"> Reset</a></button>
              </div>
              <!-- /.box-footer -->
            </form>
        
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
			</div>
</section>  
			<!-- Main content -->
			<section class="content">
				
				<div class="row">

					<div class="col-md-12">
						<div class="box box-default box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">List of Manufacturer</h3>

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
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$sr_no =1;
											if ($result > 0) {
											
											while($row = $result->fetch_assoc()){	?>
											    <tr>
											    <td>
												   <?php echo $sr_no;?>
												</td>											
											
												<td>
													<?php echo $row['manufacturer_name'];?>
												</td>
												
												 <td><a href="add_manufacturer.php?id=<?php echo $row['manufacturer_pk'];?>" > <span style="color:#33ACFF;"><button type="button" class="btn btn-block bg-navy btn-xs" data-toggle="tooltip" data-original-title="Edit Record"><i class="fa fa-edit"></i></button></span></a>&nbsp;|&nbsp;<a href="add_manufacturer.php?del_id=<?php echo $row['manufacturer_pk'];?>"><span style="color: #ffffff" onclick="return confirm('Are you sure to Delete?')"><span style="color:#ff0000;"><button type="button" class="btn btn-block btn-danger btn-xs" data-toggle="tooltip" data-original-title="Delete Record"><i class="fa fa-remove"></i></button></span>
												</td>
											</tr>

											<?php
											$sr_no+=1; }  
										}
										else { ?>

											 <td colspan="3">
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
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            // bind 'myForm' and provide a simple callback function 
            $('#Manufacturer').ajaxForm(function() { 
            	 $('#Manufacturer')[0].reset();
                alert("Record Inserted OR Updated successfully...!"); 
               window.location.href = "add_manufacturer.php";
            }); 
        }); 
    </script> 
