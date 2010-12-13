<?php
/*
 * Share.It -- /index.php
 * Alexander Joo
 * Ibrahim Shareef 
 *  
 * This is the initial page. Includes branding header, login, sign up, and
 * Facebook Connect integration.
 * 
 */

/*=====================================================================
/* Included files, Globals, HTML Header, Body
/*===================================================================*/
require_once './shared/sql_cfg_local.php'; 
require_once './shared/db_ops.php';
require_once './shared/user_ops.php';
require_once './shared/page_ops.php';
require_once './shared/auth/Authenticator.php';

global $db_server;
global $postResult;
 

//Checking for SHAREIT Session Cookies
 if (isset($_COOKIE[SHARE_IT_COOKIE]))
 {
 	if (ValidateShareItAuthCookie($_COOKIE[SHARE_IT_COOKIE]))
 	{
 		//redirect home page
 		header('location:home.php');
 		exit;
 	}
 		//redirect to user home page, e.g. home.php 	
 }
 if (isset($_COOKIE[FACEBOOK_COOKIE]) || (isset($_POST['email'])) && isset($_POST['password'])) //user signed in with facebook or share.it credentials
 {
    //validate facebook cookie and set share.it cookie
 	if (!ValidateUserSignIn($_COOKIE[FACEBOOK_COOKIE],$_POST['email'], $_POST['password']))
 	{
 		$error_msg = '<b>Invalid username or password</b>';
 	}
 	else //sign-in succeeded 
 	{
 		header('location:home.php');
 		exit;
 	}
 }
 
//Checking for FB delegated auth cookie
 
 
 
/*
//Incoming post (signin) handling logic
if (isset($_POST['email']) && isset($_POST['password']))
{
	$user_email = sanitizeString($_POST['email']);
	//This now includes sha1 hashing of the password string
	$user_password = sha1($pw_salt . sanitizeString($_POST['password']));
	
	// check exists-returns UID if found
	$validateResult = SigninValidate($user_email, $user_password);
	
	// This is the error case
	if ($validateResult < 0)
	{
		// we can later add code to process different errors		
		$postResult = "<h2>Oops, the email/password combination was not found.</h2>";
	}
	else // User found, password match
	{
		$uid = $validateResult;
		$theUser = new siuser; 
		$theUser->getFullName($uid);
		$first = $theUser->firstname;
		$last = $theUser->lastname;
		setcookie('uid', $validateResult, time()+ 60*60*24*7, '/');
		setcookie('firstname', $first, time()+ 60*60*24*7, '/');
		setcookie('lastname', $last, time()+ 60*60*24*7, '/');
		$postResult =
		"<h2>User found. Welcome, $first $last.</h2><br>
		Go to your <a href=\"./home.php\">home page.</a><br><br>";
	}	
}
*/
//Page Header
/*echo getPageHeader("Welcome to Share.it", "Welcome to Share.it",
	"Share.it is a social utility to help you share items with your friends and neighbors!");*/
 
if ($postResult != null)
{
	echo $postResult;
}

/*else echo <<< _END
<h2>Current users sign in here</h2>
_END;*/
 
//Signup block -- current version redirects user to signup page; later
//versions can have AJAX signup from the index page.
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>share.it</title>
  </head>
  <body>
    <h1>share.it</h1>
    <h1>Sign In Here</h1>
    <br><h2>$error_msg</h2></br>
<form method="post" action="index.php"/>
	Email: <br><input type="text" name="email"/><br>
	Password: <br><input type="text" name="password"/><br>
	<input type="submit" value="Sign in!"/>
</form>
<br>
<p>Don't have an account? Sign up for one <a href="signup.php">here.</a></p>
    <p><fb:login-button autologoutlink="true"></fb:login-button></p>
    <p><fb:like></fb:like></p>
    <div id="fb-root"></div>
    <script type="text/javascript" src="auth.js"></script>
    <script>
      window.fbAsyncInit = function() {
        FB.init({appId: '130911066966920', status: true, cookie: true,
                 xfbml: true});
        FB.Event.subscribe('auth.sessionChange', OnAuthChange);
        FB.getLoginStatus(OnAuthChange);
      };
      (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
//HTML footer
echo "</body>";
?>