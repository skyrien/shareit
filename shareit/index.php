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
 
 
 
 
//Incoming post (signin) handling logic
if (isset($_POST['email']) && isset($_POST['password']))
{
	$user_email = sanitizeString($_POST['email']);
	//This now includes sha1 hashing of the password string
	$user_password = sha1(sanitizeString($_POST['password']));
	
	// check exists
	$addResult = AddUser($user_email, $user_password, $firstName, $lastName);
	if (addResult < 0)
	{
		// we can later add code to process different errors		
		$postResult = "<h2>User Add failed.</h2>";
	}
	else // Additional add code
	{
		$postResult = "<h2>User add success! User #$addResult has been created.</h2>";
		//echo "User $user_email is now Share.it user #$addResult<br><br>";
		
		
		//redirect user to signin
	}	
}

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

//Signin block
echo <<< _END
<h2>Current Users</h2>
<form method="post" action="index.php"/>
	Email: <br><input type="text" name="email"/><br>
		
	Password: <br><input type="text" name="password"/><br>
	
	<input type="submit" value="Sign in..."/>
</form>
<hr />
_END;
 
 
//Signup block -- current version redirects user to signup page; later
//versions can have AJAX signup from the index page.
 echo "Don't have an account? Sign up for one <a href=\"shared/signup.php\">here!</a>";



//HTML footer
echo "</body>";
?>