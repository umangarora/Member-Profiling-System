<?php
include('functions.php');

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
<?php } ?>
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h3 id="myModalLabel">Add a Task for <?php echo getName($_GET['mem_id']); ?> </h3>
  </div>
  <div class="modal-body" align="center">
  <input type="text" id="mem_id" value="<?php echo $_GET['mem_id']; ?>" name='mem_id' style="display:none;">
  <input type="text" id="tasktitle" name="title" placeholder="Task Title" required="required" style="width:480px" /><br />
  <input type="date" id="taskdeadline" name="deadline" placeholder="deadline" required="required" style="width:480px" min="<?php echo date('Y-m-d'); ?>" max="<?php echo getTermEndDate(getTerm()); ?>"/><br />
  <input type="number" id="taskpriority" name="priority" style="width:480px" placeholder="priority" required="required" min="1" max="10"/><br />
  <textarea rows="3" style="width:480px" id="taskdes" name="des" placeholder="Description" required="required" /></textarea><br />
  <div id="ModalError" style="padding-top:10px; padding-bottom:10px;"></div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button type="submit" class="btn btn-primary" onclick="addtask()" name="submit">Add Task</button>
  </div>
<!--<form action="addtask.php?mem_id=<?php echo $_GET['mem_id']; ?>" method="post">
<fieldset>
<legend></legend>


</fieldset>
</form>
-->