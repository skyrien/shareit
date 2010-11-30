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
require_once './shared/sql_cfg_local.php';
require_once './shared/db_ops.php';
 global $db_server;
 global $postResult;
 
//Checking for SHAREIT Session Cookies
 
 
 
 
//Redirect if already logged in
 


 
 
//Checking for FB delegated auth cookie
 
//TEST CODE
//AddUser('sky', 'tester', 'xand', 'skyr');
 
// if (isset($_POST['myemail'])) echo $_POST['myemail'] . "<br>";
// if (isset($_POST['emailagain'])) echo $_POST['emailagain'] . "<br>";
// if (isset($_POST['password'])) echo $_POST['password'] . "<br>";
// if (isset($_POST['firstname'])) echo $_POST['firstname'] . "<br>";
// if (isset($_POST['lastname'])) echo $_POST['lastname'] . "<br>";
// if (isset($_POST['agree'])) echo $_POST['agree'] . "<br>"; 
 
//Incoming POST handling code
if (isset($_POST['myemail']) && isset($_POST['password']) && isset($_POST['agree']))
{
	$user_email = sanitizeString($_POST['myemail']);
	//This now includes sha1 hashing of the password string
	$user_password = sha1($pw_salt . sanitizeString($_POST['password']));
	$agree = $_POST['agree']; // true-false
	$firstName = sanitizeString($_POST['firstname']);
	$lastName = sanitizeString($_POST['lastname']);
	
	// the add user ID is given to the addResult var
	// if failed, a negative number will be returned
	$addResult = AddUser($user_email, $user_password, $firstName, $lastName);
	if ($addResult < 0)
	{
		if ($addResult == -2)
			$postResult = "<h2>User add failed. Already exists.</h2>";
		else $postResult = "<h2>User Add failed.</h2>";
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
<link rel="stylesheet" href="./css/blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="./css/blueprint/print.css" type="text/css" media="print">	
<link rel="stylesheet" href="./css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" /> 
<!--[if lt IE 8]><link rel="stylesheet" href="./css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->		
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

if ($postResult != null)
{
	echo $postResult;
	echo "<h3>Sign in <a href=\"./index.php\">here!</a>";
}

else echo <<< _END
<h2>Add new user:</h2>
<form method="post" action="signup.php">
	Your email<br><input type="text" maxlength="100" name="myemail" /><br>
	Re-enter email<br><input type="text" maxlength="100" name="emailagain" /><br>
	New password<br><input type="text" maxlength="32" name="password" /><br>
	First name<br><input type="text" maxlength="100" name="firstname" /><br>
	Last name<br><input type="text" maxlength="100" name="lastname" /><br>
	I agree to the <a href="http://shareit.skyrien.com/terms.php">terms of use</a>.
	<input type="checkbox" name="agree"/><br>
	<input type="submit" value="Add user..."/>
</form>
_END;



//HTML footer
echo "</body>";
?>