<?php // shared/db_ops.php
/*
 * Share.It -- ./shared/db_ops.php
 * Alexander Joo
 *  
 * This file includes frequently used database operations, including
 * connection logic, entry viewing, and add-remove user logic. 
 * Graphical version is at ./admin/users.php
 */
require_once '../shared/sql_cfg_local.php';
require_once '../shared/sql_errors.php';

//initializes connection and selects the default shareit db
function DBConnect($db_host, $db_db, $db_user, $db_pw)
{
	// Initiates connection to sql server
	$db_server = mysql_connect($db_host, $db_user, $db_pw);
	if(!$db_server) die("Unable to connect to MySQL " . mysql_error());

	// Selects db defined in sql_login
	mysql_select_db($db_db) or die("Unable to select database: " . mysql_error());
	return $db_server;
}

function DBDisconnect($db_server)
{
	mysql_close($db_server);
}

function sanitizeString($input)
{
	$input = mysql_escape_string($input);
	$input = stripslashes($input);
	$input = htmlentities($input);
	$input = strip_tags($input);
	return $input;
}

// USER OPERATIONS (Add, Remove, Update)
/*=== Add user experience ============================================
Here we will be creating the code to add a new user. Taking in unique
values per user (by email), we create a new user object in the table.
If the user already exists, we say "already exists", and re-direct to
"sign-in". Build the frame first, then add features (security/form
validation).

Flow: 	1. If form contents is invalid, return error.
		2. If form is valid, ERROR if user exists.
		3. If user does not exist, enter into DB. Return success page.
=====================================================================*/
// Input parameters //
// string emailAddress - Email address given in the form
// string newPassword - Password entered in the form
function AddUser($emailAddress, $newPassword)
{
	// Additional input validation goes here
	$email = $emailAddress;
	$password = $newPassword;
	//form failure result
	//return false; 
				
	$db_server = DBConnect( $GLOBALS[db_hostname],
							$GLOBALS[db_database],
							$GLOBALS[db_username],
							$GLOBALS[db_password]);
		
	// Code to check if "emailAddress" exists
	$query = "SELECT * from tbl_credential WHERE username=\"$email\"";
	$result = mysql_query($query);
	if (!$result) die ("Query failed. Or user exists" . mysql_error());
	$rows = mysql_num_rows($result);
	
	//Return error
	if ($rows > 0)
	{
		echo '<br>Oops, this account already exists. Go to login link 
		<a href url="http://shareit.skyrien.com/index.php">here</a>';
		DBDisconnect($db_server);
		return false;
	}
		
	// Code to enter user into DB
	//lock
	$query = "INSERT INTO tbl_credential(username, password) VALUES ('$email', '$password')";
	$result = mysql_query($query);
	$uid = mysql_insert_id();
	if (!$result) die ("Insert failed. Do not pass go." . mysql_error());
	//unlock
	
	DBDisconnect($db_server);
	return $uid;
}

// Remove a user goes here

?>