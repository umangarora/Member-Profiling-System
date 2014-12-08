<?php
include('functions.php');

if((isset($_POST['id']))&&(isset($_POST['eventid']))&&(isset($_POST['attend']))){
	updateEventAttendance($_POST['id'],$_POST['eventid'],$_POST['attend']);
}
header( 'Location: myprofile.php' );
?>