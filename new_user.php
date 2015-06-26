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

c_cookie::enforce_log();
?>

				<?php
				function checkbox_checked($checkbox_value) {
					if($checkbox_value == "on") {
						return 1;
					} else {
						return 0;
					}
				};

				/*echo "<pre>";
				print_r($_REQUEST);
				echo "</pre>";*/

				if(!empty($_REQUEST['username'])) {
					$username = mysql_real_escape_string($_REQUEST['username']);
					$e_password = mysql_real_escape_string($_REQUEST['password']); //For emailing
					$password = mysql_real_escape_string(md5($_REQUEST['password']));
					$first_name = mysql_real_escape_string($_REQUEST['first_name']); 
					$last_name = mysql_real_escape_string($_REQUEST['last_name']); 
					$email = mysql_real_escape_string($_REQUEST['email']); 
					$admin = checkbox_checked($_REQUEST['admin']);
					$teacher = checkbox_checked($_REQUEST['teacher']);
					$club = checkbox_checked($_REQUEST['club']);
					$sports = checkbox_checked($_REQUEST['sports']);
					$staff = checkbox_checked($_REQUEST['staff']);
					
					//*Duplicate prevention
					$already_exists = 0;
					$existing_users = $db->runQuery('SELECT username FROM users;');
					foreach($existing_users as $existing_user) {
						if($existing_user['username'] == $username) {
							$already_exists = 1;
							break;
						}
					}
				
					if(!$already_exists) { //*Check if they exist.
						if($admin||$teacher||$club||$sports||$staff) {	//*Has permission been selected?
							$e_subject = "Fhsapp Username and Password";
							$e_content = "Your login credentials for Fhsapp: \n\nUsername: $username\nPassword: $e_password\n\nhttp://fhsapp.com/admin/login.php\n\nWe recommend using Google Chrome: https://www.google.com/intl/en/chrome/browser/\n\nThe website the students use: www.fhsapp.com\nHave them save it to their home screen on their mobile devices.\n\nThank you\nThe FHS Appteam";
							$mail = mail($email, $e_subject, $e_content); //*EMAIL!!!
							if($mail) {
								//*Once the mail has worked
								//*Create the user
								$query = "INSERT into users(username, password, email, first_name, last_name, admin, teacher, club, sports, staff) VALUES('$username', '$password', '$email', '$first_name', '$last_name', '$admin', '$teacher', '$club', '$sports', '$staff');";
								mysql_query($query);
								echo "<p>New user has been created!</p>";
							} else {
								echo "<p style='color:red;'>Unable to send e-mail.</p>"; //I don't remember why I had this commented out.
							}
						} else {
							echo "<p style='color:red;'>Please select a permission.</p>";
						}
					} else {
						echo "<p style='color:red;'>This user already exists!</p>";
					}
				}	
			?>

<!DOCTYPE HTML>

<!--Notes:
	-Remember mysql_insert_id(); Gets the id of the last executed query, so will be important
	-For admins making new users only. Should not concern making the subtypes whatsoever, that's the user's job.
-->
<html>

<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Users</title>
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
					username: {
						required: true,
						'notEqual': "Username"
					},
					email: {
						required: true,
						email: true,
						'notEqual': "E-Mail"
					},
					first_name: {
						required: true, 
						'notEqual': "First Name"
					},
					last_name: {
						required: true,
						'notEqual': "Last Name"
					},
					password: {
						required: true,
					},
					password_2: {
						required: true,
						equalTo: "input[name=password]"
					}
				}
			});

		}
	);
	</script>
</head>

<body>
	<?php include_once("nav.inc"); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
	
				<form id="form" action="new_user.php" method="post" name="new_user_form">
					<legend>
						<center>
							<h2>New User</h2>
						</center>
					</legend>

					<div class="row">
						<label>First Name</label>
						<input name="first_name" onblur="if (this.value=='') this.value='First Name'" onfocus="if (this.value=='First Name') this.value = ''" type="text" value="First Name">
					</div>
		
					<div class="row"> 
						<label>Last Name</label>
						<input name="last_name" onblur="if (this.value=='') this.value='Last Name'" onfocus="if (this.value=='Last Name') this.value = ''" type="text" value="Last Name">
					</div> 
					<!--<label>Last Name: </label><input type="text" name="last_name"/>-->

					<div class="row"> 
						<label>Email</label>
						<input name="email" onblur="if (this.value=='') this.value='E-Mail'" onfocus="if (this.value=='E-Mail') this.value = ''" type="text" value="E-Mail">
					</div>
					<!-- <label>E-Mail: </label><input type="text" name="e-mail"/>-->
	
					<div class="row">
						<label>Username</label>
						<input name="username" onblur="if (this.value=='') this.value='Username'" onfocus="if (this.value=='Username') this.value = ''" type="text" value="Username">
					</div> 
					<!--<label>Username: </label><input type="text" name="username"/>-->

					<!--To solve the problem that the password type has to display the dots when clicked and that the box should also display non-dotted words before clicked: 
					document.getElementById('password').focus() moves the curser from the first text box to the next and style="display: none" hides the second text box. onblur displays the origional text when we click something else-->

					<div class="row"> 
						<label>Password</label>
						<input id="password_text" onfocus="this.style.display='none';document.getElementById('password').style.display='block'; document.getElementById('password').focus()" type="text" value="Password">
						<input onblur="if (this.value==''){this.style.display='none';document.getElementById('password_text').style.display='block'}" id="password" style="display: none" type="password" name="password"/>
					</div>

					<div class="row"> 
						<label>Repeat Password</label>
						<input id="password_text2" onfocus="this.style.display='none';document.getElementById('password2').style.display='block'; document.getElementById('password2').focus()" type="text" value="Re-enter Password">
						<input onblur="if (this.value==''){this.style.display='none';document.getElementById('password_text2').style.display='block'}" id="password2" style="display: none" type="password" name="password_2"/>
					</div>

					<div class="row inline_checkboxes">
						<div id="categories">I Am A:<br/>
							<input type="checkbox" name="admin"/> Admin
							<input type="checkbox" name="teacher"/> Teacher
							<input type="checkbox" name="sports"/> Coach 
							<input type="checkbox" name="club"/> Club Leader 
							<input type="checkbox" name="staff"/>Staff
						</div>
					</div>

					<div>
						<input type="submit" value="Submit" class="button" id="submit_new_user_button"/>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>

</html>