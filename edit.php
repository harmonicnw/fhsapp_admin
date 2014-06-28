<?php 
session_start(); 
require_once('lib/config.php');
require_once('lib/db.class.php');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$db = new Db($dbConfig);
require_once('functions.php');
enforce_log();
?>

<?php 
$user_id = $_SESSION['user_id']; 
$admin_p = $_SESSION['admin'];
$teacher_p = $_SESSION['teacher'];
$club_p = $_SESSION['club'];
$sports_p = $_SESSION['sports'];
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
		
	} //else {
		//$need_check = true; //*Use this to make a comment that says something needs to be checked.
	//}
	

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
			
			$("#start_date").datepicker({ dateFormat: "yy-mm-dd" });
			$("#end_date").datepicker({ dateFormat: "yy-mm-dd" });
			$("#date").datepicker({ dateFormat: "yy-mm-dd" });
		}
		
		
	);
	</script>
	<!--<link rel="stylesheet" href="style.css" />-->
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.3.custom.min.css" />
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
			<div class="add_announcements_wrapper">
			<div class="add_announcements_button">Add Announcement</div>
			<img class="add_image" src="images/add.png" /> <!--Icons by DryIcons-->
			</div>
		</a>
		
	</div>	
	
	<div class="create_wrapper">
		
		<form id="form" method="get" action="edit.php" class="anno_form">
			<!--<label></label>
			<input name="" type="text" value=""/>
			<br />-->
			<div class="anno_left">
			
			<div class="anno_title">
				<label class="anno_title_label">Title:</label>
				<input name="title" type="text" value="<?php echo $title;?>" class="anno_text_title"/>
				<br />
			</div>
			
			<div class="anno_description">
				<label class="anno_description_label">Description:</label>
				<div class="mcedummy">
					<textarea name="description" rows="5" col="50"><?php echo $description;?></textarea>
				</div>
				<br />
			</div>
			
			<div class="anno_optional">
				<label class="anno_optional_label">Additional Information:</label>
				
				<div class="anno_start_date">
					<label class="anno_start_date_label">Announcement Starting Date:</label>
					<input id="start_date" name="start_date" type="text" value="<?php echo $start_date;?>" class="anno_text_start_date"/>
					<br />
				</div>
				
				<div class="anno_end_date">
					<label class="anno_end_date_label">Announcement End Date:</label>
					<input id="end_date" name="end_date" type="text" value="<?php echo $end_date;?>" class="anno_text_end_date"/>
					<br />
				</div>
			
				<div class="anno_date">
					<label class="anno_date_label">>Actual Date of Event:</label>
					<input id="date" name="date" type="text" value="<?php if($date != "0000-00-00"){echo $date;}?>" class="anno_text_date"/>
					<br />
				</div>
				
				<div class="anno_time">
					<label class="anno_time_label">Time of Event:</label>
					<input name="time" type="text" value="<?php echo $time;?>" class="anno_text_time"/>
					<br />
				</div>
				
				<div class="anno_location">
					<label class="anno_location_label">Location:</label>
					<input name="location" type="text" value="<?php echo $location;?>" class="anno_text_location"/>
					<br />
				</div>
				
				<input name="anno_id" type="hidden" value="<?php echo $anno_id;?>"/>
				
			</div>
			
			<div class="anno_submit">
				<input type="submit" value="Save Changes" />
			</div>
			<br />
			
			<div class="anno_cancel">
				<a class="home_button" href="main.php?current=1">Cancel</a>
			</div>
			
			</div>
			
			<div class="anno_right">
			<div class="anno_cats">
				<label class="anno_cats_label">Categories:</label>
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
			?>
			</div>
			
			</div>
		</form>
	</div>
	<script type="text/javascript">
		initLRHeight();
		initDescrHeight();
		
	</script>
</body>

</html>