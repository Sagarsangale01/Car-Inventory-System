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
	</style>
</head>
<?php 
session_start();
  $user = $_SESSION['username'];
  $userID = $_SESSION['userid'];
  $currentDate = date("Y-m-d h:i:sa"); 
  $carcount = 1;
if(!empty($user)) {

 if(!empty($_POST) && $_POST['updateID'] == 0 && $_POST['modelId'] == 0)  {

 	//print_r($_REQUEST);
                
                if(isset($_REQUEST['manufacturer_fk'])) { $manufacturer_fk = $_REQUEST['manufacturer_fk']; } else { $manufacturer_fk = ""; }
                if(isset($_REQUEST['model_name'])) { $model_name = $_REQUEST['model_name']; } else { $model_name = ""; }
                if(isset($_REQUEST['car_color'])) { $car_color = $_REQUEST['car_color']; } else { $car_color = ""; }
                if(isset($_REQUEST['fuel'])) { $fuel = $_REQUEST['fuel']; } else { $fuel = ""; }
                if(isset($_REQUEST['manufacturer_year'])) { $manufacturer_year = $_REQUEST['manufacturer_year']; } else { $manufacturer_year = ""; }
                if(isset($_REQUEST['registration_year'])) { $registration_year = $_REQUEST['registration_year']; } else { $registration_year = ""; }
               // if(isset($_REQUEST['car_picture1'])) { $car_picture1 = $_REQUEST['car_picture1']; } else { $car_picture1 = ""; }
                //if(isset($_REQUEST['car_picture2'])) { $car_picture2 = $_REQUEST['car_picture2']; } else { $car_picture2 = ""; }
                if(isset($_REQUEST['note'])) { $note = $_REQUEST['note']; } else { $note = ""; }

                $car_picture1 = $_FILES['car_picture1']['name'];
                $car_picture2 = $_FILES['car_picture2']['name'];

               //   $target_dir = "Upload_Files/";
          // Upload file
            move_uploaded_file($_FILES['car_picture1']['tmp_name'],'Upload_Files/'.$car_picture1);
            move_uploaded_file($_FILES['car_picture2']['tmp_name'],'Upload_Files/'.$car_picture2);

 $sqlcheck= "SELECT model_pk,carcount FROM car_model WHERE manufacturer_fk = '$manufacturer_fk' AND model_name = '$model_name' AND color = '$car_color' AND fuel = '$fuel' AND manufacturer_year = '$manufacturer_year' AND registration_year = '$registration_year' AND status = '1' ORDER BY model_pk DESC LIMIT 0,1";

if ($checkResult = $dbConnect->FetchRecords($sqlcheck)) {
$model_pk = $checkResult[0]['model_pk'];
$carCount = $checkResult[0]['carcount'];
$carCount +=1; 

 $sql_update = "UPDATE car_model SET carcount ='$carCount' WHERE model_pk = '$model_pk'";	  
 $retval = $dbConnect->UpdateRecord($sql_update);

}
else {

$sqlCount = "SELECT count FROM car_model WHERE manufacturer_fk = '$manufacturer_fk' AND model_name = '$model_name' AND status = '1' ORDER BY count DESC LIMIT 0,1";

if ($countResult = $dbConnect->FetchRecords($sqlCount)) {
$carcount = $countResult[0]['count'];
$carcount +=1; 
}

                $sql = "INSERT INTO car_model "."(manufacturer_fk,model_name,color,fuel,manufacturer_year,registration_year,note,car_picture1,car_picture2,carcount,created_date,status) "."VALUES "."('$manufacturer_fk','$model_name','$car_color','$fuel','$manufacturer_year','$registration_year','$note','$car_picture1','$car_picture2','$carcount','$currentDate','1')";
                 // $retval = mysql_query( $sql);
              
                $retval = $dbConnect->InsertRecord($sql);
        }
     }

  //--------start code for detete--------------------//
      if(!empty($_GET['del_id']))  {
         $delete_id = $_GET['del_id'];
        
		 $sql_del = "UPDATE car_model SET status ='0' WHERE model_pk = '$delete_id'";	  
		   $retval_del = $dbConnect->UpdateRecord($sql_del);
      
            if(! $retval_del ) {

               echo("<div align='center'; style ='font:18px Arial,tahoma,sans-serif;color:#ff0000;'> Could not Deleted data </div>" . mysql_error());
            }
            else{
           echo "<script type=\"text/javascript\">";
		             echo "alert(\"Record Deleted successfully...\");";
		             echo "window.location.href = \"add_model.php\";";
		             echo "</script>";
                }
       }
    //----------end detete code------------------//

  //----------------start update------------------------------------------
if ($_POST['updateID'] == 1 && $_POST['modelId'] != 0) {
	 

                if(isset($_REQUEST['manufacturer_fk'])) { $manufacturer_fk = $_REQUEST['manufacturer_fk']; } else { $manufacturer_fk = ""; }
                if(isset($_REQUEST['model_name'])) { $model_name = $_REQUEST['model_name']; } else { $model_name = ""; }
                if(isset($_REQUEST['car_color'])) { $car_color = $_REQUEST['car_color']; } else { $car_color = ""; }
                if(isset($_REQUEST['fuel'])) { $fuel = $_REQUEST['fuel']; } else { $fuel = ""; }
                if(isset($_REQUEST['manufacturer_year'])) { $manufacturer_year = $_REQUEST['manufacturer_year']; } else { $manufacturer_year = ""; }
                if(isset($_REQUEST['registration_year'])) { $registration_year = $_REQUEST['registration_year']; } else { $registration_year = ""; }
               if(isset($_REQUEST['note'])) { $note = $_REQUEST['note']; } else { $note = ""; }

                $car_picture1 = $_FILES['car_picture1']['name'];
                $car_picture2 = $_FILES['car_picture2']['name'];
          // Upload file
            move_uploaded_file($_FILES['car_picture1']['tmp_name'],'Upload_Files/'.$car_picture1);
            move_uploaded_file($_FILES['car_picture2']['tmp_name'],'Upload_Files/'.$car_picture2);

 if(isset($_REQUEST['modelId'])) { $modelId = $_REQUEST['modelId']; } else { $modelId = ""; }

                 $sql_update = "UPDATE car_model SET manufacturer_fk = '$manufacturer_fk',model_name = '$model_name',color = '$car_color',fuel = '$fuel',manufacturer_year = '$manufacturer_year',registration_year = '$registration_year',note = '$note',car_picture1 = '$car_picture1',car_picture2  = '$$car_picture2' WHERE model_pk = '$modelId'";	  
		   $retval_del = $dbConnect->UpdateRecord($sql_update);
      
           //  if(! $retval_del ) {

           //     echo("<div align='center'; style ='font:18px Arial,tahoma,sans-serif;color:#ff0000;'> Could not updated data </div>" . mysql_error());
           //  }
           //  else{
           // echo "<script type=\"text/javascript\">";
		         //     echo "alert(\"Record Updated successfully...\");";
		         //     echo "window.location.href = \"add_manufacturer.php\";";
		         //     echo "</script>";
           //      }

}

if(!empty($_GET['id']))  {
         $update_id = $_GET['id'];
         $updateID = 1;
          $query = "SELECT model_pk,manufacturer_fk,model_name,color,fuel,manufacturer_year,registration_year,note,car_picture1,car_picture2 FROM car_model WHERE  model_pk = '$update_id' AND status = '1'";
		  $UpdateResult = $dbConnect->FetchRecords($query);
		}

//---------------end update--------------------------------------------------

//query for view list
          $query = "SELECT model_pk, manufacturer_name, model_name, color, fuel, manufacturer_year, registration_year, note, car_picture1, car_picture2 FROM car_model
          LEFT JOIN manufacturer ON manufacturer.manufacturer_pk = car_model.manufacturer_fk 
           WHERE car_model.status = '1' ORDER BY model_name Asc";
		  $result = $dbConnect->FetchRecordsLarge($query);

//query for view Manufacturer DropDown list
          $query = "SELECT manufacturer_pk,manufacturer_name,created_date FROM manufacturer WHERE status = '1' ORDER BY manufacturer_pk Desc";
		  $resultMfg = $dbConnect->FetchRecordsLarge($query);

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
					<li><a>Car Model</a>
					</li>
					<li><a>Add Car Model</a>
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
              <h3 class="box-title">Add Car Model</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <!-- form start -->
            <form class="form-horizontal" id="Model" action="add_model.php" method="post" enctype='multipart/form-data'>
              <div class="box-body">
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">Manufacturer Name <span style="color:#ff0000;">*</span>:</label>

                  <div class="col-sm-4">
                   <select name="manufacturer_fk" class="form-control manufacturer_fk" id="manufacturer_fk" tabindex="1" autofocus="autofocus">
                 <option value="0">-- SELECT MANUFACTURER --</option>
         <?php while($row = $resultMfg->fetch_assoc()){ 

         	 if ($UpdateResult[0]['manufacturer_fk'] == $row['manufacturer_pk'])
                          {
                              $selected = "selected=\"selected\"";
                          }
                          else
                          {
                          $selected = '';
                        }

         	?>
  <option value="<?php echo $row['manufacturer_pk'];?>" <?php echo $selected ?>><?php echo $row['manufacturer_name'];?></option> 
        <?php  }  ?>  </select>
                  </div>
                   <label class="col-sm-2 control-label">Model Name <span style="color:#ff0000;">*</span>:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="model_name" name="model_name" tabindex="1" required="required" value='<?php if(isset($UpdateResult[0]['model_name'])) { echo $model_name = $UpdateResult[0]['model_name']; } else { echo $model_name = ""; } ?>'>
                    </div>
                </div>
                   
                     <div class="form-group">                
                    <label class="col-sm-2 control-label">Car Color<span style="color:#ff0000;">*</span> :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="car_color" name="car_color" required="required" tabindex="1" value='<?php if(isset($UpdateResult[0]['color'])) { echo $color = $UpdateResult[0]['color']; } else { echo $color = ""; } ?>'>
                    </div>
                    <label class="col-sm-2 control-label">Fuel Type<span style="color:#ff0000;">*</span> :</label>
                    <div class="col-sm-4">
                     <select class="form-control" id="fuel" name="fuel" required="required" tabindex="1">
                      <option value="">--SELECT FUEL TYPE--</option>
                      <option value="CNG" <?php if($UpdateResult[0]['fuel']=="CNG"){echo"selected=selected";}?>>CNG</option>
                      <option value="Diesel" <?php if($UpdateResult[0]['fuel']=="Diesel"){echo"selected=selected";}?>>Diesel</option>
                       <option value="Petrol" <?php if($UpdateResult[0]['fuel']=="Petrol"){echo"selected=selected";}?>>Petrol</option>
                      </select>
                    </div>
                  </div>

                   <div class="form-group">                
                    <label class="col-sm-2 control-label">Manufacturing Year<span style="color:#ff0000;">*</span> :</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="manufacturer_year" name="manufacturer_year" required="required" tabindex="1" value='<?php if(isset($UpdateResult[0]['manufacturer_year'])) { echo $manufacturer_year = $UpdateResult[0]['manufacturer_year']; } else { echo $manufacturer_year = ""; } ?>'>
                    </div>
                    <label class="col-sm-2 control-label">Registration Year<span style="color:#ff0000;">*</span> :</label>
                      <div class="col-sm-4">
                      <input type="text" class="form-control" id="registration_year" name="registration_year" required="required" tabindex="1" value='<?php if(isset($UpdateResult[0]['registration_year'])) { echo $registration_year = $UpdateResult[0]['registration_year']; } else { echo $registration_year = ""; } ?>'>
                    </div>
                  </div>

                    <div class="form-group">                
                    <label class="col-sm-2 control-label">Car Picture 1<span style="color:#ff0000;">*</span> :</label>
                    <div class="col-sm-4">
                      <input type="file" class="form-control" id="car_picture1" name="car_picture1" required="required" tabindex="1">
                   <br>
                    	<img src="Upload_Files/<?php if(isset($UpdateResult[0]['car_picture1'])) { echo $car_picture1 = $UpdateResult[0]['car_picture1']; } else { echo $car_picture1 = ""; } ?>" alt="" width="25%" height="25%">
                    </div>
                    <label class="col-sm-2 control-label">Car Picture 2<span style="color:#ff0000;">*</span> :</label>
                      <div class="col-sm-4">
                      <input type="file" class="form-control" id="car_picture2" name="car_picture2" required="required" tabindex="1">
                   <br>
                    	<img src="Upload_Files/<?php if(isset($UpdateResult[0]['car_picture2'])) { echo $car_picture2 = $UpdateResult[0]['car_picture2']; } else { echo $car_picture2 = ""; } ?>" alt="" width="25%" height="25%">
                    </div>
                  </div>

                   <div class="form-group">
                  <label class="col-sm-2 control-label">Note :</label>

                  <div class="col-sm-10">
                    <textarea id="note" name="note" tabindex="1"> 
    <?php if(isset($UpdateResult[0]['note'])) { echo $note = $UpdateResult[0]['note']; } else { echo $note = ""; } ?>
                 </textarea>
                  </div>

				<input type="hidden" name="updateID" id="updateID" value='<?php if(isset($updateID)){ echo "$updateID" ; } else { echo "0"; } ?>'>

                <input type="hidden" name="modelId" id="modelId" value='<?php if(isset($UpdateResult[0]['model_pk'])) { echo $model_pk = $UpdateResult[0]['model_pk']; } else { echo $model_pk = "0"; } ?>'>


                </div>
              <!-- /.box-body -->
              <div class="box-footer subtn" align="center">
                <button type="submit" class="btn btn-info">Submit</button>
               <button class="btn btn-default"><a href="add_model.php"> Reset</a></button>
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
								<h3 class="box-title">List of Models</h3>

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
												<th>Color</th>
												<th>Fuel</th>
												<th>Mfg. Year</th>
												<th>Registration Year</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$sr_no =1;
											if ($result > 0) {

											while($row = $result->fetch_assoc()){	

												?>
											    <tr>
											    <td>
												   <?php echo $sr_no;?>
												</td>											
											
												<td>
													<?php echo $row['manufacturer_name'];?>
												</td>
												<td>
													<?php echo $row['model_name'];?>
												</td>
												<td>
													<?php echo $row['color'];?>
												</td>
												<td>
													<?php echo $row['fuel'];?>
												</td>
												<td>
													<?php echo $row['manufacturer_year'];?>
												</td>
												<td>
													<?php echo $row['registration_year'];?>
												</td>
												
												 <td><a href="add_model.php?id=<?php echo $row['model_pk'];?>" > <span style="color:#33ACFF;"><button type="button" class="btn btn-block bg-navy btn-xs" data-toggle="tooltip" data-original-title="Edit Record"><i class="fa fa-edit"></i></button></span></a>&nbsp;|&nbsp;<a href="add_model.php?del_id=<?php echo $row['model_pk'];?>"><span style="color: #ffffff" onclick="return confirm('Are you sure to Delete?')"><span style="color:#ff0000;"><button type="button" class="btn btn-block btn-danger btn-xs" data-toggle="tooltip" data-original-title="Delete Record"><i class="fa fa-remove"></i></button></span>
												</td>
											</tr>

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
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            // bind 'myForm' and provide a simple callback function 
            $('#Model').ajaxForm(function() { 
            	 $('#Model')[0].reset();
                alert("Record Inserted OR Updated successfully...!"); 
               window.location.href = "add_model.php";
            }); 
        }); 
    </script> 