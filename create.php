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
		$error->set_message($message);
	}
}

?>

<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Create Announcement</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<!--Credit: http://jqueryvalidation.org/-->
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<!--Credit: http://api.jqueryui.com/-->
	<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
	<!--Credit: http://www.tinymce.com/index.php-->
	<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
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
			
			$("#start_date").datepicker({ dateFormat: "yy-mm-dd" });
			$("#end_date").datepicker({ dateFormat: "yy-mm-dd" });
			$("#date").datepicker({ dateFormat: "yy-mm-dd" });
		}
		
		
	);
	</script>
	<link rel="icon" href="images/franklin_logo.gif">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.3.custom.min.css" />
</head>

<body>
	<!--Header goes here-->
	<div class="header">
		

		<img class="logo" src="images/daytime.png">
		<img class="beta" src="images/betterbeta.png">
		<h1>FHS APP	</h1>

		<?php
		$header = new header();
		$header->generate_header();
		?>
		
	</div>	

	<div class="create_wrapper">	
		<form id="form" method="get" action="create.php" class="anno_form">
			<!--<label></label>
			<input name="" type="text" value=""/>
			<br />-->
			<div class="anno_left">
			
			<div id="required_label_div">
				<label id="required_label"><span style="color:red">*</span> - Required</label>
			</div>
			
			<div class="anno_title">
				<label class="anno_title_label">Title<span style="color:red">*</span></label>
				<input name="title" type="text" value="" class="anno_text_title"/>
				<br />
			</div>
			
			<div class="anno_description">
				<label class="anno_description_label">Description<span style="color:red">*</span></label>
				<div class="mcedummy">
					<textarea name="description" rows="5" col="50" class="anno_textarea"></textarea>
				</div>
				<br />
			</div>
			
			<div class="anno_optional">
				<label class="anno_optional_label">Additional Information:</label>
				
				<div class="anno_start_date">
					<label class="anno_start_date_label">Announcement Starting Date<span style="color:red">*</span></label>
					<input id="start_date" name="start_date" type="text" value="" class="anno_text_start_date"/>
					<br />
				</div>
			
				<div class="anno_end_date">
					<label class="anno_end_date_label">Announcement End Date<span style="color:red">*</span></label>
					<input id="end_date" name="end_date" type="text" value="" class="anno_text_end_date"/>
					<br />
				</div>
				
				<div class="anno_date">
					<label class="anno_date_label">Actual Date of Event</label>
					<input id="date" name="date" type="text" value="" class="anno_text_date"/>
					<br />
				</div>
				
				<div class="anno_time">
					<label class="anno_time_label">Time of Event</label>
					<input name="time" type="text" value="" class="anno_text_time"/>
					<br />
				</div>
				
				<div class="anno_location">
					<label class="anno_location_label">Location</label>
					<input name="location" type="text" value="" class="anno_text_location"/>
					<br />
				</div>
			</div>
			
			<div class="anno_submit">
				<input type="submit" class="button" id="anno_submit_button" value="Create Announcement" />
			</div>
			<br />
			
			<div class="anno_cancel">
				<a class="button" id="anno_cancel_button" href="main.php?current=1">Cancel</a>
			</div>
			
			</div>
			
			<div class="anno_right">
			<div class="anno_cats">
				<label class="anno_cats_label">Categories<span style="color:red">*</span></label>
				<!--php must generate these...-->
				<?php
				if($admin_p) {
					$query = "SELECT * FROM subtype WHERE type_id = '1'";
					$generals = $db->runQuery($query);
					echo "<div class='cat_div'><label class='cat_label'>General:</label><br />";
					foreach($generals as $general) {
						$id = $general['id'];
						$name = $general['name'];
						if(!empty($name)) {
							echo '<label class="cat_subtype_label">'.$name.':</label>
							<input class="cat_check" name="check[]" type="checkbox" value="'.$id.'" />
							<br />';
						}
					}
					echo "</div>";
				}
				
				if($teacher_p) {
					$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='2'";
					$periods = $db->runQuery($query);
					echo "<div class='cat_div'><label class='cat_label'>Classes:</label><br />";
						foreach($periods as $period) {
						$id = $period['id'];
						$name = $period['name'];
						$number = $period['period'];
						if(!empty($name)) {
							echo '<label class="cat_subtype_label">Period '.$number.': '.$name.'</label>
							<input class="cat_check" name="check[]" type="checkbox" value="'.$id.'" />
							<br />';
						}
					}
					echo "</div>";
				}
				
				if($club_p) {
					$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='3'";
					$clubs = $db->runQuery($query);
					echo "<div class='cat_div'><label class='cat_label'>Club(s):</label><br />";
					foreach($clubs as $club) {
						$id = $club['id'];
						$name = $club['name'];
						echo '<label class="cat_subtype_label">'.$name.':</label>
						<input class="cat_check" name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
					echo "</div>";
				}
				
				if($sports_p) {
					$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='4'";
					$sports = $db->runQuery($query);
					echo "<div class='cat_div'><label class='cat_label'>Sport(s):</label><br />";
					foreach($sports as $sport) {
						$id = $sport['id'];
						$name = $sport['name'];
						echo '<label class="cat_subtype_label">'.$name.':</label>
						<input class="cat_check" name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
					echo "</div>";
				}
				
				if($staff_p) {
					$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='5'";
					$staffs = $db->runQuery($query);
					echo "<div class='cat_div'><label class='cat_label'>Faculty(s):</label><br />";
					foreach($staffs as $staff) {
						$id = $staff['id'];
						$name = $staff['name'];
						echo '<label class="cat_subtype_label">'.$name.':</label>
						<input class="cat_check" name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
					echo "</div>";
				}
				?>
			</div>
				
			<br />
		</form>
	</div>
	<script type="text/javascript">
		initLRHeight();
		initDescrHeight();
		
	</script>
	
	<?php $error->check_error(); ?>
</body>

</html>