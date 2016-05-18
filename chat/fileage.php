<?php 
// this file returns files age
require("includes.php"); 
if(empty($_SESSION['user'])) 
    { 
        
        header("Location: login.php"); 
        die("Redirecting to login.php"); 
    }
	clearstatcache();
echo (filemtime('../../files/chat.txt')); //file age echoed so ajax can get it back
