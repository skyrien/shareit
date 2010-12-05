<?php
/*
 * Share.It -- /home.php
 * Alexander Joo
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
require_once './shared/collection_ops.php';
require_once './shared/page_ops.php';
global $db_server;
global $postResult;

//User for this session
$theUser = new siuser; 

//Incoming POST (signin) handling logic
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
		$theUser->getUserAssets($uid);
		$first = $theUser->firstname;
		$last = $theUser->lastname;
		setcookie('uid', $validateResult, time()+ 60*60*24*7, '/');
		setcookie('firstname', $first, time()+ 60*60*24*7, '/');
		setcookie('lastname', $last, time()+ 60*60*24*7, '/');
	}	
}

//Checking for FB delegated auth cookie -- this should only be on the index.php page
 

//Validating SHAREIT Session Cookies

//User is authed in
//LATER, we need to add a session signature to trust the source
if (isset($_COOKIE['uid']))
	$theUser->uid = $_COOKIE['uid'];
else break;
	
if (isset($_COOKIE['firstname']))
	$theUser->firstname = $_COOKIE['firstname'];

if (isset($_COOKIE['lastname']))
 	$theUser->lastname = $_COOKIE['lastname'];
 
//Redirect if already logged in
 
 
 

 
 //Page Header
 echo getPageHeader("$theUser->firstname $theUser->lastname Home - Share.it",
 				"Home - Share.it",
 				"Manage your items, and who you share it to.");
 
//Section: You
echo <<< _END
<h2>Hi $theUser->firstname! Here are your stats:</h2>
Ranking:<br>
Friends:<br>
Items shared:<br>
Up-votes:<br>
Badges:<br>
<br>
<hr />
_END;

//Section: Collections
$collectiontext = <<< _END
<h2>Collections</h2>
_END;
//Load default collection data
$defaultCollection = new sicollection();
$defaultCollection->getObjects($theUser->uid, 'default');

/*
//Loads names of all collections
$collectionCount = count($theUser->collections);
for ($j = 0; $j < $collectionCount; $j++)
{
	// assigns collection name to thisCollection
	$thisCollection .= $theUser->collections[$j];
	//$collectiontext .= "Add item to collection";	
}
*/

echo $collectiontext . "<br><hr />";

//Section: Circles
echo <<< _END
<h2>Circles</h2>
<br>
<hr />
_END;


//HTML footer
echo "</body>";
?>