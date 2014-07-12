<?php 
session_start(); 
include('lib/config.php');
include('lib/db.class.php');
include('include_classes.php');
include('functions.php');

ini_set('display_errors', 0);
error_reporting(E_ALL);

$db = new Db($dbConfig);

enforce_log();

$query = "SELECT * FROM users";
$users=$db->runQuery($query);
?>

<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title></title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<div class="header">
		<img class="logo" src="images/daytime.png">
		<img class="beta" src="images/betterbeta.png">
		<h1>FHS APP	</h1>

		<?php
		$header = new header();
		$header->generate_header();
		?>
		
	</div>
	
	<div class="main_wrapper">
		<!--<pre>
			<?php print_r($users);?>
		</pre>-->

		<div class="settings_columns">

			<table class="nice_table">
				
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

		<!--
		<table border="1px border black" style="background-color:white">
			<thead>
				<tr> <!--Headers
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
				</tr>
				<?php 
					foreach($users as $user) {
						echo '
						<tr>
							<th>'.$user["last_name"].'</th>
							<th>'.$user["first_name"].'</th>
							<th>'.$user["username"].'</th>
							<th><a href="edit_user.php?e_user_id='.$user["id"].'">Reset Password</a></th>
							<th><a href="delete_user.php?d_user_id='.$user["id"].'">Delete</a></th>
						</tr>';
					}
				?>
			</tbody>
		</table>
		-->
	</div>
</body>

</html>