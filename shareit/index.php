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
 
 
 

//Page Header
 echo <<< _END
<html>
	<head>
		
		<title>Welcome to Share.It</title>
		
		<!-- Blueprint Framework CSS, including Fancy Type -->
		<link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">	
		<link rel="stylesheet" href="blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" /> 
		<!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->		
	</head>
	
	<body>
	<!-- Requried for HTML Header (within body) -->
	<div class="container">
    <div id="header" class="span-24 last">
    
    <h1 id="signup">Welcome to Share.it</h1>
	</div>
	<hr />

_END;

 
//Signup block -- current version redirects user to signup page; later
//versions can have AJAX signup from the index page.
 echo "Don't have an account? Sign up for one <a href=\"shared/signup.php\">here!</a>";



//HTML footer
echo "</body>";
?>