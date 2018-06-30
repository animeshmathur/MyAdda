
<meta charset="utf-8">
<link rel="stylesheet" href="my.css" type="text/css" media="all">
<link rel="shortcut icon" href="images/favicon.ico" /> 
<script src="include/jquery.js"></script>
<script>
$(document).ready(
function()
{
$('img').attr({
"draggable":"false","ondragstart":"return false"
});
$('img').bind('contextmenu', function(e) {
    return false;
});
}
); 
</script>
    
		