<?php 
/*
 * 
 * Share.It -- Database Helper 
 * Author: Ibrahim Shareef
 * 
 * This file contains logic for interacting with the sql database
 * 
 */

require_once 'sql_config.php';

function ExecuteSqlQuery($db_name, $query)
{
	if (!mysql_ping())
	{
		$link = mysql_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD) or die(mysql_error());
	}
	mysql_select_db($db_name) or die(mysql_error());
	$safe_query = mysql_real_escape_string($query, $link);
	if (!safe_query)
	{
		return false;
	}
	$result = mysql_query($safe_query);
	return $result;
}


?>