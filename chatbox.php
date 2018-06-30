<?php
include("session.php");
include("mysqlconnect.php");
?>
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=210,width=320');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>

<h2><i><font color="#669966">Online Friends</font></i></h2>
<?php
$count=0;
$res2=mysql_query("select * from friends where reqfrom='".$uid."' and status='accepted' or reqto='".$uid."' and status='accepted'");
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
			echo "<table cellpadding=5>";
			while($row=mysql_fetch_array($res))
			{
				$res1=mysql_query("select uname,dp from register where uid='".$row['uid']."'");
				while($row1=mysql_fetch_array($res1))
				{
					echo "<tr><td><img src=green_bullet.jpg></td><td><img src=upload/".$row1['dp']." height=50 width=40></td><td>".$row1['uname']."</td><td>";
					?>
					
                    <a href="chatwindow.php?friend=<?php echo $row['uid'];?>" onClick="return popitup('chatwindow.php?friend=<?php echo $row['uid'];?>&lower_limit=1&offset=1;')">Chat Now</a></td></tr>
                    <?php
					$count++;
				}
			}
			echo "</table>";
		}
	}
	if($count==0)
	{
		echo "<font color=green>* No Friend Is Online Now *</font>";
	}
}
else
{
	echo "<font color=green>* No Friend Available *</font>";
}
echo "</center>";
?>

