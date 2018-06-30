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
<style>
#left
{
float:left;
width:18%;
background:#FFFFFF;
}
#general_notifications
{
float:left;
width:100%;
}
#quotes
{
float:left;
width:100%%;
}
#birthdays
{
float:left;
width:100%;
}
#post_textbox
{

float:right;
width:100%;
height:50px;
}
#activities
{
float:right;
min-height:100%;
width:25%;
text-align:center;
background-color:#f3f2f2
}
#posts
{
float:right;
min-height:100%;
width:55%;
text-align:center;
border-right:thin groove #4D4C4C;
}
</style>
<script>
var activity_pos=0;

function loadActivities()
{
$(document).ready(
function()
{
document.getElementById('activity_load_status').innerHTML="<span style=\"color:#AAAAAA;font-size:14px;\">Loading...</span>";
$.post("get_activities.php","pos="+activity_pos,
function(data,status)
{
document.getElementById('activity_load_status').innerHTML="";
$("#activities_list").append(data);
}
);
}
);
}

var post_pos=0;

var prev_post_text="";
var x=0;//Post Type (Text or Video)

function submitPost()
{
var text=document.getElementById('post_text').value;
text=text.replace("'","''");
if(text!=""&&text!=prev_post_text)
{
if(x==1)
{
videoid=text.substr(text.lastIndexOf("v=")+2);
//alert(videoid);
text="<iframe class=\"youtube-player\" type=\"text/html\" width=\"80%\" height=\"285\" src=\"http://www.youtube.com/embed/"+videoid+"\" allowfullscreen frameborder=\"0\"></iframe>";
}
if(confirm("Confirm and proceed ...?"))
{
document.getElementById('post_text').value="... Please wait ...";
$.post("post_submit.php","post_text="+text,
function(data,status)
{
prev_post_text=text;
document.getElementById('post_text').value="";
post_pos=0;
loadPosts();
}
);
}
}
}

function loadPosts()
{
$(document).ready(
function()
{
document.getElementById('posts_load_status').innerHTML="<br><br><span style=\"color:#AAAAAA;font-size:14px;\">Loading...</span>";
$.post("get_posts.php","pos="+post_pos,
function(data,status)
{
document.getElementById('posts_load_status').innerHTML="";
$("#posts_list").append(data);
}
);
}
);
}

function loadGeneralNotifications()
{
$(document).ready(
function()
{
$("#general_notifications").load("get_general_notifications.php");
}
);
}

loadActivities();
loadPosts();
loadGeneralNotifications();

function removePost(postid)
{
$(document).ready(
function()
{
var x=confirm("Are you sure.. you want to remove it?");
if(x==true)
{
$.post("remove_post.php","postid="+postid,
function(data,status)
{
post_pos=0;
loadPosts();
alert(data);
}
);
}
}
);
}

$(document).ready(
function()
{
$(".post_button").click(
function()
{
if(x==0)
{
$("#link_video_button").css("border","inset #FFFFFF");
$("#text_post_button").css("border","outset #FFFFFF");
$("#post_text").attr("placeholder","..... Paste the video link here (only YouTube) .....");
document.getElementById('post_text').value="";
x=1;
}
else
{
$("#link_video_button").css("border","outset #FFFFFF");
$("#text_post_button").css("border","inset #FFFFFF");
$("#post_text").attr("placeholder",".......... Share your words ..........");
document.getElementById('post_text').value="";
x=0;
}
}
);
}
);
</script>
</head>
<body>
<div id="wrap">
<?php include("mainlinks.php");?>
<div id="content">
<br>
<div id="left">
<div id="quotes">
<br>
<h4 style="font-weight:normal;color:#c40e0e">:: <font color="#000000">....</font> <font color="#1a0f80"><b>Today's Words</b></font> <font color="#000000">....</font> ::</h4>
<span style="color:#FF0000; font-size:24px;float:left;">"</span><br>
<span style="color:#AAAAAA; font-style:italic;font-size:16px;">
I often warn people: "Somewhere along the way, someone is going to tell you, 'There is no "I" in team.' What you should tell them is, 'Maybe not. But there is an "I" in independence, individuality and integrity.
</span><br>
<span style="color:#FF0000; font-size:24px;float:right;">"</span>
<br>
</div>
<div id="birthdays">
<center>
<?php
$res1=mysql_query("select * from friends where reqfrom='".$uid."' and status='accepted' or reqto='".$uid."' and status='accepted'");
if(mysql_num_rows($res1))
{
	$i=0;
	$friend_id="";
	while($row1=mysql_fetch_array($res1))
	{
		if($row1['reqfrom']==$uid)
		{
			$friend_id=$row1['reqto'];
		}
		else
		{
			$friend_id=$row1['reqfrom'];
		}
		$res2=mysql_query("select uname from register where uid='".$friend_id."' and substring(dob,5)=substring(DATE(Now()),5)");
		if($row2=mysql_fetch_array($res2))
		{
			if($i==0)
			{
				?>
				<h4 style="color:#4D4C4C"><i>Birthday Reminder</i></h4>
				<table cellpadding="5" id="birthday_friends" style="text-align:center;width:85%;">
				<?php
				$i=1;
			}
			echo "<tr><td style=\"border-bottom:thin #E5E5E5 solid;\"><img src=\"images/bday.jpg\" height=22px width=26px></td><td style=\"border-bottom:thin #E5E5E5 solid;\"><font color=\"#0066CC\"><i>".$row2['uname']."</i></font></td></tr>";
		}
	}
	if($i==1)
	{
		?>
		</table>
		<br>
		<?php
	}
}
?>

</center>
</div>
<div id="general_notifications">
</div>
</div>
<div id="activities">
<h2 style="font-weight:normal;color:#c40e0e">:: <font color="#000000">....</font> <font color="#1a0f80"><b>What's on ?</b></font> <font color="#000000">....</font> ::</h2>
<div id="activities_list"></div><p id="activity_load_status"></p>
<button id="more_activities_button" style="height:24px;color:#373737;width:100%;font-size:18px;text-align:center;" title="View More" onClick="loadActivities();">&bull;&nbsp;&bull;&nbsp;&bull;</button>
</div>
<div id="posts">
<h2 style="font-weight:normal;color:#c40e0e">:: <font color="#000000">....</font> <font color="#1a0f80"><b>Care to share?</b></font> <font color="#000000">....</font> ::</h2>
<table id="post_textbox" style="text-align:center;">
<tr><td style="width:80%;">
<input type="text" name="post_text" id="post_text" style="height:100%;width:100%;font-size:15px;color:#AAAAAA;text-align:center;" placeholder="''............... Share your words ...............''" onBlur="submitPost();" autocomplete="off"></td><td><button id="text_post_button" class="post_button" style="height:100%;background:#FFFFFF;border:inset #FFFFFF;" title="Share Words"><img src="images/post.png" height="26" width="46" /></button></td><td><button id="link_video_button" class="post_button" style="height:100%;background:#FFFFFF;border:outset #FFFFFF;" title="Share Video"><img src="images/video.jpg" height="30" width="40" /></button></td></tr>
</table>
<table cellpadding=5 id="posts_list" style="font-size:16px;color:#373737;"></table><p id="posts_load_status"></p>
<button id="more_posts_button" style="height:24px;color:#373737;width:100%;font-size:18px;text-align:center;" title="View More" onClick="loadPosts();">&bull;&nbsp;&bull;&nbsp;&bull;</button><br>
</div>
</div>
</div>
</body>
</html>