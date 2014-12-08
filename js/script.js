// JavaScript Document

function addtask()
{
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		}
	}
	var mem_id=document.getElementById('mem_id').value;
	var title=document.getElementById('tasktitle').value;
	var description=document.getElementById('taskdes').value;
	var priority=document.getElementById('taskpriority').value;
	var deadline=document.getElementById('taskdeadline').value;
	var parameter="title="+title+"&des="+description+"&priority="+priority+"&deadline="+deadline;
	if(!((title=="")||(description=="")||(priority==""))){
		xmlhttp.open("POST","addtask.php?mem_id="+mem_id, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameter);
		$('#myModal').modal('hide');
	}
	else
	{
		document.getElementById('ModalError').innerHTML="<div class='alert alert-error'>Please add a proper Task</div>";	
	}
}

function updateactivity(str,num)
{
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			if(str=='1'){
				document.getElementById("act"+num).bgColor="#FF7575";
				document.getElementById("act1"+num).bgColor="#FF7575";
			}
			else if(str=='2'){
				document.getElementById("act"+num).bgColor="#FFCC00";
				document.getElementById("act1"+num).bgColor="#FFCC00";
			}
			else if(str=='3'){
				document.getElementById("act"+num).bgColor="#8FD658";
				document.getElementById("act1"+num).bgColor="#8FD658";
			}
		}
	}
	var id=document.getElementById('id'+num).value;
	var week=document.getElementById('week'+num).value;
	var color=document.getElementById('color'+num).value;
	var parameter="id="+id+"&week="+week+"&color="+color;
	xmlhttp.open("POST","changeSubScore.php",id,week,color, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(parameter);
}

function newPopup(url) {
		  var w=400;
		  var h=520;
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		popupWindow = window.open(
			url,'popUpWindow','toolbar=0, location=0, directories=0, status=0, menubar=0, scrollbars=0, resizable=0, copyhistory=0, width='+w+', height='+h+', top='+top+', left='+left);
}

function getModalContent(str)
{
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById('myModal').innerHTML=xmlhttp.responseText;
		}
	}
	//var parameter="id="+id+"&week="+week+"&color="+color;
	xmlhttp.open("GET","addtask.php?mem_id="+str, true);
	//xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//xmlhttp.send(parameter);
	xmlhttp.send();
}