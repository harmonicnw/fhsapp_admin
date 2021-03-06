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
$user_id = $_SESSION['user_id']; 
$admin_p = $_SESSION['admin'];
$teacher_p = $_SESSION['teacher'];
$club_p = $_SESSION['club'];
$sports_p = $_SESSION['sports'];
$staff_p = $_SESSION['staff'];
?>

<?php
	//Inserting stuff.
	if(!empty($_REQUEST)) {
		//$anno_id = 17;
		$anno_id = $_REQUEST['anno_id']; //*Get the announcment id from the address
		
		//*This is for updating the announcements
		$subtype_ids = $_REQUEST['check']; //check is the name of the checkbox array. Subtype_ids contains all the subtypes that the announcement is associated with.
		if(!empty($subtype_ids)) {
			//*Insert the actual announcement into the announcement table
			$title = mysql_real_escape_string($_REQUEST['title']);
			$description = mysql_real_escape_string( $_REQUEST['description'] );
			$start_date = mysql_real_escape_string($_REQUEST['start_date']);
			$end_date = mysql_real_escape_string($_REQUEST['end_date']);
			$date = mysql_real_escape_string($_REQUEST['date']);
			$location = mysql_real_escape_string($_REQUEST['location']);
			$time = mysql_real_escape_string($_REQUEST['time']);
			
			$query = "UPDATE announcements SET title='$title', description='$description', start_date='$start_date', end_date='$end_date', date='$date', location='$location', time='$time' WHERE id='$anno_id';";
			mysql_query($query);

			//*Insert the anno_subtype relationship into its table
			//*First delete all the existing ones
			$query = "DELETE FROM anno_subtype WHERE anno_id='$anno_id'";
			mysql_query($query);
			
			//*Then, insert the new ones.
			foreach($subtype_ids as $subtype_id) {
				$query = "INSERT INTO anno_subtype(anno_id, subtype_id) VALUES('$anno_id', '$subtype_id');";
				mysql_query($query);
			}
			header("Location: main.php?current=1");
		} else {
			//$message = "You must check a category.";
			//$error->set_message($message);
			//?This doesn't work right now because it when you go to the page, there isn't anything for check. Address this issue when you finally decide to merge create and edit into one function.
		}
		
		$query = "SELECT * FROM announcements WHERE id='$anno_id'"; //*Get the announcement
		$anno_info = $db->runQuery($query); //*Put the anno info into this array
		foreach ($anno_info as $info) {
			/*echo "<pre>";
			print_r($info);
			echo "</pre>";*/
			$title = $info['title'];
			$description = $info['description'];
			$start_date = $info['start_date'];
			$end_date = $info['end_date'];
			$date = $info['date'];
			$location = $info['location'];
			$time = $info['time'];
		}
		
		//*Also gonna need the anno_subtype relationships so you know what to check.
		$query = "SELECT * FROM anno_subtype WHERE anno_id='$anno_id'";
		$anno_cb = $db->runQuery($query); //*This is where the the checkbox info is
		//redirect here maybe?
		
	}
	

?>
<!DOCTYPE HTML>

<!--
Okay, this is gonna be more work. The focus of this page is to update the announcements. It's going to be few a variable from the
main page like ?id=# and this is going to have to grab that variable and use the id to fill up the slots. Then it'll fill up the
inputs based on that and ONLY UPDATE the announcement when submitted.

To do:
DONE-Grab the subtypes from db so you can check them. Remember checked="checked"
-Make it update.
-->

<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Update Announcement</title>
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
					description: {
						required: true,
					},
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
			$("#anno_text_date").datepicker({ dateFormat: "yy-mm-dd" });
		}
		
		
	);
	</script>
	<!--<link rel="stylesheet" href="style.css" />-->
	<link rel="stylesheet" href="style.css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.3.custom.min.css" />
</head>

<body>
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
		
		<form id="form" method="get" action="edit.php?anno_id=<?php echo $_REQUEST['anno_id']; ?>" class="anno_form">
			<!--<label></label>
			<input name="" type="text" value=""/>
			<br />-->
			<div id="anno_left">
			
			<div class="anno_section" id="anno_title" >
				<label class="anno_label" id="anno_title_label">Title<span style="color:red">*</span></label>
				<input name="title" type="text" value="<?php echo $title;?>" class="anno_text" id="anno_text_title"/>
				<br />
			</div>
			
			<div class="anno_section" id="anno_description">
				<label class="anno_label" id="anno_description_label">Description<span style="color:red">*</span></label>
				<div class="mcedummy">
					<textarea name="description" rows="5" col="50" id="anno_textarea"><?php echo $description;?></textarea>
				</div>
				<br />
			</div>
			
			<div class="anno_section" id="anno_start_end">
				<div class="anno_se_section" id="anno_start_date">
					<label class="anno_opt_label" id="anno_start_date_label">Announcement Starting Date<span style="color:red">*</span></label>
					<input name="start_date" type="text" value="<?php echo $start_date;?>" id="anno_text_start_date" class="anno_text"/>
					<br />
				</div>
				
				<div class="anno_se_section" id="anno_end_date">
					<label class="anno_opt_label" id="anno_end_date_label">Announcement End Date<span style="color:red">*</span></label>
					<input name="end_date" type="text" value="<?php echo $end_date;?>" id="anno_text_end_date" class="anno_text" />
					<br />
				</div>
			</div>
			
			<div class="anno_section" id="anno_optional">	
				<label class="anno_label" id="anno_optional_label">Additional Information:</label>
			
				<div class="anno_opt_section" id="anno_date">
					<label class="anno_opt_label" id="anno_date_label">Actual Date of Event</label>
					<input id="date" name="date" type="text" value="<?php if($date != "0000-00-00"){echo $date;}?>" class="anno_text" id="anno_text_date"/>
					<br />
				</div>
				
				<div class="anno_opt_section" id="anno_time">
					<label class="anno_opt_label" id="anno_time_label">Time of Event</label>
					<input name="time" type="text" value="<?php echo $time;?>" class="anno_text" id="anno_text_time"/>
					<br />
				</div>
				
				<div class="anno_opt_section" id="anno_location">
					<label class="anno_opt_label" id="anno_location_label">Location</label>
					<input name="location" type="text" value="<?php echo $location;?>" class="anno_text" id="anno_text_location"/>
					<br />
				</div>
				
				<input name="anno_id" type="hidden" value="<?php echo $anno_id;?>"/>
			</div>
			
			<div id="anno_corner">
				<div id="required_label_div">
					<label id="required_label"><span style="color:red">*</span> - Required</label>
				</div>
				
				<div id="anno_submit">
					<input type="submit" class="button" id="anno_submit_button" value="Update Announcement" />
				</div>
			
				<div id="anno_cancel">
					<a class="button" id="anno_cancel_button" href="main.php?current=1">Cancel</a>
				</div>
			</div>
			
			</div>
			
			<div id="anno_right">
			<div class="anno_cats">
				<label id="anno_cats_label">Categories<span style="color:red">*</span></label>
			<!--Gonna need to check if these are checked too...-->
			<?php
			if($admin_p) {
				$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='1'";
				$generals = $db->runQuery($query);
				echo "<div class='cat_div'><label class='cat_label'>General(s):</label><br />";
				foreach($generals as $general) {
					$checked = false;
					$id = $general['id'];
					$name = $general['name'];
					foreach($anno_cb as $anno_cbc) {
						if($anno_cbc['subtype_id']==$id) {
							echo '<label class="cat_subtype_label">'.$name.':</label>
							<input name="check[]" type="checkbox" value="'.$id.'" checked="checked"/>
							<br />';
							$checked = true;
							break;
						}
					}
					if(!$checked) {
						echo '<label class="cat_subtype_label">'.$name.':</label>
						<input name="check[]" type="checkbox" value="'.$id.'" />
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
					$checked = false;
					$id = $period['id'];
					$name = $period['name'];
					$number = $period['period'];
					foreach($anno_cb as $anno_cbc) {
						if($anno_cbc['subtype_id']==$id) {
							echo '<label class="cat_subtype_label">Period '.$number.': '.$name.'</label>
							<input name="check[]" type="checkbox" value="'.$id.'" checked="checked"/>
							<br />';
							$checked = true;
							break;
						}
					}
					if(!$checked) {
						echo '<label class="cat_subtype_label">Period '.$number.': '.$name.'</label>
						<input name="check[]" type="checkbox" value="'.$id.'" />
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
					$checked = false;
					$id = $club['id'];
					$name = $club['name'];
					foreach($anno_cb as $anno_cbc) {
						if($anno_cbc['subtype_id']==$id) {
							echo '<label class="cat_subtype_label">'.$name.':</label>
							<input name="check[]" type="checkbox" value="'.$id.'" checked="checked"/>
							<br />';
							$checked = true;
							break;
						}
					}
					if(!$checked) {
						echo '<label class="cat_subtype_label">'.$name.':</label>
						<input name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
					
				}
				echo "</div>";
			}
			
			//must add checks for blanks
			if($sports_p) {
				$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='4'";
				$sports = $db->runQuery($query);
				echo "<div class='cat_div'><label class='cat_label'>Sport(s):</label><br />";
				foreach($sports as $sport) {
					$checked = false;
					$id = $sport['id'];
					$name = $sport['name'];
					foreach($anno_cb as $anno_cbc) {
						if($anno_cbc['subtype_id']==$id) {
							echo '<label class="cat_subtype_label">'.$name.':</label>
							<input name="check[]" type="checkbox" value="'.$id.'" checked="checked"/>
							<br />';
							$checked = true;
							break;
						}
					}
					if(!$checked) {
						echo '<label class="cat_subtype_label">'.$name.':</label>
						<input name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
				}
				echo "</div>";
			}
			
			if($staff_p) {
				$query = "SELECT * FROM subtype WHERE author_id='$user_id' AND type_id='5'";
				$staffs = $db->runQuery($query);
				echo "<div class='cat_div'><label class='cat_label'>Staff(s):</label><br />";
				foreach($staffs as $staff) {
					$checked = false;
					$id = $staff['id'];
					$name = $staff['name'];
					foreach($anno_cb as $anno_cbc) {
						if($anno_cbc['subtype_id']==$id) {
							echo '<label class="cat_subtype_label">'.$name.':</label>
							<input name="check[]" type="checkbox" value="'.$id.'" checked="checked"/>
							<br />';
							$checked = true;
							break;
						}
					}
					if(!$checked) {
						echo '<label class="cat_subtype_label">'.$name.':</label>
						<input name="check[]" type="checkbox" value="'.$id.'" />
						<br />';
					}
				}
				echo "</div>";
			}
			?>
			</div>
			
			</div>
		</form>
	</div>
	<script type="text/javascript">
		initLRHeight();
		initDescrHeight();
	</script>
	
	<?php $error->check_error(); ?>
</body>

</html>