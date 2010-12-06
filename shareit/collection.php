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
require_once './shared/sql_cfg_local.php'; 
require_once './shared/db_ops.php';
require_once './shared/user_ops.php';
require_once './shared/collection_ops.php';
require_once './shared/page_ops.php';

//How does a user get into this page? Are there POSTed here? I think
//it's an HTTP GET request that directs a user here. PHP offers access
//to parameters in the query string.

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