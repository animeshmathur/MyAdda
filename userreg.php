<html>
<head>
<title>User Registration</title>
<script src="scripts.js"></script>
</head>
<body style="background-color:#FFFFCC">

<div align=center>
<img src=logo.jpg height="200" width="800">
<form action=userregsubmit.php method="post" name="regform" onSubmit="return(checkRegFields());">
<table cellpadding="5">
<caption><h2><i>User Registration</i></h2></caption>
<tr><td>User ID: </td><td><input type=text name="uid"></td></tr>
<tr><td>Passowrd: </td><td><input type=password name="pwd"></td></tr>
<tr><td>Re-enter Password</td><td><input type=password name="rpwd"></td></tr>
<tr><td>Name: </td><td><input type=text name="uname"></td></tr>
<tr>
<td>Gender: </td><td><input type=radio name="ugender" value="Male">Male <input type=radio name="ugender" value="Female">Female</td></tr><tr><td>Date of Birth (DD/MM/YY): </td>
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
</tr>
<tr>
<td>City: </td>
<td>
<select name="ucity">
<option value="-1">--- Select City ---</option>
<option value=Gwalior>Gwalior</option>
<option value=Bhopal>Bhopal</option>
<option value=Indore>Indore</option>
</select>
</td>
</tr>
<tr><td>E-mail: </td><td><input type="email" name="umail"></td></tr>
<tr><td><input type=submit value=Submit></td><td><input type=reset></td></tr>
</table>
</form>
</div>
</body>
</html>