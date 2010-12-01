<?php
/* /shared/page_ops.php
 * Object-based class 


*/
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
		//setcookie('uid', $validateResult, time()+ 60*60*24*7, '/');
		//setcookie('uid', $postResult, time()+ 60*60*24*7, '/');
		$postResult = "<h2>User found.</h2>";
	}	
}