<?php
	require("includes.php"); //includes file is included so all php pages are part of session so password protection can be arranged.
		
	if(empty($_SESSION['user'])) {  
		header("Location: login.php"); 
		die("Redirecting to login.php"); 
	}
	//If sessions user is not set user will be redirected to the login page.
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>

	<head>
		<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/><!-- Necessary materials are included -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!-- such as css files jquery 1.9.1. for ajax and jquery -->
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script><!-- All functions used are also located in js folder. -->
		<script src="js/functions.js"></script>
		<script type="text/javascript">
		var user= "<?php echo($_SESSION['user']);?>"; // get username for css to get chat boxes to right places.
		updatefunction(user);
		</script>
	</head>




<body>

<div id = "chat_area"></div> <!-- Div where chat is written from chat.txt file -->

<div id="inputarea">	<!-- input areas are included and submit button are in this div -->

<form   autocomplete="off" action="write.php">
	
	<textarea  id="textfield" type="text" name="message" ></textarea><!-- Form where we get message to send to the php file trough ajax. Ajax that stops normal submit and submits form -->
	<input type="image" height ="100" src="img/submit.png" id="sumbitbutton" type="submit" name="submit" value="Submit">

</form>
</div>

<img id="button" src="img/del.png" height="50px" onclick='deletedata()' >  <!-- 2 image buttons that are outside divs so they just randomly flop around  -->
<img id="button" src="img/logout.png" height="50px" onclick='logout()' >

</body>
</html>