<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>

<head>
		<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>


<?php 
 require("includes.php"); 
	$users = fopen("../../files/kayttajat.txt", "r") or die("Unable to open file!"); //open files for verification
	$passwords = fopen("../../files/password.txt", "r") or die("Unable to open file!");
	$salts = fopen("../../files/salt.txt", "r") or die("Unable to open file!");

	if($_POST['user']){
	$user = $_POST['user'];
	/*checkt that no one enters anything not nice in my fields*/
	$testi = ereg_replace("[^A-Za-z0-9?!öäåÄÖÅ[:space:]]", "", $user); 
	if($user != $testi){
		
		header( "Location: login.php" );
		echo("<script>alert('Please use only letters and numbers');</script>");
	}
	/*get usernames and passwords out of txt files*/
	$users = file_get_contents("../../files/kayttajat.txt");	
	$users = str_replace('"', "", $users);
	$users = explode(',', $users);
	$password = $_POST['password'];	
	$password = file_get_contents("../../files/password.txt");	
	$password = str_replace('"', "", $password);
	$password =  explode(',', $password);	
	$salt = file_get_contents("../../files/salt.txt");	
	$salt = str_replace('"', "", $salt);
	$salt =  explode(',', $salt);	
	$key;	
	$isuser = false;
	$count = count($password);
	/*check that username exists*/
	for ($x = 0; $x<= $count; $x++) {
     
		if ($users[$x]=== $_POST['user']){
			$key = $x;
			$isuser = true;
		break;
		}
		
	}
	
	/*if user is not found tell user that his username is wrong*/
	/*also check and test password, using salts and such so pretty secure*/
	if($isuser == true){
			$check_password = hash('sha256', $_POST['password']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password .$salt[$key]); 
				
            } 
            if($check_password === $password[$key]) 
            { 
                $login_ok = true; 
				$_SESSION['user'] = $users[$key];
				header( "Location: index.php" );
				echo "toimi";
            } 		
	}else{
				header( "Location: login.php" );
		echo("<script>alert('Please use existing username');</script>");	
	}
	}
	
?> 


<body>
<div id="login_form">
<div id="login_form2">

<form   autocomplete="off"  action="login.php" method="POST">

<input type="text" id="loginfield" name="user" placeholder="Username"></input><br>
<input type="password" id="loginfield" name="password" placeholder="Password"></input>
<br>
<input id = "loginbutton" type="submit" name="submit" value="Log in" onclick="passwordcheck()">

</form>

<input id = "loginbutton" type="button" onclick='location.href="newuser.php"' value="New User">
</div>
</div>
</body>
</html>