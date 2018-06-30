<?php
include("session.php");
include("head.php");
include("mysqlconnect.php");
$friend=$_REQUEST['friend'];
?>
<html>
<head>
<title>My Adda : CHAT</title>
<script>
$(document).ready(getChatText);

$(window).unload(function() {
//alert('Handler for .unload() called.');
});

function getChatText()
{
$(document).ready(
function()
{
$.post("chattextwindow.php","friend=<?php echo $friend?>",
function(data,status)
{
//alert(data);
$("#chat_text").append(data);
if(data!="")
{
$("#chat_text_window").scrollTop($("#chat_text_window").height());
}
getChatText();
}
);
}
);
}

function postChatText()
{
$(document).ready(
function()
{
my_txt=document.getElementById('my_text').value;
if(my_txt=="")
{return false;}
else
{
my_txt=my_txt.replace(":)","<img src=images/smilies/smile.png class=smilie>");
my_txt=my_txt.replace(":(","<img src=images/smilies/sad.png class=smilie>");
my_txt=my_txt.replace(":P","<img src=images/smilies/tease.png class=smilie>");
my_txt=my_txt.replace(":D","<img src=images/smilies/big-smile.png class=smilie>");
$("#chat_text").append("<tr><td><i><b><?php echo $uid;?>: </b></i></td><td><i>"+my_txt+"</i></td></tr>");
$("#chat_text_window").scrollTop($("#chat_text_window").height());
document.getElementById('my_text').value="";
$.post("chatsubmit.php","friend=<?php echo $friend?>&txt="+my_txt);}
}
);
}
</script>
<style>
.smilie
{height:15px;width:15px;}
</style>
</head>
<body onUnload="cleanUp();">
<center><br>
<div id="chat_text_window" style="height:220;width:450;border:thick #666666 groove;border-radius:15px;padding:5px 5px;background-color:#FFFFFF;overflow:scroll;">
<table id="chat_text" style="float:left;"></table>
</div>
<div id="text_to_send">
<form onSubmit="return false" autocomplete="off">
<table>
<tr><td><input type="text" autocomplete="off" id="my_text" name="txt" style="height:30;width:400;border:thin #666666 groove;border-radius:10px;"></td>
<td><button onClick="postChatText()" style="width:80;style="background-color:#4D4c4c;font-size:15px;color:#FFFFFF;height:35px;border-radius:10px">Send</button></td></tr>
</table>
</form>
</div>
</center>
</body>
</html>