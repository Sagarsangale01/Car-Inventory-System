<?php    
require_once("db_connect/dbconnect.php");
$dbConnect = new dbConnect();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Technical Task</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<style>
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
    </style>
<body class="hold-transition login-page">
<?php
if(!empty($_POST))  {
  if(isset($_REQUEST['user_id'])) { $user_id = $_REQUEST['user_id']; } else { $user_id = ""; }
  if(isset($_REQUEST['password'])) { $password = $_REQUEST['password']; } else { $password = ""; }
  
 echo $user_id = mysql_real_escape_string($user_id);
 echo $pass = mysql_real_escape_string($password);
  echo $password = md5($pass);

$sqlLigin = "SELECT user_pk, user_name, user_id, password FROM user WHERE BINARY user_id = '$user_id' AND BINARY password = '$password'";
$rssqlLigin = $dbConnect->FetchRecords($sqlLigin);

  if(!empty($rssqlLigin))  {
     $first_name = $rssqlLigin[0]['user_name'];
     $userid = $rssqlLigin[0]['user_pk'];
  
    session_start();
    $_SESSION['username']=$first_name; // You can set the value however you like.
    $_SESSION['userid']=$userid;
	
 header('Location: dashboard.php');

 }
  else {
    echo "<br><br><div align='center'; style ='font:18px Arial,tahoma,sans-serif;color:#ff0000;'> Entered user name or password is incorrect. Please try again.</div>";

  }
} 

?>

<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Interview Task: Mini Car Inventory System</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="index.php" method="post">
      <div class="form-group has-feedback">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <input class="form-control" name="user_id" id="user_id" placeholder="Employee Id">
      </div>
      <div class="form-group has-feedback">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
      </div>
       <div class="row">
        <div class="col-xs-8">
           <span data-toggle="" data-target=""><a href="forgot-password.php"> I forgot my password</a></span>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br>
	<span align="right"> 
</span>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>

</html>
