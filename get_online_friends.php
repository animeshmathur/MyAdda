<?php
include("session.php");
include("mysqlconnect.php");
$count=0;
$res2=mysql_query("select distinct reqto,reqfrom from friends where reqfrom='".$uid."' and status='accepted' or reqto='".$uid."' and status='accepted'");
if(mysql_num_rows($res2))
{
	while($row2=mysql_fetch_array($res2))
	{
		if($uid==$row2['reqfrom'])
		{
			$res=mysql_query("select * from onlineuser where uid='".$row2['reqto']."'");
		}
		else
		{
			$res=mysql_query("select * from onlineuser where uid='".$row2['reqfrom']."'");
		}
		if(mysql_num_rows($res))	
		{
			if($count==0)
			{
			echo "<center><font color=#ff6666 style=\"font-size:26px;\"> :: </font><font color=#1a0f80 style=\"font-size:26px;\">...Online Friends...</font><font color=#ff6666 style=\"font-size:26px;\"> :: </font><br><br></center>";
			echo "<table width=100% cellpadding=10 style=\"background-color:#E5E5E5;color:#4D4C4C;text-align:center;font-size:14px;\">";
			}
			while($row=mysql_fetch_array($res))
			{
				$res1=mysql_query("select uname,dp from register where uid='".$row['uid']."'");
				while($row1=mysql_fetch_array($res1))
				{
					echo "<tr><td><img src=images/gdot.jpg style=\"border-radius:20px;\" draggable=\"false\" ondragstart=\"return false;\" oncontextmenu=\"return false;\"></td><td><img src=upload/".$row1['dp']." width=60 draggable=\"false\" ondragstart=\"return false;\" oncontextmenu=\"return false;\"></td><td><font color=#c40e0e size=4px><b>".$row1['uname']."</b></font></td><td>";
					?>
                    <a href="#" onClick="return(popitup('chatwindow.php?friend=<?php echo $row['uid'];?>','<?php echo $row['uid'];?>'));"><b>Chat Now</a></b></a></a></td></tr>
                    <?php
					$count++;
				}
			}
		}
	}
	if($count==0)
	{
		echo "<br><br><br><br><font color=#ffffff style=\"font-size:25px;\">* No Friend Is Online Now *</font>";
	}
	else
	{echo "</table>";}
}
else
{
	echo "<font color=#ffffff>* No Friend Available *</font>";
}
echo "<script>";
$res2=mysql_query("select txtfrom from chat where txtto='".$uid."' and txt_status='0' group by txtfrom");
while($row2=mysql_fetch_array($res2))
{
	echo "popitup('chatwindow.php?friend=".$row2['txtfrom']."','".$row2['txtfrom']."');";
}
echo "</script>";
?>