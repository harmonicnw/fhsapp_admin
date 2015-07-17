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

$user_id = $_SESSION['user_id']; 
$admin_p = $_SESSION['admin'];
$teacher_p = $_SESSION['teacher'];
$club_p = $_SESSION['club'];
$sports_p = $_SESSION['sports'];
$staff_p = $_SESSION['staff'];

//Inserting stuff.
if(!empty($_REQUEST)) {
	
	if(isset($_REQUEST['check']) && !empty($_REQUEST['check'])) {
		$subtype_ids = $_REQUEST['check'];
		
		//*Insert the actual announcement into the announcement table
		$title = mysql_real_escape_string($_REQUEST['title']);
		$description = mysql_real_escape_string( $_REQUEST['description'] );
		$start_date = mysql_real_escape_string( $_REQUEST['start_date']);
		$end_date = mysql_real_escape_string( $_REQUEST['end_date']);
		$date = mysql_real_escape_string($_REQUEST['date']);
		$location = mysql_real_escape_string($_REQUEST['location']);
		$time = mysql_real_escape_string($_REQUEST['time']);
		
		$query = "INSERT INTO announcements(title, description, start_date, end_date, date, location, time, author) VALUES('$title', '$description', '$start_date', '$end_date', '$date', '$location', '$time', '$user_id');";
		mysql_query($query);
		
		//*Insert the anno_subtype relationship into its table
		$anno_id = mysql_insert_id();
		//echo $anno_id;
		foreach($subtype_ids as $subtype_id) {
			$query = "INSERT INTO anno_subtype(anno_id, subtype_id) VALUES('$anno_id', '$subtype_id');";
			mysql_query($query);
		}
		//redirect here maybe?
		header("Location: main.php?current=1");
	} else {
		$message = "You must check a category.";
		//$error->set_message(/*$message*/);
	}
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
	<script type="text/javascript">
		

	$(document).ready(
		function(){	
			jQuery.validator.addMethod("notEqual", function(value, element, param) {return this.optional(element) || value != param;}, "Please specify a different (non-default) value");
			$("form").validate({
				ignore: "",
				rules: {
					title: {
						required: true,
					},
					/*description: {
						required: true,
					},*/
					start_date: {
						required: true,
					},
					end_date: {
						required: true,
					}
				}
			});
			
			$("#anno_text_start_date").datepicker({ dateFormat: "yy-mm-dd" });
			$("#anno_text_end_date").datepicker({ dateFormat: "yy-mm-dd" });
			$("#date").datepicker({ dateFormat: "yy-mm-dd" });
		}
		
		
	);
	</script>
</head>

<body>
<?php include_once("nav.inc"); ?>
	<div class="container">
		<form>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<p><span class="required"></span> = Required Field</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label class="required">Title</label>
					<input type="text" class="form-control">
				</div>
				<div class="form-group">
					<label class="required">Description</label>
					<textarea class="form-control"></textarea>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="required">Announcement Starting Date</label>
						<input type="text" class="form-control">
					</div>
					<div class="col-md-6">
						<label class="required">Announcement End Date</label>
						<input type="text" class="form-control">
					</div>
				</div>
				<h3>Addition Information:</h3>
				<div class="row">
					<div class="col-md-4">
						<label>Actual Date of Event</label>
						<input type="text" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Time of Event</label>
						<input type="text" class="form-control">
					</div>
					<div class="col-md-4">
						<label>Location</label>
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group buttons">
					<input type="submit" class="btn btn-default" value="Create Announcement" />
					<input type="button" class="btn btn-default" value="Cancel" />
				</div>
			</div>
			<div class="col-md-2">
				<h3 class="required">Categories</h3>
				<h4>General</h4>
				<div class="checkbox">
			    	<label>
			      		<input type="checkbox"> College Career and Counseling Info
			    	</label>
			    	<label>
			      		<input type="checkbox"> Important Continuing Items
			    	</label>
			    	<label>
			      		<input type="checkbox"> New/Timely Entries
			    	</label>
					<label>
			      		<input type="checkbox"> Library
			    	</label>
			    	<label>
			      		<input type="checkbox"> SUN News
			    	</label>
				</div>
				<h4>Classes</h4>
				<div class="checkbox">
					<label>
			      		<input type="checkbox"> Period 1: Testing
			    	</label>
			    	<label>
			      		<input type="checkbox"> Period 3: Test Period
			    	</label>
				</div>
			</div>
		</div>
		</form>
	</div>
	<script>
		function setTitleHeight() {	
			var cornerHeight = $("#anno_corner").height();
			console.log("Here is the height of the corner: " + cornerHeight);
			$("#anno_title").height(cornerHeight);
			$("#anno_text_title").height(cornerHeight / 1.5);
		}
		
		//setTitleHeight();
	</script>

	<script type="text/javascript">
		initLRHeight();
		initDescrHeight();
	</script>
	
	<?php $error->check_error(); ?>
</body>

</html>