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
$(document).ready(
function()
{
$("#create_album_form").hide();
}
);

$(document).ready(
function()
{
$("#create_album_button").click(
function()
{
$("#create_album_button").fadeOut(
function()
{
$("#create_album_form").show();
}
);
}
);
}
);

$(document).ready(
function()
{
$("#create_album_cancel_button").click(
function()
{
$("#create_album_form").fadeOut(
function()
{
$("#create_album_button").show();
}
);
}
);
}
);

$(document).ready(
function()
{
$("#create_album_submit_button").click(
function()
{
document.getElementById("create_album_status").innerHTML="Please Wait...";
$.post("createalbumsubmit.php","atitle="+document.getElementById("new_album_title").value,
function(data,status)
{
document.getElementById("create_album_status").innerHTML=data;
window.setTimeout('location.reload()', 3000);
}
);
}
);
}
);
</script>

</head>
<body>
<div id="wrap">
<?php
include("mainlinks.php");
?>
<div id="content" style="background-position:0px 60px;background-repeat:no-repeat;background-attachment:fixed;background-image:url(images/albums.jpg);min-height:739;width:100%;">
<center>
<br><br>
<h1 style="font-weight:normal;color:#c40e0e">:: <font color="#000000">....</font> <font color="#1a0f80"><b>My Albums</b></font> <font color="#000000">....</font> ::</h1>
<?php
$res=mysql_query("select * from albums where uid='".$uid."'");
if(mysql_num_rows($res))
{
	$i=1;
	echo "<table cellspacing=20 style=\"text-align:center;background-color:#4d4c4c;opacity:0.8;border-radius:20px;\">";
	while($row=mysql_fetch_array($res))
	{
		if($i==1)
		{
			echo "<tr>";
		}
		echo "<td style=\"height:150px;width:180px;background-color:#ffffff;border-radius:20px;\"><a href=\"viewalbum.php?albumid=".$row['albumid']."\"><img src=\"upload/album_photos/".$row['albumcover']."\" width=100% height=100%><br>".$row['atitle']."</a></td>";
		$i++;
		if($i==5)
		{
			echo "</tr>";
			$i=1;
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
	echo "<font color=#000000>* No Album Available *</font>";
}
?>

<p id="create_album_status"></p>
<button id="create_album_button" style="background-color:#373737;font-size:15px;color:#FFFFFF;height:35px;border-radius:10px;"> Create New Album </button>
<div id="create_album_form" style="border:double thick #FFFFFF;background-color:4d4c4c;color:#E5E5E5;width:500px;border-radius:10px">
<h3>Create New Album</h3>
<table style="color:#FFFFFF">
<tr><td>Album Title: </td><td><input type="text" id="new_album_title" name="atitle"></td><td><input type="button" id="create_album_submit_button" value="Create"></td><td><button id="create_album_cancel_button">Cancel</button></td></tr>
</table>
</div>
</center>
</div>
</div>
</body>
</html>