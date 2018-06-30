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
</head>
<body>
<div id="wrap">
<?php include("mainlinks.php")?>
<div id="content">
<center><br>
<h1 style="font-weight:normal;color:#c40e0e">:: <font color="#ffffff">....</font> <font color="#1a0f80"><b>My Profile</b></font> <font color="#ffffff">....</font> ::</h1>
<form action="updateprofilesubmit.php" method="post">
<table style="background:#373737;color:#FFFFFF;width:60%;text-align:center;border-radius:20px;">
<?php
$res=mysql_query("select * from profile where uid='".$uid."'");
if($row=mysql_fetch_array($res))
{
	echo "<tr><td>My Nick Name: </td><td><input type=text name=nicknm value=\"".$row['nickname']."\"></td></tr><tr><td>About Me: </td><td><textarea name=myinfo columns=100 rows=4>".$row['myinfo']."</textarea></td></tr><tr><td>Age: </td><td><input type=text name=age value=\"".$row['age']."\" /></td></tr><tr><td>Relationship Status: </td><td>";
	echo "<input type=radio name=relstatus value=Single ";
	if($row['relstatus']=='Single')
	echo "checked";
	echo ">Single <input type=radio name=relstatus value=Married ";
	if($row['relstatus']=='Married')
	echo "checked";
	echo ">Married <input type=radio name=relstatus value=Commited ";
	if($row['relstatus']=='Commited')
	echo "checked";
	echo ">Commited</td></tr><tr><td>Hobbies:</td><td><textarea name=hobbies>".$row['hobbies']."</textarea></td></tr><tr><td>Favourite Movie: </td><td><textarea name=favmovie>".$row['favmovie']."</textarea></td></tr><tr><td>Favourite Celebrity: </td><td><textarea name=favcelebrity>".$row['favcelebrity']."</textarea></td></tr><tr><td>Favourite Music: </td><td><textarea name=favmusic>".$row['favmusic']."</textarea></td></tr><tr><td>Favourite Singer: </td><td><textarea name=favsinger>".$row['favsinger']."</textarea></td></tr><tr><td>My Best Friend(s): </td><td><textarea name=bestfrnd>".$row['bestfrnd']."</textarea></td></tr><tr><td><input type=submit value=Update></td><td><input type=reset></td></tr>";
}
?>
</table>
</form>
</center>
</div>
</div>
</body>
</html>