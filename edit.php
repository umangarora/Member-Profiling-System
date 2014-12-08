<?php  
include('functions.php');
if(!isset($_SESSION['id'])){
	header( 'Location: index.php' );
}
if(isset($_POST['name'])){
	$i=$_SESSION['id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$facebook=$_POST['facebook'];
	$twitter=$_POST['twitter'];
	$phone=$_POST['phone'];
	edituser($i,$name,$email,$facebook,$twitter,$phone);
	?>
    <script>
		window.close();
	</script>
    <?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
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
<script type="text/javascript">
	// Popup window code
	function newPopup(url) {
		  var w=300;
		  var h=150;
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		popupWindow = window.open(
			url,'popUpWindow','toolbar=0, location=0, directories=0, status=0, menubar=0, scrollbars=0, resizable=0, copyhistory=0, width='+w+', height='+h+', top='+top+', left='+left);
	}
</script>
</head>
<body>
<center>
<div class="info">

<?php  
$myid=$_SESSION['id'];
?>
<form action="edit.php" method="post">
<legend>Edit Profile</legend>
<input type="text" name="name" value="<?php echo getName($myid); ?>" required="required" /><br />
<input type="email" name="email" value="<?php echo getEmail($myid); ?>" required="required" /><br />
<input type="text" name="facebook" value="<?php echo getFacebook($myid); ?>" required="required" /><br />
<input type="text" name="twitter" value="<?php echo getTwitter($myid); ?>" required="required" /><br />
<input type="text" name="phone" value="<?php echo getPhNumber($myid); ?>" required="required" /><br />
<a class="btn btn-mini" href="javascript:newPopup('upload.php');">Update Image</a><br />

<!--<input type="number" name="dep_id" placeholder="Department ID" required="required" /><br /> --><br />
<button type="submit" class="btn btn-primary" name="submit">Done</button>  <a class="btn" href="logout.php">Logout</a>
</form>
</div>
</center>
</body>
</html>
