<?php
include("mysqlconnect.php");
include("session.php");
$nicknm=$_REQUEST["nicknm"];
$myinfo=$_REQUEST["myinfo"];
$age=$_REQUEST['age'];
$relstatus=$_REQUEST['relstatus'];
/*
$h1=$_REQUEST['h1'];
$h2=$_REQUEST['h2'];
$h3=$_REQUEST['h3'];
$h4=$_REQUEST['h4'];
$h5=$_REQUEST['h5'];
$h6=$_REQUEST['h6'];
if($h6!='')
{
	$hobbies=$h1.";".$h2.";".$h3.";".$h4.";".$h5.";".$h6;
}
else
{
	$hobbies=$h1.";".$h2.";".$h3.";".$h4.";".$h5;
}
*/
$hobbies=$_REQUEST['hobbies'];
$favmovie=$_REQUEST['favmovie'];
$favcelebrity=$_REQUEST['favcelebrity'];
$favmusic=$_REQUEST['favmusic'];
$favsinger=$_REQUEST['favsinger'];
$bestfrnd=$_REQUEST['bestfrnd'];
$q="insert into profile values('".$uid."','".$nicknm."','".$myinfo."','".$age."','".$relstatus."','".$hobbies."','".$favmovie."','".$favcelebrity."','".$favmusic."','".$favsinger."','".$bestfrnd."')";
//echo $q;
$res=mysql_query($q);
header("location:profile.php");
?>