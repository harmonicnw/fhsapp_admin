<?php

class Db { 

	protected $connection;
	protected $config;

	function __construct($config) { 
		$this->config = $config;
		$this->connection = $this->connect();
	}

	function connect() { 
		$conn = mysql_connect($this->config['dbhost'], $this->config['username'], $this->config['password']) or die('Error connecting to database');
		if (!mysql_select_db($this->config['database'])) { 
			die('could not select database');
		}
		return 1;	
	}

	function runQuery($query) { 
		if ($result = mysql_query($query) or die(mysql_error()));
		$resultsArray = array();
		while ($rows = mysql_fetch_array($result)) { 
			$resultsArray[] = $rows;
		}
		return $resultsArray;
	}

	function runInsertQuery($query) { 
		if ($result = mysql_query($query) or die(mysql_error()));
		return mysql_insert_id();
	}

}