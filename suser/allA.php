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
<title>All Member Attendance</title>
</head>
<body>
<div class="container-fluid">
<div class="row-fluid" style="margin:10px auto;">
<div class="span12" style="overflow:auto;">
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                        <td width="15%" style="text-align:center"><strong>Name</strong></td>
							<?php 
                            $EventList=getEvents();
                            for($i=0;$i<sizeof($EventList);$i++){
                                echo "<td style='text-align:center;'><strong>".$EventList[$i]['name']."</strong></td>";
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
								$a=getEventAttendance($mydepmembers[$x]['id']);
								echo "<td style='text-align:center'><strong><a href='../profile.php?id=".$mydepmembers[$x]['id']."'>".$mydepmembers[$x]['name']."</a></strong></td>";
								for($i=0;$i<sizeof($EventList);$i++){
										echo "<td style='text-align:center;' ".getEventColor($a['e'.$EventList[$i]['event_id']])." ><strong></strong></td>";
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