<?php
/*
 * Share.It -- /home.php
 * Alexander Joo
 *  
 * This is the initial page. Includes branding header, login, sign up, and
 * Facebook Connect integration.
 * 
 */

/*=====================================================================
/* Included files, Globals, HTML Header, Body
/*===================================================================*/
require_once './shared/sql_cfg_local.php'; 
require_once './shared/db_ops.php';
require_once './shared/user_ops.php';
global $db_server;
global $postResult;
$theUser = new siuser; 

//Checking for SHAREIT Session Cookies

//User is authed in
if (isset($_COOKIE['uid']))
	$theUser->uid = $_COOKIE['uid'];
else break;
	
if (isset($_COOKIE['firstname']))
	$theUser->firstname = $_COOKIE['firstname'];

if (isset($_COOKIE['lastname']))
 	$theUser->lastname = $_COOKIE['lastname'];
 
//Redirect if already logged in
 
 
 
 
//Checking for FB delegated auth cookie
 
 
 
 //Page Header
 echo <<< _END
<html>
	<head>
		
		<title>$theUser->firstname $theUser->lastname Home</title>
		
		<!-- Blueprint Framework CSS, including Fancy Type -->
		<link rel="stylesheet" href="./css/blueprint/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="./css/blueprint/print.css" type="text/css" media="print">	
		<link rel="stylesheet" href="./css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" /> 
		<!--[if lt IE 8]><link rel="stylesheet" href="./css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->		
	</head>
	
	<body>
	<!-- Requried for HTML Header (within body) -->
	<div class="container">
    <div id="header" class="span-24 last">
    <h1 id="signup">Home - Share.it</h1>
	<hr />
    </div>
    
    <div id="subheader" class="span-24 last">
	<h3 class="alt">Manage your items, and who you share it to.</h3>
	</div>
    
	<hr />

_END;

 
//Section: You
echo <<< _END
<h2>$theUser->firstname $theUser->lastname's Stats</h2>
Ranking:<br>
Friends:<br>
Items shared:<br>
Up-votes:<br>
Badges:<br>
<hr />
_END;


//Section: Collections
echo <<< _END
<h2>Collections</h2>

<hr />
_END;

//Section: Circles
echo <<< _END
<h2>Circles</h2>
<hr />
_END;

//Section: Other options
echo <<< _END
<h2>Circles</h2>
<hr />
_END;


//HTML footer
echo "</body>";
?>