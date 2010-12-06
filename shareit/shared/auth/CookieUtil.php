<?php 
/*
 *Share.It -- Cookie Helper
 *Author: Ibrahim Shareef 
 *
 * This file contains the logic to validate cookies
 * currently supported cookies:
 * facebook.com
 * share.it.com
 */

require_once 'fb_cfg.php';
require_once 'DBUtil.php';
/*
 * Validates the share.it.com auth cookie
 * currently, only does simple checks
 * TODO: Implement secure cookie!!
 */
function ValidateShareItAuthCookie()
{
	if (isset($_COOKIE[SHARE_IT_COOKIE]))
	{
		$output = array();
		parse_str(trim($_COOKIE[SHARE_IT_COOKIE], '\\"'), $output);
		if (isset($output['uid']) && isset($output['firstname']) && isset($output['lastname']))
		{
			return true;
		}
	}
	//all other cases cookie is invalid
	return false;
}

function GetFaceBookCookie()
{
	if (isset($_COOKIE[FACEBOOK_COOKIE])
	{
		 $args = array();
  		 parse_str(trim($_COOKIE[FACEBOOK_COOKIE], '\\"'), $args);
  	     ksort($args);
  	     $payload = '';
  		 foreach ($args as $key => $value) 
  		 {
         	if ($key != 'sig') 
         	{
          		$payload .= $key . '=' . $value;
         	}
  		 }
	 	 if (md5($payload . FACEBOOK_SECRET) != $args['sig']) 
	 	 {
    		return null;
	 	 }
	}
	return $args;
}

function SetShareItAuthCookie()
{
	//TODO: extract user uid, firstname, lastname from db, fb auth cookie for facebook signin
	//now we have all cookie data
	//TODO: cookie should aslo contain signature with secret key, uid, firstname, lastname
	$format = 'uid=%s&firstname=%s&lastname=%s';
	$cookie_payload = sprintf($format,$uid,$firstname,$lastname);
	setcookie(SHARE_IT_COOKIE, $cookie_payload, time()+ 60*60*24*7, '/');
	return true;
}



?>