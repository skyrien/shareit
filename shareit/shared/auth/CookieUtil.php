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
		parse_str(trim($_COOKIE[SHARE_IT_COOKIE]), $output);
		if (isset($output['uid']) && isset($output['firstname']) && isset($output['lastname']))
		{
			return true;
		}
	}
	//all other cases cookie is invalid
	return false;
}

function ValidateFaceBookCookie()
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
	 	 if (md5($payload . FACEBOOK_SECRET) == $args['sig']) 
	 	 {
    		return true;
	 	 }
	}
	return false;
}

function SetShareItAuthCookie()
{
	
}



?>