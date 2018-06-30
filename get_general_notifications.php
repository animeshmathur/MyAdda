<?php
include("session.php");
include("mysqlconnect.php");
$res=mysql_query("select * from friends where reqto='".$uid."' and status='pending'");
if($num=mysql_num_rows($res))
{
	?>
	<br><span style="font-size:14px;color:#4D4C4C;"><i><b>You have <?php if($num==1){echo "a friend request";}else{echo $num." friend requests";}?> pending</b>... <a href="friendrequests.php">See</a></i></span>
	<?php
}
$res=mysql_query("select * from messages where msgto='".$uid."' and msg_status=1");
if($num=mysql_num_rows($res))
{
	?>
	<br /><br /><span style="font-size:14px;color:#4D4C4C;"><i><b>You have <?php if($num==1){echo "a new message";}else{echo $num." new messages";}?> in your </b> <a href="messages.php">Inbox</a></i></span>
	<?php
}
?>