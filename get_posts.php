<?php
include("session.php");
include("mysqlconnect.php");
$pos=$_REQUEST['pos'];
$count=0;
while($count<10)
{
	$res1=mysql_query("select post_id,post,uid,concat(day(post_time),' ',monthname(post_time),' at ',date_format(post_time,'%h:%i %p')) as p_time from posts order by post_id desc limit ".$pos.",10");
	if(mysql_num_rows($res1))
	{
		$post_user_id="";
		while($row1=mysql_fetch_array($res1))
		{	
			if($count<10)
			{
			if($row1['uid']==$uid)
			{
				$post_user_id=$uid;
				if($row3=mysql_fetch_array(mysql_query("select uid,uname,dp from register where uid='".$post_user_id."'")))
				{
					echo "<tr><td style=\"width:2px;\">&bull;</td><td><img src=\"upload/".$row3['dp']."\" height=35px  draggable=false ondragstart=\"return false\" oncontextmenu=\"return false\">&nbsp;&nbsp;<a href=\"profile.php\" style=\"color:#c40e0e;font-size:16px;\"><b>".$row3['uname']."</b></a>:</td><td></td></tr><tr><td></td><td style=\"width:100%;border-bottom:thin #373737 solid;padding:20px 10px;\"><p><span style=\"color:#373737\"><b>".$row1['post']."</b></span><br><br><span style=\"color:#AAAAAA;font-size:13px\"> &nbsp;&nbsp;&nbsp;&nbsp;<i>- on ".$row1['p_time']."</i></p></td><td>";
					echo "<button id=\"remove_post_button\" title=\"Remove\" onClick=\"removePost(".$row1['post_id'].");\" style=\"background-color:#FFFFFF;color:#FF6666;border:#E5E5E5 solid thin;border-radius:5px;\">x</button>";
					echo "</td></tr>";
				}
				$count++;
			}
			else
			{
				$post_user_id=$row1['uid'];
				$res2=mysql_query("select reqfrom,reqto from friends where (reqto='".$row1['uid']."' and reqfrom='".$uid."' and status='accepted') or (reqto='".$uid."' and reqfrom='".$row1['uid']."' and status='accepted')");
				if(mysql_num_rows($res2))
				{
					if($row3=mysql_fetch_array(mysql_query("select reg_id,uid,uname,dp from register where uid='".$post_user_id."'")))
					{
						echo "<tr><td style=\"width:2px;\">&bull;</td><td><img src=\"upload/".$row3['dp']."\" height=35px  draggable=false ondragstart=\"return false\" oncontextmenu=\"return false\">&nbsp;&nbsp;<a href=\"userprofile.php?rid=".$row3['reg_id']."\" style=\"color:#c40e0e;font-size:16px;\"><b>".$row3['uname']."</b></a>:</td><td></td></tr><tr><td></td><td style=\"width:100%;border-bottom:thin #373737 solid;padding:20px 10px;\"><p><span style=\"color:#373737\"><b>".$row1['post']."</b></span><br><br><span style=\"color:#AAAAAA;font-size:13px\"> &nbsp;&nbsp;&nbsp;&nbsp;<i>- on ".$row1['p_time']."</i></p></td><td>";
					if($post_user_id==$uid)
					{
						echo "<button id=\"remove_post_button\" title=\"Remove\" onClick=\"removePost(".$row1['post_id'].");\" style=\"background-color:#FFFFFF;color:#c40e0e;border:#E5E5E5 solid thin;border-radius:6px;\">x</button>";}
						echo "</td></tr>";
					}
				}
				$count++;
			}
			$pos++;
			}	
			//echo $i;
		}
	}
	else
	{
		$count=10;
		echo "<script>$(document).ready(function(){\$(\"#more_posts_button\").hide();});</script>";
	}
}
echo"<script>post_pos=".$pos.";</script>";
?>