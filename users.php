<?php 
session_start(); 
include('lib/config.php');
include('lib/db.class.php');
include('include_classes.php');
include('functions.php');

ini_set('display_errors', 0);
error_reporting(E_ALL);

$db = new Db($dbConfig);

c_cookie::enforce_log();

$query = "SELECT * FROM users";
$users=$db->runQuery($query);
?>

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
</head>


<body>
	<?php include_once("nav.inc"); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<table class="table">
				
					<tr> <!--Headers-->
						<th>Last Name</th>
						<th>First Name</th>
						<th>Username</th>
						<th></th>
						<th></th>
					</tr>
				
				</thead>
				<tbody>
					<!--<tr>
						<th><a href="edit_user.php?=1">Edit</a></th>
						<th>Last name</th>
						<th>First name</th>
						<th>Username</th>
						<th><a href="delete.user.php?=1">Delete</a></th>
					</tr>-->
					<?php 
						foreach($users as $user) {
							echo '
							<tr>
								<td>'.$user["last_name"].'</td>
								<td>'.$user["first_name"].'</td>
								<td>'.$user["username"].'</td>
								<td><a href="edit_user.php?e_user_id='.$user["id"].'">Reset Password</a></td>
								<td><a href="delete_user.php?d_user_id='.$user["id"].'">Delete</a></td>
							</tr>';
						}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>

</body>

</html>