<?php
include("mysqlconnect.php");
$frame_no=1;
$q="select dp from register where not dp='noimage.jpg' order by rand() limit 4";
$res=mysql_query($q);
?>

<?php
while(($row=mysql_fetch_array($res))&&($frame_no<=4))
{
	echo "<div id=frame_".$frame_no." class=frame_image style=\"width:24%\"><img src=upload/".$row['dp']." style=\"height:100%;max-width:100%; draggable=\"false\" ondragstart=\"return false\" onContextMenu=\"return false\"></div>";
	$frame_no++;
}
?>
