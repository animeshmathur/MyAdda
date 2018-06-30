<?php 
include("session.php");
include("mysqlconnect.php");
$v_rid=$_REQUEST['rid'];
$v_uid="";
?>
<html>
<head>
<title>My Adda</title>
<?php include("head.php"); ?>
</head>
<body>
<div id="wrap">
<?php include("mainlinks.php");?>
<div id="content">
<br><br>
<div id="left" style="width:280px;float:left">
<?php
$res1=mysql_query("select * from register where reg_id='".$v_rid."'");
if($row1=mysql_fetch_array($res1))
{
$v_uid=$row1['uid'];
$res2=mysql_query("select * from profile where uid='".$v_uid."'");
	$uname=$row1['uname'];
	echo "<center><h2>".$row1['uname']."</h2><div style=\"height:150px;width:180px\"><img src=\"upload/".$row1['dp']."\" height=100% style=\"max-width:100%\"></div></center>";
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
	$bday=substr($row1['dob'],8)." Mar";
	break;
	case "04":
	$bday=substr($row1['dob'],8)." Apr";
	break;
	case "05":
	$bday=substr($row1['dob'],8)." May";
	break;
	case "06":
	$bday=substr($row1['dob'],8)." Jun";
	break;
	case "07":
	$bday=substr($row1['dob'],8)." Jul";
	break;
	case "08":
	$bday=substr($row1['dob'],8)." Aug";
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
	echo "<center><table style=\"min-width:16%;text-align:center;\">";
	echo "<tr><td><b><font size=4px color=#4d4c4c>B day - </font></b>".$bday."</td><td><br><br><br></td></tr>";
	echo "<tr><td><b><font size=4px color=#4d4c4c>Place - </font></b>".$row1['ucity']."</td><td></td></tr>";
	echo "<tr><td><b><font size=4px color=#4d4c4c>E mail - </font></b>".$row1['umail']."</td><td></td></tr>";
	echo "</table></center>";
	?>
</div>
<div id="right" style="width:78%;float:right;">
<h1 style="font-weight:normal;color:#c40e0e">:: <font color="#000000">....</font> <font color="#1a0f80"><b><?php echo strtok($uname, " ");?>'s Profile</b></font> <font color="#000000">....</font> ::</h1>
	<?php
	echo "<div style=\"width:75%;float:left;\">";
	echo "<center><table cellspacing=10 class=\"profile\" id=\"basic_details\" style=\"max-width:80%;background-color:#bbbaba;border-radius:10px;\">";
	echo "<tr><td><b><font size=4px color=\"#4d4c4c\">Gender: </font></b></td><td>".$row1['ugender']."</td></tr>";
	echo "</table></center><br>";
}
if(!mysql_num_rows($res2))
{
echo "<br><font color=#c40e0e size=4px>*** Seems <b>".$uname."</b> is a new member and has not completed the profile yet. ***</font>";
}
if($row2=mysql_fetch_array($res2))
{
	echo "<center>";
	echo "<center><table class=\"profile\" style=\"text-align:center;background-color:#bbbaba;padding:10px 10px;border-radius:10px;\"><tr>";
	if($row2['nickname']!="")
	echo "<td style=\"padding-right:30px;\"><b><font size=4px color=#4d4c4c>a.k.a : </font></b><i>".$row2['nickname']."</i></td>";
	if($row2['age']!="")
	echo "<td><b><font size=4px color=#4d4c4c>Age : </font></b><i>".$row2['age']."</i></td>";
	echo "</tr></table></center><br>";
	if($row2['favmovie']!=""||$row2['favcelebrity']!=""||$row2['favsinger']!=""||$row2['favmusic']!=""||$row2['bestfrnd']!="")
	{
	echo "<table class=\"profile\" style=\"font-size:15px;background-color:#bbbaba;padding:10px 10px;border-radius:10px;max-width:88%;\">";
	echo "<th><font size=4px color=#4d4c4c><b>Favorites:</b></font></th>";
	if($row2['favmovie']!="")
	echo "<tr><td><b><i>Movie: </i></b></td><td><i>".$row2['favmovie']."</i></td></tr>";
	if($row2['favcelebrity']!="")
	echo "<tr><td><b><i>Celebrity: </i></b></td><td><i>".$row2['favcelebrity']."</i></td></tr>";
	if($row2['favsinger']!="")
	echo "<tr><td><b><i>Singer: </i></b></td><td><i>".$row2['favsinger']."</i></td></tr>";
	if($row2['favmusic']!="")
	echo "<tr><td><b><i>Music: </i></b></td><td><i>".$row2['favmusic']."</i></td></tr>";
	if($row2['bestfrnd']!="")
	echo "<tr><td><b><i>My Best Buddies: </i></b></td><td><i>".$row2['bestfrnd']."</i></td></tr>";
	echo "</table><br>";
	}
	
	echo "<table class=\"profile\" style=\"font-size:15px;background-color:#bbbaba;padding:10px 10px;border-radius:10px;\">";
	if($row2['myinfo']!="")
	echo "<tr><td><b><font size=4px color=#4d4c4c>About Me: </font></b></td><td>".$row2['myinfo']."</td></tr>";
	if($row2['relstatus']!="")
	echo "<tr><td><b><font size=4px color=\"#4d4c4c\">Relationship Status: </font></b></td><td>".$row2['relstatus']."</td></tr>";
	if($row2['hobbies']!="")
	echo "<tr><td><b><font size=4px color=\"#4d4c4c\">My Hobbies: </font></b></td><td>".$row2['hobbies']."</td></tr>";
	echo "</table><br>";
	echo "</center>";
}
?>
</div>
<div id="user_friends" style="float:right;width:25%;height:400px;overflow-y:scroll;background-color:#EEEEEE;border-radius:20px;">
<?php
$res3=mysql_query("select * from friends where reqfrom='".$v_uid."' and status='accepted' or reqto='".$v_uid."' and status='accepted'");
if(mysql_num_rows($res3))
{
	echo "<table border=0 cellpadding=5 style=\"text-align:center;width:100%;\"><caption><h4>:: ... <i>Also Knows<i> ... ::</h4></caption>";
	while($row3=mysql_fetch_array($res3))
	{
		echo "<tr>";
		$res4=mysql_query("select * from register where uid='".$row3['reqfrom']."' and not uid='".$v_uid."' or uid='".$row3['reqto']."' and not uid='".$v_uid."'");
		if($row4=mysql_fetch_array($res4))
		{
			echo "<td style=\"padding-left:40px;\"><img src=upload/".$row4['dp']." height=40px></td><td>";
			if($row3['reqfrom']==$v_uid)
			{
				if($row3['reqto']!=$uid)
				echo "<a href=userprofile.php?rid=".$row4['reg_id'];
				else
				echo "<a href=profile.php";
			}
			else
			{
				if($row3['reqfrom']!=$uid)
				echo "<a href=userprofile.php?rid=".$row4['reg_id'];
				else
				echo "<a href=profile.php";
			}
			echo " style=\"text-decoration:none;font-size:14px;\">".$row4['uname']."</a></td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
?>
</div>
</div>
</div>
</div>
</body>
</html>