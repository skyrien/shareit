<?php 
/*
 * Share.It -- AuthHelper.php
 *Author: Ibrahim Shareef 
 *
 *This file contains the logic for authenticating a user
 * 
 */
require_once 'fb_cfg.php';
require_once 'CookieUtil.php';

/*
 * This function validate user sign in of the two supported types: facebook or share.it authentication
 * 
 */
function ValidateUserSignIn()
{
	
	if (isset($_COOKIE[FACEBOOK_COOKIE]))
	{
		$vals = GetFaceBookCookie();
		if (!$vals)
		{
			return false; //facebook cookie was in-valid
		}
		
			//set share.it auth cookie
			
			SetShareItAuthCookie();
		}
	}
}

?>