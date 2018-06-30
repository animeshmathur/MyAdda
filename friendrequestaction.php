<?php
include("session.php");
include("mysqlconnect.php");
$reqid=$_POST['reqid'];
$actiontype=$_POST['actiontype'];
if($actiontype=='accept')
{
	$q="update friends set status='accepted' where reqto='".$uid."' and reqfrom='".$reqid."'";
	echo "<b><font color=#118a2e size=4px>is your Friend now.</font></b>";

}
else if($actiontype=='reject')
{
	$q="delete from friends where reqto='".$uid."' and reqfrom='".$reqid."' and status='pending'";
	echo "<b><font color=#000000 size=4px>=Friend Request rejected!</font></b>";
}
$res=mysql_query($q);
?>
