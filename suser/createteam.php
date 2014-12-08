<?php
	include('../functions.php');
	include('sfunctions.php');
	if(!isset($_SESSION['id'])){
	header('Location: ../index.php' );
	}
	if(isAdmin($_SESSION['id'])==0){
		header('Location: ../index.php' );
	}
?>
<?php if((isset($_POST['teamname']))&&(isset($_POST['dep_id']))){
	createTeam($_POST['teamname'],$_POST['dep_id']);
	?> <script> window.close()</script><?php
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet">
<title>Create a Team</title>
<style type="text/css">
body{
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
    	<form action="createteam.php" method="post">
        <fieldset>
        <legend>Please Select Department</legend>
        <select name="dep_id">
            <?php echo getDepartmentList(); ?>
        </select><br />
        <legend>Team Name</legend>
        <input type="text" name="teamname" placeholder="Team Name" required/><br />
        <button type="submit" name="submit" class="btn btn-primary">Create</button>
        </fieldset>
        </form>
    </div>
</body>
</html>