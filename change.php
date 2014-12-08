<?php
include('functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.css" rel="stylesheet">
<title>Change Password</title>
<style type="text/css">
body{
	overflow:hidden;
}
.addtask{
	margin:0 auto;
	overflow:hidden;
	text-align:center;
	padding: 20px;
}
</style>
</head>
<?php

if(!isset($_SESSION['id'])){
	header( 'Location: index.php' ) ;
}
if(isset($_POST['oldpass'])){
	$new1=$_POST['newpass1'];
	$new2=$_POST['newpass2'];
	if($new1!=$new2){
		$err="Unmatching Passwords";
	}
	else{
	$message=updatepass($_SESSION['id'],$_POST['oldpass'],$_POST['newpass1']);
	}
}
?>
<body>
<div class="addtask">
<form action="change.php" method="post">
<fieldset>
<legend>Change Password</legend>
<input type="password" name="oldpass" placeholder="Old Passward" required="required" /><br />
<input type="password" name="newpass1" placeholder="New Password" required="required" /><br />
<input type="password" name="newpass2" placeholder="New Password Again" required="required" /><br />
<?php if(isset($err)) echo $err; ?><?php if(isset($message)){
if($message!=1)
	echo "<div style='color:red;'>Incorrect Password</div>";
}
?><br />
<button type="submit" class="btn" name="submit">Change</button>
</fieldset>
</form>
<?php
if(isset($message)){
	if($message==1){
		echo "<div style='color:green;'>Password Updated Successfully</div><br />";
		?><a class="btn btn-primary" href="javascript:window.close();">Done</a><br />
		<br /><?php
	}
}
?>
</div>
</body>
</html>
