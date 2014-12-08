<?php
include('functions.php');
if((isset($_POST['id']))&&(isset($_POST['week']))&&(isset($_POST['color']))){
	//echo "hello1";
	updateSubScore($_POST['id'],$_POST['week'],$_POST['color']);
	//echo "hello2";
}
//header( 'Location: myprofile.php' );
?>