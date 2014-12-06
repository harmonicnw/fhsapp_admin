<?php

class error {

	private $error_message;
	
	public function __construct() {
		
	}
	
	/*public function set_message(/*$message) {
		$this->error_message = $SESSION['error_message'];
	}*/
	
	public function reset_error() {
		$_SESSION['error_message'] = "";
	}
	
	public function check_error() {
		$this->error_message = $_SESSION['error_message'];
		if (!empty($this->error_message)) {
			echo "<script type='text/javascript'>alert('{$this->error_message}');</script>";
		}
		$this->reset_error();
	}
}

?>