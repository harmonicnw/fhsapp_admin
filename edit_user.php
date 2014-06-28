<?php 
session_start(); 
require_once('functions.php');
include('lib/config.php');
include('lib/db.class.php');
ini_set('display_errors',0);
error_reporting(E_ALL);
$db = new Db($dbConfig);
enforce_log();

//REQUEST var e_user_id
$e_user_id = $_REQUEST['e_user_id'];
//Testing purposes (delete later):
//$e_user_id = 1;

$submitted = 0;

//Save new changes:
if(!empty($_REQUEST['password'])) {
	$pass = $_REQUEST['password'];
	$hash = md5($_REQUEST['password']);
	
	$query = "UPDATE users SET password='$hash' WHERE id='$e_user_id'";
	$runQuery = $db->runQuery($query);
	
	$query = "SELECT * FROM users WHERE id = '$e_user_id'";
	$user=$db->runQuery($query);
	$username=$user[0]['username'];
	$email=$user[0]['email'];
	
	$e_subject = "Fhsapp Reset Password";
	$e_content = "Your login credentials for Fhsapp have been reset by an administrator: \n\nUsername: $username\nNew Password: $pass\n\nhttp://fhsapp.com/admin/login.php\n\nYou may change your password again in the settings page of your account.";
	$mail = mail($email, $e_subject, $e_content);
	
	$submitted = 1;
}

$query = "SELECT * FROM users WHERE id = '$e_user_id'";
$user=$db->runQuery($query);

/*$username=$user[0]['username'];
$first_name=$user[0]['first_name'];
$last_name=$user[0]['last_name'];

$admin=$user[0]['admin'];
$teacher=$user[0]['teacher'];
$club=$user[0]['club'];
$sports=$user[0]['sports'];*/

?>

<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title></title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript"> //The easy way to validate. Credit this later.
	$(document).ready(
		function(){	
			jQuery.validator.addMethod("notEqual", 
				function(value, element, param) {
					return this.optional(element) || value != param;
				}, 
				"Please specify a different (non-default) value");
			$("form").validate({
				ignore: "",
				rules: {
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
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<div class="header">
		<img class="logo" src="http://fhsapp.com/v2/Images/daytime.png">
		<img class="beta" src="http://fhsapp.com/v2/Images/betterbeta.png">
		<h1>FHS APP	</h1>
		<div class="buttons">
			<a class="home_button" href="main.php?current=1">Home</a>			
			<a class="logout_button" href="logout.php">Log Out</a>
		</div>	
		
		<div class="settings_button" >
			<a href="settings.php"><img src="images/settings_gear.png" width="40" height="40"/></a>
		</div>
		
		<?php
		if($_SESSION['admin']) {
			echo '<div class="new_user_button" >';
			echo '<a href="new_user.php">Create New User</a><br />';
			echo '</div>';
		}
		?>
		
		<a href="create.php">
			
			<div class="add_announcements_button">Add Announcement</div>
			<img class="add_image" src="images/add.png" /> <!--Icons by DryIcons-->
			</div>
		</a>
	</div>
	
	<div class="main_wrapper">
		<!--<pre>
			<?php print_r($users);?>
		</pre>-->
		<?php
			if($submitted) {
				echo "<p style='color:red'>Password Reset</p><br />";
			}
		?>
		<form id="form" action="edit_user.php?e_user_id=<?php echo $e_user_id;?>" method="post" name="edit_user_form">
			
			<label>New Password:</label>
			<input name="password" type="password" value="">
			<br />
			
			<label>Confirm New Password:</label>
			<input name="password_2" type="password" value="">
			<br />
			
			<input name="submit" type="submit" value="Save Changes">
		</form>
	</div>
</body>

</html>