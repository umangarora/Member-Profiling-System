<?php 
include('functions.php');
if(!isset($_SESSION['id'])){
	header( 'Location: index.php?continue=profile.php?id='.$_GET['id']);
}
if(!isset($_GET['id'])){
	header( 'Location: myprofile.php' );
}

$myid=$_SESSION['id'];
$uid=$_GET['id'];
if($uid==$_SESSION['id']){
	header( 'Location: myprofile.php' );
}
$tt=isFirstLogin($uid);
if($tt==0){
	header('Location:404.php');
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
	<link rel="stylesheet" href="css/main.css"> 
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.min.js"></script>
	<script src="js/jquery.scrollto.min.js"></script>
	<script src="js/slabtext.min.js"></script>
	<script src="js/jquery.nav.js"></script>
	<script src="js/main.js"></script>
    <script type="text/javascript">
	// Popup window code
	function newPopup(url) {
		  var w=400;
		  var h=520;
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		popupWindow = window.open(
			url,'popUpWindow','toolbar=0, location=0, directories=0, status=0, menubar=0, scrollbars=0, resizable=0, copyhistory=0, width='+w+', height='+h+', top='+top+', left='+left);
	}
</script>
</head>
<!-- To change color change the class "color-1" to "color-2, color-3 ... color-6" -->
<body class="home color-<?php echo 1+$uid%6; ?>">
	<div id="header">
		<div class="container">

			<div class="row">

					<i id="nav-button" class="icon-circle-arrow-down"></i>
					<h2 id="logo"><a href="index.php">Member<span class="highlight" style="margin-left:17px;">Profiling System</span></a></h2>
				

				<div id="top-nav" class="">
					<ul id="fixed-nav">
						<li class="current"><a href="#home"><?php echo getName($uid); ?></a></li>
						<li><a href="#tasks">Tasks</a></li>
						<?php if(!isVP($uid)){ ?><li><a href="#team">Teams</a></li> <?php } ?>
						<li><a href="#department">Departments</a></li>
                        <li><a href="#stats">Statistics</a></li>
					</ul>
				</div>

			</div>
		</div>
	</div><!-- End Header -->
	<!-- Big Full screen Banner -->
    
    <?php $departlist=getDepartmentIDs($_GET['id']); ?>
	<div class="hero bg-fixed bg-color" id="home" <?php if($departlist[0]==2) echo "style='background-image:url(http://farm6.staticflickr.com/5327/9451815744_5dc48637a6_o.jpg); background-size:cover;'"?>>

		<div class="slogan">
			<div  class="vcenter container">
            <?php echo printProfilePicture(0,$uid,200); ?>
				<div class="row">
					<div class="span12">
						<h1><?php echo getName($uid); ?></h1>
                        <?php echo getPhNumber($uid); ?><br>
                        <?php
						if(isVP($uid)){
							echo "Vice President, ";
							$departlist=getDepartmentIDs($uid);
							echo getDepartmentName($departlist[0]);
							echo "<br />";
						}
						else{
							$departlist=getDepartmentIDs($uid);
							$z=0;
							while(isset($departlist[$z])){
								if(isTLinDep($uid,$departlist[$z]))
									echo "Team Leader, ";
								echo getDepartmentName($departlist[$z]);
								echo "<br>";
								$z++;
							}
							echo "<br>";
						} ?><br>
						<a target="_blank" href="mailto:<?php echo getEmail($uid); ?>"><img src="img/net.png" width="50"></a><a href="http://www.twitter.com/<?php echo getTwitter($uid);?>" target="_blank"><img src="img/twitter.png" width="50"></a><a href="http://www.fb.com/<?php echo getFacebook($uid);?>" target="_blank"><img src="img/facebook.png" width="50"></a>
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
						<h2>Tasks</h2>
						<div class="hr hr-small hr-center"><span class="hr-inner"></span></div>
					</div>
				</div>
				<div class="row">
                	<center><h2>Incomplete Tasks</h2></center>
                	<div class="span12">
                    <?php
						$undonetask=getUndoneTask($uid);
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
                                    <td  style='text-align:center'>Task</td>
                                    <td  style='text-align:center'>Description</td>
                                    <td  style='text-align:center'>Assigned By</td>
                                    <td  style='text-align:center'>Assigned</td>
                                    <td  style='text-align:center'>Deadline</td>
                                    <td  style='text-align:center'>Priority</td>
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
								<td  style='text-align:center'>".$task['priority']."</td>";
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
                	<center><h2>Completed Tasks</h2></center>
                	<div class="span12">                    
					<?php
						$donetask=getDoneTask($uid);
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
                                    <td  style='text-align:center'>Task</td>
                                    <td  style='text-align:center'>Description</td>
                                    <td  style='text-align:center'>Assigned By</td>
                                    <td  style='text-align:center'>Assigned</td>
                                    <td  style='text-align:center'>Deadline</td>
                                    <td  style='text-align:center'>Priority</td>
                                    <td  style='text-align:center'>Completed On</td>
                                </tr>
                            </thead>
                            <?php
							while(isset($donetask[$z])){
								$task=getTask($donetask[$z]);
                                echo "<tr>";
                                echo "<td>".$task['title']."</td>
								<td>".$task['des']."</td>
								<td  style='text-align:center'>".getName($task['assby'])."</td>
								<td  style='text-align:center'>".$task['ass']."</td>
								<td style='text-align:center'>".$task['deadline']."</td>
								<td  style='text-align:center'>".$task['priority']."</td>
								<td  style='text-align:center'>".$task['done']."</td>";
                                echo "</tr>";
								$z++;
							} ?>
                        </table>
                        </div>
                        <?php } ?>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Services Section -->
	<!-- About Us section --><?php if(!isVP($uid)){ ?>
	<div class="section" id="team">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="span12">
						<div class="title">
							<h2>Teams</h2>
							<div class="hr hr-small hr-center"><span class="hr-inner"></span></div>
						</div>
					</div>
				</div>
				<?php $myTeams=getTeamIDs($uid);
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
                        <p><?php printOverallOTF($mem['id']); ?></p>
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
	<!-- Features 
    
    
    
    This is the Department
    
    
    Section -->
	<div class="section section-alt" id="department">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="span12">
						<div class="title">
							<h2>Departments</h2>
							<div class="hr hr-small hr-center"><span class="hr-inner"></span></div>
						</div>
                    </div>
				</div>
                <?php $myDepartments=getDepartmentIDs($uid); 
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
                        <a href="profile.php?id=<?php echo $mem['id'];?>"><h3><?php echo $mem['name']; ?></h3></a>
                        <p><?php printOverallOTF($mem['id']); ?></p>
                     </div>
                     <?php $y++; } ?>
               	</div>
                <?php $x++; } ?>
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
							$a=TotalOTF($uid,getTerm());
							echo "<td>";
							if($a[0]!=-1){
                            echo "<strong>Overall OTF:</strong> ".$a[0]."<br>";
                            echo "<strong>Total Weighted OTF:</strong> ".$a[1]."<br><br><br>";
                            }
                            else echo "<strong>No Task Given. </strong>Never deserved Work.<br><br>";
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
						if(isVP($uid)){
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
						if(isVP($uid))
							echo "<td style='text-align:center'><strong>".getName($uid)."</strong></td>";
						$b=getSubScore($uid);
						for($z=$startweek;$z<=$endweek;$z++){
							$a=OTF($uid,$z);
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
						if(isVP($uid)){
							$x=0;
							while(isset($mydepmembers[$x])){
								if($mydepmembers[$x]['id']!=$uid){
								echo "<tr>";
								echo "<td style='text-align:center'><strong>".$mydepmembers[$x]['name']."</strong></td>";
								$b=getSubScore($mydepmembers[$x]['id']);
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
								}
							$x++;
							}
						}
						?> 
                        </tbody>
                             </table>
                         </div>
                         <?php if(!isVP($uid)){ ?>
                         <div class="row">
                                <?php $EventList=getEvents();
								$a=getEventAttendance($uid);
								?>
                                <table class="table table-bordered">
                                <thead>
                                <tr><td width="15%"><strong>Attendance</strong></td>
                                    <?php for($i=0;$i<sizeof($EventList);$i++){
										if($a['e'.$EventList[$i]['event_id']]>=0){
										echo "<td ".getEventColor($a['e'.$EventList[$i]['event_id']])." style='text-align:center;'><strong>".$EventList[$i]['name']."</strong></td>";
										}
									}
									?>
                                </tr>
                                </thead>
                                </table>
                        </div>
                        <?php } else { ?>
                         <div class="row">
                                <?php $EventList=getEvents();
								?>
                                <table class="table table-bordered">
                                <thead>
                                <?php 
								$z=0;
								while(isset($mydepmembers[$z]))
								{
									if($mydepmembers[$z]['id']!=$uid){
									$a=getEventAttendance($mydepmembers[$z]['id']);
								?>
                                <tr><td width="15%" style="text-align:center"><strong><?php echo $mydepmembers[$z]['name'] ?></strong></td>
                                    <?php for($i=0;$i<sizeof($EventList);$i++){
											echo "<td ".getEventColor($a['e'.$EventList[$i]['event_id']])." style='text-align:center;'><strong>".$EventList[$i]['name']."</strong></td>";
									}
									?>
                                </tr>
                                <?php } $z++; }
								?>
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
        Logged in as <a href="myprofile.php"><?php echo getName($myid); ?></a>. <a href="logout.php">LOGOUT.</a><br>
 <a href="javascript:newPopup('change.php');">Change Password</a><?php
		if(isAdmin($myid)){
			echo '<br><a href="suser/index.php">Admin Panel</a>';
		}
		?>
	</div>
</body>
</html>