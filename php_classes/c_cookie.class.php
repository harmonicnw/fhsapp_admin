<?php

class c_cookie {
	
	function __construct() {
	//c is for cookie
	}
	
	//*Sets the session variables from the cookie.
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
		$_SESSION['staff'] = $userdata[0]['staff'];
				
	}
	
	public static function enforce_log() { //*Run at the top of every page
		if(!isset($_SESSION['user_id'])) { //*If there isn't a user_id set in the session, look at the cookie.
			c_cookie::check_cookie();
		} else { 
			c_cookie::set_cookie_session();//*If the user_id is set, then just set the session variables.
		}
	}
	
	private static function make_cookie() { //*Make the cookie which will holde the user_id. The cookie is called "staylogged".
		$expire = time()+(60*60*24*150);    //*Cookie lasts for 150 days.
		setcookie("staylogged", $_SESSION['user_id'], $expire);
	}
	
	private static function check_cookie() {
		if(isset($_COOKIE['staylogged'])) { //*If there is a cookie, set the user id and the session variables and go to the main page.
			$_SESSION['user_id']= $_COOKIE['staylogged'];
			c_cookie::set_cookie_session();
			header('Location: main.php?current=1');
		} else {                            //*If there isn't a cookie, go to the login.
			header('Location: login.php');
		}
	}
	
	public static function delete_cookie() {
		$expire = time()-1;
		setcookie("staylogged", $_SESSION['user_id'], $expire);
	}
	
	public static function kLA() { //*Stands for Keep Log Assigned
		if(isset($_POST['staylogged'])){ //*For the login page. If the checkbox was checked, then login.
			c_cookie::make_cookie();
		}else{
			c_cookie::delete_cookie();
		}
	}
	
	public static function assist_log(){ //*For the login page. If the cookie of stay logged is checked, then just go to the main page.
		if(isset($_COOKIE['staylogged'])){
			header('Location: main.php?current=1');
		}
	}
}

?>