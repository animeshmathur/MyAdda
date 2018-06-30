<?php
include("session.php");
include("mysqlconnect.php");
$nicknm=$_REQUEST["nicknm"];
$myinfo=$_REQUEST["myinfo"];
$age=$_REQUEST['age'];
$relstatus=$_REQUEST['relstatus'];
$hobbies=$_REQUEST['hobbies'];
$favmovie=$_REQUEST['favmovie'];
$favcelebrity=$_REQUEST['favcelebrity'];
$favmusic=$_REQUEST['favmusic'];
$favsinger=$_REQUEST['favsinger'];
$bestfrnd=$_REQUEST['bestfrnd'];
$q="update profile set nickname='".$nicknm."',myinfo='".$myinfo."',age='".$age."',relstatus='".$relstatus."',hobbies='".$hobbies."',favmovie='".$favmovie."',favcelebrity='".$favcelebrity."',favmusic='".$favmusic."',favsinger='".$favsinger."',bestfrnd='".$bestfrnd."' where uid='".$uid."'";
$res=mysql_query($q);
header("location:profile.php");
?>