<?php
	// On logout , 
	// Delete all created sessions 
	// Default all cookies 
	session_start();
	session_destroy();
	setcookie("username",'');
	setcookie("password",'');
	// Redirect to the login page 
	header("location:index.php");
?>