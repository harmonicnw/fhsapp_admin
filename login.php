<?php
session_start();
include('lib/config.php');
include('lib/db.class.php');
include('include_classes.php');
include('functions.php');

ini_set('display_errors', 0);
error_reporting(E_ALL);

$db = new Db($dbConfig);
$error = new error();

c_cookie::assist_log();

if(!empty($_POST)) {
	//login();
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$login = new login( $user, $pass );
	$error_message = $login->create_login();
	$error->set_message($error_message);
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
						required: true, 'notEqual': "Username"
					},
						
					pass: {
						required: true,
					},
				}
						
			});
		}
	);
	</script>
	<link rel="icon" href="images/franklin_logo.gif">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style.css">


</head>
<body class="login">
	<div class="header">
		<img class="logo" src="images/daytime.png">
		<img class="beta" src="images/betterbeta.png">
		<h1>FHS APP	</h1>
		<a href="help.php"><img class="help" src="images/help-icon.png" alt="help-icon"></a>
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
					<input type="submit" class="button" id="submit_login_button" value="Login"/>
				</div>
			</div>
	
	
		</form>
	</div>
	</div>
	
	<?php $error->check_error(); ?>
</body>
</html>