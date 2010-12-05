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
	public $collections;
	public $circles;
	
	//This function takes in a $uid and returns the full name on the object
	public function getFullName($uid)
	{
		$this->uid = $uid;
		$userProfile = $this->GetUserData($uid, 'profile');
		if (!$userProfile) // failure case
			return -1;
		$rows = mysql_num_rows($userProfile);
		//No rows are found
		if ($rows < 1)
		{
			return -2;
		}
		else //begin processing the sql returned contents
		{
			for ($j = 0; $j < $rows; $j++)
			{
				$theField = mysql_result($userProfile, $j, 'field');
				$theValue = mysql_result($userProfile, $j, 'value');
				switch($theField)
				{
					case "default":
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
	
	public function getCollections($uid)
	{
		$this->uid = $uid;
		//this is the MySQL query result for collecions
		$collections = $this->GetUserData($uid, 'collection');
		if (!$collections) // failure case
			return -1;
		$rows = mysql_num_rows($collections);
		//No rows are found
		if ($rows < 1)
		{
			return 0;
		}
		else //begin processing the sql returned contents
		{
			for ($j = 0; $j < $rows; $j++)
			{
				$theField = mysql_result($collections, $j, 'field');
				$theValue = mysql_result($collections, $j, 'value');
				switch($theField)
				{
					case "default":
					{
						$this->defaultcollection = $theValue;
						break; 
					}
					case "":
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
	}		
		// Code to extract first/last name
	
		// USER OPERATIONS
	/*=== getUserAssets() ================================================
	This code populates the siuser object with profile attributes,
	list of collections, and list of circles. 
	
	Flow: 	1. uid is passed
			2. If there are items, return values; 
			3. Otherwise, return 0
	=====================================================================*/
	// Input parameters //
	// string ownerid - uid of the owner of the collection
	// string collectionid - name of the collection being retrieved
	public function getUserAssets($uid)
	{
		$this->uid = $uid;
		//this is the MySQL query result for collecions
		$userdata = $this->GetUserData($uid, '');
		if (!$userdata) // failure case
			return -1;
		$rows = mysql_num_rows($userdata);
		//No rows are found
		if ($rows < 1)
		{
			return 0;
		}
		else //begin processing the sql returned contents
		{
			for ($j = 0; $j < $rows; $j++)
			{
				$theType = mysql_result($userdata, $j, 'fieldtype');
				$theValue = mysql_result($userdata, $j, 'value');
				switch($theType)
				{
					//In this case, the field values are firstname, lastname
					case "profile":
					{
						//only profile cares about the field
						$theField = mysql_result($userdata, $j, 'field');
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
						break;
					}
					//In this case, the field values are firstname, lastname
					case "collection":
					{
						$this->collections[] = $theValue;
						break;	
					}	

					case "circle":
					{
						$this->circles[] = $theValue;	
						break;						
					}
				
				}
			}
		}
		
		
	}
	
	private function GetUserData($uid, $contents)
	{		
		$db_server = DBConnect( $GLOBALS['db_hostname'],
								$GLOBALS['db_database'],
								$GLOBALS['db_username'],
								$GLOBALS['db_password']);
	
		//Pulls content requested
		if ($contents != '')
			$query = "SELECT * from tbl_user WHERE uid=\"$uid\" AND fieldtype=\"$contents\"";
		else  $query = "SELECT * from tbl_user WHERE uid=\"$uid\"";
		$result = mysql_query($query);
		if (!$result) {die ("Query failed." . mysql_error()); DBDisconnect($db_server); return;}
		DBDisconnect($db_server);
		return $result;
	}
	
}

?>