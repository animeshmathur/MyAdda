<?php
//$con=mysql_connect("mysql224.cp.365techsupport.com","u1022690_animesh","130792");
$con=mysql_connect("localhost","root","");
if(!$con)
{
	die('Connection failed!...'.mysql_error());
}
mysql_select_db("db1022690_myadda",$con);
//mysql_select_db("myadda",$con);

?>