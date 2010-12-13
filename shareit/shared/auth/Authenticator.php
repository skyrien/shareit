<?php 
/*
 * Share.It -- AuthHelper.php
 *Author: Ibrahim Shareef 
 *
 *This file contains the logic for authenticating a user
 * 
 */
require_once 'fb_cfg.php';
require_once 'CookieUtil.php';

/*
 * This function validate user sign in of the two supported types: facebook or share.it authentication
 * 
 */
function ValidateUserSignIn($facebook_cookie, $username, $password)
{	
	if (isset($facebook_cookie))
	{
		$vals = GetFaceBookCookie($facebook_cookie);
		if (!$vals)
		{
			return false; //facebook cookie was in-valid
		}
		$uid = GetUIDFromFacebookUID($vals['uid']);		
	}
	else if (isset($username) && isset($password))
	{
		$uid = SignInValidate($username,$password);
		if ($uid < 0)
		{
			die("Invalid uid: " . $uid);
		}
	}
	if ($uid) //if user found. Set share.it cookie
	{
		//set share.it auth cookie
		SetShareItAuthCookie();
		return true;
	}
	else //user was not found
	{
		return false;
	}
}

// USER OPERATIONS (Check, Add, Remove, Update)
/*=== Signin Validate ================================================
This code checks to see if the requested user exists

Flow: 	1. If form contents is invalid, return -1.
		2. If form is valid, return -2 if user does not exist.
		3. If more than one user is found, -3 is returned.
		4. A match is found; the UID is returned. 
=====================================================================*/
// Input parameters //
// string emailAddress - Email address given in the form
// string incomingPassword - Password entered in the form; will be SHA1 hashed and salted
function SignInValidate($emailAddress, $incomingPassword)
{
	// Additional input validation goes here
	$email = $emailAddress;
	$password = $incomingPassword;
	$uid = 0;
	//form failure result
	//return -1; 				
	$result = ExecuteSqlQuery(DB_SHAREIT_DATABASE, "SELECT * from tbl_credential WHERE username=\"$email\" AND password=\"$password\"");
	
	if (!$result) die ("Query failed." . mysql_error());
	$rows = mysql_num_rows($result);
	//no match found
	if ($rows == 0)
	{
		return 0; //user does not exist
	}
	if ($rows == 1)
	{
		$uid = mysql_result($result, 0,'uid');			
		DBDisconnect($db_server);
		return $uid;
	}
	else //all other cases, fatal error 
	{
		die("UID query returned multiple rows: " . $rows);
	}
}

function GetUIDFromFacebookUID($fb_uid)
{
	$uid = 0;
	//form failure result
	//return -1; 				
	$result = ExecuteSqlQuery(DB_SHAREIT_DATABASE, "SELECT * from tbl_credential WHERE fbtoken=\"$fb_uid\"");
	if (!$result) die ("Query failed." . mysql_error());
	$rows = mysql_num_rows($result);
	//no match found
	if ($rows == 0)
	{
		return 0; //user does not exist
	}
	if ($rows == 1)
	{
		$uid = mysql_result($result, 0,'uid');			
		DBDisconnect($db_server);
		return $uid;
	}
	else //all other cases, fatal error 
	{
		die("UID query returned multiple rows: " . $rows);
	}
}

?>