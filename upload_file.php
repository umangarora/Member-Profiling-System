<?php

include("functions.php");
if(!isset($_SESSION['id'])){
	header( 'Location: index.php' );
}?>
<html>
<head>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<style>
body{
	padding:20px;
}
</style>
</head>
<body>
<center>
<?php
$myid=$_SESSION['id'];
$allowedExts = array("gif", "jpeg", "jpg", "png", "PNG", "JPG" );
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ( in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
		echo "Please Upload a Smaller Size";
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    //echo "Type: " . $_FILES["file"]["type"] . "<br>";
    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("img/photo/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "img/photo/".$myid.".".$extension);
	  updateimage($myid);
      echo "Image Update Successfully<br />";
	  ?>
      <a class="btn btn-danger" href="javascript:window.close()">Close</a>
	  <?php
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>
</center>
</body>
</html>