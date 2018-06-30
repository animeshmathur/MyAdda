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
</head>
<body>
<div id="wrap">
<?php include("mainlinks.php")?>
<div id="content">
<center><br>
<h1 style="font-weight:normal;color:#c40e0e">:: <font color="#ffffff">....</font> <font color="#1a0f80"><b>My Profile</b></font> <font color="#ffffff">....</font> ::</h1>
<form action="createprofilesubmit.php">
<table style="background:#373737;color:#FFFFFF;width:60%;text-align:center;border-radius:20px;">
<tr><td>My Nick Name: </td><td><input type="text" name="nicknm" /></td></tr>
<tr><td>About Me: </td><td><textarea name="myinfo" columns="100" rows="4"></textarea></td></tr>
<tr><td>Age: </td><td><input type="text" name="age" /></td></tr>
<tr><td>Relationship Status: </td><td><input type="radio" name="relstatus" value="Single" />Single <input type="radio" name="relstatus" value="Married" />Married <input type="radio" name="relstatus" value="Commited" />Commited</td></tr>
<tr>
<td>Hobbies: </td>
<td>
<textarea name="hobbies"></textarea>
<?php 
//<input type="checkbox" name="h1" value="Music">Music <input type="checkbox" name="h2" value="Movies">Movies <input type="checkbox" name="h3" value="Books">Books <br><input type="checkbox" name="h4" value="Computers">Computers <input type="checkbox" name="h5" value="TV">TV <br>Others (<i>Please Specify</i>): <input type="text" name="h6">
?>
</td>
</tr>
<tr><td>Favourite Movie: </td><td><textarea name="favmovie"></textarea></td></tr>
<tr><td>Favourite Celebrity: </td><td><textarea name="favcelebrity"></textarea></td></tr>
<tr><td>Favourite Music: </td><td><textarea name="favmusic"></textarea></td></tr>
<tr><td>Favourite Singer: </td><td><textarea name="favsinger"></textarea></td></tr>
<tr><td>My Best Friend(s): </td><td><textarea name="bestfrnd"></textarea></td></tr>
<tr><td><input type="submit" value="Save"></td><td><input type="reset"></td></tr>
</table>
</form>
</center>
</div>
</div>
</body>
</html>