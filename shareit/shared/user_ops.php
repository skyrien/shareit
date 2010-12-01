<?php // shared/user_ops.php
/*
 * Share.It -- /shared/user_ops.php
 * Alexander Joo
 *  
 * This file includes the siuser object, and operation relating to users.
 */


class siuser
{
	// These are user attributes
	public $uid;
	public $firstname;
	public $lastname;
	public $errorstrings;
	
	
	
	public function getFullName($uid)
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