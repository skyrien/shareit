<?php // shared/db_ops.php
/*
 * Share.It -- /shared/db_ops.php
 * Alexander Joo
 *  
 * This file includes frequently used database operations, including
 * connection logic, entry viewing, and add-remove user logic. 
 * Graphical version is at ./admin/users.php
 */

//initializes connection and selects the default shareit db
function DBConnect($db_host, $db_db, $db_user, $db_pw)
{
//	echo $db_host . "<br>";
//	echo $db_db . "<br>";
//	echo $db_user . "<br>";
//	echo $db_pw . "<br>";
	
	// Initiates connection to sql server	
	$db_server = mysql_connect($db_host, $db_user, $db_pw);
	if(!$db_server) die("Unable to connect to MySQL: " . mysql_error());

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



/*=== Add user experience ============================================
Here we will be creating the code to add a new user. Taking in unique
values per user (by email), we create a new user object in the table.
If the user already exists, we say "already exists", and re-direct to
"sign-in". Build the frame first, then add features (security/form
validation).

Flow: 	1. If form contents is invalid, return -1.
		2. If form is valid, return -2 if user exists.
		3. If user does not exist, enter into DB. Return success page.
		4. This also creates the default collection / default circle
=====================================================================*/
// Input parameters //
// string emailAddress - Email address given in the form
// string newPassword - Password entered in the form - this will be salted
// and sha1 hashed.
function AddUser($emailAddress, $newPassword, $firstName, $lastName)
{
	// Additional input validation goes here
	$email = $emailAddress;
	$password = $newPassword;
	//form failure result
	//return -1; 				
	$db_server = DBConnect( $GLOBALS['db_hostname'],
							$GLOBALS['db_database'],
							$GLOBALS['db_username'],
							$GLOBALS['db_password']);
			
	// Code to enter user into DB
	//lock
	$query = "INSERT INTO tbl_credential(username, password) VALUES ('$email', '$password')";
	$result = mysql_query($query);
	$uid = mysql_insert_id();
	//unlock	
	if (!$result)
	{
		$mysqlerror = mysql_errno();
		if ($mysqlerror = 1062)
		{
			DBDisconnect($db_server);
			return -3;	
		}
	}
	//We're returning the auto-incremented ID that was generated on the insert
	else
	{
		//Insert first name into DB
		$query = "INSERT INTO tbl_user(uid, fieldtype, field, value) VALUES
		('$uid', 'profile', 'firstName', '$firstName'),
		('$uid', 'profile', 'lastName', '$lastName'),
		('$uid', 'collection', 'name', 'default'),
		('$uid', 'circle', 'name', 'default')";
		$result = mysql_query($query);
		if (!$result) die ("New user insert failed." . mysql_error());
	}
	DBDisconnect($db_server);
	return $uid;
}

// Remove a user goes here

?>