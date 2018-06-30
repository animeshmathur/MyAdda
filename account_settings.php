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
<script>
$(document).ready(
function()
{
$("#basic_details_editable").hide();
$("#editable_email").hide();
$("#editable_pwd").hide();
document.getElementById('password_form').old_pwd.value="";
}
);
$(document).ready(
function()
{
$("#edit_bd_button").click(
function()
{
$("#basic_details").fadeOut(
function()
{
$("#basic_details_editable").fadeIn();
}
);
}
);
}
);
$(document).ready(
function()
{
$("#edit_email_button").click(
function()
{
$("#old_email").fadeOut(
function()
{
$("#editable_email").fadeIn();
}
);
}
);
}
);

$(document).ready(
function()
{
$("#edit_pwd_button").click(
function()
{
$("#old_pass").fadeOut(
function()
{
$("#editable_pwd").fadeIn();
}
);
}
);
}
);

$(document).ready(
function()
{
$("#change_bd_button").click(
function()
{
document.getElementById('status').innerHTML="<font color=#0066CC>Please Wait...</font>";
$.post("change_basic_details.php","uname="+document.getElementById('basic_details_editable').uname.value+"&ugender="+$('input:radio[name="ugender"]:checked').val()+"&ucity="+document.getElementById('basic_details_editable').ucity.value+"&bday="+document.getElementById('basic_details_editable').bday.value+"&bmonth="+document.getElementById('basic_details_editable').bmonth.value+"&byear="+document.getElementById('basic_details_editable').byear.value,
function(data,status)
{
document.getElementById('status').innerHTML="<font color=green>"+data+"</font>";
}
);
}
);
}
);

$(document).ready(
function()
{
$("#change_email_button").click(
function()
{
document.getElementById('status').innerHTML="<font color=#0066CC>Please Wait...</font>";
$.post("change_umail.php","umail="+document.getElementById('new_umail').value,
function(data,status)
{
document.getElementById('status').innerHTML="<font color=green>"+data+"</font>";
}
);
}
);
}
);

$(document).ready(
function()
{
$("#change_pwd_button").click(
function()
{
if(document.getElementById('password_form').old_pwd.value!=""&&document.getElementById('password_form').new_pwd.value!=""&&document.getElementById('password_form').new_rpwd.value!="")
{
if(document.getElementById('password_form').new_pwd.value==document.getElementById('password_form').new_rpwd.value)
{
document.getElementById('status').innerHTML="<font color=#0066CC>Please Wait...</font>";
$.post("change_upassword.php","oldpwd="+document.getElementById('password_form').old_pwd.value+"&newpwd="+document.getElementById('password_form').new_pwd.value,
function(data,status)
{
document.getElementById('status').innerHTML="<font color=green>"+data+"</font>";
document.getElementById('password_form').old_pwd.value="";
document.getElementById('password_form').new_pwd.value="";
document.getElementById('password_form').new_rpwd.value="";
}
);
}
else
{
document.getElementById('status').innerHTML="<font color=#0066CC>New passwords do not match!</font>";
document.getElementById('password_form').new_pwd.value="";
document.getElementById('password_form').new_rpwd.value="";
}
}
else
{alert("Filling all password fields is mandatory!");}
}
);
}
);
</script>
<style>
[type=button],[type=reset],button{background-color:#E5E5E5;color:#4D4C4C;text-align:center;border-radius:10px;}
</style>
</head>



<body>
<div id="wrap">
<?php include("mainlinks.php");?>

<div id="content" style="background-position:0px 60px;background-repeat:no-repeat;background-attachment:fixed;background-image:url(images/settings.jpg);min-height:739;width:100%;">
<center>
<br><br>
<?php
$res=mysql_query("select * from register where uid='".$uid."'");
if($row=mysql_fetch_array($res))
{
?>

<h1 style="font-weight:normal;color:#c40e0e">:: <font color="#000000">....</font> <font color="#1a0f80"><b>My Account Settings</b></font> <font color="#000000">....</font> ::</h1>
<p id="status"></p>
<div id="account_basic_details">
<div id="basic_details">
<table cellpadding="5" style="width:600px;background-color:#6f6f6f;color:#ffffff;text-align:center;border-radius:10px;opacity:0.8;">
<?php
echo "<tr><td>Name: </td><td>".$row['uname']."</td></tr>";
echo "<tr><td>Gender: </td><td>".$row['ugender']."</td></tr>";
echo "<tr><td>City: </td><td>".$row['ucity']."</td></tr>";
echo "<tr><td>Date Of Birth: </td><td>".$row['dob']."</td></tr>";
?> 
</table><br>
<button id="edit_bd_button" style=" background-color:#e9e9e9;color:#373737;font-size:15px;height:35px;border-radius:10px;"><b>Update Details</b></button>
</div>
<form id="basic_details_editable" name="basic_details_editable">
<table cellpadding="5" style="width:600px;background-color:#4D4C4C;color:#E5E5E5;text-align:center;border-radius:10px;">
<tr><td>Name: </td><td><input type="text" name="uname" value="<?php echo $row['uname'];?>"></td></tr>
<tr><td>Gender: </td><td><input type=radio name="ugender" value="Male" <?php if($row['ugender']=="Male"){echo "checked=\"checked\"";}?>>Male <input type=radio name="ugender" value="Female" <?php if($row['ugender']=="Female"){echo "checked=\"checked\"";}?>>Female</td></tr>
<tr><td>City: </td><td>
<select name="ucity">
<option value="-1">--- Select City ---</option>
<option value=Gwalior <?php if($row['ucity']=="Gwalior"){echo "selected=\"selected\"";}?>>Gwalior</option>
<option value=Bhopal <?php if($row['ucity']=="Bhopal"){echo "selected=\"selected\"";}?>>Bhopal</option>
<option value=Indore <?php if($row['ucity']=="Indore"){echo "selected=\"selected\"";}?>>Indore</option>
</select>
</td></tr>
<tr><td>Date Of Birth: </td><td>
<select name="bday">
<option value="-1">-</option>
<?php
for($i=1;$i<=31;$i++)
{
if(substr($row['dob'],8,2)==$i)
{echo "<option value=".$i." selected=\"selected\">".$i."</option>";}
else
{echo "<option value=".$i.">".$i."</option>";}
}
?>
</select>
<select name="bmonth">
<option value="-1">-</option>
<?php
$month[1]="Jan";
$month[2]="Feb";
$month[3]="Mar";
$month[4]="Apr";
$month[5]="May";
$month[6]="Jun";
$month[7]="Jul";
$month[8]="Aug";
$month[9]="Sep";
$month[10]="Oct";
$month[11]="Nov";
$month[12]="Dec";
for($i=1;$i<=12;$i++)
{
if(substr($row['dob'],5,2)==$i)
{echo "<option value=".$i." selected=\"selected\">".$month[$i]."</option>";}
else
{echo "<option value=".$i.">".$month[$i]."</option>";}
}
?>
</select>
<select name="byear">
<option value="-1">-</option>
<?php
for($i=1947;$i<=2012;$i++)
{
if(substr($row['dob'],0,4)==$i)
{echo "<option value=".$i." selected=\"selected\">".$i."</option>";}
else
{echo "<option value=".$i.">".$i."</option>";}
}
?>
</select>
</td></tr>
<tr><td><input type="button" id="change_bd_button" value="Change"></td><td><input type="reset"></td></tr>
</table>
</form>
<br><br><br>
</div>
<div id="account_details">
<table cellpadding="5" style="width:600px;background-color:#6f6f6f;color:#ffffff;border-radius:10px;text-align:center;opacity:0.8;">
<tr id="old_email"><td><b>E-Mail - </b>&nbsp;&nbsp;<i><?php echo $row['umail'];?></i></td><td><button id="edit_email_button" style="width:100px;color:#666666;border-radius:5px;">Edit</button></td></tr>
<tr id="editable_email"><td><b>E-Mail - </b>&nbsp;&nbsp;<i><input type="email" id="new_umail" value="<?php echo $row['umail'];?>" size="35"></i></td><td><button id="change_email_button" style="width:100px;color:#666666;border-radius:5px;">Change</button></td></tr>

<tr id="old_pass"><td>Password - **********</td><td><button id="edit_pwd_button" style="width:100px;color:#373737;border-radius:5px;">Edit</button></td></tr>
<tr id="editable_pwd">
<td>
<form id="password_form">
<table style="color:#E5E5E5;">
<tr><td>Enter Old Password - </td><td><input type="password" name="old_pwd"></td></tr>
<tr><td>Enter New Password - </td><td><input type="password" name="new_pwd"></td></tr>
<tr><td>Re-Enter New Password - </td><td><input type="password" name="new_rpwd"></td></tr>
</table>
</form>
</td><td><button id="change_pwd_button" style="width:100px;color:#373737;border-radius:5px;">Change</button></td>
</tr>
</table>
</div>
<?php
}
?>
<br><br><br>
<table>
<tr><td><button style="color:#FFFFFF;background-color:#c40e0e;height:35px;border-radius:10px;"><b>&times; Remove My Account Permanently &times;</b></button></td></tr>
</table>
</center>
</div>
</div>
</body>
</html>