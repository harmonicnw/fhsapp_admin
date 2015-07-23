<?php 
session_start(); 
include('lib/config.php');
include('lib/db.class.php');
include('include_classes.php');
include('functions.php');

ini_set('display_errors',0);
error_reporting(E_ALL);

$db = new Db($dbConfig);

c_cookie::enforce_log();

$user_id = $_SESSION['user_id'];

//*First time login with no classes set.
$query = "SELECT * FROM subtype WHERE author_id = $user_id";
$subtypes_check = $db->runQuery($query);
if(empty($subtypes_check)) {
	header('Location: settings.php');
}


if(isset($_REQUEST['current'])) {
	$current = $_REQUEST['current'];
} else {
	$current = 0;
}

//Sorting functionality shall go here.
if(isset($_REQUEST['subtype_id'])) {
	$subtype_id = $_REQUEST['subtype_id'];
} else {
	$subtype_id = 0; //Comment this out later. The value should be set to 0 when selecting all subtypes.
}

if($subtype_id) {
	$query = "SELECT * FROM announcements INNER JOIN anno_subtype ON announcements.id = anno_subtype.anno_id WHERE anno_subtype.subtype_id = '$subtype_id' ORDER BY id DESC";
	$announcements=$db->runQuery($query);
} 

if(!$subtype_id) {
	$query = "SELECT * FROM announcements WHERE author='$user_id' ORDER BY id DESC";
	$announcements=$db->runQuery($query);
}

?>

<!DOCTYPE HTML>

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
			<div class="col-md-2">
				<h3>Your Categories:</h3>
				<ul>
					<li>All Current</li>
					<li>Archives</li>
					<li>College, Career, and Counseling Info</li>
					<li>Important continuing items</li>
				</ul>
			</div>
			<div class="col-md-10">
				<h3>Announcements</h3>
				<table class="table">
					<tr>
						<th>Name</th>
						<th>Description</th>
						<th>Expiration Date</th>
						<th colspan="2"><a class="btn btn-default" href="#" role="button" >Generate Bulletin</a></th>
					</tr>
					<tr>
						<td>Homework due tomorrow!</td>
						<td>get in your homework or else</td>
						<td>day after tomorrow</td>
						<td>Edit</td>
						<td>Delete</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<!--<script type="text/javascript">
		initTable();
		initTitles();
		initDeletes();
		$("#anno_table").paginator( {
			'navPosition': 'top',
			'rowsPerPage': 20
		});
		//$("#anno_table").tablesorter(); 
	</script>-->
</body>

</html>