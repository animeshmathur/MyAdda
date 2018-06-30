<?php
include("session.php");
include("mysqlconnect.php");
$sname=$_REQUEST["sname"];
$sname=str_replace("'","''",$sname);
?>
<html>
<head>
<?php include("head.php");?>
<title>My Adda</title>
<script>
function addFriend(reqto)
{
$(document).ready(
function()
{
document.getElementById('friend_request_'+reqto).innerHTML="<font color=#0066CC>Sending Request...</font>";
$.post("addfriend.php","fid="+reqto,
function(data,status)
{
document.getElementById('friend_request_'+reqto).innerHTML=data;
}
);
}
);
}
</script>
</head>
<body>
<div id="wrap">
<?php
include("mainlinks.php");
?>
<div id="content" style="background-position:0px 60px;background-repeat:no-repeat;background-attachment:fixed;background-image:url(images/friends.jpg);min-height:739;width:100%;">
<center>
<br><br>
<?php
$q="select * from register where uname like '%".$sname."%' and not uid='".$uid."'";
$res=mysql_query($q);
//echo $q."<br>".$res;
echo "<h2 style=\"color:#c40e0e;width:50%;border-radius:20px\">.... <font color=1a0f80>Search Result(s) for <font color=c40e0e>::</font> <font color=#ffffff>".$sname." <font color=c40e0e>....</font></font></h2>";
echo "<table border=0 cellpadding=5 style=\"text-align:center;background-color:#dddddd;opacity:0.9;border-radius:10px;\">";
$count=1;
if(mysql_num_rows($res))
{
	while($row=mysql_fetch_array($res))
	{
		if($count%2!=0)
		{
			echo "<tr>";
		}
		echo "<td><img src=upload/".$row['dp']." height=80px></td><td><b><a href=userprofile.php?rid=".$row['reg_id']." style=\"text-color=#2d2c2c font-size=6px\"><font color=#c40e0e size=4px>".$row['uname']."</font><b></a></td>";
		$res1=mysql_query("select * from friends where reqfrom='".$uid."' and reqto='".$row['uid']."' or reqfrom='".$row['uid']."' and reqto='".$uid."'");
		if(!mysql_num_rows($res1))
		{
				echo "<td id=\"friend_request_".$row['uid']."\" style=\"padding-right:80px;\"><button onclick=\"addFriend('".$row['uid']."');\" style=\"background-color:#373737;color:#FFFFFF;border-radius:15px;height:35px\"><b>Add as a Friend ?</b></button></td>";
		}
		else
		{
			if($row1=mysql_fetch_array(mysql_query("select * from friends where reqfrom='".$uid."' and reqto='".$row['uid']."' and status='accepted' or reqfrom='".$row['uid']."' and reqto='".$uid."' and status='accepted'")))
			{																																				
				echo "<td style=\"padding-right:80px;size:16px\"><b><font color=#118a2e size=4px>is your Friend</font></b></td>";
			}
			else
			{
				echo "<td style=\"padding-right:80px;\"><b><font color=#ff6666 size=4px>(Friend request pending)</font></b></td>";
			}
		}
		if($count%2==0)
		{
		echo "</tr>";
		$count++;	
		}
		else
		{
		$count++;
		}
		
	}
}
else
{
	echo "<tr><td><font color=c40e0e size=10px> * No Record Found * </font></td></tr>";
}
?>
</table>
</center>
</div>
</div>
</body>
</html>