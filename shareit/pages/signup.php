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
 global $postResult;
 
//Checking for SHAREIT Session Cookies
 
 
 
 
//Redirect if already logged in
 
 
 
 
//Checking for FB delegated auth cookie
 
 
 
//Incoming POST handling code
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['agree']))
{
	$user_email = sanitizeString($_POST['email']);
	//This now includes sha1 hashing of the password string
	$user_password = sha1(sanitizeString($_POST['password']));
	$agree = $_POST['agree'];
	$firstName = sanitizeString($_POST['firstName']);
	$lastName = sanitizeString($_POST['lastName']);
	
	// the add user ID is given to the addResult var
	// if failed, a negative number will be returned
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

//HTML Header
echo <<< _END
<html>
<head>
<title>Account Creation - Share.It</title>
<!-- Blueprint Framework CSS, including Fancy Type -->
<link rel="stylesheet" href="../css/blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="../css/blueprint/print.css" type="text/css" media="print">	
<link rel="stylesheet" href="../css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" /> 
<!--[if lt IE 8]><link rel="stylesheet" href="../css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->		
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
if ($postResult != null)
{
	echo $postResult;
}

else echo <<< _END
<h2>Add new user:</h2>
<form method="post" action="signup.php"/>
	Your email<br><input type="text" name="email"/><br>
	
	Re-enter email<br><input type="text" name="emailAgain"/><br>
	
	New password<br><input type="text" name="password"/><br>
	
	First name: <br><input type="text" name="firstName"/><br>
	
	Last name: <br><input type="text" name="lastName"/><br>
	
	I agree to the <a href="http://shareit.skyrien.com/terms.php">terms of use</a>.
	<input type="checkbox" name="agree"/><br>
	
	<input type="submit" value="Add user..."/>
</form>
_END;



//HTML footer
echo "</body>";
?>