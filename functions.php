<?php


date_default_timezone_set('Asia/Calcutta');
session_start();


$server=0;
if(!$server){
	
	
define("DB_HOST", "127.0.0.1" );
define("DB_NAME", "mpsdu");
define("DB_USER", "dumps");
define("DB_PASS", "123");
}
else {
		
define("DB_HOST", "mpsdu.db.11523588.hostedresource.com" );
define("DB_NAME", "mpsdu");
define("DB_USER", "mpsdu");
define("DB_PASS", "Umang@12345");
}
/*
define("DB_HOST", "mysql14.000webhost.com" );
define("DB_NAME", "a8101739_mps");
define("DB_USER", "a8101739_mps");
define("DB_PASS", "umang@12345");
*/


function login ($user,$pass) {
	$user=strtolower($user);
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM user WHERE username='$user' AND password='$pass'");
	$rows=mysql_num_rows($q);
	mysql_close();
	if($rows==1){		
		$p=mysql_fetch_array($q);
		$_SESSION['id']=$p['id'];
		return $p['id'];		
	}
	return $rows;
}

function getDepartmentList(){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM department");	
	$deplist="";
	while($row = mysql_fetch_array($q))
	{
		$deplist=$deplist."<option value=".$row['dep_id'].">".$row['dep_name']."</option>";
	}	
	mysql_close();
	return $deplist;
}

function getDepartmentMembers($depid){//Return all the members of a department
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM depmember, member where depmember.member_id=member.id and dep_id='".$depid."' order by member.id");	
	$deplist=array();
	$z=0;
	while($row = mysql_fetch_array($q))
	{
		$a['id']=$row['member_id'];
		$a['name']=$row['name'];
		$a['email']=$row['net'];
		$a['image']=$row['image'];
		$a['dep']=$row['dep_id'];
		$deplist[$z++]=$a;
	}	
	mysql_close();
	return $deplist;
}
function getDepartmentTeamList($depid){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM team where team_dep='".$depid."';");	
	$deplist=array();
	$x=0;
	while($row = mysql_fetch_array($q))
	{
		$deplist[$x][0]=$row['team_id'];
		$deplist[$x][1]=$row['team_name'];
		$x++;
		//$deplist=$deplist."<option value=".$row['dep_id'].">".$row['dep_name']."</option>";
	}	
	$teamlist="";
	$x=0;	
	while(isset($deplist[$x])){
		$teamlist=$teamlist."<option value=".$deplist[$x][0].">".$deplist[$x][1]."</option>";
		$x++;
	}
	mysql_close();
	return $teamlist;
}

function getDepartmentMemberList($depid){
	$List=getDepartmentMembers($depid);
	$memlist="<option value=''>-</option>";
	$x=0;	
	while(isset($List[$x])){
		if(!isVP($List[$x]['id'])){
			$memlist=$memlist."<option value=".$List[$x]['id'].">".$List[$x]['name']."</option>";
		}
		$x++;
	}
	return $memlist;
}

function isFirstLogin($id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * from member where  id='".$id."'");
	$rows=mysql_num_rows($q);
	mysql_close();
	return $rows;
}

function updatepass($myid,$old,$new){
	$old1=md5($old);
	$new1=md5($new);
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("select * from user where id='".$myid."' and password='".$old1."';");	
	$rows=mysql_num_rows($q);
	if($rows!=0){
		$q=mysql_query("update user set password='".$new1."' where id='".$myid."' and password='".$old1."';");
		mysql_close();		
		return 1;
	}
	else {
		mysql_close();
		return 0;
	}
}

function edituser($id,$name,$email,$facebook,$twitter,$phone){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("update member set name='".$name."', net='".$email."', facebook='".$facebook."', twitter='".$twitter."', phone='".$phone."' where id='".$id."';");
	mysql_close();	
}

function updateuser($id,$name,$email,$facebook,$twitter,$phone,$dep_id){
	$term=getTerm();
	$year=date('Y');
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("select * from member where id='".$id."';");
	$count=mysql_num_rows($q);
	if($count==0){
		$q=mysql_query("insert into member(id,name,net,facebook,twitter,phone,image) values('".$id."','".$name."','".$email."','".$facebook."','".$twitter."','".$phone."','me.jpg');");
		$q=mysql_query("insert into depmember(member_id,dep_id) values('".$id."','".$dep_id."');");
		$q=mysql_query("insert into attendence(memberid) values('".$id."');");
		$q=mysql_query("insert into ".$term.$year."(id) values('".$id."')");
	}
	mysql_close();	
}

function updateimage($id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("update member set image='".$id.".jpg' where id='".$id."';");
	mysql_close();	
}

function getName($id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM member where id='".$id."'");
	$row = mysql_fetch_array($q);
	$name=$row['name'];
	mysql_close();
	return $name;
}

function getImage($id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM member where id='".$id."'");
	$row = mysql_fetch_array($q);
	$name=$row['image'];
	mysql_close();
	return $name;
}

function getEmail($id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM member where id='".$id."'");
	$row = mysql_fetch_array($q);
	$name=$row['net'];
	mysql_close();
	return $name;
}

function getFacebook($id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM member where id='".$id."'");
	$row = mysql_fetch_array($q);
	$name=$row['facebook'];
	mysql_close();
	return $name;
}

function getTwitter($id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM member where id='".$id."'");
	$row = mysql_fetch_array($q);
	$name=$row['twitter'];
	mysql_close();
	return $name;
}

function getPhNumber($id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM member where id='".$id."'");
	$row = mysql_fetch_array($q);
	$phone=$row['phone'];
	mysql_close();
	return $phone;
}

function getTeamIDs($memid)//return all the teams
{
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM teammember, team where team.team_id=teammember.team_id and member_id='".$memid."'");
	$i=0;
	$teamid=array();
	while($row = mysql_fetch_array($q))
	{
		$a['id']=$row['team_id'];
		$a['name']=$row['team_name'];
		$a['dep']=$row['team_dep'];
		$l=mysql_query("select * from teamleader where team='".$row['team_id']."'");
		$z=0;
		$leader=array();
		while($subrow=mysql_fetch_array($l))
		{
			$leader[$z++]=$subrow['leader'];
		}
		$a['lead']=$leader;
		$teamid[$i++]=$a;
	}
	mysql_close();
	return $teamid;
}

//This function returns the department IDs of the departments you are in
function getDepartmentIDs($id)
{
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM depmember where member_id='".$id."'");
	$i=0;
	while($row = mysql_fetch_array($q)){
		$depid[$i++]=$row['dep_id'];
	}
	mysql_close();
	return $depid;
}

function getDepartmentName($dep_id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM department where dep_id='".$dep_id."'");
	$row = mysql_fetch_array($q);
	$dep_name=$row['dep_name'];
	return $dep_name;
}

function getTeamName($team_id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM team where team_id='".$team_id."'");
	$row = mysql_fetch_array($q);
	$team_name=$row['team_name'];
	return $team_name;
}

function getTeamLeader($team_id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM teamleader where team='".$team_id."'");
	$i=0;
	while($row = mysql_fetch_array($q)){
		$tlid[$i++]=$row['leader'];
	}
	mysql_close();
	if($i==0)
		return array();
	return $tlid;
}
	
function getTeamMembers($teamid)//return all the team members
{
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM teammember, member where teammember.member_id=member.id and team_id='".$teamid."'");
	$arr=array();
	$i=0;
	while($row = mysql_fetch_array($q))
	{	
		$memberid['id']=$row['member_id'];
		$memberid['name']=$row['name'];
		$memberid['image']=$row['image'];
		$arr[$i++]=$memberid;
	}
	mysql_close();
	return $arr;
}

function canAssign($memid,$assid){
	if($memid==$assid)
		return 0;
	if(isVP($assid))
		return 1;
	$Teams=getTeamIDs($memid);
	$a=0;
	while(isset($Teams[$a])){
		if(in_array($assid,$Teams[$a]['lead'])){
			return 1;
		}
		$a++;
	}
	return 0;
}

function addtask($memid,$des,$deadline,$priority,$title,$assbyid)	
{
	$deadlinedate=strtotime($deadline);
	$week=date('W',$deadlinedate);
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("select * from member where id='".$memid."';");
	$count=mysql_num_rows($q);
	if($count!=0)
		$q=mysql_query("insert into task(id,des,deadline,priority,done,status,approved,remark,ass,title,assby,week) values('".$memid."','".$des."','".$deadline."','".$priority."','2014-12-31',0,'',0,CURDATE(),'".$title."','".$assbyid."','".$week."');");	
	mysql_close();
}
	
function DoneTheTask($remark,$task_id,$id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	//echo $deadline;
	$q=mysql_query("update task set
	done=CURDATE(), status=1, remark='".$remark."'
	where task_id='".$task_id."' and id='".$id."';");	
	mysql_close();
}

function getDoneTask($id)
{
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$currentweek=date('W');
	$q=mysql_query("SELECT * FROM task where id='".$id."' and week='".$currentweek."' order by deadline;");
	$arr1=array();
	$i=0;
	while($row = mysql_fetch_array($q))
	{
		$done=$row['status'];
		if($done==1)
		{
			$arr1[$i]=$row['task_id'];
			$i=$i+1;		
		}		
	}
	mysql_close();
	return $arr1;
}

function getTask($task_id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM task where task_id='".$task_id."'");
	$row = mysql_fetch_array($q);
	mysql_close();
	return $row;
}

function getUnDoneTask($id)
{
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM task where id='".$id."' and status=0 order by deadline");	
	$arr1=array();
	$i=0;
	while($row = mysql_fetch_array($q))
	{
		$arr1[$i]=$row['task_id'];
		$i=$i+1;
	}
	mysql_close();
	return $arr1;
}
/*
function getDepartment_member11($aa)//for attendence.php
{
	//$aa=getDepartment_id($id);
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM depmember where dep_id='".$aa."'");
	$arr=array();
	$i=0;
	while($row = mysql_fetch_array($q))
	{	
		$memberid=$row['member_id'];	
		//echo $memberid;
		$arr[$i+1]=$memberid;
		$i=$i+1;
	}
	mysql_close();
	$arr[0]=$i;

/*	for($j=0;$j<$i;$j++){
		if($arr[$j]!=$_SESSION['id']){
			
			echo getName($arr[$j]);
			echo "<br>";
		}
	}

	return $arr;
	return $i;
}
*/
function IsVP($id)
{	
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM department WHERE dep_vp ='".$id."'");
	$row = mysql_fetch_array($q);	
	if ($row>=1)
	{
		return 1;
	}
	else return 0;
}

function isTLinDep($id,$dep_id)
{	
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM team , teamleader WHERE team.team_dep='".$dep_id."' and teamleader.leader='".$id." and teamleader.team=team.team_id';");
	$row = mysql_fetch_array($q);	
	if ($row>=1)
	{
		return 1;
	}
	else return 0;					
}

function attendence($id)  //needs to be updated by the admin after every event.
{
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("update attendence SET Event2='1' WHERE MemberID='$id';");
	mysql_close();
}

function getTerm(){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$w=date('W');
	$q=mysql_query("SELECT * FROM terms where startweek<='".$w."' and endweek>='".$w."';");
	$row = mysql_fetch_array($q);
	mysql_close();
	return $row['name'];
}

function getTermStartWeek($term){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$w=date('W');
	$q=mysql_query("SELECT * FROM terms where name='".$term."' order by start desc ;");
	$row = mysql_fetch_array($q);
	mysql_close();
	return $row['startweek'];
}

function getTermEndDate($term){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$w=date('W');
	$q=mysql_query("SELECT * FROM terms where name='".$term."' order by start desc ;");
	$row = mysql_fetch_array($q);
	mysql_close();
	return $row['end'];
}

function getTermEndWeek($term){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$w=date('W');
	$q=mysql_query("SELECT * FROM terms where name='".$term."' order by start desc ;");
	$row = mysql_fetch_array($q);
	mysql_close();
	return $row['endweek'];
}

function OTF($id,$week)
{	
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$arr=array();
	$q=mysql_query("SELECT * FROM task where id='".$id."' and week='".$week."';");
	$i=0; //i= number of tasks due in this week
	$done=0; // number of done tasks in the week
	$aa=0;	// summation of priorities of the done tasks
	$bb=0;  // summation of priorities of all the tasks
	while($row = mysql_fetch_array($q))
	{
		$arr[$i]=$row['task_id'];
		$i=$i+1;
		$bb=$bb+$row['priority'];
		//echo $days;
		if($row['status']==1)
		{
			$comp=strtotime($row['done']);
			$dead=strtotime($row['deadline']);
			if(($dead-$comp)>=0){
				$done=$done+1;
				$aa=$aa+$row['priority'];
			}
		}
	}
	//echo $done;
	//echo "<br>";	
	//echo $i;
	//echo "<br>";
	if($i!=0){
		$a[0]=($done*100.0)/$i;
		$a[0] = sprintf('%0.2f', $a[0]);
		$a[1]=($aa*100.0)/$bb;
		$a[1] = sprintf('%0.2f', $a[1]);
	}
	else{
		$a[0]=-1;
		$a[1]=-1;
	}
	mysql_close();
	return $a;
}


function TotalOTF($id,$term)
{	
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM terms where name='".$term."';");
	$row = mysql_fetch_array($q);
	$startweek=$row['startweek'];
	$endweek=$row['endweek'];
	$arr=array();
	$q=mysql_query("SELECT * FROM task where id='".$id."' and week between '".$startweek."' and '".$endweek."';");
	$i=0; //i= number of tasks due in this week
	$done=0; // number of done tasks in the week
	$aa=0;	// summation of priorities of the done tasks
	$bb=0;  // summation of priorities of all the tasks
	while($row = mysql_fetch_array($q))
	{
		$arr[$i]=$row['task_id'];
		$i=$i+1;
		$bb=$bb+$row['priority'];
		//echo $days;
		if($row['status']==1)
		{
			$comp=strtotime($row['done']);
			$dead=strtotime($row['deadline']);
			if(($dead-$comp)>=0){
				$done=$done+1;
				$aa=$aa+$row['priority'];
			}
		}
	}
	//echo $done;
	//echo "<br>";	
	//echo $i;
	//echo "<br>";
	if($i!=0){
		$a[0]=($done*100.0)/$i;
		$a[0] = sprintf('%0.2f', $a[0]);
		$a[1]=($aa*100.0)/$bb;
		$a[1] = sprintf('%0.2f', $a[1]);
	}
	else{
		$a[0]=-1;
		$a[1]=-1;
	}
	mysql_close();
	return $a;
}
	
function isAdmin($id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM admin WHERE id ='".$id."'");
	$row = mysql_fetch_array($q);	
	if ($row>=1)
	{
		return 1;
	}
	else return 0;
}

function printProfilePicture($link,$userid,$size){
	if($link==0){
	$a='<img class="profilepic" style="background-image:url(img/photo/'.getImage($userid).');" src="img/head.png" width="'.$size.'px">';
	}
	else{
		$a='<a href="profile.php?id='.$userid.'"><img class="profilepic" style="background-image:url(img/photo/'.getImage($userid).');" src="img/head.png" width="'.$size.'px"></a>';
	}
	return $a;	
}

function printOverallOTF($userid){
	$a=TotalOTF($userid,getTerm());
	if($a[0]!=-1){
		echo "<strong>OTF:</strong> ".$a[0]."<br>";
		echo "<strong>Weighted OTF:</strong> ".$a[1]."<br>";
	}
	else
		echo "<strong>No Task Given.</strong><br>";
}

function getUnapprovedTask($myid){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM task where assby='".$myid."' and approved=0 and status=1 order by deadline");	
	$arr1=array();
	$i=0;
	while($row = mysql_fetch_array($q))
	{
		$arr1[$i]=$row['task_id'];
		$i=$i+1;
	}
	mysql_close();
	return $arr1;	
}

function getAssignedUndoneTask($myid){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM task where assby='".$myid."' and status=0 order by deadline");	
	$arr1=array();
	$i=0;
	while($row = mysql_fetch_array($q))
	{
		$arr1[$i]=$row['task_id'];
		$i=$i+1;
	}
	mysql_close();
	return $arr1;	
}

function aTask($task_id,$id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	//echo $deadline;
	$q=mysql_query("update task set
	approved=1
	where task_id='".$task_id."' and assby='".$id."';");	
	mysql_close();
}

function dTask($task_id,$id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	//echo $deadline;
	$q=mysql_query("update task set
	status=0
	where task_id='".$task_id."' and assby='".$id."';");	
	mysql_close();
}

function getAllMembers(){
	$list=array();
	$z=0;
	for($a=1;$a<=16;$a++){
		$l=getDepartmentMembers($a);
		for($b=0;$b<sizeof($l);$b++){
			$list[$z++]=$l[$b];
		}
	};
	return $list;
}

function getSubScore($mem_id){
	$year=date('Y');
	$term=getTerm();
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("select * from ".$term.$year." where id='".$mem_id."';");
	$row=mysql_fetch_array($q);	
	mysql_close();
	return $row;
}

function getColor($a){
	if($a==0)
		$color="bgcolor='#FFFFFF'";
	else if($a==1)
		$color="bgcolor='#FF7575'";
	else if($a==2)
		$color="bgcolor='#FFCC00'";
	else if($a==3)
		$color="bgcolor='#8FD658'";
	return $color;
}

function getEventColor($a){
	if($a==-1)
		$color="bgcolor='#FFFFFF'";
	if($a==1)
		$color="bgcolor='#FF7575'";
	else if($a==3)
		$color="bgcolor='#8FD658'";
	else if($a==2)
		$color="bgcolor='#FFCC00'";
	else if($a==0)
		$color="bgcolor='#FFFFFF'";
	return $color;
}

function updateSubScore($id,$week,$score){
	$year=date('Y');
	$term=getTerm();
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	echo "hellofunction";
	$q=mysql_query("update ".$term.$year." set w".$week."='".$score."' where id='".$id."'");
	mysql_close();
}

function updateEventAttendance($id,$event,$attend){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("update attendence set e".$event."='".$attend."' where MemberID='".$id."'");
	mysql_close();
}

function getEvents(){
	$t=getTerm();
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("select * from terms where name='".$t."';");
	$term=mysql_fetch_array($q);
	$q=mysql_query("select * from event where date between '".$term['start']."' and '".$term['end']."';");
	$z=0;
	$List=array();
	while($row=mysql_fetch_array($q)){
		$List[$z++]=$row;
	}
	mysql_close();
	return $List;
}

function getEventAttendance($memid){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("select * from attendence where MemberID='".$memid."';");
	$row=mysql_fetch_array($q);	
	mysql_close();
	return $row;
}

function getRegisteredUsers(){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("select * from user where id not in (select id from member) order by password;");
	$a=array();
	$i=0;
	while($row=mysql_fetch_array($q))
	{
		$a[$i++]=$row;
	}
	mysql_close();
	return $a;
}

?>