<?php
	require("includes.php"); 
    unset($_SESSION['user']); 
    header("Location: login.php"); 
    die("Redirecting to: login.php");
	//When logout is called we unset user and send to login page.