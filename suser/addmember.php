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
<?php if(isset($_POST['tm'])){
	addToTeam($_POST['tm'],$_POST['team_id'],$_POST['lead']);
	?><script>window.reload();</script><?php
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet">
<title>Add Member To a Team</title>
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
<script>
function getContent(str)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	document.getElementById("content").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","addmember.php?dep_id="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>
    <div class="addtask">
    <?php
	if(isset($_GET['dep_id'])) { 
    		$dep_id=$_GET['dep_id'];
	?>
    
    	<form action="addmember.php" method="post">
         <legend>Please Select Team</legend>
                <select name="team_id">
					<?php echo getDepartmentTeamList($dep_id); ?>
                </select><br />
        <legend>Please Select Member</legend>
        <select name="tm">
        	<?php echo getDepartmentMemberList($dep_id); ?>
        </select><br />
        <legend>Role</legend>
        <select name="lead">
        	<option value='0'>Team Member</option>
            <option value='1'>Team Leader</option>
        </select><br />       
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php }	else { ?>      
	 <form action="addmember.php" method="get">
                <legend>Please Select Department</legend>
                <select name="dep_id" onchange="getContent(this.value)">
                	<option value="">--</option>
					<?php echo getDepartmentList(); ?>
                </select>
                <!--<button type="submit" name="submit" class="btn btn-primary">Submit</button>-->
        </form>
        <div id="content">
        </div>
    <?php } ?>
    </div>
</body>
</html>