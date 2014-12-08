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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet">
<title>Untitled Document</title>
</head>

<body>
<div class="container-fluid">
<div class="row-fluid" style="margin:10px auto;">
<div class="span12" style="overflow:auto;">
                        <table class="table table-bordered">
                        <?php 
						$startweek=getTermStartWeek(getTerm());
						$endweek=getTermEndWeek(getTerm()); ?>
                        <thead>
						<tr>
                        <?php
                        echo "<td style='text-align:center'><strong>Name</strong></td>";
						$x=1;
						for($z=$startweek;$z<=$endweek;$z++){
							if($z==date('W')) echo "<td style='text-align:center'><strong>Present Week</strong></td>";
							else echo "<td style='text-align:center'><strong>Week-".$x."</strong></td>";
							$x++;	
						}
						?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $mydepmembers=getAllMembers();                        
							$x=0;
							while(isset($mydepmembers[$x])){
								if(isVP($mydepmembers[$x]['id']))
								echo "<tr bgcolor='#BBBBBB'>";
								else
								echo "<tr>";
								$b=getSubScore($mydepmembers[$x]['id']);
								echo "<td style='text-align:center'><strong><a href='../profile.php?id=".$mydepmembers[$x]['id']."'>".$mydepmembers[$x]['name']."</a></strong></td>";
								for($z=$startweek;$z<=$endweek;$z++){
									$a=OTF($mydepmembers[$x]['id'],$z);
									echo "<td style='text-align:center' ".getColor($b['w'.$z]).">";
									if($a[0]!=-1){
									echo "".$a[0]."<br>";
									echo "<strong>".$a[1]."</strong><br>";
									}
									else echo "-";
									echo "</td>";
								}
								echo "</tr>";
								$x++;
							}
						?> 
                        </tbody>
                             </table>
                         </div>
</div>
</div>

</body>
</html>