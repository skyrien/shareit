<?php
// Test file. For... testing stuff, duh.

//Includes
require_once './shared/sql_cfg_local.php'; 
require_once './shared/db_ops.php';
require_once './shared/user_ops.php';
require_once './shared/page_ops.php';

//AddUser("heather@horst.com", "password", "Heather", "Horst");


	$uid = 13;
	$theUser = new siuser; 
	$theUser->getUserAssets($uid);
	print_r($theUser);		

?>