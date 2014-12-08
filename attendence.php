<?php 

include('functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendence</title>
</head>

<body>
	
    <?php
	
		$depid=getDepartment_id($_SESSION['id']);
		
		$arr=getDepartment_member11($depid[0]);
		$y=1;
		$flag=0;
		$i=$arr[0];
		for($y=1;$y<$i+1;$y++)
		{
	
	if(isset($_POST[$arr[$y]]))
	{
		attendence($arr[$y]);
		$flag=1;
		
		
	}
		}
		if($flag==1)
		echo "Your Data Has Been Collected";
	?>
    

<?php
if(!isset($_SESSION['id'])){
	header( 'Location: index.php' ) ;
}
else{
	$isvp=IsVP($_SESSION['id']);
	$flag=0;
	$tttt=array();
	if($isvp==1)
	{
		//echo '<form>';
		echo '<form action="attendence.php" method="post">';
		$depid=getDepartment_id($_SESSION['id']);
		
		$arr=getDepartment_member11($depid[0]);
		$i=$arr[0];
		//echo $i;
		
		for($j=1;$j<$i+1;$j++){
		{if($arr[$j]!=$_SESSION['id']){
			
			$tttt[$flag]=getName($arr[$j]);
			
			
           echo '<input type="checkbox" name="',$arr[$j],'" value="aa">';

			echo getName($arr[$j]);
			echo "<br>";
			
				
				 $flag=$flag+1;
						}}
	}	
	}
}	

echo '<input type="submit" value="Submit">';
echo '</form>';


	
?>









</body>
</html>