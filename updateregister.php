<html>
<head><title>Update Info</title></head>
<body>

<?php
include("session.php");
include("mysqlconnect.php");
include("head.php");
?>
<center>
<form action="updateregistersubmit.php" method="post">
<table>
<caption><h3><i>Update Personal Info</i></h3></caption>

<?php
$res=mysql_query("select * from register where uid='".$uid."'");
if($row=mysql_fetch_array($res))
{
	echo "<tr><td>City: </td><td><select name=ucity><option value=".$row['ucity'].">".$row['ucity']."</option>";
	if($row['ucity']=='Gwalior')
	{
		echo "<option value=Bhopal>Bhopal</option><option value=Indore>Indore</option>";
	}
	else if($row['ucity']=='Bhopal')
	{
		echo "<option value=Gwalior>Gwalior</option><option value=Indore>Indore</option>";
	}
	else if($row['ucity']=='Indore')
	{
		echo "<option value=Bhopal>Bhopal</option><option value=Gwalior>Gwalior</option>";
	}
	echo "</select></td></tr><tr><td>E-Mail: </td><td><input type=text name=umail value=".$row['umail']."></td></tr><tr><td><input type=submit value=Update></td><td><input type=reset></td></tr>";
}
?>
</table>
</form>
</center>
</body>
</html>