<?php  
include('functions.php');
if(!isset($_SESSION['id'])){
	header( 'Location: index.php' );
}
if(isFirstLogin($_SESSION['id'])){
	header( 'Location: edit.php' );
}

if(isset($_POST['name'])){
	$i=$_SESSION['id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$facebook=$_POST['facebook'];
	$twitter=$_POST['twitter'];
	$phone=$_POST['phone'];
	$dep_id=$_POST['dep_id'];
	updateuser($i,$name,$email,$facebook,$twitter,$phone,$dep_id);
	header( 'Location: index.php' );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Information</title>
<style type="text/css">
.info{
	position: absolute;
	height: 400px;
	margin-left:auto;
	margin-right:auto;
	margin-top:-200px;
	top: 50%;
	width:100%;
}
</style>
</head>
<body>
<center>
<div class="info">
<?php if(isFirstLogin($_SESSION['id'])==0){ ?>
<form action="updateinfo.php" method="post">
<input type="text" name="name" placeholder="Name" required="required" /><br />
<input type="email" name="email" placeholder="Your .net Email ID" required="required" /><br />
<input type="text" name="facebook" placeholder="Facebook Username" required="required" /><br />
<input type="text" name="twitter" placeholder="Twitter Username" required="required" /><br />
<input type="text" name="phone" placeholder="Phone" required="required" /><br />
<select name="dep_id"><?php
echo getDepartmentList();
?></select>
<!--<input type="number" name="dep_id" placeholder="Department ID" required="required" /><br /> --><br />
<input type="submit" class="btn btn-primary" name="submit"  />  <a class="btn" href="logout.php">Logout</a>
</form>
<?php } ?>

</div>
</center>
</body>
</html>
