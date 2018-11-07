<html>
<?php    
//include("dbconnect.php");
require_once("dbconnect.php");
$dbConnect = new dbConnect("algoreal_db");
?>
<head>
  <link rel="icon" href="fevicon.png" type="image/gif">
<style type="text/css">
 input{
 border:1px solid olive;
 border-radius:5px;
 }
 h1{
  color:darkgreen;
  font-size:22px;
  text-align:center;
 }

</style>
</head>
<body>
<h1>Forgot Password<h1>
<form action='#' method='post'>
<table cellspacing='5' align='center'>
<tr><td>Email id:</td><td><input type='text' name='mail'/></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Submit'/></td></tr>
</table>
</form>
<?php
if(isset($_POST['submit']))
{ 
 
 $mail=$_POST['mail'];
 $q="select employee_id,first_name,middle_name,last_name,contact_no,email_id, password from employee_info WHERE status = '1' AND email_id='".$mail."' ";
 $p = $dbConnect->FetchRecords($query);
 //$p=mysql_affected_rows();
 if($p!=0) 
 {
  //$res=mysql_fetch_array($q);
  $to=$p[0]['email_id'];
  $subject='Remind password';
  $message='Your password : '.$res['password']; 
  $headers='From:info@algoreal.com';
  $m=mail($to,$subject,$message,$headers);

  if($m)
  {
    echo'Check your inbox in mail';
  }
  else
  {
   echo'mail is not send';
  }
 }
 else
 {
  echo'You entered mail id is not present';
 }
}
?>
</body>
</html>