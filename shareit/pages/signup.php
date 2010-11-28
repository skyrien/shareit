<?php
/*
 * Share.It -- /pages/signup.php
 * Alexander Joo
 *  
 * This is the page for signing up and adding a new account.
 * 
 * This page is also the first Blueprint based test page.
 * 
 */

/*=====================================================================
/* Included files, Globals, HTML Header, Body
/*===================================================================*/
 require_once '../shared/db_ops.php';
 global $db_server;
 
 
//Checking for SHAREIT Session Cookies
 
 
 
 
//Redirect if already logged in
 
 
 
 
//Checking for FB delegated auth cookie
 
 
 
//Incoming POST handling code
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['agree']))
{
	$user_email = sanitizeString($_POST['email']);
	$user_password = sanitizeString($_POST['password']);
	$agree = $_POST['agree'];
	$addResult = AddUser($user_email, $user_password);
	if (!addResult)
	{
		echo "<h2>User Add failed.</h2>";
	}
	else
	{
		echo "<h2>User add success!</h2>";
		echo "User $user_email is now Share.it user #$addResult<br><br>";
	}	
} 
 

//HTML Header
echo <<< _END
<html>
	<head>
		
		<title>Account Creation - Share.It</title>
		
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
    
    <h1 id="signup">Sign up for Share.it</h1>
	</div>
	<hr />

	<div id="subheader" class="span-24 last">
    <h3 class="alt">Sign up for Share.it and start sharing stuff with your friends!</h3>
    </div>

    <hr />
	
	
_END;

 
//Signup block



//Form goes here currently the password is not hashed. It should be.
echo <<< _END
<h2>Add new user:</h2>
<form method="post" action="signup.php"/>
	Email Address (up to 100 characters)<br><input type="text" name="email"/><br>
	Password (up to 32 characters)<br><input type="text" name="password"/><br>
	I agree to the <a href="http://shareit.skyrien.com/terms.php">terms of use</a>.
	<input type="checkbox" name="agree"/><br>
	<input type="submit" value="Add user..."/>
</form>
_END;



//HTML footer
echo "</body>";
?>