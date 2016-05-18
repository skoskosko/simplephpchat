<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<style>
</style>
<head>
		<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>

<?php
 require("includes.php"); 
$users = fopen("../../files/kayttajat.txt", "r") or die("Unable to open file!");
$passwords = fopen("../../files/password.txt", "r") or die("Unable to open file!");
$salts = fopen("../../files/salt.txt", "r") or die("Unable to open file!");

/*include used files for writing passwords*/
if( $_POST['password']){
	if($_POST['user']){

	$users = file_get_contents("../../files/kayttajat.txt");	
	$users = str_replace('"', "", $users);
	$users = explode(',', $users);
	
	$count = count($users);
/*check for odd characters and then complain is there are some*/	
	$userillegalcharacters =  str_replace(str_split('<>\/{}[]!"#¤%&/)(@£$€}]{["'),"",$_POST['user']);
	$userillegalcharacters =  str_replace(" ","",$userillegalcharacters);
	$userillegalcharacters = str_replace("'","",$userillegalcharacters);	
	if($userillegalcharacters!=$_POST['user']){
		echo("<script>alert('Use only letters and numbers');</script>");
			exit(header("Location: newuser.php"));
	}
	/* if username exists complain and stop making new ones*/
	for ($x = 0; $x<= $count; $x++) {
     
	 if ($users[$x]=== $_POST['user']){
		echo("<script>alert('Username already exists');</script>");
			exit(header("Location: newuser.php"));
		}
	}
	
	$password =  str_replace(str_split('<>\/{}[]!"#¤%&/)(@£$€}]{["'),"",$_POST['password']);
	$password =  str_replace(" ","",$password);
	$password = str_replace("'","",$password);
	if($password !=  $_POST['password']){
		
		echo("<script>alert('password contains illegal characters<>\/{}[]!#¤%&/@£$€}]{[spaces punctuations or bracket');</script>");
			exit(header("Location: newuser.php"));
		
	}
	
	/* getting some salt and password and make them encrypted so bad guys cant easily crack them */
$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
$password = hash('sha256', $_POST['password']); 
for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 

/* writing into txt files all passwords and salts */
file_put_contents('../../files/salt.txt',',"' , FILE_APPEND);
file_put_contents('../../files/salt.txt', $salt, FILE_APPEND);
file_put_contents('../../files/salt.txt', '"', FILE_APPEND);

file_put_contents('../../files/password.txt',',"' , FILE_APPEND);
file_put_contents('../../files/password.txt', $password, FILE_APPEND);
file_put_contents('../../files/password.txt', '"', FILE_APPEND);
		
		
	/* also users hetting writed */	
$user = $_POST["user"];
file_put_contents('../../files/kayttajat.txt',',"' , FILE_APPEND);
file_put_contents('../../files/kayttajat.txt', $user, FILE_APPEND);
file_put_contents('../../files/kayttajat.txt', '"', FILE_APPEND);


header( "Location: login.php" );

/*check for password */
}}else{
	if($_POST['user']){
	echo("<script>alert('Give password');</script>");
	}
}
			
?>



<script src="js/jquery-1.12.3.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
			var users = [<?php echo fread($users,filesize("../../files/kayttajat.txt"));?>];
			users = users.toString();
			users = users.replace(new RegExp("," ,"g"), "<br />");
			document.getElementById("usernamelist").innerHTML = users;
	});
//ready function to make list of users

</script>
<body>
<div id="usernamelist"></div>
<div id="login_form">
<div id ="login_form2">
<form   autocomplete="off" action="newuser.php"id="contactForm"  method="POST">
<input type="text" id ="loginfield" id="loginfield" placeholder="Username" name="user" />
<input type="password" id ="loginfield" placeholder="Password"  id="loginfield" name="password" /><br>
<input type="submit" name="submit" id ="loginbutton" value="Make new user">
</form>
<input type="button" id ="loginbutton" onclick='location.href="login.php"' value="Back">
</div>
</div>

</body>
</html> 
