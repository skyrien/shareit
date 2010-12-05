<?php // shared/group_ops.php
/*
 * Share.It -- /shared/group_ops.php
 * Alexander Joo
 *  
 * This file includes the sigroup object, and operation relating to users.
 */


class sigroup
{
	// These are user attributes
	public $gid;
	public $grouptype;
	public $groupname;
	public $numMembers; // Is this important?
	public $errorstrings;
	
	public function addGroup($owner, $grouptype, $groupname)
	{
		$db_server = DBConnect( $GLOBALS['db_hostname'],
								$GLOBALS['db_database'],
								$GLOBALS['db_username'],
								$GLOBALS['db_password']);
		
		// Code to check if "group" exists for this user
		$query = "SELECT * from tbl_group WHERE owner=\"$owner\"
											AND grouptype=\"$grouptype\"
											AND groupname=\"$groupname\"";
		$result = mysql_query($query);
		if (!$result) die ("Query failed." . mysql_error());
		$rows = mysql_num_rows($result);
		
		//Return error
		if ($rows > 0)
		{
			//echo '<br>Oops, this account already exists. Go to login link 
			//<a href url="http://shareit.skyrien.com/index.php">here</a>';
			DBDisconnect($db_server);
			return -2;
		}
		//lock										
		$query = "INSERT INTO tbl_group(owner, type, groupname) VALUES ('$uid', '$grouptype', '$groupname')";
		$result = mysql_query($query);
		if (!$result) die ("Default bag insert failed." . mysql_error());
		$this->gid = mysql_insert_id();
		//unlock
		DBDisconnect($db_server);
	}
	
	public function getName($uid)
	{
		$userProfile = $this->GetUserData($uid, 'profile');
		if (!$userProfile) // failure case
			return;
		$rows = mysql_num_rows($userProfile);
		//No rows are found
		if ($rows < 1)
		{
			return 'No name';
		}
		else //begin processing the sql returned contents
		{
			for ($j = 0; $j < $rows; $j++)
			{
				$theField = mysql_result($userProfile, $j, 'field');
				$theValue = mysql_result($userProfile, $j, 'value');
				switch($theField)
				{
					case "firstName":
					{
						$this->firstname = $theValue;
						break; 
					}
					case "lastName":
					{
						$this->lastname = $theValue;
						break;
					}
					default:
					{
						$errorstrings = "($theField,$theValue)" . $errorStrings;
						break;
					}
				}
			}
		}
			
		// Code to extract first/last name
		
			
	}
	
	
	private function GetUserData($uid, $contents)
	{		
		$db_server = DBConnect( $GLOBALS['db_hostname'],
								$GLOBALS['db_database'],
								$GLOBALS['db_username'],
								$GLOBALS['db_password']);
	
		//Pulls content requested
		if ($contents != null)
			$query = "SELECT * from tbl_user WHERE uid=\"$uid\" AND fieldtype=\"$contents\"";
		else  $query = "SELECT * from tbl_user WHERE uid=\"$uid\"";
		$result = mysql_query($query);
		if (!$result) {die ("Query failed." . mysql_error()); DBDisconnect($db_server); return;}
		DBDisconnect($db_server);
		return $result;
	}
	
}

?>