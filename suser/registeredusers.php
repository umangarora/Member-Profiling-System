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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet">
<title>Registered Users</title>
</head>
<body>
<div class="container-fluid">
<div class="row-fluid" style="margin:10px auto;">
<div class="span12" style="overflow:auto;">
<?php $memberlist=getRegisteredUsers(); ?>
<table class="table table-bordered">
<thead>
<tr>
<td><strong>ID</strong></td><td><strong>User</strong></td>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<sizeof($memberlist);$i++) {?>
<tr><td><?php echo $memberlist[$i]['id'];?></td><td><?php echo $memberlist[$i]['username'];?></td></tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</body>
</html>