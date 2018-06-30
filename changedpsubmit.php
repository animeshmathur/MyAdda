<?php require_once "phpuploader/include_phpuploader.php" ?>
<?php include("session.php");?>
<?php
include("mysqlconnect.php");
include("image_compress_script.php");
/*
$allowedExts = array(".jpg", ".jpeg", ".gif", ".png");
$file_name = $_FILES["file"]["name"];
$extension=substr($file_name,strlen($file_name)-4);
$extension=strtolower($extension);
if($extension=="jpeg")
{$extension=".jpeg";}
//echo $extension.",".$_FILES["file"]["size"].",".$_FILES["file"]["type"];
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 1024000)
&& in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
  	{
    	echo "Error: ".$_FILES["file"]["error"] . "<br>";
  	}
	else
	{
		move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$uid.$extension);
   		$res=mysql_query("update register set dp='".$uid.$extension."' where uid='".$uid."'");
	}
}
else
{
 echo "Invalid file";
}
*/
$uploader=new PhpUploader();
$mvcfile=$uploader->GetValidatingFile();
$extension=substr($mvcfile->FileName,strlen($file_name)-4);
$extension=strtolower($extension);
if($extension=="jpeg")
{$extension=".jpeg";}
$mvcfile->FileName=$uid.$extension;
$targetfilepath= "upload/" . $mvcfile->FileName;
if(file_exists($targetfilepath)==1)
unlink($targetfilepath);
$mvcfile->MoveTo( $targetfilepath );
createThumbnail($targetfilepath,$targetfilepath,250,250);
$res=mysql_query("update register set dp='". $mvcfile->FileName."' where uid='".$uid."'");
if($row=mysql_fetch_array(mysql_query("select activity_id from autogen")))
{
	$res2=mysql_query("select activity_id from activities where activity_type='dp_change' and substring(activity_time,1,13)=substring(NOW(),1,13)");
	if(mysql_num_rows($res2))
	{
		if($row2=mysql_fetch_array($res2))
		mysql_query("update activities set activity_time=NOW() where activity_id='".$row2['activity_id']."'");
	}
	else
	{
		mysql_query("insert into activities values('".$row['activity_id']."','dp_change',NOW(),'".$uid."')");
		mysql_query("update autogen set activity_id=activity_id+1");
	}
}
$uploader->WriteValidationOK("");
//header("location:profile.php");
?>