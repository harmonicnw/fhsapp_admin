<?php

class login {

#region members

	//protected $c_cookie;

	protected $typedusername;
	protected $typedhash;
	
	private $userdata;
	
	private $row;
	private $hash;
	
	private $result;
#end

	public function __construct() { 
		
	}
	
	private function create_cookie() {
		$this->$c_cookie = new c_cookie();
	}
	
	//For setting session variables at the login
	private function set_session($typedusername) {
		$this->$userdata = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$typedusername'"));
		$_SESSION['user_id'] = $this->$userdata['id'];
		$_SESSION['admin'] = $this->$userdata['admin'];
		$_SESSION['teacher'] = $this->$userdata['teacher'];
		$_SESSION['club'] = $this->$userdata['club'];
		$_SESSION['sports'] = $this->$userdata['sports'];
		$_SESSION['username'] = $this->$typedusername;
	}
	
	public static function create_login(){
		
		$this->$typedusername= (addslashes($_POST['user'])); //thought we didn't need the array or slashes -- could be wrong
		$this->$typedhash= md5((addslashes($_POST['pass'])));

		$this->$result = mysql_query("SELECT password FROM users WHERE username='".$this->$typedusername."'");
		if(!$this->$result) { die('goofed' . mysql_error() ); }
	
		if($this->$result){
			$this->$row = mysql_fetch_row($result);
			$this->$hash = $this->$row[0]; 
		} else {
			//echo "Invalid Username.";
		}
	
		if($this->$typedhash === $this->$hash){
			$this->set_session($this->$typedusername);
			c_cookie::kLA(); //? Problem here? Maybe?
			header('Location: main.php?current=1');
			exit();
		} else {	
			/*echo "typedhash = ". $typedhash;
			echo "hash = ". $hash; 
			echo "Login Failed."; */
		}
	}

	private function get_post_inputs() {
		$this->$typedusername= (addslashes($_POST['user'])); //thought we didn't need the array or slashes -- could be wrong
		$this->$typedhash= md5((addslashes($_POST['pass'])));

		$this->$result = mysql_query("SELECT password FROM users WHERE username='".$this->$typedusername."'");
		if(!$this->$result) { die('goofed' . mysql_error() ); }
	}
}

?>