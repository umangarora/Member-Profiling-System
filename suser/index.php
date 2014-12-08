<?php
include("../functions.php");
include("sfunctions.php");
if(!isset($_SESSION['id'])){
	header('Location: ../index.php' );
}
if(isAdmin($_SESSION['id'])==0){
	header('Location: ../index.php' );
}
?>
<html>
<head>
<title>Admin Panel</title>
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
    <script type="text/javascript">
	// Popup window code
	function newPopup(url) {
		  var w=520;
		  var h=520;
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		popupWindow = window.open(
			url,'popUpWindow','toolbar=0, location=0, directories=0, status=0, menubar=0, scrollbars=0, resizable=0, copyhistory=0, width='+w+', height='+h+', top='+top+', left='+left);
	}
</script>

</head>
<body>
<center>
<br>
<br>

<strong><div class="btn-group">

<a href="javascript:newPopup('create.php');" class="btn btn-success btn-large">Add a User</a>
<a href="javascript:newPopup('createteam.php');" class="btn btn-success btn-large">Create a Team</a>
<a href="javascript:newPopup('addmember.php');" class="btn btn-success btn-large">Add Member To Team</a>
<a href="allP.php" target="_blank" class="btn btn-primary btn-large">Performance</a>
<a href="allA.php" target="_blank" class="btn btn-primary btn-large">Attendance</a>
<!--<a href="javascript:newPopup('addevent.php');" class="btn btn-success btn-large">Add an Event</a>-->

</div></strong>

<h4>
</h4>
<a class="btn" href="../myprofile.php">My Profile</a> <a class="btn btn-danger" href="../logout.php">Logout</a>
</center>
</body>