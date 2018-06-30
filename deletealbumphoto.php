<?php
include("session.php");
include("mysqlconnect.php");
$albumid=$_REQUEST['albumid'];
$res=mysql_query("select count(*) as count from photos where albumid='".$albumid."'");
$no_of_photos=0;
$photo_file_name="";
if($row=mysql_fetch_array($res))
{
$no_of_photos=$row['count'];
}
$arr_index=0;
$photoid;
for($i=0;$i<$no_of_photos;$i++)
{
if(isset($_REQUEST['photo_'.$i]))
{
$photoid[$arr_index]=$_REQUEST['photo_'.$i];
$arr_index++;
}
}
for($i=0;$i<$arr_index;$i++)
{
$res=mysql_query("select photo from photos where photoid='".$photoid[$i]."'");
if($row=mysql_fetch_array($res))
{$photo_file_name=$row['photo'];}
$res=mysql_query("delete from photos where photoid='".$photoid[$i]."'");
if(file_exists("upload//album_photos//".$photo_file_name)==1)
{unlink("upload//album_photos//".$photo_file_name);}
//echo $res;
}
header("location:editalbum.php?albumid=".$albumid);
?>