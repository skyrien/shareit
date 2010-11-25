<?php
/*
 * Share.It -- ./admin/users_text.php
 * Alexander Joo
 *  
 * This page provides a text based view of the users that are present in the system. 
 * Graphical version is at ./admin/users.php
 */

/*=====================================================================
/* Included files, Globals, HTML Header, Body
/*===================================================================*/
require_once '../shared/sql_config.php';
require_once '../shared/db_ops.php';
global $db_server;

echo <<< _END
<html>
	<head>
		<title>Share.It Admin</title>
	</head>
	<body>
		
<h1>Share.It User Administration Console</h1><br>
=======================================================================<br>
Welcome to the Share.It administration panel. You can use this page to<br>
add, remove, modify existing users and their profile data. <br><br>
_END;


// Incoming POST handling code
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

// Shows updated user count, credentials
$db_server = DBConnect($db_hostname, $db_database, $db_username, $db_password);
$query = "SELECT uid, username, created FROM tbl_credential";
$result = mysql_query($query);
if (!$result) die ("Database access failed: " . mysql_error());
DBDisconnect($db_server);

$rows = mysql_num_rows($result);
if ($rows == 0)
	echo "Currently, there are no users in the system.<br><br>";
else if ($rows == 1)
	echo "Currently, there is 1 user in the system.<br><br>";	
else echo "Currently, there are $rows users in the system.<br><br>";

echo "<h2>Current Users:</h2>";
if ($rows > 0)
{
	for ($j=0; $j < $rows; $j++)
	{
		//This should be updated with mysql_fetch_row()
		echo "******************************<br>";
		echo '* Username: ' . mysql_result($result, $j,'username') . ' -- UID: ' . mysql_result($result, $j,'uid') . '<br>';
		echo '* Created: ' . mysql_result($result, $j,'created') . '<br>';
		echo "******************************<br><br>";
	}
}

// This will be available regardless of the form post state
echo "Allowed actions below:<br><br>";

//Form goes here currently the password is not hashed. It should be.
echo <<< _END
<h2>Add new user:</h2>
<form method="post" action="users_text.php"/>
	Email Address (up to 100 characters)<br><input type="text" name="email"/><br>
	Password (up to 32 characters)<br><input type="text" name="password"/><br>
	I agree to the <a href="http://shareit.skyrien.com/terms.php">terms of use</a>.
	<input type="checkbox" name="agree"/><br>
	<input type="submit" value="Add user..."/>
</form>
_END;


//Closing HTML document
echo <<< _END
</body>
_END;

?>