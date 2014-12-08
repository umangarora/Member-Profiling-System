



<?php 
include('functions.php');
if(!isset($_SESSION['id'])){
	header( 'Location: index.php' );
}
$myid=$_SESSION['id'];
$tt=isFirstLogin($_SESSION['id']);
if($tt==0){
	header('Location: updateinfo.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8" />
	<title>AIESEC in Delhi University | MPS</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="HandheldFriendly" content="true">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Import CSS -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
    <!-- <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet"> -->
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.min.js"></script>
	<script src="js/jquery.scrollto.min.js"></script>
    <script src="js/bootstrap.js"></script>
	<script src="js/slabtext.min.js"></script>
	<script src="js/jquery.nav.js"></script>
	<script src="js/main.js"></script>
    <script src="js/script.js"></script>
</head>
<!-- To change color change the class "color-1" to "color-2, color-3 ... color-6" -->
<body class="home color-2">
<?php include_once("analyticstracking.php") ?>
	<div id="header">
		<div class="container">
			<div class="row">
            	<i id="nav-button" class="icon-circle-arrow-down"></i>
				<h2 id="logo"><a href="index.php">Member<span class="highlight" style="margin-left:17px;">Profiling System</span></a></h2>
                <div id="top-nav" class="">
					<ul id="fixed-nav">
						<li class="current"><a href="#home">Me</a></li>
						<li><a href="#tasks">Tasks</a></li>
						<?php if(!isVP($myid)){ ?><li><a href="#team">My Team</a></li> <?php } ?>
						<li><a href="#department">My Department</a></li>
                        <li><a href="#stats">Statistics</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div><!-- End Header -->
	<!-- Big Full screen Banner -->
    <?php $departlist=getDepartmentIDs($_SESSION['id']); ?>
	<div class="hero bg-fixed bg-color" <?php if($departlist[0]==2) echo "style='background-image:url(http://farm6.staticflickr.com/5327/9451815744_5dc48637a6_o.jpg); background-size:cover;'"?>id="home">
		<div class="slogan">
			<div  class="vcenter container">
	            <?php echo printProfilePicture(0,$myid,200); ?>
				<div class="row">
					<div class="span12">
						<h1><?php echo getName($_SESSION['id']); ?></h1>
                        <?php echo getPhNumber($_SESSION['id']); ?><br>
                        <?php if(isVP($myid)){
							echo "Vice President, ";
							$departlist=getDepartmentIDs($_SESSION['id']);
							echo getDepartmentName($departlist[0]);
							echo "<br />";
						}
						else{
							$departlist=getDepartmentIDs($_SESSION['id']);
							$z=0;
							while(isset($departlist[$z])){
								if(isTLinDep($myid,$departlist[$z]))
									echo "Team Leader, ";
								echo getDepartmentName($departlist[$z]);
								echo "<br>";
								$z++;
							}
							echo "<br>";
						} ?><br>
						<a target="_blank" href="mailto:<?php echo getEmail($_SESSION['id']); ?>"><img src="img/net.png" width="50"></a><a href="http://www.twitter.com/<?php echo getTwitter($_SESSION['id']);?>" target="_blank"><img src="img/twitter.png" width="50"></a><a href="http://www.fb.com/<?php echo getFacebook($_SESSION['id']);?>" target="_blank"><img src="img/facebook.png" width="50"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Full screen banner  -->
	<!-- Services Section -->
	<!-- class section-alt is to give a different color please edit css/style.css to change the color -->
	<div class="section section-alt" id="tasks">
		<div class="container">
			<div class="content">
				<div class="row" >
					<div class="title">
						<h2>My Tasks</h2>
						<div class="hr hr-small hr-center"><span class="hr-inner"></span></div>
					</div>
				</div>
				<div class="row">
                	<div class="span12">
                    <center><h4>Incomplete Tasks</h4></center>
                    <?php
						$undonetask=getUndoneTask($myid);
						$z=0;
						if(!isset($undonetask[$z])){
							echo "<p class='text-center'> <img src='img/notaskleft.png' ><br>
							No Incomplete Task :D </p>";
						}
						else { ?>
                        <div class="row" style=" overflow:auto; ">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td style='text-align:center'>Task</td>
                                    <td style='text-align:center'>Description</td>
                                    <td style='text-align:center'>Assigned By</td>
                                    <td style='text-align:center'>Assigned</td>
                                    <td style='text-align:center'>Deadline</td>
                                    <td style='text-align:center'>Priority</td>
                                    <td style='text-align:center'>Remarks</td>
                                    <td style='text-align:center'>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
							while(isset($undonetask[$z])){
								$task=getTask($undonetask[$z]);
                                echo "<tr>";
                                echo "<td>".$task['title']."</td>
								<td>".$task['des']."</td>
								<td  style='text-align:center'>".getName($task['assby'])."</td>
								<td  style='text-align:center'>".$task['ass']."</td>
								<td  style='text-align:center'>".$task['deadline']."</td>
								<td  style='text-align:center'>".$task['priority']."</td>
								<form action='taskdone.php?tid=".$task['task_id']."' method='post'>
								<td  style='text-align:center'><input type='text' name='remark' placeholder='Remark' required /></td>
								<td  style='text-align:center'><button name='submit' type='submit' class='btn btn-primary'>Submit</button></td></form>";
                                echo "</tr>";
								$z++;
							} ?>
                            </tbody>
                        
                        </table>
                        </div>
                  <?php } ?>
                    </div>
				</div>
                <div class="row">
                	<div class="span12">
                    <center><h4>Completed Tasks</h4></center>                    
					<?php
						$donetask=getDoneTask($myid);
						$z=0;
						if(!isset($donetask[$z])){
							echo "<p class='text-center'> <img src='img/notaskdone.jpg' ><br>
							No Task Done :( </p>";
						}
						else { ?>
                        <div class="row" style=" overflow:auto; ">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td style='text-align:center'>Task</td>
                                    <td style='text-align:center'>Description</td>
                                    <td style='text-align:center'>Assigned By</td>
                                    <td style='text-align:center'>Assigned</td>
                                    <td style='text-align:center'>Deadline</td>
                                    <td style='text-align:center'>Priority</td>
                                    <td style='text-align:center'>Completed On</td>
                                </tr>
                            </thead>
                            <?php
							while(isset($donetask[$z])){
								$task=getTask($donetask[$z]);
                                echo "<tr>";
                                echo "<td>".$task['title']."</td>
								<td>".$task['des']."</td>
								<td style='text-align:center'>".getName($task['assby'])."</td>
								<td style='text-align:center'>".$task['ass']."</td>
								<td style='text-align:center'>".$task['deadline']."</td>
								<td style='text-align:center'>".$task['priority']."</td>
								<td style='text-align:center'>".$task['done']."</td>";
                                echo "</tr>";
								$z++;
							} ?>
                        </table>
                        </div>
				<?php 	} ?>
                    </div>
				</div>
                <div class="row">
                	<div class="span12">                    
					<?php
						$donetask=getAssignedUndoneTask($myid);
						$z=0;
						if(!isset($donetask[$z])){
							echo "";
						}
						else { ?>
                        <center><h4>Assigned Undone Tasks</h4></center>
                        <div class="row" style=" overflow:auto; ">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                	<td style='text-align:center'>Assigned To</td>
                                    <td style='text-align:center'>Task</td>
                                    <td style='text-align:center'>Description</td>
                                    <td style='text-align:center'>Assigned</td>
                                    <td style='text-align:center'>Deadline</td>
                                    <td style='text-align:center'>Priority</td>
                                </tr>
                            </thead>
                            <?php
							while(isset($donetask[$z])){
								$task=getTask($donetask[$z]);
                                echo "<tr>";
                                echo "<td style='text-align:center'>".getName($task['id'])."</td>
								<td>".$task['title']."</td>
								<td>".$task['des']."</td>
								<td style='text-align:center'>".$task['ass']."</td>
								<td style='text-align:center'>".$task['deadline']."</td>
								<td style='text-align:center'>".$task['priority']."</td>";
                                echo "</tr>";
								$z++;
							} ?>
                        </table>
                        </div>
				<?php 	} ?>
                    </div>
				</div>
                <div class="row">
                	<div class="span12">                    
					<?php
						$donetask=getUnapprovedTask($myid);
						$z=0;
						if(!isset($donetask[$z])){
							echo "";
						}
						else { ?>
                        <center><h4>Not yet approved Tasks</h4></center>
                        <div class="row" style=" overflow:auto; ">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td style='text-align:center'>Assigned To</td>
                                    <td style='text-align:center'>Task</td>
                                    <td style='text-align:center'>Description</td>
                                    <td style='text-align:center'>Priority</td>
                                    <td style='text-align:center'>Completed On</td>
                                    <td style='text-align:center'>Remark</td>
                                    <td style='text-align:center'>Approve</td>
                                </tr>
                            </thead>
                            <?php
							while(isset($donetask[$z])){
								$task=getTask($donetask[$z]);
                                echo "<tr>";
                                echo "<td style='text-align:center'>".getName($task['id'])."</td>
								<td>".$task['title']."</td>
								<td>".$task['des']."</td>
								<td style='text-align:center'>".$task['priority']."</td>
								<td style='text-align:center'>".$task['done']."</td>
								<td style='text-align:center'>".$task['remark']."</td>
								<td style='text-align:center'><a href='atask.php?tid=".$task['task_id']."' class='btn btn-primary'>Approve</a>  <a href='dtask.php?tid=".$task['task_id']."' class='btn btn-danger'>Disapprove</a></td>";
                                echo "</tr>";
								$z++;
							} ?>
                        </table>
                        </div>
				<?php 	} ?>
                    </div>
				</div>
			</div> 
		</div>
	</div>
	<!-- End Services Section -->
	<!-- About Us section --><?php if(!isVP($myid)){ ?>
	<div class="section" id="team">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="span12">
						<div class="title">
							<h2>My Team</h2>
							<div class="hr hr-small hr-center"><span class="hr-inner"></span></div>
						</div>
					</div>
				</div>
				<?php $myTeams=getTeamIDs($myid);
				$x=0;
				while(isset($myTeams[$x]['id'])){
				?>
                <div class="row">
                <h3><center><?php echo $myTeams[$x]['name']."-".getDepartmentName($myTeams[$x]['dep'])."<br />";?></center></h3>
                <?php $myTeamMembers=getTeamMembers($myTeams[$x]['id']);
				$y=0;
				while(isset($myTeamMembers[$y])){
					$mem=$myTeamMembers[$y];
				?>
                     <div class="span4 i-block">
                     	<?php echo printProfilePicture(1,$mem['id'],100); ?>
                        <a href="profile.php?id=<?php echo $mem['id'];?>">
                        
                        <h3 <?php 
						if(in_array($mem['id'],$myTeams[$x]['lead'])) 
						echo 'id="tl"'; ?>
                        >
                        
						<?php echo $mem['name']; ?></h3></a>
                        <p><?php printOverallOTF($mem['id']); ?>
                        <?php if((!in_array($mem['id'],$myTeams[$x]['lead']))&&in_array($myid,$myTeams[$x]['lead'])&&($myid!=$mem['id'])){
							echo "<br />"; ?>
                            <a href="#myModal" role="button" class="btn btn-primary"  onClick="getModalContent(<?php echo $mem['id'] ?>)" data-toggle="modal">Add Task</a>
                            <!--<a class="btn btn-primary" href="JavaScript:newPopup('addtask.php?mem_id=<?php echo $mem['id']; ?>');">Add task</a><br />-->
                        <?php } ?>
                        </p>
                     </div>
                      <?php $y++; if($y%3==0) echo "</div><div class='row'>" ?>
                     <?php  } ?>
               	</div>
                <?php $x++; } ?>
			</div>
		</div> 
	</div>
    <?php } ?>
	<!-- End About US -->
	<!-- Features Section -->
	<div class="section section-alt" id="department">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="span12">
						<div class="title">
							<h2>My Department</h2>
							<div class="hr hr-small hr-center"><span class="hr-inner"></span></div>
						</div>
                    </div>
               	</div>
                <?php $myDepartments=getDepartmentIDs($myid); 
				$x=0;
				while(isset($myDepartments[$x])){
				?>
                <div class="row">
                <?php $mydepmembers=getDepartmentMembers($myDepartments[$x]);
				$y=0;
				while(isset($mydepmembers[$y])){
					$mem=$mydepmembers[$y];
				?>
                     <div class="span4 i-block">
                     	<?php echo printProfilePicture(1,$mem['id'],100); ?>
                        <a href="profile.php?id=<?php echo $mem['id'];?>">
                        <h3>
						<?php echo $mem['name']; ?></h3></a>
                        <p><?php printOverallOTF($mem['id']); ?>
                        
                        <?php if((isVP($myid))&&($myid!=$mem['id'])){
							echo "<br />"; ?>
                            <a href="#myModal" role="button" onClick="getModalContent(<?php echo $mem['id'] ?>)" class="btn btn-primary" data-toggle="modal">Add Task</a>
                            <!--<a class="btn btn-primary" href="JavaScript:newPopup('addtask.php?mem_id=<?php echo $mem['id']; ?>');">Add task</a><br />-->
                        <?php
						} ?>
                        </p>
                     </div>
                     <?php $y++; } ?>
               	</div>
                <?php $x++; } ?>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
                
                
			</div>
		</div>
	</div> 
	<!-- End Features -->
	<!-- Contact Section -->
	<div class="section" id="stats" >
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="span12">
						<div class="title">
							<h2>Statistics</h2>
							<div class="hr hr-small hr-center"><span class="hr-inner"></span></div>
						</div>
                        <div class="row">
                        <center>
						<?php
                        	$a=TotalOTF($myid,getTerm());
							echo "<td>";
							if($a[0]!=-1){
                            echo "<strong>Overall OTF:</strong> ".$a[0]."<br>";
                            echo "<strong>Overall Weighted OTF:</strong> ".$a[1]."<br><br><br>";
                            }
                            else echo "<strong>No Task Given. </strong>You never deserved Work.<br><br>";
							echo "</td>";
						?>
                        </center>
                        </div>
                        <div class="row" style=" overflow:auto; ">
                        <table class="table table-bordered">
                        <?php 
						$startweek=getTermStartWeek(getTerm());
						$endweek=getTermEndWeek(getTerm()); ?>
                        <thead>
						<tr>
                        <?php
						if(isVP($myid)){
							echo "<td style='text-align:center'><strong>Name</strong></td>";	
						}
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
						<tr>
                        <?php
						if(isVP($myid))
							echo "<td style='text-align:center'><strong>My Stats</strong></td>";
						$b=getSubScore($myid);
						for($z=$startweek;$z<=$endweek;$z++){
							$a=OTF($myid,$z);
							echo "<td style='text-align:center' ".getColor($b['w'.$z]).">";
							if($a[0]!=-1){
								echo "".$a[0]."<br>";
								echo "<strong>".$a[1]."</strong><br>";
                            }
                            else echo "-";
							echo "</td>";
						}
						?>
                        </tr>
                        <?php
						if(isVP($myid)){
							$x=0;
							while(isset($mydepmembers[$x])){
								if($mydepmembers[$x]['id']!=$myid){
								echo "<tr>";
								echo "<td style='text-align:center'><strong>".$mydepmembers[$x]['name']."</strong></td>";
								$b=getSubScore($mydepmembers[$x]['id']);
								for($z=$startweek;$z<=$endweek;$z++){
									$a=OTF($mydepmembers[$x]['id'],$z);
									$idtext="";
									if($z==date('W'))
										$idtext="id='act1".$x."'";
									echo "<td style='text-align:center' ".$idtext." ".getColor($b['w'.$z]).">";
									if($a[0]!=-1){
										echo "".$a[0]."<br>";
										echo "<strong>".$a[1]."</strong><br>";
									}
									else echo "-";
									echo "</td>";
								}
								echo "</tr>";
								}
							$x++;
							}
						}
						?> 
                        </tbody>
                        </table>
                        </div>
                        <?php if(isVP($myid)){ ?>
                        <div class="row" style=" overflow:auto; ">
                            <div class="span4">
                            	<table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td style='text-align:center'><strong>Name</strong></td>
                                            <td style='text-align:center'><strong>Present Week</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                $x=0;
                                while(isset($mydepmembers[$x])){
                                    if($mydepmembers[$x]['id']!=$myid){
                                    echo "<tr>";
                                    echo "<td style='text-align:center'><strong>".$mydepmembers[$x]['name']."</strong></td>";
									$a=getSubScore($mydepmembers[$x]['id']);
									$z=(date('W'));
									echo "<td style='text-align:center' id='act".$x."' ".getColor($a['w'.$z]).">"; ?>
                                    <form action="changeSubScore.php" method="post">
                                    <input type="text" name="id" id="id<?php echo $x;?>" value="<?php echo $mydepmembers[$x]['id']?>" style="display:none">
                                    <input type="text" name="week" id="week<?php echo $x;?>" value="<?php echo $z?>" style="display:none">
                                    <select id="color<?php echo $x;?>" name="color" onChange="updateactivity(this.value,<?php echo $x; ?>)">
                                        <option value="1"<?php if($a['w'.$z]==1) echo 'selected="selected"'?>>Red</option>
                                        <option value="2" <?php if($a['w'.$z]==2) echo 'selected="selected"'?>>Yellow</option>
                                        <option value="3" <?php if($a['w'.$z]==3) echo 'selected="selected"'?>>Green</option>
                                    </select>
                                    <!--<button type="submit" class="btn btn-small" name="submit">Change</button> -->
                                    </form>
									<?php echo "</td>"; echo "</tr>";
                                    } $x++;
                                }
                                ?> 
                                </tbody>
                                </table>
                                </div>
                                <div class="span8" style="overflow:auto;">
                                <?php $EventList=getEvents(); ?>
                                <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <?php for($i=0;$i<sizeof($EventList);$i++){
										echo "<td><strong>".$EventList[$i]['name']."</strong></td>";
									}
									?>
                                </tr>
                                </thead>
                                <tbody>
								<?php
                                $x=0;
                                while(isset($mydepmembers[$x])){
                                    if($mydepmembers[$x]['id']!=$myid){
                                    echo "<tr>";
                                    echo "<td style='text-align:center'><strong>".$mydepmembers[$x]['name']."</strong></td>";
									$a=getEventAttendance($mydepmembers[$x]['id']);
									for($i=0;$i<sizeof($EventList);$i++){
										echo "<td style='text-align:center' ".getEventColor($a['e'.$EventList[$i]['event_id']]).">"; 
										if($a['e'.$EventList[$i]['event_id']]==0){
										?>
										<form action="changeEventAttendance.php" method="post">
										<input type="text" name="eventid" value="<?php echo $EventList[$i]['event_id']?>" style="display:none">
                                        <input type="text" name="id" value="<?php echo $mydepmembers[$x]['id']?>" style="display:none">
										<select name="attend">
											<option value="1"<?php if($a['e'.$EventList[$i]['event_id']]==1) echo 'selected="selected"' ?>>No</option>
											<option value="2" <?php if($a['e'.$EventList[$i]['event_id']]==2) echo 'selected="selected"' ?>>Late</option>
                                            <option value="3" <?php if($a['e'.$EventList[$i]['event_id']]==3) echo 'selected="selected"' ?>>Yes</option>
										</select>
										<button type="submit" class="btn btn-small" name="submit">Change</button>
										</form>
										<?php
										}
										echo "</td>"; 
									}echo "</tr>";
                                    } $x++;
                                }
                                ?> 
                                </tbody>
                                </table>
                                </div>
                                </div>
                            <?php
						}
						else{
						?>
                        <div class="row">
                                <?php $EventList=getEvents();
								$a=getEventAttendance($myid);
								?>
                                <table class="table table-bordered">
                                <thead>
                                <tr><td width="15%"><strong>Attendance</strong></td>
                                    <?php for($i=0;$i<sizeof($EventList);$i++){
										if($a['e'.$EventList[$i]['event_id']]!=-1){
										echo "<td ".getEventColor($a['e'.$EventList[$i]['event_id']])." style='text-align:center;'><strong>".$EventList[$i]['name']."</strong></td>";}
									}
									?>
                                </tr>
                                </thead>
                                </table>
                        </div>
                        <?php } ?>
					</div>
				</div>
			</div>
		</div> 

	</div>
	<!-- End Contact Section -->
	<div id="footer">
		&copy; 2013 AIESEC in Delhi University. Developed and Maintained by THE CIM.<br>
        Logged in as <?php echo getName($_SESSION['id']); ?>. <a href="logout.php">LOGOUT.</a><br>
 <a href="javascript:newPopup('change.php');">Change Password</a> <a href="javascript:newPopup('edit.php');">Edit Profile</a>  <?php
		if(isAdmin($myid)){
			echo ' <a href="suser/index.php">Admin Panel</a>';
		}
		?>
        <a href="javascript:newPopup('https://docs.google.com/spreadsheet/viewform?formkey=dEpXTHU0RWM1Ri1pbFk1RUIwMHFES0E6MA#gid=0');">Weekly Form </a>
        
        
	</div>
</body>
</html>


