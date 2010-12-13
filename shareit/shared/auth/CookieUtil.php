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
require_once 'cookie_cfg.php';
require_once './shared/db/DBUtil.php';
/*
 * Validates the share.it.com auth cookie
 * currently, only does simple checks
 * TODO: Implement secure cookie!!
 */
function ValidateShareItAuthCookie($cookie)
{
	if (isset($cookie))
	{
		$output = array();
		parse_str(trim($cookie, '\\"'), $output);
		if (isset($output['uid'])))
		{
			return true;
		}
	}
	//all other cases cookie is invalid
	return false;
}

function GetFaceBookCookie($facebook_cookie)
{
	if (isset($facebook_cookie))
	{
		 $args = array();
  		 parse_str(trim($facebook_cookie, '\\"'), $args);
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
	$format = 'uid=%s';
	$cookie_payload = sprintf($format,$uid);
	setcookie(SHARE_IT_COOKIE, $cookie_payload, time()+ 60*60*24*7, '/');
	return true;
}



?>