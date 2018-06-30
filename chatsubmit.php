<?php
include("session.php");
include("mysqlconnect.php");
$txt=$_REQUEST['txt'];
$friend=$_REQUEST['friend'];
$txt=str_replace("'","''",$txt);
$txt=str_replace("<","&lt;",$txt);
$txt=str_replace(">","&gt;",$txt);
$txt=str_replace("&lt;img src=images/smilies/smile.png class=smilie&gt;",":)",$txt);
$txt=str_replace("&lt;img src=images/smilies/sad.png class=smilie&gt;",":(",$txt);
$txt=str_replace("&lt;img src=images/smilies/tease.png class=smilie&gt;",":P",$txt);
$txt=str_replace("&lt;img src=images/smilies/big-smile.png class=smilie&gt;",":D",$txt);
$txt=str_replace(":)","<img src=images/smilies/smile.png class=smilie>",$txt);
$txt=str_replace(":(","<img src=images/smilies/sad.png class=smilie>",$txt);
$txt=str_replace(":P","<img src=images/smilies/tease.png class=smilie>",$txt);
$txt=str_replace(":D","<img src=images/smilies/big-smile.png class=smilie>",$txt);
$res=mysql_query("insert into chat values('".$uid."','".$friend."','".$txt."',NOW(),'0')");
?>