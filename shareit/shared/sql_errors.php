<?php // shared/errors.php

function mysql_fatal_error($msg)
{
	$msg2 - mysql_error();
	echo <<< _END
	
	Nope, that didn't work, but we did get back this error:
	
	<p>$msg: $msg2</p>
	
	Try again, or do something else. Or email me at <a href="mailto:me@skyrien.com">me@skyrien.com</a>.
_END;
	
}

?>