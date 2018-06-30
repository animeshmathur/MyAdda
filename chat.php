<?php
include("session.php");
include("mysqlconnect.php");
?>
<!Doctype html>
<html>
<head>
<?php
include("head.php");
?>
<?php
if(!mysql_num_rows(mysql_query("select * from onlineuser where uid='".$uid."'")))
{
	$res1=mysql_query("insert into onlineuser values('".$uid."')");
}
?>
<title>My Adda : CHAT</title>
<script>
var opened_win=new Array();
function popitup(url,id) 
{
//alert("chk");
if(!opened_win[id]||opened_win[id].closed) 
{
	opened_win[id]=window.open(url,'chatwindow'+id,'height=300,width=500');
	if (window.focus) {opened_win[id].focus()}
}
else
{
	opened_win[id].focus();
}
return false;
}

function getOnlineFriends()
{
$(document).ready(
function()
{
$("#chat").load("get_online_friends.php",
function()
{
window.setTimeout(getOnlineFriends,30000);
}
);
}
);
}

getOnlineFriends();
</script>
</head>
<body>
<div id="chat">
</div>
</body>
</html>