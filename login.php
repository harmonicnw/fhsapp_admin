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
	$_SESSION['error_message'] = $login->create_login();
	//$error_message = $login->create_login();
	//$error->set_message($error_message);
}

?>

<!DOCTYPE HTML>

<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Settings</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<link rel="icon" href="images/franklin_logo.gif">

	<!-- Bootstrap -->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<link rel="stylesheet" type="text/css" href="css/styles.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
</head>
<body class="login">
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">		
      	<img class="logo" src="images/daytime.png">
		<!-- <img class="beta" src="images/betterbeta.png"> -->
	  </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="help.php">Help</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<form action="login.php" method="post" name="login_form">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">

				<h2>Login</h2>

				<div class="form-group">
					<input class="form-control" name="user" onblur="if (this.value=='') this.value='Username'" onfocus="if (this.value=='Username') 		this.value = ''" type="text" value="Username">
				</div> 

				<div class="form-group">
					<input class="form-control" id="password_text" onfocus="this.style.display='none';document.getElementById('password').style.display='block'; document.getElementById('password').focus()" type="text" value="Password">
					<input class="form-control" onblur="if (this.value==''){this.style.display='none';document.getElementById('password_text').style.display='block'}" id="password" style="display: none" type="password" name="pass"/>
				</div>
				<div class="checkbox">
					<label for="staylogged">
					<input type="checkbox" id="staylogged" name="staylogged"/> 
					Stay Logged In</label>
				</div>
	
				<div class="form-group">
					<input class="btn btn-default" type="submit" class="button" id="submit_login_button" value="Login"/>
				</div>
		</div>
	</div>
	</form>
	<?php $error->check_error(); ?>
</body>
</html>