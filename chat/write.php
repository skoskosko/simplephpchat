<?php

require("includes.php"); 
if(empty($_SESSION['user'])) 
    { 
        header("Location: login.php"); 
        die("Redirecting to login.php"); 
    }
	
$message = $_POST["message"];
$message = str_replace("'","",$message);
$message =  str_replace(str_split('<>\;][}{"'),"",$message);
//taking away some things that can cause problems with the code


//this is to make images mp3s and some video clips to show in chat field
if(substr( $message, 0, 4 ) === "http"){
	if(mb_substr($message , -3)== "gif" || mb_substr($message , -3)== "jpg" || mb_substr($message , -3)== "png" ){
		$imgstart = "<img src='";
		$imgstart .= $message;
		$imgstart .= "' width='100%' onclick='view(this)'>";
		$message = $imgstart;
	}
	if(mb_substr($message , -3)== "mp4" || mb_substr($message , -4)== "webm"){
		
		$imgstart = "<video controls src='";
		$imgstart .= $message;
		$imgstart .= "' width='100%'></video>";
		$message = $imgstart;
		
		
	}
	if(mb_substr($message , -3)== "mp3"){
		
		$imgstart = "<audio controls><source src='";
		$imgstart .= $message;
		$imgstart .= "' type='audio/mpeg'></audio>";
		$message = $imgstart;
		
		
	}

	
	
	
}




//making posters name to session user. 
$name = $_SESSION['user'];

//and write everything to the file
file_put_contents('../../files/chat.txt', "<p class='", FILE_APPEND);
file_put_contents('../../files/chat.txt', $name, FILE_APPEND);
file_put_contents('../../files/chat.txt', "'>", FILE_APPEND);
file_put_contents('../../files/chat.txt', date("Y-m-d H:i:s"), FILE_APPEND);
file_put_contents('../../files/chat.txt', "<br>", FILE_APPEND);
file_put_contents('../../files/chat.txt', $name, FILE_APPEND);
file_put_contents('../../files/chat.txt', ":<br>", FILE_APPEND);
file_put_contents('../../files/chat.txt', $message, FILE_APPEND);
file_put_contents('../../files/chat.txt', "</p>", FILE_APPEND);