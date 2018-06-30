<script language="javascript" type="text/javascript">
<!--
function chatpopitup(url) {
	newwindow=window.open(url,'chat','height=600,width=500');
	if (window.focus) {newwindow.focus()}
	return false;
}

//-->
</script>
<div id="top" class="main_top">
<div id="topLeft" class="main_top">
<img src="images/logo.jpg" height="80%" width="92px"/>
</div>
<script>
$(document).ready(showTopNavigations());

function hideTopNavigations()
{
$(document).ready(
function()
{
$("#show_top_navigations_button").hide();
$(".top_navigations").hide("slow",
function()
{
$("#top").css("opacity","0.85");
$("#show_top_navigations_button").show();
}
);
}
);
}

function showTopNavigations()
{
$(document).ready(
function()
{
$("#show_top_navigations_button").hide();
$(".top_navigations").fadeIn("slow",
function()
{
$("#top").css("opacity","1");
}
).delay(6000);
hideTopNavigations();
}
);
}
</script>
<div id="topRight">
<?php

$res=mysql_query("select uname,dp from register where uid='".$uid."'");
if($row=mysql_fetch_array($res))
{
echo "<table style=\"color:#f2f2f2;font-size:18px;text-align:center;position:fixed;z-index:2;\">";
echo "<tr><td style=\"width:200px\"><b>".$row['uname']."</b></td></tr>";
echo "<tr><td style=\"width:75px\"><a href=profile.php><img src=upload/".$row['dp']." style=\"height:82px;\" draggable=false ondragstart=\"return false\" oncontextmenu=\"return false\"></a></td></tr>";
echo "</table>";
}
?>
<table cellpadding="10" style="float:right;text-align:center;height:100%;">
<tr>
<td><form action=searchfriendsubmit.php method="post"><input type="text" name="sname" placeholder="Search your friend" style="width:450px;color:#AAAAAA;border-radius:12px;padding:3px 10px;"/></form></td>
<td class="top_navigations"><a href="account_settings.php" style="font-size:14px;color:#AAAAAA;">|&nbsp;<i><b>Settings</b></i>&nbsp;|</a></td>
<td class="top_navigations"><a href=logout.php style="font-size:15px;color:#FF6666;"><b>LOGOUT</b></a></td>
<td><button id="show_top_navigations_button" style="font-size:10px;color:#CCCCCC;background-color:#666666;border-radius:5px;" onclick="showTopNavigations();">&nabla;</button></td>
</tr>
</table>
</div>
<div id="navigations" class="top_navigations"> 
<a href="myhome.php" style="color:#ffffff;size:280; ">HOME</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="profile.php" style="color:#ffffff;size:280; ">PROFILE</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="friends.php" style="color:#ffffff;size:280;">FRIENDS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="messages.php" style="color:#ffffff;size:280;">MESSAGES</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="albums.php" style="color:#ffffff;size:280;">ALBUMS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="chat.php" onClick="return chatpopitup('chat.php')" style="color:#ffffff;size:280;">CHAT</a>
</div>
</div>
