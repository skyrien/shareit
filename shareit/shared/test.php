<?php
$pw_salt = "abcd";
$user_password = sha1($pw_salt . "hadsadadasdadello");
echo $user_password;

?>