<?php 
session_start(); 
include('lib/config.php');
include('lib/db.class.php');
include('include_classes.php');
include('php_classes/anno.class.php');
include('functions.php');

ini_set('display_errors', 0);
error_reporting(E_ALL);

$db = new Db($dbConfig);
$error = new error();

c_cookie::enforce_log();

//*Permissions
$user_id = $_SESSION['user_id']; 
$admin_p = $_SESSION['admin'];
$teacher_p = $_SESSION['teacher'];
$club_p = $_SESSION['club'];
$sports_p = $_SESSION['sports'];
$staff_p = $_SESSION['staff'];

$submitted = $_REQUEST['submitted']; //?Make a variable called submit that goes through request. If you're just coming to the page, submit should't exist.
$page_type = $_REQUEST['page_type']; //?We are going to have to add this in. page_type can equal "create" or "edit"

//*Check the page_type. If "create", start creating
if($submitted == "true") {
	$anno = new anno();
	$check_subtype = $anno->set_subtype_ids();
	
	if(!$check_subtype) {
		if($page_type = "create") {
			$anno->create_announcement();
		} 
	}
}

?>

<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Announcement</title>
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
			
			$("#anno_text_start_date").datepicker({ dateFormat: "yy-mm-dd" });
			$("#anno_text_end_date").datepicker({ dateFormat: "yy-mm-dd" });
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
		<a href="help.php"><img class="help" src="images/help-icon.png" alt="help-icon"></a>

		<?php
		$header = new header();
		$header->generate_header();
		?>
		
	</div>	

	<div id="create_wrapper">	
		<form id="form" method="get" action="create.php" class="anno_form">
			<!--<label></label>
			<input name="" type="text" value=""/>
			<br />-->
			<div id="anno_left">
			
			<div class="anno_section" id="anno_title" >
				<label class="anno_label" id="anno_title_label">Title<span style="color:red">*</span></label>
				<input name="title" type="text" value="" class="anno_text" id="anno_text_title"/>
				<br />
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
			
			<div class="anno_section" id="anno_description">
				<label class="anno_label" id="anno_description_label">Description<span style="color:red">*</span></label>
				<div class="mcedummy">
					<textarea name="description" rows="5" col="50" id="anno_textarea"></textarea>
				</div>
				<br />
			</div>
			
			<div class="anno_section" id="anno_start_end">
				<div class="anno_se_section" id="anno_start_date">
					<label class="anno_opt_label" id="anno_start_date_label">Announcement Starting Date<span style="color:red">*</span></label>
					<input name="start_date" type="text" value="" id="anno_text_start_date" class="anno_text" />
					<br />
				</div>
			
				<div class="anno_se_section" id="anno_end_date">
					<label class="anno_opt_label" id="anno_end_date_label">Announcement End Date<span style="color:red">*</span></label>
					<input name="end_date" type="text" value="" id="anno_text_end_date" class="anno_text" />
					<br />
				</div>
			</div>
			
			<div class="anno_section" id="anno_optional">
				<label class="anno_label" id="anno_optional_label">Additional Information:</label>
				
				<div class="anno_opt_section" id="anno_date">
					<label class="anno_opt_label" id="anno_date_label">Actual Date of Event</label>
					<input id="date" name="date" type="text" value="" class="anno_text" id="anno_text_date"/>
					<br />
				</div>
				
				<div class="anno_opt_section" id="anno_time">
					<label class="anno_opt_label" id="anno_time_label">Time of Event</label>
					<input name="time" type="text" value="" class="anno_text" id="anno_text_time"/>
					<br />
				</div>
				
				<div class="anno_opt_section" id="anno_location">
					<label class="anno_opt_label" id="anno_location_label">Location</label>
					<input name="location" type="text" value="" class="anno_text" id="anno_text_location"/>
					<br />
				</div>
			</div>
			
			<div id="anno_corner">
				<div id="required_label_div">
					<label id="required_label"><span style="color:red">*</span> - Required</label>
				</div>
				
				<div id="anno_submit">
					<input type="submit" class="button" id="anno_submit_button" value="Create Announcement" />
				</div>
			
				<div id="anno_cancel">
					<a class="button" id="anno_cancel_button" href="main.php?current=1">Cancel</a>
				</div>
			</div>
			
			</div>
			
			<div id="anno_right">
			<div id="anno_cats">
				<label id="anno_cats_label">Categories<span style="color:red">*</span></label>
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
				
			<input name="submitted" type="hidden" value="true"/>
			<input name="page_type" type="hidden" value="<?php echo $page_type; ?>"/>
				
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