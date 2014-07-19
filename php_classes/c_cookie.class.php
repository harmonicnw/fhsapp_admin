<?php

class c_cookie {
	
	function __construct() {
	
	}
	
	private static function set_cookie_session(){
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
	
	public static function enforce_log() {
		if(!isset($_SESSION['user_id'])) {
			c_cookie::check_cookie();
		} else { 
			c_cookie::set_cookie_session();
		}
	}
	
	private static function make_cookie() {
		$expire = time()+(60*60*24*150);
		setcookie("staylogged", $_SESSION['user_id'], $expire);
	}
	
	private static function check_cookie() {
		if(isset($_COOKIE['staylogged'])) {
			$_SESSION['user_id']= $_COOKIE['staylogged'];
			/*$this->*/c_cookie::set_cookie_session();
			header('Location: main.php?current=1');
		}else{
			header('Location: login.php');
			//echo "<h1>There is no spoon.</h1>";
		}
	}
	
	public static function delete_cookie() {
		$expire = time()-1;
		setcookie("staylogged", $_SESSION['user_id'], $expire);
	}
	
	public static function kLA() {
		if(isset($_POST['staylogged'])){
			c_cookie::make_cookie();
		}else{
			c_cookie::delete_cookie();
		}
	}
	
	public static function assist_log(){
		if(isset($_COOKIE['staylogged'])){
			header('Location: main.php?current=1');
		}
	}
}

?>