<?php
// This is called when you want to empty chat field.

require("includes.php"); //check that you are logged in
if(empty($_SESSION['user'])) 
    { 
        header("Location: login.php");  
        die("Redirecting to login.php"); 
    }
//and lastly make chat file empty
$myfile = fopen("../../files/chat.txt", "w") or die("Unable to open file!"); // opening file anr replacing everyrthiung in it, after that closing file.
fwrite($myfile, "");
fclose($myfile);