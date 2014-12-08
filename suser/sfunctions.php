<?php


/*
define("DB_HOST", "127.0.0.1" );
define("DB_NAME", "mps");
define("DB_USER", "dumps");
define("DB_PASS", "123");

*/


date_default_timezone_set('Asia/Calcutta');

function addToTeam($mem_id,$team_id,$lead){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("select * from teammember where member_id='".$mem_id."' and team_id='".$team_id."';");
	$count=mysql_num_rows($q);
	if($count==0){
		$q=mysql_query("insert into teammember(member_id,team_id) values('".$mem_id."','".$team_id."');");
	}
	if($lead==1){
		$q=mysql_query("select * from teamleader where leader='".$mem_id."' and team='".$team_id."';");
		$count=mysql_num_rows($q);
		if($count==0){
			$q=mysql_query("insert into teamleader(leader,team) values('".$mem_id."','".$team_id."');");
		}
	}
	mysql_close();
}


function def($name,$start,$end){//To define a term
	$s=strtotime($start);
	$e=strtotime($end);
	if(($e-$s)<=0){
		return 3;
	}
	$cw=date('W');
	$sw=date('W',$s);
	$year=date('Y');
	$ew=date('W',$e);
	if($ew==1){
		$ew=53;
	}
	//if($sw-$cw<0){
		//return 2;
	//}
	$weeklist="";
	for($a=$sw;$a<=$ew;$a++){
		$weeklist.="w".$a." INT DEFAULT 0";
		if($a!=$ew)
			$weeklist.=",";
	}
	$List=getAllMembers();
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("insert into terms(start,end,name,startweek,endweek) values('".$start."','".$end."','".$name."','".$sw."','".$ew."');");
	$q=mysql_query("create table ".$name.$year."(id int,".$weeklist.");");
	for($a=0;$a<sizeof($List);$a++){
		$q=mysql_query("insert into ".$name.$year."(id) values(".$List[$a]['id'].");");
	}
	mysql_close();
	return 1;
}

function createTeam($teamname,$dep_id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT team_id from team order by team_id desc;");
	$id = mysql_fetch_array($q);
	$i= $id['team_id']+1;		
	$q=mysql_query("insert into team(team_id,team_name,team_dep) values('".$i."','".$teamname."','".$dep_id."');");
	mysql_close();
}


function checkUsernameAvailability($username){
	$username=strtolower($username);
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT * FROM user WHERE username='$username'");
	$rows=mysql_num_rows($q);
	mysql_close();
	return $rows;
}


function create($username,$password){
	$username=strtolower($username);
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT id from user order by id desc;");
	$id = mysql_fetch_array($q);
	$i= $id['id']+1;
	$pass=md5($password);		
	$q=mysql_query("insert into user(id,username,password) values('".$i."','".$username."','".$pass."');");
	mysql_close();
}


function removeuser($id){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	mysql_close();
}

function addDep($name,$vp){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("SELECT id from user where username='".$vp."';");
	$vpidarr=mysql_fetch_array($q);
	$vpid=$vpidarr['id'];
	$q=mysql_query("SELECT dep_id from department order by dep_id desc;");
	$id = mysql_fetch_array($q);
	$i= $id['dep_id']+1;		
	$q=mysql_query("insert into department(dep_id,dep_name,dep_vp) values('".$i."','".$name."','".$vpid."');");
	mysql_close();
}

function addEvent($name,$date,$scope){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	$q=mysql_query("insert into event(name,date) values('".$name."','".$date."');");
	$q=mysql_query("select event_id from event where name='".$name."' and date='".$date."';"); 
	$row=mysql_fetch_array($q);
	if($scope==1){
	$q=mysql_query("ALTER TABLE attendence ADD e".$row['event_id']." INT DEFAULT 0");
	}
	else{
	$q=mysql_query("ALTER TABLE attendence ADD e".$row['event_id']." INT DEFAULT -1");
	$q=mysql_query("update attendence set e".$row['event_id']."='0' where MemberID in (select leader from teamleader)");
	}
	mysql_close();
}

?>