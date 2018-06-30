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
<script src="include/jquery.js"></script>
<script>
function loadMessageBox(op)
{
	document.getElementById('message_box').innerHTML="<br><br><h2 style=\"color:#0066CC;\">Loading ...</h2>";
	$(document).ready(
	function()
	{
		$("#message_box").load("messagebox.php","op="+op);
	}
	);
}

function composeMessage()
{
$(document).ready(
function()
{
document.getElementById('compose_status').innerHTML="<font color=#0066CC>Sending.....</font>";
$.post("sendmessagesubmit.php","msgto="+document.getElementById('msgto').value+"&msgtext="+document.getElementById('msgtext').value,
function(data,status)
{
document.getElementById('compose_status').innerHTML=data;
}
);
}
);
}

function makeMessage(fid,fname)
{
document.getElementById('send_message').innerHTML="<table width=\"100%\" id=\"msg_to\"><caption style=\" background-color:#4D4C4C;color:#FFFFFF;\">Sending Message To : "+fname+"<button style=\"color:#FF0000;float:right;\" onclick=\"cancelMessage();\">x</button></caption><tr><td><input type=\"hidden\" id=\"msgto\" value=\""+fid+"\" style=\"width:100%;\" readonly=true></td></tr><tr><td><textarea id=\"msgtext\" style=\"width:100%;height:160px;overflow-y:scroll;\"></textarea></td></tr><tr><td><button id=\"send_message_button\" style=\"width:150px;color:#0066CC;\" onclick=\"sendMessage();\">Send</button><div id=\"send_message_status\" style=\"float:right;\"></div></td></tr></table>";
return false;
}

function cancelMessage()
{
document.getElementById('send_message').innerHTML="";
}

function sendMessage()
{
//alert("chk");
$(document).ready(
function()
{
document.getElementById('send_message_status').innerHTML="<font color=#0066CC>Sending...</font>";
$.post("sendmessagesubmit.php","msgto="+document.getElementById('msgto').value+"&msgtext="+document.getElementById('msgtext').value,
function(data,status)
{
document.getElementById('send_message_status').innerHTML=data;
}
);
}
);
}

function confirmMessageDelete()
{
if(confirm("Are you sure.. you want delete this message?"))
{
return true;
}
else
{
return false;
}
}
</script>
<style>
button
{
	opacity:0.8;
}
button:hover
{
	opacity:1;
}
</style>
</head>
<body>
<div id="wrap">
<?php include("mainlinks.php");?>
<div id="content" style="background-position:0px 60px;background-repeat:no-repeat;background-attachment:fixed;background-image:url(images/msg.jpg);min-height:739;width:100%;">
<center>
<br><br>
<h1 style="font-weight:normal;color:#c40e0e">:: <font color="#000000">....</font> <font color="#1a0f80"><b>My Messages</b></font> <font color="#000000">....</font> ::</h1>
<center>
<table >
<tr><td style="padding:5px 80px;"><button onClick="loadMessageBox('Compose')" style=" background-color:#e9e9e9;color:#373737;font-size:15px;height:35px;border-radius:10px;width:200px;"><b>COMPOSE</b></button></td>
<td style="padding:5px 80px;"><button onClick="loadMessageBox('Inbox')" style=" background-color:#e9e9e9;color:#373737;font-size:15px;height:35px;border-radius:10px;width:200px;"><b>INBOX</b></button></td>
<td style="padding:5px 80px;"><button onClick="loadMessageBox('Sent')" style=" background-color:#e9e9e9;color:#373737;font-size:15px;height:35px;border-radius:10px;width:200px;"><b>SENT</b></button></td></tr>
</table>

<div id="message_box" height="80%" width="80%" style="border-width:0px;">
<script>loadMessageBox('Inbox');</script>
</div>
</div>
<div id="send_message" style="position:fixed; bottom:10px; right:10px; border:thin #4D4C4C; background-color:#FFFFFF; width:460px; z-index:2;"></div>
</div>
</div>
</center>
</body>
</html>