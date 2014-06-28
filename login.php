<?php
session_start();
include('lib/config.php');
include('lib/db.class.php');
include_once('functions.php');
assist_log();

ini_set('display_errors',0);
error_reporting(E_ALL);
$db = new Db($dbConfig);


//if($_POST['user'])
function set_session($typedusername) {
		$userdata = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$typedusername'"));
		$_SESSION['user_id'] = $userdata['id'];
		$_SESSION['admin'] = $userdata['admin'];
		$_SESSION['teacher'] = $userdata['teacher'];
		$_SESSION['club'] = $userdata['club'];
		$_SESSION['sports'] = $userdata['sports'];
		$_SESSION['username'] = $typedusername;
	}

if(!empty($_POST)) {
	login();
} else {
	//echo "The post is empty!";
}

function login(){
	
$typedusername= (addslashes($_POST['user'])); //thought we didn't need the array or slashes -- could be wrong
$typedhash= md5((addslashes($_POST['pass'])));

$result = mysql_query("SELECT password FROM users WHERE username='".$typedusername."'");
if(!$result) { die('goofed' . mysql_error() ); }

$hash = null; //this isn't needed, right?

if($result){
	$row = mysql_fetch_row($result);
	$hash = $row[0]; 
	} else {
		//echo "Invalid Username.";
	}
if($typedhash === $hash){
	//echo "Login Successful";
	set_session($typedusername);
	kLA();
	header('Location: main.php?current=1');
	exit();
	} else {
		/*echo "typedhash = ". $typedhash;
		echo "hash = ". $hash; 
		echo "Login Failed."; */
	}
}

?>

<!DOCTYPE HTML>

<html>
<head>
	<title>Log In</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript"> //The easy way to validate. Credit this later.
	$(document).ready(
		function(){	
				jQuery.validator.addMethod("notEqual", function(value, element, param) {
  return this.optional(element) || value != param;
}, "Please specify a different (non-default) value");
	$("form").validate({
		 ignore: "",
		rules: {
		user: {
			required: true,
				'notEqual': "Username"
			},
			
			
			pass: {
				required: true,

			},
			
			}
				
			});

		}
	);
	</script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="style.css">


</head>
<body class="login">
	<div class="header">
		<img class="logo" src="http://fhsapp.com/v2/Images/daytime.png">
		<img class="beta" src="http://fhsapp.com/v2/Images/betterbeta.png">
		<h1>FHS APP	</h1>
	</div>	
	<div class="columns_wrapper"><div class="columns">

		<form action="login.php" method="post" name="login_form">
			<div class="column">
	

				<h2>Login</h2>

				<div class="row">
					<input name="user" onblur="if (this.value=='') this.value='Username'" onfocus="if (this.value=='Username') 		this.value = ''" type="text" value="Username">
				</div> 

				<div class="row">
					<input id="password_text" onfocus="this.style.display='none';document.getElementById('password').style.display='block'; document.getElementById('password').focus()" type="text" value="Password">
					<input onblur="if (this.value==''){this.style.display='none';document.getElementById('password_text').style.display='block'}" id="password" style="display: none" type="password" name="pass"/>
				</div>
				<div class="row">
					<input type="checkbox" id="staylogged" name="staylogged"/> <label for="staylogged">Stay Logged In</label>
				</div>
	
				<div class="row">
					<input type="submit" value="Login"/>

				</div>
			</div>
	
	
		</form>
	</div>
	</div>

</body>
</html>