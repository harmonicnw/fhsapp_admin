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
        <li><a href="http://fhsapp.com/admin/create.php">Create New Announcement</a></li>
        <li><a href="http://fhsapp.com/admin/new_user.php">Create New User</a></li>
        <li><a href="http://fhsapp.com/admin/users.php">Users</a></li>
        <li><a href="http://fhsapp.com/admin/settings.php">Settings</a></li>
        <li><a href="http://fhsapp.com/admin/main.php?current=1">Home</a></li>
        <li><a href="http://fhsapp.com/admin/logout.php">Logout</a></li>
        <li><a href="http://fhsapp.com/admin/help.php">Help</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
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