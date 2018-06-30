<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<link rel="shortcut icon" href="images/favicon.ico" /> 
<title>My Adda</title>
<script src="include/scripts.js"></script>
<script src="include/jquery.js"></script>
<?php 
if(isset($_REQUEST['msg']))
{
$msg=$_REQUEST['msg'];
if($msg=="0")
{
echo "<script>alert(\"Invalid ID or Password!.\");</script>";
}
else if($msg=="1")
{
echo "<script>alert(\"Congratulations! Now you are a registered member of My Adda.\");</script>";
}
else
{
echo "<script>alert(\"Oops! Some error has occured!\");</script>";
}
//echo $msg;
}
?>
<script>$(document).ready(function()
{$("#images").hide();});$(document).ready(function()
{$("#images").load("random_picture_frame.php",function()
{$("#images").fadeIn();});});</script>
<style>
a{color:#003399;font-style:normal;text-decoration:none;}
a:hover{color:#FFFFFF;font-style:normal;text-decoration:none;}
#top{height:136px;width:100%;background-color:#3e3d3d;}
#frame
{
	height:220px;
	width:100%;
	background-color:#4d4c4c;
}
.frame_image{width:24%;float:right;height:100%;}
#mid{width:100%;height:550px;background-color:#3e3d3d;margin:0 auto;text-align:center;}
td{text-align:center;}
#reg
{
	width:55%;
	height:200%;
	align:center;
	background-color:#888787;
	float:right;
	border-radius:0px;
}
#login
{
	width:55%;
	background-color:#888787;
	float:right;
	position:relative;
	top:100px;
	height:36px;
	border-radius:8px;
}
</style>
<script>
var uid_status=0;
function checkIdAvailabilty()
{
	var uid=document.regform.user_id.value.toLowerCase();
	document.regform.user_id.value=uid;
	if(uid!="")
	{
		if(!uid.match(/^[0-9a-zA-Z]+$/))
		{
			alert("Only lowercase alphanumeric characters allowed in User ID!");
			uid_status=0;
			return false;
		}
		else
		{
			document.getElementById('id_avail_status').innerHTML="<font color=#FFFFFF>Checking Availability...</font>";
			$.post("get_uid_availability.php","userid="+uid,
			function(data,status)
			{
				document.getElementById('id_avail_status').innerHTML=data;
				if(data=="<font color=green><img src=\"images/tick.jpg\" title=\"User ID avalable!\"></font>")
				{	
					uid_status=1;
				}
				else
				{
					uid_status=0;
				}
			}
			);
		}
	}
}
</script>
</head>
<body>
<div id="top">
<div id="logo" style="float:left;width:30%;"><img src="images/index_logo.jpg" height="132px" width="100%"/></div>
<div id="login">
<form action="checklogin.php" style="background-color:#9B9B9B;text-align:center;"  method="post" name="loginform" onSubmit="return(checkLoginFields());">
<table cellpadding="5" width="50%" height="100%" style="float:right">
<tr>
<td><span style="font-size:20px;color:#333232;"><b>LOGIN</b></span></td>
<td><input type=text name="my_id" style="height:18px;color:#272727;border-radius:9px;padding:3px 10px"  placeholder="User ID"></td>
<td><input type=password name="my_pwd" style="height:18px;color:#272727;border-radius:9px;padding:3px 10px"  placeholder="Password" ></td>
<td><input type=submit value=" GO " style="background-color:#4D4C4C;font-size:15px;color:#FFFFFF;height:28px;border-radius:10px"></td>
</tr>
</table>
</form>
</div>
</div>
<div id="frame">
<div id="images" style="height:100%;width:100%;"></div>
</div>
<div id="mid">
<center>
<div id="reg">
<h2><font color=#333232>Not Registered?</font></h2>
<h3><font color=#E3E3E3>Sign Up here!!!</font></h3>
<form action=userregsubmit.php method="post" name="regform" onSubmit="return(checkRegFields());" style="background-color:#888787;width:100%;border-radius:26px;"><br/>
<table cellpadding="5">
<tr><td><font size=4>User ID:    </font></td>
<td><input type=text name="user_id" style="height:16px;color:#272727;border-radius:9px;padding:3px 10px" size="32" onBlur="checkIdAvailabilty();"></td><td id="id_avail_status"></td></tr>
<tr><td><font size=4>Password:    </font></td>
<td><input type=password name="user_pwd" style="height:16px;color:#272727;border-radius:9px;padding:3px 10px" size="32"></td><td></td></tr>
<tr><td><font size=4>Re-enter Password:    </font></td>
<td><input type=password name="rpwd" style="height:16px;color:#272727;border-radius:9px;padding:3px 10px" size="32"></td><td></td></tr>
<tr><td><font size=4>Name:    </font></td>
<td><input type=text name="uname" style="height:16px;color:#272727;border-radius:9px;padding:3px 10px" size="32"></td><td></td></tr>
<tr>
<td><font size=4>Gender:    </font></td>
<td><input type=radio name="ugender" value="Male" checked="checked">Male <input type=radio name="ugender" value="Female">Female</td><td></td></tr>
<tr><td><font size=4>Date of Birth (DD/MM/YY):    </font></td>
<td>
<select name="bday">
<option value="-1">-</option>
<?php
for($i=1;$i<=31;$i++)
echo "<option value=".$i.">".$i."</option>";
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
echo "<option value=".$i.">".$month[$i]."</option>";
?>
</select>
<select name="byear">
<option value="-1">-</option>
<?php
for($i=1947;$i<=2012;$i++)
echo "<option value=".$i.">".$i."</option>";
?>
</select>
</td>
<td></td>
</tr>
<tr>
<td>City:    </td>
<td>
<select name="ucity" >
<option value="-1">--- Select City ---</option>
<option value=Gwalior>Gwalior</option>
<option value=Bhopal>Bhopal</option>
<option value=Indore>Indore</option>
<option value=Gwalior>Delhi</option>

</select>
</td>
<td></td>
</tr>
<tr><td><font size=4>E-mail:    </font></td><td><input type="email" name="umail" style="height:16px;color:#272727;border-radius:10px;padding:3px 10px" size="32" title="Kindly provide your valid e-mail address. This helps you to get proper assistance in case on any help."></td><td></td></tr>
<tr><td><input type=submit value=Submit style="background-color:#4D4c4c;font-size:15px;color:#FFFFFF;height:28px;border-radius:10px"></td>
<td><input type=reset style="background-color:#4D4c4c;font-size:15px;color:#FFFFFF;height:28px;border-radius:10px"></td><td></td></tr>
</table>
</form>
</div>
</body>
</html>