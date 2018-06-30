<?php
include("session.php");
include("mysqlconnect.php");
$pos=$_REQUEST['pos'];
$count=0;
while($count<8)
{
	$res1=mysql_query("select uid,activity_type,concat(day(activity_time),' ',monthname(activity_time),' at ',date_format(activity_time,'%h:%i %p')) as act_time from activities order by activity_id desc limit ".$pos.",8");
	if(mysql_num_rows($res1))
	{
		while($row1=mysql_fetch_array($res1))
		{	
			if($count<8)
			{
			$res2=mysql_query("select reqfrom,reqto from friends where (reqto='".$row1['uid']."' and reqfrom='".$uid."' and status='accepted') or (reqto='".$uid."' and reqfrom='".$row1['uid']."' and status='accepted')");
			if($row2=mysql_fetch_array($res2))
			{
				$friend_id="";
				if($row2['reqfrom']==$uid)
				{
					$friend_id=$row2['reqto'];
				}
				else
				{
					$friend_id=$row2['reqfrom'];
				}
				if($row3=mysql_fetch_array(mysql_query("select reg_id,uid,uname,dp from register where uid='".$friend_id."'")))
				{
					$activity_type=$row1['activity_type'];
					//echo $activity_type;
					//Change DP Activity
					if($activity_type=="dp_change")
					{
						echo "<table cellpadding=5 style=\"font-size:14px;border-bottom:thin #E5E5E5 solid;\"><tr><td>&bull;</td><td><img src=\"upload/".$row3['dp']."\" height=35px  draggable=false ondragstart=\"return false\" oncontextmenu=\"return false\"></td><td><a href=\"userprofile.php?rid=".$row3['reg_id']."\" style=\"color:#c40e0e;\"><b>".$row3['uname']."'s</b></a> profile picture changed on ".$row1['act_time'].".";
						echo "</td></tr></table>";
					}
					//New album photo activity
					else if(substr($activity_type,0,16)=="new_album_photo_")	
					{
						echo "<table cellpadding=5 style=\"font-size:14px;border-bottom:thin #E5E5E5 solid;\"><tr><td>&bull;</td><td><img src=\"upload/".$row3['dp']."\" height=35px  draggable=false ondragstart=\"return false\" oncontextmenu=\"return false\"></td><td><a href=\"userprofile.php?rid=".$row3['reg_id']."\" style=\"color:#c40e0e;\"><b>".$row3['uname']."</b></a> added new photo(s) to album ";
						if($row4=mysql_fetch_array(mysql_query("select atitle from albums where albumid='".substr($activity_type,16)."'")))
						{
							echo "<a href=\"view_friend_album.php?albumid=".substr($activity_type,16)."\">".$row4['atitle']."</a>";
						}
						echo " on ".$row1['act_time'].".</td></tr></table>";
					}
				}
				//echo $i;
			$count++;
			}
			$pos++;
			}
		}
	}
	else
	{
		$count=8;
		echo "<script>$(document).ready(function(){\$(\"#more_activities_button\").hide();});</script>";
	}
}
echo"<script>activity_pos=".$pos.";</script>";
?>
