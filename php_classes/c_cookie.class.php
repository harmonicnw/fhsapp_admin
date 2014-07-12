<?php

class $c_cookie {
	
	// private $user_id;
	// private $query;
	// private $result;
	// private $userdata;
	
	function __construct() {
	
	}
	
	private function set_cookie_session(){
		$user_id = $_SESSION['user_id'];
		$query = "SELECT * FROM users WHERE id='$user_id'";
		$result = mysql_query($query);
		$userdata = array();
		while ($rows = mysql_fetch_array($result)) { 
			$userdata[] = $rows;
		}
		//$userdata = mysql_fetch_array(mysql_query($query));
		$_SESSION['teacher'] = $userdata[0]['teacher'];
		$_SESSION['club'] = $userdata[0]['club'];
		$_SESSION['sports'] = $userdata[0]['sports'];
		$_SESSION['admin'] = $userdata[0]['admin'];
				
}	
	public function enforce_log() {
		if(!isset($_SESSION['user_id'])) {
			check_cookie();
		}else{ set_cookie_session();
		}
	}
	
	private function make_cookie() {
		$expire = time()+(60*60*24*150);
		setcookie("staylogged", $_SESSION['user_id'], $expire);
	}
	
	private function check_cookie() {
		if(isset($_COOKIE['staylogged'])) {
			$_SESSION['user_id']= $_COOKIE['staylogged'];
			set_cookie_session();
			header('Location: main.php?current=1');
		}else{
			header('Location: login.php');
			//echo "<h1>There is no spoon.</h1>";
		}
	}
	
	private function delete_cookie() {
		$expire = time()-1;
		setcookie("staylogged", $_SESSION['user_id'], $expire);
	}
	
	public static function kLA() {
		if(isset($_POST['staylogged'])){
			make_cookie();
		}else{
			delete_cookie();
		}
	}
	
	private function assist_log(){
		if(isset($_COOKIE['staylogged'])){
			header('Location: main.php?current=1');
		}
	}
}

?>