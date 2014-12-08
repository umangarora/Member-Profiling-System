<?php
include('functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<title>ADD TASK</title>
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
if(!isset($_GET['mem_id'])){
	header( 'Location: myprofile.php' ) ;
}
if(!canAssign($_GET['mem_id'],$_SESSION['id'])){
	header( 'Location: myprofile.php' ) ;
}
if(isset($_POST['des'])){
	$memid=$_GET['mem_id'];
	$description=$_POST['des'];
	$title=$_POST['title'];
	$deadline=$_POST['deadline'];
	$priority=$_POST['priority'];
	$assbyid=$_SESSION['id'];
	addtask($memid,$description,$deadline,$priority,$title,$assbyid);
	$to = getEmail($memid);
	$subject = "New Task Assigned";
	$message = "Hi ".getName($memid)."!\nA new task is assigned to you by ".getName($assbyid).".\n\nTask Title: ".$title."\nTask Description: ".$description."\nDeadline: ".$deadline."\nPriority: ".$priority."\n\nRegards,\nMPS Admin";
	$from = "MPS Admin <mps@aiesec.net>";
	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);
	?>
    <script type="text/javascript">
	window.opener.location.reload();
	window.close();
	</script>
    <?php
}

?>
<body>
<div class="addtask">
<form action="addtask.php?mem_id=<?php echo $_GET['mem_id']; ?>" method="post">
<fieldset>
<legend>Add a Task for <?php echo getName($_GET['mem_id']); ?> </legend>
<input type="text" name="title" placeholder="Task Title" required="required" /><br />
<input type="date" name="deadline" placeholder="deadline" required="required"  min="<?php echo date('Y-m-d'); ?>" max="<?php echo getTermEndDate(getTerm()); ?>"/><br />
<input type="number" name="priority" placeholder="priority" required="required" min="1" max="10"/><br />
<textarea rows="10" cols="60" name="des" placeholder="Description" required="required" /></textarea><br />
<button type="submit" class="btn btn-primary" name="submit">Add task</button>
</fieldset>
</form>
</div>
</body>
</html>
