<?php
include("session.php");
include("mysqlconnect.php");
$albumid=$_REQUEST['albumid'];
$_SESSION['albumid']=$albumid;
?>
<html>
<head>
<title>MyAdda</title>
<?php
include("head.php");
?>
<script>
$(document).ready(
function()
{
	$("#add_photo_form").hide();
	//$("#large_photo_frame").load("getalbumphoto.php","photoid="+photoid_arr[0]);
	if(photo_arr[0]!="empty")
	{
		$("#large_photo_frame").html("<img src=\"upload/album_photos/"+photo_arr[0]+"\" height=100% draggable=false ondragstart=\"return false\" oncontextmenu=\"return false\">");
	}
	else
	{
		$("#large_photo").hide();
	}
	if(photo_arr.length==1)
	{
	$("#prev_btn").hide();
	$("#next_btn").hide();
	}
}
);

var photo_arr=new Array();
photo_arr[0]="empty";
var photo_arr_index=0;

function showLeftPhoto(showLargePhoto)
{
$(document).ready(
function()
{
photo_arr_index--;
if(photo_arr_index<0)
{
photo_arr_index=(photo_arr.length-1);
}
$("#large_photo_frame").html("<img src=\"upload/album_photos/"+photo_arr[photo_arr_index]+"\" height=100% draggable=false ondragstart=\"return false\" oncontextmenu=\"return false\">");
}
);
}

function showRightPhoto()
{
$(document).ready(
function()
{
photo_arr_index++;
if(photo_arr_index>(photo_arr.length-1))
{
photo_arr_index='0';
}
//alert(photoid_arr[photoid_arr_index]);
//$("#large_photo_frame").load("getalbumphoto.php","photoid="+photoid_arr[photoid_arr_index]);
$("#large_photo_frame").html("<img src=\"upload/album_photos/"+photo_arr[photo_arr_index]+"\" height=100% draggable=false ondragstart=\"return false\" oncontextmenu=\"return false\">");
}
);
}

function showLargePhoto(photo,i)
{
$(document).ready(
function()
{
photo_arr_index=i;
//alert(photoid_arr_index);
//$("#large_photo_frame").load("getalbumphoto.php","photoid="+photoid);
document.getElementById('large_photo_frame').innerHTML="<img src=\"upload/album_photos/"+photo+"\" height=100% draggable=false ondragstart=\"return false\" oncontextmenu=\"return false\">";
}
);
}

</script>
<style>
.album_image
{
	text-align:center;
	border:#FFFFFF thick solid;
	border-radius:10px;
	background-color:#FFFFFF;
}
.album_image:hover
{
	opacity:.88;
}

</style>
</head>
<body>
<div id="wrap">
<?php
include("mainlinks.php");
?>
<div id="content" style="background-position:0px 60px;background-repeat:no-repeat;background-attachment:fixed;background-image:url(images/pics.jpg);min-height:739;width:100%;">
<br><br>
<script>
document.write("<a href=\""+document.referrer+"\" style=\"float:left;color:#E5E5E5;font-size:16px;\">&lt;&lt; Back</a>");
</script>
<center>
<?php
$res1=mysql_query("select * from albums where albumid='".$albumid."'");
$atitle="";
if($row1=mysql_fetch_array($res1))
{
	$atitle=$row1['atitle'];
	$auser=$row1['uid'];
}
echo "<span style=\"color:#E5E5E5;font-size:20px;\"><b><i>".$atitle."</i></b></span><br>";
?>
<div id="large_photo" style="height:400px;width:800px;z-index:2;;">
<div id="left_nav" style="width:10%;height:100%;opacity:0.55;background-color:#4D4C4C;float:left;"><br><br><br><br><br><br><br><br><button id="prev_btn" style="font-size:36px;color:#4D4C4C;" onClick="showLeftPhoto()">&lt;</button></div>
<div id="large_photo_frame" style="width:80%;height:100%;float:left;background-color:#000000;"></div>
<div id="right_nav" style="width:10%;height:100%;opacity:0.55;background-color:#4D4C4C;float:right;"><br><br><br><br><br><br><br><br><button id="next_btn" style="font-size:36px;color:#4D4C4C;" onClick="showRightPhoto()"><b>&gt;</b></button></div>
</div>
<?php
$res2=mysql_query("select * from photos where albumid='".$albumid."' order by photoid");
if(mysql_num_rows($res2))
{
	?>
	<div id="photo_list">
	<table cellspacing=50>	
	<?php
	$i=0;
	while($row2=mysql_fetch_array($res2))
	{
	if($i%8==0)
	{echo "<tr>";}
		?>
		<script>photo_arr[<?php echo $i;?>]="<?php echo $row2['photo'];?>";</script>
		<?php
		echo "<td class=\"album_image\" style=\"width:60px;height:60px\"><img src=\"upload/album_photos/".$row2['photo']."\" style=\"max-height:60px;max-width:60px;\" onclick=\"showLargePhoto('".$row2['photo']."',".$i.")\"></td>";
		$i++;
	if($i%8==0)
	{echo "</tr>";}
	}
	if($i%8!=0)
	{echo "</tr>";}
	?>
	</table>
	</div>
	<?php
}
else
{
	echo "<br><font color=green>* Album Is Empty *</font><br>";
}
?>
</center>
</div>
</div>
</body>
</html>
