<?php
/*
 * Share.It -- /collection.php
 * Alexander Joo
 *  
 * This page hosts the colelction management console. It allows viewing
 * of existing objects and their status, adding/removing items, and
 * other collection admin (change name, details, etc...).
 * 
 */

/*=====================================================================
/* Included files, Globals, HTML Header, Body
/*===================================================================*/
require_once './shared/db/sql_cfg_local.php'; 
require_once './shared/db_ops.php';
require_once './shared/user_ops.php';
require_once './shared/collection_ops.php';
require_once './shared/page_ops.php';

$theuid;
$theCollectionName;
// Check for GET items 
// u (optional) - user id
// col (optional) - collectionid (under the user)
// go to default collection if not present
// go to authenticated user if u is not present
if (isset($_GET['uid']))
{
	$theuid = $_GET['uid'];
}
// else $theuid should become the cookie id 
$thecollection = new sicollection;
if (isset($_GET['col']))
{
	$theCollectionName = $_GET['col']);
}
else $thecollection->collectionid = 'default';
{	
	$thecollection = new $theCollection;
	$thecollection->getObjects($theuid, $theCollectionName);
}

// create and populate collection object


// Get attributes needed for header
// $title for the html page
// $bigtext page title
// $mini text... may not be necessary here.

// Need page header
echo getPageHeader($title, $bigtext, $subtext);

// Need collection contents

// Need available logic

// Having a state machine diagram for this page may be helpful

// Add item logic will eventualyl be an AJAX div box, but for now,
// lets direct them to a special page, "additem.php" 

?>