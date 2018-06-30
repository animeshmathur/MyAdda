<?php
include("session.php");
include("mysqlconnect.php");
$op=$_REQUEST['op'];
switch($op)
{
	case 'Inbox':
	echo "<table cellspacing=10 style=\"width:80%\"><caption><h2>".$op."</h2></caption>";
	$q="select *,concat(day(msgtime),' ',monthname(msgtime),' at ',date_format(msgtime,'%h:%i %p')) as m_time from messages where msgto='".$uid."' order by msgid desc";
	$res=mysql_query($q);
	if(mysql_num_rows($res))
	{
		$i=1;
		while($row=mysql_fetch_array($res))
		{
			$res1=mysql_query("select * from register where uid='".$row['msgfrom']."'");
			if($row1=mysql_fetch_array($res1))
			{
				echo "<tr><td style=\"width:80px;text-align:center;\"><img src=upload/".$row1['dp']." width=80px ondragstart=\"return false;\" draggable=\"false\" oncontextmenu=\"return false;\"></td><td style=\"width:20%;text-align:center;\"><b><font color=#c40e0e size=4px>".$row1['uname'].":</font></b></td><b><td style=\"width:80%;size:16px;color:#4d4c4c;background-color:#FFFFFF;opacity:0.8;padding:10px 10px;border-radius:10px;\"><b>".$row['msg']."</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color:#AAAAAA;font-size:13px;font-style:italic;float:right;\">-&nbsp;on ".$row['m_time']."</span><center><a href=# onclick=\"return(makeMessage('".$row['msgfrom']."','".$row1['uname']."'));\"><b><font color=#16b329>Reply</font></b></a>&nbsp;&nbsp;<a href=deletemessage.php?msgid=".$row['msgid']."  onclick=\"return(confirmMessageDelete());\"><b><font color=#000000>Delete</font></b></a></center></td></tr>";
			}
			$i++;
		}
		mysql_query("update messages set msg_status=0 where msgto='".$uid."'");
	}
	else
	{
		echo"<tr><td><font color=#c40e0e size=12px>* No Messages Available *</font></td></tr>";
	}
	break;
	
	case 'Sent':
	echo "<table cellspacing=20 style=\"width:80%\"><caption><h2>".$op."</h2></caption>";
	$q="select * from messages where msgfrom='".$uid."' order by msgtime";
	$res=mysql_query($q);
	if(mysql_num_rows($res))
	{
		while($row=mysql_fetch_array($res))
		{
			$res1=mysql_query("select * from register where uid='".$row['msgto']."'");
			if($row1=mysql_fetch_array($res1))
			{
			echo "<tr><td><b><font color=#c40e0e size=4px>".$row1['uname'].": </font></b></td><td>&nbsp&nbsp<font color=#1a0f80 size=3.5px><b>".$row['msg']."</b></font></td><b><td>&nbsp&nbsp<a href=deletemessage.php?msgid=".$row['msgid']." onclick=\"return(confirmMessageDelete());\"><b><font color=#000000>......... Delete</font></b></a></td></b></tr>";
			}
		}
	}
	else
	{
		echo"<tr><td><font color=#c40e0e size=12px>* No Messages Sent *</font></td></tr>";
	}
	break;
	
	case 'Compose':
	?>
	<h2><?php echo $op;?></h2>
	<p id="compose_status"></p>
	<table cellspacing=20 style="text-align:center;width:50%;">
	<tr>
	<td>
	<select name="msgto" id="msgto" style="width:100%;height:30px;text-align:center;font-size:18px;color:#666666;">
	<option value="-1">----- Send Message To -----</option>
	<option value="all" style="color:#0066CC;">All My Friends</option>
	<?php
	$res1=mysql_query("select * from friends where reqfrom='".$uid."' and status='accepted' or reqto='".$uid."' and status='accepted'");
	if(mysql_num_rows($res1))
	{
		while($row1=mysql_fetch_array($res1))
		{
			$res2=mysql_query("select * from register where uid='".$row1['reqfrom']."' and not uid='".$uid."' or uid='".$row1['reqto']."' and not uid='".$uid."'");
			if($row=mysql_fetch_array($res2))
			{
				if($row1['reqfrom']==$uid)
				{
					echo "<option value=\"".$row1['reqto']."\">".$row['uname']."</option>";
				}
				else
				{
					echo "<option value=\"".$row1['reqfrom']."\">".$row['uname']."</option>";
				}
			}
		}
	}
	?>
	</select>
	</td></tr><tr><td><textarea name="msgtext" id="msgtext" style="width:100%;height:200px;"></textarea></td></tr>
	<tr><td><input type=button onclick="composeMessage();" value=Send style=" background-color:#4D4C4C;color:#FFFFFF;font-size:15px;width:150px;border-radius:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=reset value=Clear style=" background-color:#4D4C4C;color:#FFFFFF;font-size:15px;width:150px;border-radius:5px;"></td></tr>
	<?php
	break;
}
echo "</table>";
?>
