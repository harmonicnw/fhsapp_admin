<?php

class error {

	private $error_message;
	
	public function __construct() {
		
	}
	
	public function set_message($message) {
		$this->error_message = $GLOBALS['message'];
	}
	
	public function check_error() {
		if (!empty($this->error_message)) {
			echo "<script type='text/javascript'>alert('{$this->error_message}');</script>";
		}
		$GLOBALS['message'] = "";
	}
}

?>