<?php
require("includes.php"); 
if(empty($_SESSION['user'])) 
    {  
        header("Location: login.php"); 
        die("Redirecting to login.php"); 
    }
	/* this phps functyion is to just give user their text fields. Unlike other fields it needs to have html tag for those nordics*/
	?>

<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<style>
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body onload="pageScroll()">
<?php
$chattekstit = fopen("../../files/chat.txt", "r") or die("Unable to open file!");
echo fread($chattekstit,filesize("../../files/chat.txt"));
fclose($chattekstit);
?>
<script type="text/javascript">
function pageScroll() { window.scrollBy(0,10000000000000000000000000000000000000000000000000000000000000000000000000000000000000);}

</script>
</html>
	 
	 
	 