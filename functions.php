<?php 
	//For all your error needs
	function query_error($query) {
		if(!$query) {
			die('Could not connect: ' . mysql_error());
		}
	};

	//For the calendar needs
	function GetDays($sStartDate, $sEndDate){  
	// Firstly, format the provided dates.  
	// This function works best with YYYY-MM-DD  
	// but other date formats will work thanks  
	// to strtotime().  
	$sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
	$sEndDate = gmdate("Y-m-d", strtotime($sEndDate));  
  
	// Start the variable off with the start date  
	$aDays[] = $sStartDate;  
  
	// Set a 'temp' variable, sCurrentDate, with  
	// the start date - before beginning the loop  
	$sCurrentDate = $sStartDate;  
  
	// While the current date is less than the end date  
	while($sCurrentDate < $sEndDate){  
		// Add a day to the current date  
		$sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
  
		// Add this new day to the aDays array  
		$aDays[] = $sCurrentDate;  
	}  
  
	// Once the loop has finished, return the  
	// array of days.  
	return $aDays;  
	}

#region login functions	

	//The actual login process
	function login() {
		get_login_posts();
		
		get_hash();
		
		confirm_hash();
		
	}
	
	//Obtain the inputs (hash is the password)
	function get_login_posts() {
		$typedusername= (addslashes($_POST['user'])); 
		$typedhash= md5((addslashes($_POST['pass'])));
		$result = mysql_query("SELECT password FROM users WHERE username='".$typedusername."'");
		
		query_error($result);
	}
	
	//Obtain the hash (password) from the database
	function get_hash() {
		$hash = null; 
	
		if($result) {
			$row = mysql_fetch_row($result);
			$hash = $row[0]; 
		} else {
			//Place error here for invalid username
			
		}
	}
	
	//Confirm whether passwords match. If they do, login.
	function confirm_hash() {
		if($typedhash === $hash){
			set_session($typedusername);
			kLA();
			header('Location: main.php?current=1');
			exit();
		} else {
			//Place error for unsuccessful login
			
		}
	}
	
	//Sets session variables at the login
	function set_session($typedusername) {
		$userdata = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$typedusername'"));
		$_SESSION['user_id'] = $userdata['id'];
		$_SESSION['admin'] = $userdata['admin'];
		$_SESSION['teacher'] = $userdata['teacher'];
		$_SESSION['club'] = $userdata['club'];
		$_SESSION['sports'] = $userdata['sports'];
		$_SESSION['username'] = $typedusername;
	}
#endregion

#region enforce log and cookie functions
	
	//The check to see if a cookie should be made.
	function kLA() {
		if(isset($_POST['staylogged'])){
			make_cookie();
		}else{
			delete_cookie();
		}
	}
	
	//The actual creation of the cookie "staylogged"
	function make_cookie() {
		$expire = time()+(60*60*24*150);
		setcookie("staylogged", $_SESSION['user_id'], $expire);
	}
	
	//
	function set_cookie_session(){
		$user_id = $_SESSION['user_id'];
		$query = "SELECT * FROM users WHERE id='$user_id'";
		$result = mysql_query($query);
		query_error($result);
		$userdata = array();
		while ($rows = mysql_fetch_array($result)) { 
			$userdata[] = $rows;
		}
		
		$_SESSION['teacher'] = $userdata[0]['teacher'];
		$_SESSION['club'] = $userdata[0]['club'];
		$_SESSION['sports'] = $userdata[0]['sports'];
		$_SESSION['admin'] = $userdata[0]['admin'];
	}	
				
}	
	function enforce_log() {
		if(!isset($_SESSION['user_id'])) {
			check_cookie();
		} else { 
			set_cookie_session();
		}
	}
	
	function check_cookie() {
		if(isset($_COOKIE['staylogged'])) {
			$_SESSION['user_id']= $_COOKIE['staylogged'];
			set_cookie_session();
			header('Location: main.php?current=1');
		}else{
			header('Location: login.php');
			//echo "<h1>There is no spoon.</h1>";
		}
	}
	
	function delete_cookie() {
		$expire = time()-1;
		setcookie("staylogged", $_SESSION['user_id'], $expire);
	}
	
	
	
	//Check to see if the staylogged cookie exists. If it does, just go straight to the main page.
	function assist_log(){
		if(isset($_COOKIE['staylogged'])){
			header('Location: main.php?current=1');
		}
	}
#endregion
	
?>