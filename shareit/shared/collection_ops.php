<?php // shared/collection_ops.php
/*
 * Share.It -- /shared/collection_ops.php
 * Alexander Joo
 *  
 * This file includes the sicollection object, and operation relating to users.
 */
class siobject
{
	public $objectid; // unique object id
	public $itemid; // root item id
	public $itemname; // unique item name (possibly ported from root name)
	public $status;
	public $hasid; 
	
}

class sicollection
{
	public $collectionid; // collection name
	public $ccount; //count of objects in collection
	public $objects; // array of objects in collection

	function insertObject($itemid, $name)
	{
		
	}
	
	// COLLECTION OPERATIONS
	/*=== addObject() ================================================
	This code creates a new object in tbl_object -- CODE BELOW INCORRECT
	
	Flow: 	1. Get ownerid and cid being fetched for
			2. If there are items, return values; 
			3. Otherwise, return 0
	=====================================================================*/
	// Input parameters //
	// string ownerid - uid of the owner of the collection
	// string collectionid - name of the collection being retrieved
	function getObjects($ownerid, $collectionid)
	{
		$this->collectionid = $collectionid;
		//the type on this object is a mysql result from tbl_collection
		$collectiondata = $this->getCollectionObjects($ownerid, $collectionid);
		if (!$collectiondata) // failure case
			return -1;
		$this->ccount = mysql_num_rows($collectiondata);
		for ($j = 0; $j < $this->ccount; $j++)
		{
			$theObject = new siobject();
			$theObject->objectid = mysql_result($collectiondata, $j, 'objectid');
			$theObject->itemname = mysql_result($collectiondata, $j, 'itemname');
			$theObject->status = mysql_result($collectiondata, $j, 'itemstatus');
			$theObject->hasid = mysql_result($collectiondata, $j, 'hasid');
			$this->objects[j] = $theObject;
		}
	}
	
	
	/*=== getObjects() ================================================
	This code populates the $objects array on the collection object
	
	Flow: 	1. Get ownerid and cid being fetched for
			2. If there are items, return values; 
			3. Otherwise, return 0
	=====================================================================*/
	// Input parameters //
	// string ownerid - uid of the owner of the collection
	// string collectionid - name of the collection being retrieved
	function getObjects($ownerid, $collectionid)
	{
		$this->collectionid = $collectionid;
		//the type on this object is a mysql result from tbl_collection
		$collectiondata = $this->getCollectionObjects($ownerid, $collectionid);
		if (!$collectiondata) // failure case
			return -1;
		$this->ccount = mysql_num_rows($collectiondata);
		for ($j = 0; $j < $this->ccount; $j++)
		{
			$theObject = new siobject();
			$theObject->objectid = mysql_result($collectiondata, $j, 'objectid');
			$theObject->itemname = mysql_result($collectiondata, $j, 'itemname');
			$theObject->status = mysql_result($collectiondata, $j, 'itemstatus');
			$theObject->hasid = mysql_result($collectiondata, $j, 'hasid');
			$this->objects[j] = $theObject;
		}
	}
	
	// This function joins two tables, tbl_collection, and tbl_object, to get
	// collection membership data and data on the objects that they contain
	private function getCollectionObjects($ownerid, $collectionid)
	{		
		$db_server = DBConnect( $GLOBALS['db_hostname'],
								$GLOBALS['db_database'],
								$GLOBALS['db_username'],
								$GLOBALS['db_password']);
	
		//Pulls content requested
		$query = "SELECT objectid, itemname, itemstatus, hasid
					FROM tbl_collection NATURAL JOIN tbl_object
					WHERE ownerid=\"$ownerid\" AND collectionid=\"$collectionid\"";
		$result = mysql_query($query);
		if (!$result) {die ("Query failed." . mysql_error()); DBDisconnect($db_server); return;}
		DBDisconnect($db_server);
		return $result;
	}
	
	
}


?>