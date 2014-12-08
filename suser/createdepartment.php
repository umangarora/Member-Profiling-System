<?php
	include('../functions.php');
	include('sfunctions.php');
	if(!isset($_SESSION['id'])){
	header('Location: ../index.php' );
	}
	if(isAdmin($_SESSION['id'])==0){
		header('Location: ../index.php' );
	}
	if(isset($_POST['name'])){
		$name=$_POST['name'];
		$vp=$_POST['vp'];
		addDep($name,$vp);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet">
<title>ADD TASK</title>
<style type="text/css">
body{
	overflow:hidden;
}
.addtask{
	margin:auto auto;
	overflow:hidden;
	text-align:center;
	padding: 20px;
}
</style>
</head>
<body>
<div class="addtask">
	<form action="createdepartment.php" method="post">
		<input type="text" name="name" placeholder="Name of Department" required /><br />
		<input type="text" name="vp" placeholder="VP" required /><br />
		<button type="submit" name="submit" class="btn btn-primary">Create Department</button>
	</form>
    </div>
</body>
</html>