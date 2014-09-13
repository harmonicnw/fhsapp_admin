<?php

class login {
	public $typedusername;
	public $typedhash;
	
	public function __construct($user, $pass) {
		$this->typedusername = addslashes($user);
		$this->typedhash = md5(addslashes($pass));
	}
	
	//For setting session variables at the login
	private function set_session() {
		$query = "SELECT * FROM users WHERE username='$this->typedusername'";
		$userdata = mysql_fetch_array(mysql_query($query));
		$_SESSION['user_id'] = $userdata['id'];
		$_SESSION['admin'] = $userdata['admin'];
		$_SESSION['teacher'] = $userdata['teacher'];
		$_SESSION['club'] = $userdata['club'];
		$_SESSION['sports'] = $userdata['sports'];
		$_SESSION['staff'] = $userdata['staff'];
		$_SESSION['username'] = $this->typedusername;
	}
	
	public function create_login(){
		
		$result = mysql_query("SELECT password FROM users WHERE username='".$this->typedusername."'");
		if(!$result) { die('goofed' . mysql_error() ); }
	
		if($result){
			$row = mysql_fetch_row($result);
			$hash = $row[0]; 
		} else {
			//echo "Invalid Username.";
			//$message = "wrong answer";
			
		}
	
		if($this->typedhash === $hash){
			$this->set_session($this->typedusername);
			c_cookie::kLA(); //? Problem here? Maybe?
			header('Location: main.php?current=1');
			exit();
		} else {	
			/*echo "typedhash = ". $typedhash;
			echo "hash = ". $hash; 
			echo "Login Failed."; */
		}
	}
}

?>