<?php require_once "phpuploader/include_phpuploader.php" ?>
<?php include("session.php");?>
<?php
include("mysqlconnect.php");
include("image_compress_script.php");
$albumid=$_SESSION['albumid'];
/*
$allowedExts = array(".gif", ".jpeg", ".jpg", ".png");
$temp = substr($_FILES["file"]["name"],strlen($_FILES["file"]["name"])-4);
$extension =strtolower($temp);
if($extension=="jpeg")
{$extension=".jpeg";}
if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/jpg")|| ($_FILES["file"]["type"] == "image/pjpeg")|| ($_FILES["file"]["type"] == "image/x-png")|| ($_FILES["file"]["type"] == "image/png"))&& ($_FILES["file"]["size"] < 1024000)&& in_array($extension, $allowedExts))
{
if($_FILES["file"]["error"]>0)
{
    echo "Error: ".$_FILES["file"]["error"]."<br>";
}
else
{
  if (file_exists("upload/" . $_FILES["file"]["name"]))
  {
    echo $_FILES["file"]["name"]." already exists.";
  }
  else
  {	
  	$q="select photoid from autogen";
	$res=mysql_query($q);
	if($row=mysql_fetch_array($res))
	{
	   $photoid=$row['photoid'];
       move_uploaded_file($_FILES["file"]["tmp_name"],"upload/album_photos/".$albumid."_".$photoid.$extension);
	   $q="INSERT INTO `photos`(`photoid`, `albumid`, `photo`, `phototime`) VALUES ('".$photoid."','".$albumid."','".$albumid."_".$photoid.$extension."',NOW())";
	   $res1=mysql_query($q);
	   $res2=mysql_query("update autogen set photoid=photoid+1");
	   //echo "Picture Changed!".",".$res1;
  	}
  }
}
}
else
{
  echo "Invalid file";
}
header("location:viewalbum.php?albumid=".$albumid);
*/
$uploader=new PhpUploader();
$mvcfile=$uploader->GetValidatingFile();
$extension=substr($mvcfile->FileName,strlen($file_name)-4);
$extension=strtolower($extension);
if($extension=="jpeg")
{$extension=".jpeg";}
$res1=mysql_query("select photoid,activity_id from autogen");
if($row1=mysql_fetch_array($res1))
{
	$photoid=$row1['photoid'];
	mysql_query("INSERT INTO `photos`(`photoid`, `albumid`, `photo`, `phototime`) VALUES ('".$photoid."','".$albumid."','".$albumid."_".$photoid.$extension."',NOW())");
	//echo "Picture Changed!".",".$res1;
	$mvcfile->FileName=$albumid."_".$photoid.$extension;
	$targetfilepath= "upload/album_photos/" . $mvcfile->FileName;
	if( is_file ($targetfilepath) )	
	unlink($targetfilepath);
	$mvcfile->MoveTo( $targetfilepath );
	createThumbnail($targetfilepath,$targetfilepath,400,800);
	mysql_query("update autogen set photoid=photoid+1");
	$res2=mysql_query("select activity_id from activities where activity_type='new_album_photo_".$albumid."' and substring(activity_time,1,13)=substring(NOW(),1,13)");
	if(mysql_num_rows($res2))
	{
		if($row2=mysql_fetch_array($res2))
		mysql_query("update activities set activity_time=NOW() where activity_id='".$row2['activity_id']."'");
	}
	else
	{
		mysql_query("insert into activities values('".$row1['activity_id']."','new_album_photo_".$albumid."',NOW(),'".$uid."')");
		mysql_query("update autogen set activity_id=activity_id+1");
	}
	$uploader->WriteValidationOK("");
}
?> 
		