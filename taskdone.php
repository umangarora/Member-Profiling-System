<?php 
include('functions.php');
if(!isset($_SESSION['id'])){
	header('Location: myprofile.php') ;
}
else{
	if(isset($_GET['tid']))
	{
		if(isset($_POST['remark'])){
		DoneTheTask($_POST['remark'],$_GET['tid'],$_SESSION['id']);
		header('Location: myprofile.php') ;			
		}
	}
}
?>

