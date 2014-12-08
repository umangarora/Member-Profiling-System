<?php 
include('functions.php');
if(!isset($_SESSION['id'])){
	header('Location: myprofile.php') ;
}
else{
	if(isset($_GET['tid']))
	{
		aTask($_GET['tid'],$_SESSION['id']);
	header('Location: myprofile.php') ;
	}
}
?>

