<?php
class SanitizeField
{
	static function clean($field)
	{

		$result = trim(addslashes(htmlentities(htmlspecialchars($field))));
 		return $result;
	}
}




?>