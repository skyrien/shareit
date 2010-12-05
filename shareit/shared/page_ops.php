<?php
/* /shared/page_ops.php
 * Object-based class 


*/
// Page Header
function getPageHeader($title, $bigtext, $subtext)
{
 $output = <<< _END
<html>
	<head>
		
		<title>$title</title>
		
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
    
    <h1 id="signup">$bigtext</h1>
	<hr />
	</div>
_END;

if ($subtext != '')
{
	$output .= <<< _END
    <div id="subheader" class="span-24 last">
	<h3 class="alt">$subtext</h3>
	</div>
	<hr />
_END;
}
return $output;
}
