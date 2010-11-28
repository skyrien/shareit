<?php
/*
 * Share.It -- /index.php
 * Alexander Joo
 *  
 * This is the initial page. Includes branding header, login, sign up, and
 * Facebook Connect integration.
 * 
 */

/*=====================================================================
/* Included files, Globals, HTML Header, Body
/*===================================================================*/
 require_once 'shared/db_ops.php';
 global $db_server;
 
 
//Checking for SHAREIT Session Cookies
 
 
 
 
//Redirect if already logged in
 
 
 
 
//Checking for FB delegated auth cookie
 
 
 
 
 

//HTML Header
echo <<< _END
<html>
	<head>
		<title>Welcome to Share.It</title>
	</head>
	<body>

_END;

 
//Signup block -- current version redirects user to signup page; later
//versions can have AJAX signup from the index page.
 



//HTML footer
echo "</body>";
?>