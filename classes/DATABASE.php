<?php

// The database class 

class DATABASE{
	// Initialize variables 

	private static $_instance=null;
	private $_pdo, 
			$_query,
			$_error = false,
			$_results,
			$_count=0; 

	// Database connections arguments 
	private $server = 'localhost';
	private $username = 'root';
	private $password = '';
	private $dbname = 'db_drop';

	// Connect the the database 
	public function connect()
	{
		$mysqli = new mysqli($this->server,$this->username,$this->password,$this->dbname);

		return $mysqli;		
	}


}

?>