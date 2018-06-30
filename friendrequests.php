<?php
include("session.php");
include("mysqlconnect.php");
?>
<html>
<head>
<title>MyAdda : FRIENDS</title>
<?php
include("head.php");
?>
<script>
function acceptFriendRequest(reqfrom)
{
$(document).ready(
function()
{
document.getElementById('friend_request_action_'+reqfrom).innerHTML="Please Wait...";
$.post("friendrequestaction.php","actiontype=accept&reqid="+reqfrom,
function(data,status)
{
document.getElementById('friend_request_action_'+reqfrom).innerHTML=data;
}
);
}
);
}

function rejectFriendRequest(reqfrom)
{
$(document).ready(
function()
{
document.getElementById('friend_request_action_'+reqfrom).innerHTML="Please Wait...";
$.post("friendrequestaction.php","actiontype=reject&reqid="+reqfrom,
function(data,status)
{
document.getElementById('friend_request_action_'+reqfrom).innerHTML=data;
}
);
}
);
}
</script>
</head>
<body>
<div id="wrap">
<?php include("mainlinks.php")?>
<div id="content" style="background-position:0px 60px;background-repeat:no-repeat;background-attachment:fixed;background-image:url(images/friends.jpg);min-height:739;width:100%;">
<center>
<br><br>
<h1 style="font-weight:normal;color:#c40e0e">:: <font color="#000000">....</font> <font color="#1a0f80"><b>Friend Requests</b></font> <font color="#000000">....</font> ::</h1>
<table border=0 cellpadding="20" style="width:600px;background-color:#dddddd;text-align:center;border-radius:10px;opacity:0.8;">
<?php
$res=mysql_query("select * from friends where reqto='".$uid."' and status='pending'");
if(mysql_num_rows($res))
{
	while($row=mysql_fetch_array($res))
	{
		$res1=mysql_query("select * from register where uid='".$row['reqfrom']."'");
		if($row1=mysql_fetch_array($res1))
		{
			echo "<tr><td><img src=\"upload/".$row1['dp']."\" height=80px></td><td><b><a href=\"userprofile.php?rid=".$row1['reg_id']."\"><font color=#c40e0e size=4px>".$row1['uname']."</font></a></b></td><td id=\"friend_request_action_".$row['reqfrom']."\" style=\"padding-right:80px;\"><button onclick=\"acceptFriendRequest('".$row['reqfrom']."');\" style=\"width:100px;color:#FFFFFF;background-color:#006600;border-radius:10px;\">Accept</button><br><br><button onclick=\"rejectFriendRequest('".$row['reqfrom']."');\" style=\"width:100px;color:#FFFFFF;background-color:#4D4C4C;border-radius:10px;\">Reject</button></td></tr>";
		}
	}
}

?>
</table>
</center>
</div>
</div>
</body>
</html>