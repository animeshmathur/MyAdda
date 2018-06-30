<?php
include("session.php");
include("mysqlconnect.php");
?>
<html>
<head>
<title>My Adda</title>
<?php
include("head.php");
?>
<script>
function makeMessage(fid,fname)
{
document.getElementById('send_message').innerHTML="<table width=\"100%\" id=\"msg_to\"><caption style=\" background-color:#4D4C4C;color:#FFFFFF;\">Sending Message To : "+fname+"<button style=\"color:#FF0000;float:right;\" onclick=\"cancelMessage();\">x</button></caption><tr><td><input type=\"hidden\" id=\"msgto\" value=\""+fid+"\" style=\"width:100%;\" readonly=true></td></tr><tr><td><textarea id=\"msgtext\" style=\"width:100%;height:160px;overflow-y:scroll;\"></textarea></td></tr><tr><td><button id=\"send_message_button\" style=\"width:150px;color:#0066CC;\" onclick=\"sendMessage();\">Send</button><div id=\"send_message_status\" style=\"float:right;\"></div></td></tr></table>";
return false;
}

function cancelMessage()
{
document.getElementById('send_message').innerHTML="";
}

function sendMessage()
{
//alert("chk");
$(document).ready(
function()
{
document.getElementById('send_message_status').innerHTML="<font color=#0066CC>Sending...</font>";
$.post("sendmessagesubmit.php","msgto="+document.getElementById('msgto').value+"&msgtext="+document.getElementById('msgtext').value,
function(data,status)
{
document.getElementById('send_message_status').innerHTML=data;
}
);
}
);
}

function confirmFriendRemove()
{
if(confirm("Are you sure.. you want remove this friend?"))
{
return true;
}
else
{
return false;
}
}
</script>
</head>
<body>
<div id="wrap">
<?php include("mainlinks.php")?>
<div id="content" style="background-position:0px 60px;background-repeat:no-repeat;background-attachment:fixed;background-image:url(images/friends.jpg);width:100%;min-height:624;">
<center><br>
<h1 style="font-weight:normal;color:#c40e0e">:: <font color="#ffffff">....</font> <font color="#1a0f80"><b>My Friends</b></font> <font color="#ffffff">....</font> ::</h1>
<br>
<?php
$frndreq=mysql_query("select * from friends where reqto='".$uid."' and status='pending'");
if(mysql_num_rows($frndreq))
{
	echo "<br><b><font color=#c40e0e size=20px>*** You have few pending friend request(s)... <a href=\"friendrequests.php\"><i><b>Click Here</b></i></a></font></b><br>";
}
$q="select * from friends where reqfrom='".$uid."' and status='accepted' or reqto='".$uid."' and status='accepted'";
$res1=mysql_query($q);
$i=1;
if(mysql_num_rows($res1))
{
	echo "<table border=0 cellpadding=5 style=\"text-align:center;background-color:#dddddd;opacity:0.8;border-radius:10px;\">";
	while($row1=mysql_fetch_array($res1))
	{
		if($i==1)
		{
			echo "<tr>";
		}
		$res2=mysql_query("select * from register where uid='".$row1['reqfrom']."' and not uid='".$uid."' or uid='".$row1['reqto']."' and not uid='".$uid."'");
		if($row=mysql_fetch_array($res2))
		{
			echo "<td style=\"padding-left:40px;\"><img src=upload/".$row['dp']." style=\"max-width:92;\"></td><td><a href=userprofile.php?rid=".$row['reg_id']." style=\"text-decoration:none\"><b><font color=#c40e0e size=4px>".$row['uname']."</font></b></a></td><td style=\"padding-right:40px;\">&nbsp;<b><i><a href=\"#\" style=\"color:#000000;border-radius:10px\" onclick=\"makeMessage('".$row['uid']."','".$row['uname']."');\"><font color=#000000 size=3px>Send Message</font></a><br><br>
			<a href=deletefriend.php?fid=".$row['uid']." style=\"color:#ff0000;border-radius:10px\" onclick=\"return(confirmFriendRemove());\"><font color=#000000 size=3px>Delete Friend</font></a></i></b></td>";
		}
		if($i==3)
		{
			echo "</tr>";
			$i=1;
		}
		else
		{
			$i++;
		}
	}
	if($i!=1)
	{
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo "<font color=#c40e0e size=12px><b>* No Friend Available *<b></font>";
}

?>
</center>
</div>
<div id="send_message" style="position:fixed; bottom:10px; right:10px; border:thin #4D4C4C; background-color:#FFFFFF; width:460px; z-index:2;"></div>
</div>
</body>
</html>