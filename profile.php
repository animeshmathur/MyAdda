<?php require_once "phpuploader/include_phpuploader.php" ?>
<?php 
include("session.php");
include("mysqlconnect.php");
?>
<html>
<head>
<title>My Adda</title>
<?php include("head.php"); ?>
</head>
<body>
<div id="wrap">
<script language="javascript" type="text/javascript">
<!--
function chatpopitup(url) {
	newwindow=window.open(url,'chat','height=600,width=500');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>
<div id="top" class="main_top">
<div id="topLeft" class="main_top">
<img src="images/myadda.jpg" height="60px" width="165px"/>
</div>
<script src="include/jquery.form.js"></script>
<script>
$(document).ready(
function()
{
$("#change_dp_button").html("Change Picture")
}
);

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
<table cellpadding="10" style="float:right;text-align:center;height:100%;">
<tr>
<td><form action=searchfriendsubmit.php method="post"><input type="text" name="sname" placeholder="Search your friend" style="width:450px;color:#AAAAAA;border-radius:12px;padding:3px 10px;"/></form></td>
<td class="top_navigations"><a href="account_settings.php" style="font-size:14px;color:#AAAAAA;">|&nbsp;<i><b>Settings</b></i>&nbsp;|</a></td>
<td class="top_navigations"><a href="logout.php" style="font-size:16px;color:#FF6666;"><b>LOGOUT</b></a></td>
<td><button id="show_top_navigations_button" style="font-size:10px;color:#CCCCCC;background-color:#666666;border-radius:5px;" onClick="showTopNavigations();">&nabla;</button></td>
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
</div>
<div id="content">
<div id="left" style="width:20%;float:left">
<style>
#change_dp_form *,.AjaxUploaderProgressTable *,.AjaxUploaderProgressBaCuteWebUIxt,.AjaxUploaderQueueTable *
{
max-width:250px;
}
.AjaxUploaderProgressInfoText
{
visibility:hidden;
}
#AjaxUploaderFilesButton
{
background-color:#4D4c4c;
font-size:15px;
color:#FFFFFF;
height:35px;
border-radius:10px;
}
.profile
{
text-align:center;
padding:20px 20px;
border-radius:10px;
}
</style>
<?php
$res1=mysql_query("select * from register where uid='".$uid."'");
$res2=mysql_query("select * from profile where uid='".$uid."'");
if($row1=mysql_fetch_array($res1))
{
	echo "<center><h2>".$row1['uname']."</h2><div style=\"height:205px;width:220px\"><img src=\"upload/".$row1['dp']."\" style=\"max-width:100%\"></div><br><div id=\"dpchanger\" style=\"width:100%;overflow:hidden;\">";
?>	
	<center><div id="change_dp_form" style="overflow:hidden;"><p id="dp_status"></p>
	<script type='text/javascript'>
	function CuteWebUI_AjaxUploader_OnTaskComplete(task)
	{
		$("#dp_status").html("<font color=000000>Picture Changed!</font>");
		window.setTimeout('location.reload()', 3000);
	}
	</script>

	<?php
	//echo "<form action=\"changedpsubmit.php\" method=\"post\" enctype=\"multipart/form-data\" name=dpform id=\"change_dp_form\"><table><tr><td>Select New Picture (max. size 1MB):<br><input type=\"file\" name=\"file\" id=\"file\"><br><input type=\"submit\" value=\"Change\">&nbsp;&nbsp;&nbsp;<input type=button id=\"change_dp_cancel_button\" value=\"Cancel\"></td></tr></table></form></center>";
	$uploader=new PhpUploader();

		$uploader->MultipleFilesUpload=false;
		$uploader->InsertText="Change Picture";
		
		$uploader->MaxSizeKB=1024;
		$uploader->AllowedFileExtensions="*.jpeg,*.jpg,*.png,*.gif,*.bmp,*.JPEG,*.JPG,*.PNG,*.GIF,*.BMP";
		
		$uploader->UploadUrl="changedpsubmit.php";
		
		$uploader->Render();
	
	echo "</div></center></div></center>";	
if(mysql_num_rows($res2))
{
if($row2=mysql_fetch_array($res2))
{
	$bday="";
	switch(substr($row1['dob'],5,2))
	{
	case "01":
	$bday=substr($row1['dob'],8)." Jan";
	break;
	case "02":
	$bday=substr($row1['dob'],8)." Feb";
	break;
	case "03":
	$bday=substr($row1['dob'],8)." March";
	break;
	case "04":
	$bday=substr($row1['dob'],8)." April";
	break;
	case "05":
	$bday=substr($row1['dob'],8)." May";
	break;
	case "06":
	$bday=substr($row1['dob'],8)." June";
	break;
	case "07":
	$bday=substr($row1['dob'],8)." July";
	break;
	case "08":
	$bday=substr($row1['dob'],8)." August";
	break;
	case "09":
	$bday=substr($row1['dob'],8)." Sep";
	break;
	case "10":
	$bday=substr($row1['dob'],8)." Oct";
	break;
	case "11":
	$bday=substr($row1['dob'],8)." Nov";
	break;
	case "12":
	$bday=substr($row1['dob'],8)." Dec";
	break;
	}
	echo "<br><center><table style=\"min-width:16%;text-align:center;\">";
	if($row2['nickname']!="")
	echo "<tr><td><b><font size=4px color=#4d4c4c>a.k.a - </font></b>".$row2['nickname']."</td><td></td></tr>";
	echo "<tr><td><b><font size=4px color=#4d4c4c>B day - </font></b>".$bday."</td><td><br><br><br></td></tr>";
	echo "<tr><td><b><font size=4px color=#4d4c4c>Place - </font></b>".$row1['ucity']."</td><td></td></tr>";
	echo "<tr><td><b><font size=4px color=#4d4c4c>E mail - </font></b>".$row1['umail']."</td><td></td></tr>";
	echo "</table></center>";
}
}
?>
</div>
<div id="right" style="width:80%;float:left;"><br>
<h1 style="font-weight:normal;color:#c40e0e">:: <font color="#000000">....</font> <font color="#1a0f80"><b>My Profile</b></font> <font color="#000000">....</font> ::</h1>
<?php
$res2=mysql_query("select * from profile where uid='".$uid."'");
if(!mysql_num_rows($res2))
{
echo "<br><font color=#c40e0e size=12px>*** No Profile Created Yet ***</font><br><br><a href=createprofile.php style=font-size:16px;color:#4D4C4C;><b>: Create Your Profile :<b></a><br><br>";
}
else
{
if($row2=mysql_fetch_array($res2))
{
	echo "<div style=\"width:100%;\">";
	echo "<center>";
	echo "<table class=\"profile\" id=\"basic_details\" style=\"max-width:80%;background-color:#bbbaba;border-radius:10px;\">";
	echo "<tr><td><b><font size=4px color=\"#4d4c4c\">Gender: </font></b></td><td>".$row1['ugender']."</td></tr>";
	echo "</table><br>";
	echo "<center><table class=\"profile\" style=\"text-align:center;background-color:#bbbaba;padding:10px 10px;border-radius:10px;\"><tr>";
	if($row2['age']!="")
	echo "<td><b><font size=4px color=#4d4c4c>Age : </font></b><i>".$row2['age']."</i></td>";
	echo "</tr></table></center><br>";
	if($row2['favmovie']!=""||$row2['favcelebrity']!=""||$row2['favsinger']!=""||$row2['favmusic']!=""||$row2['bestfrnd']!="")
	{
	echo "<table class=\"profile\" style=\"font-size:15px;background-color:#bbbaba;\">";
	echo "<caption><font size=4px color=#4d4c4c><b>My Favorites</b></font></caption>";
	if($row2['favmovie']!="")
	echo "<tr><td><b>Movie: </b></td><td>".$row2['favmovie']."</td></tr>";
	if($row2['favcelebrity']!="")
	echo "<tr><td><b>Celebrity: </b></td><td>".$row2['favcelebrity']."</td></tr>";
	if($row2['favsinger']!="")
	echo "<tr><td><b>Singer: </b></td><td>".$row2['favsinger']."</td></tr>";
	if($row2['favmusic']!="")
	echo "<tr><td><b>Music: </b></td><td>".$row2['favmusic']."</td></tr>";
	if($row2['bestfrnd']!="")
	echo "<tr><td><b>My Best Buddies: </b></td><td>".$row2['bestfrnd']."</td></tr>";
	echo "</table><br>";
	}
	
	echo "<table class=\"profile\" style=\"font-size:15px;background-color:#bbbaba;\">";
	if($row2['myinfo']!="")
	echo "<tr><td><b><font size=4px color=#4d4c4c>About Me: </font></b></td><td>".$row2['myinfo']."</td></tr>";
	if($row2['relstatus']!="")
	echo "<tr><td><b><font size=4px color=\"#4d4c4c\">Relationship Status: </font></b></td><td>".$row2['relstatus']."</td></tr>";
	if($row2['hobbies']!="")
	echo "<tr><td><b><font size=4px color=\"#4d4c4c\">My Hobbies: </font></b></td><td>".$row2['hobbies']."</td></tr>";
	echo "</table>";
	echo "<br><a href=\"updateprofile.php\"> :: Update Profile ::</a><br><br></center></div>";
}	
}
}	
?>
</div>

</div>

<br>
</body>
</html>