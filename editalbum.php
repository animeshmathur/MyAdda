<?php
include("session.php");
include("mysqlconnect.php");
$albumid=$_SESSION['albumid'];
?>
<html>
<head>
<title>MyAdda</title>
<?php
include("head.php");
?>
<script>
function confirmPhotoDelete()
{
x=confirm("Are you sure, you want to remove the selected photo(s)?");
if(x==true)
{
return true;
}
return false;
}

function confirmAlbumDelete()
{
x=confirm("Are you sure, you want to remove the entire album?\nNote: You can not undo this action!");
if(x==true)
{
return true;
}
return false;
}

no_of_photos=0;
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
<div id="content" style="background-position:0px 60px;background-repeat:no-repeat;background-attachment:fixed;background-image:url(images/albums.jpg);min-height:739;width:100%;">
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
}
echo "<span style=\"color:#E5E5E5;font-size:20px;\"><b><i>Edit Album :: ".$atitle."</i></b></span><br>";
$res2=mysql_query("select * from photos where albumid='".$albumid."'");
if(mysql_num_rows($res2))
{
	?>
	<div id="photo_list">
	<form action="deletealbumphoto.php" onSubmit="return(confirmPhotoDelete());">
	<table cellspacing=30>
	<?php
	$i=0;
	while($row2=mysql_fetch_array($res2))
	{
	if($i%8==0)
	{echo "<tr>";}
		echo "<td class=\"album_image\" style=\"width:60px;height:60px\"><img src=\"upload/album_photos/".$row2['photo']."\" height=100% width=100%><br><input type=\"checkbox\" name=\"photo_".$i."\" id=\"photo_checkbox_".$i."\" class=\"photo_checkbox\" value=\"".$row2['photoid']."\"></td>";
		$i++;
	if($i%8==0)
	{echo "</tr>";}

	}
	if($i%8!=0)
	{echo "</tr>";}
	echo "<script>no_of_photos=".$i.";</script>";
	?>
	</table>
	<input type="hidden" name="albumid" value="<?php echo $albumid;?>" />
	<p id="set_cover_status"></p>
	<script>
	$(document).ready(
	function()
	{
	$("#set_cover_button").click(
	function()
	{	
	photoid=-1;
	count=0;
	i=no_of_photos-1;
	while(i>=0)
	{
	if($("#photo_checkbox_"+i).is(":checked")) 
	{
    	photoid=document.getElementById("photo_checkbox_"+i).value;
		count=count+1;
		//alert(photoid);
	}
	i--;
	}
	if(count!=1)
	{
	alert("Please select any one photo for album cover!");
	}
	else
	{
	document.getElementById("set_cover_status").innerHTML="<font color=#FFFFFF>Please Wait...</font>";
	$.post("set_album_cover.php","albumid="+<?php echo $albumid;?>+"&photoid="+photoid,
	function(data,status)
	{
	document.getElementById("set_cover_status").innerHTML=data;
	}
	);
	}
	}
	);
	}
	)

	</script>
	<table cellpadding="10">
	<tr>
	<td>
	<input type="button" id="set_cover_button" style="background-color:#FFFFFF;color:#006600" value=":: Set as album cover ::" onClick="setAlbumCover();">
	</td>
	<td>
	<input type="submit" value=":: Remove Selected Photos ::" style="background-color:#FFFFFF;color:#FF0000;"/>
	</td>
	</tr>
	</table>
	</form>
	</div>
	<?php
}
else
{
	echo "<font color=green>* Album Is Empty *</font>";
}
?>
<br><br>
<form action="deletealbum.php" onSubmit="return(confirmAlbumDelete());">
<input type="hidden" name="albumid" value="<?php echo $albumid;?>" />
<input type="submit" value="Delete Album" style="background-color:#FF0000;color:#FFFFFF;border-radius:10px;font-style:italic;"/>
</form>
</center>
</div>
</div>
</body>
</html>
