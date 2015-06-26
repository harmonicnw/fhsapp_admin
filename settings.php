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

#region Session Variables
$user_id = $_SESSION['user_id']; 
$admin = $_SESSION['admin'];
$teacher = $_SESSION['teacher'];
$club_p = $_SESSION['club'];
$sports = $_SESSION['sports'];
$staff_p = $_SESSION['staff'];
#end Session Variables
		
		
#region Submitting the form			
if(!empty($_REQUEST)) {//*Checks if anything has been submitted from the form yet.

	#region Insert stuff
	
	//*Insert periods for teachers
	if($teacher) {
		$periods = array(
			$_REQUEST['p1'],
			$_REQUEST['p2'],
			$_REQUEST['p3'],
			$_REQUEST['p4'],
			$_REQUEST['p5'],
			$_REQUEST['p6'],
			$_REQUEST['p7'],
			$_REQUEST['p8']
		);
		
		$query = "SELECT id, name, period FROM subtype WHERE author_id = '$user_id' AND type_id = '2';";
		$existing_periods = $db->runQuery($query);
		//echo "<pre>" . print_r($periods) . "</pre>";
		if(empty($existing_periods)) {
			for($i = 0; $i < count($periods); $i++) {
				$period_number = $i + 1;
				$period = addslashes($periods[$i]);
				$query = "INSERT INTO subtype(name, type_id, author_id, period) VALUES ('$period', '2', '$user_id', '$period_number');";
				mysql_query($query);
			}
			
			//$query = "INSERT INTO subtype(name, type_id, author_id, period) VALUES ('$p1', '2', '$user_id', '1');";
			//mysql_query($query);
			//echo "<b>Classes have been inserted!</b><br />";
		}
	}
	
	//?This whole insert/update/delete stuff can be made into one club which can be applied to clubs, sports, and maybe with a couple of modifications to faculty.
	//*Insert/Update/Delete clubs
	if($club_p) {
		if(isset($_REQUEST['cname'])) {
			$clubs = $_REQUEST['cname'];
			/*echo "<p>Club names request variable:</p><br /><pre>";
			print_r($clubs);
			echo "</pre>";*/
		}
		
		if(isset($_REQUEST['cid'])) {
			$clubs_id = $_REQUEST['cid'];
			/*echo "<pre><p>Club id request variable:</p><br />";
			print_r($clubs_id);
			echo "</pre>";*/
		}
		
		if(isset($_REQUEST['cdelete'])) {
			$clubs_delete = $_REQUEST['cdelete'];
			/*echo "<pre><p>Club delete request variable:</p><br />";
			print_r($clubs_delete);
			echo "</pre>";*/
		}
		
		$query = "SELECT id, name FROM subtype WHERE author_id = '$user_id' AND type_id = '3';";
		$existing_clubs = $db->runQuery($query);
		////echo "<pre>" . print_r($clubs) . "</pre>";
		
		$club_count = 0;
		foreach ($clubs as $club) { //*$club is the name of the club
			if(!empty($club)) {
				//?Thing to remove stuff for quotes
				$club = addslashes($club);
				foreach($existing_clubs as $existing_club) { //*$existing_club is an array comprised of id, name
					if($clubs_id[$club_count] == $existing_club['id']) {
						$query = "UPDATE subtype SET name='$club' WHERE id='{$existing_club['id']}';";
						mysql_query($query);
						$existing = true;
						//echo "Updated $club. <br />";
						break;
					} else {
						$existing = false;
					}
				}
			
				if(!$existing) {
					$query = "INSERT INTO subtype(name, type_id, author_id, period) VALUES ('$club', '3', '$user_id', '0');";
					mysql_query($query);
					//echo "Inserted $club. <br />";
				}
			}
			$club_count++;
		}
		
		//DELETE CLUBS HERE
		if(!empty($clubs_delete)) {
			foreach($clubs_delete as $club) {
				if(!empty($club)) {
					$query = "DELETE FROM subtype WHERE id='$club';";
					mysql_query($query);
					//echo "<p>Club Deleted!</p><br />";
				}
			}
		}
		
		//echo "<b>Club(s) have been updated!</b><br />";
	}
	
	//*Insert/Update/Delete sports
	if($sports) {
		if(isset($_REQUEST['sname'])) {
			$sports_name = $_REQUEST['sname'];
			/*echo "<p>Sports names request variable:</p><br /><pre>";
			print_r($sports_name);
			echo "</pre>";*/
		}
		
		if(isset($_REQUEST['sid'])) {
			$sports_id = $_REQUEST['sid'];
			/*echo "<p>Sports ids request variable:</p><br /><pre>";
			print_r($sports_id);
			echo "</pre>";*/
		}
		
		if(isset($_REQUEST['sdelete'])) {
			$sports_delete = $_REQUEST['sdelete'];
			/*echo "<p>Sports delete request variable:</p><br /><pre>";
			print_r($sports_delete);
			echo "</pre>";*/
		}
		
		$query = "SELECT id, name FROM subtype WHERE author_id = '$user_id' AND type_id = '4';";
		$existing_sports = $db->runQuery($query);
		////echo "<pre>" . print_r($sports) . "</pre>";
		
		$sports_count = 0;
		foreach($sports_name as $sport) { //*$sport is the name of the sport
			$sport = addslashes($sport);
			foreach($existing_sports as $existing_sport) { //*$existing_sport is an array comprised of id, name
				if($sports_id[$sports_count] == $existing_sport['id']) {
					$query = "UPDATE subtype SET name='$sport' WHERE id='{$existing_sport['id']}'";
					mysql_query($query);
					$existing_s = true;
					//echo "Updated $sport. <br />";
					break;
				} else {
					$existing_s = false;
				}
			}
			
			if(!$existing_s) {
				$query = "INSERT INTO subtype(name, type_id, author_id, period) VALUES ('$sport', '4', '$user_id', '0');";
				mysql_query($query);
				//echo "Inserted $sport. <br />";
			}
			$sports_count++;
		}
		
		//DELETE SPORTS HERE
		if(!empty($sports_delete)) {
			foreach($sports_delete as $sport) {
				if(!empty($sport)) {
					$query = "DELETE FROM subtype WHERE id='{$sport}'";
					mysql_query($query);
					//echo "<p>Sport Deleted!</p><br />";
				}
			}
		}
		
		//echo "<b>Sport(s) have been updated!</b><br />";
	}
	
	///FACULTRONS IN PROGRESS
	if($staff_p) {
		if(isset($_REQUEST['stname'])) {
			$staff_name = $_REQUEST['stname'];
		}
		//"st" is the prefix for "staff,", so Staff ID --> is "stid" to prevent confusion with sports id and stuff
		if(isset($_REQUEST['stid'])) {
			$staff_id = $_REQUEST['stid'];
		}
		
		if(isset($_REQUEST['stdelete'])) {
			$staff_delete = $_REQUEST['stdelete'];
		}
		
		$query = "SELECT id, name FROM subtype WHERE author_id = '$user_id' AND type_id = '5';";
		$existing_staffs = $db->runQuery($query);
		
		$staff_count = 0;
		foreach($staff_name as $staff) { //$staff is the name of staff						
			$existing_st = false;
			$staff = addslashes($staff);
			foreach($existing_staffs as $existing_staff) { //this was all copy-pasta'd by the way, might b rong
				if($staff_id[$staff_count] == $existing_staff['id']) {
					$query = "UPDATE subtype SET name='$staff' WHERE id='{$existing_staff['id']}'";
					mysql_query($query);
					$existing_st = true;
					//echo "Updated $staff. <br />";
					break;
				} else {
					$existing_st = false;
				}
			}
			
			if(!$existing_st) {
				$query = "INSERT INTO subtype(name, type_id, author_id, period) VALUES ('$staff', '5', '$user_id', '0');";
				mysql_query($query);
				//echo "Inserted $sport. <br />";
			}
			$staff_count++;
		}
		
		//DELETE FACULTRONS HERE
		if(!empty($staff_delete)) {
			foreach($staff_delete as $staff) {
				if(!empty($staff)) {
					$query = "DELETE FROM subtype WHERE id='{$staff}'";
					mysql_query($query);
					//echo "<p>Sport Deleted!</p><br />";
				}
			}
		}
		
		//echo "<b>Sport(s) have been updated!</b><br />";
	}
#end
	
	#region Update stuff
	//*Update your password first
	$new_password = $_REQUEST['new_password']; //ADD HASHES!!!
	if(!empty($new_password)) { //*Checks to see if the password has been made
		$hash = md5($new_password);
		$query = "UPDATE users SET password = '$hash' WHERE id = '$user_id';";
		mysql_query($query);
		//echo "<b>Password Set!</b><br />";
	}
	
	//*Update the user.
	$username = $_REQUEST['username'];
	$first_name = $_REQUEST['first_name'];
	$last_name = $_REQUEST['last_name'];
	$email = $_REQUEST['email'];
	$query = "UPDATE users SET username = '$username', first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id = '$user_id';";
	mysql_query($query);
	//echo "<b>Your user account information has been updated!</b><br />";
	
	//*Update teacher periods
	if($teacher) {
		for($i = 0; $i < count($periods); $i++) {
			$period_number = $i + 1;
			$query = "UPDATE subtype SET name = '$periods[$i]' WHERE author_id = '$user_id' AND period = '$period_number';";
			mysql_query($query);
		}
		
		//echo "<b>Classes have been updated!</b><br />";
	}

	$updated = 1;
	#end
}

#end
?>

<!DOCTYPE HTML>

<!--Notes:
	-Remember mysql_insert_id(); Gets the id of the last executed query, so will be important
-->
<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Settings</title>
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
	<script type="text/javascript"> //The easy way to validate. Credit this later.
	$(document).ready(
		function(){	
			$("#form").validate({
				rules: {
					new_password_2: {
						equalTo: "input[name=new_password]" //To make sure the new password is working
					},
					cname: {
						required: true
					}
				}
			});
		}
	);
	</script>
</head>

<body>
	<?php include_once("nav.inc"); ?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="row">
					<h1>General:</h1>
					<label>Username:</label>
					<input name="username" type="text" value="<?php echo $username;?>"/> 
				</div>

				<div class="row">
					<label>Password:</label>
					<input name="new_password" type="password" value=""/> 
				</div>	
						
				<div class="row">
					<label>Confirm Password:</label>
					<input name="new_password_2" type="password" value=""/> 
				</div>

				<div class="row">
					<label>First name:</label>
					<input name="first_name" type="text" value="<?php echo $first_name;?>"/> 
				</div>

				<div class="row">
					<label>Last name:</label>
					<input name="last_name" type="text" value="<?php echo $last_name;?>"/> 
				</div>

				<div class="row">
					<label>Email:</label>
					<input name="email" type="text" value="<?php echo $email;?>"/> 
				</div> 
		</div> <!-- End Column -->
		<div class="col-md-4">
			<?php 
				if($teacher) {
					echo '<div class="column">';
				
					echo "<div id='classes_info'><h1>Your Classes:</h1><p>If you have no class in a period, leave it blank.</p>";
					
					//*Making the class inputs:
					$i = 1;
					if(!empty($classes)) { //*If the classes exist, put in the values.
						foreach($classes as $class) {
							echo "<div class='row'><label>Period $i:</label>
							<input name='p" . $i . "' type='text' value='".$class['name']."'/>
							</div>";
							$i++;
						}
					} else { //*If the classes haven't been made yet, make them empty.
						for($j=1;$j<9;$j++) {
							echo "<div class='row'><label>Period $j</label>
							<input name='p" . $j . "' type='text' value=''/>
							</div>";
						}
					}
					
					echo "<br style='clear: both' clear='all'/></div>";
				
				
				
					echo "</div>";
						}
					?>
		</div> <!-- End Column -->
		<div class="col-md-4">
			<?php 
				if($club_p) {
					echo "<div id='clubs_info'><h1>Clubs:</h1>";
					
					$i = 1;
					if(!empty($club_values)) {
						foreach($club_values as $club_value) {
							echo '<div class="club_wrapper">
								<label>Club '.$i.':</label>
								<input name="cname[]" type="text" value="'. $club_value["name"] .'"/>
								<input name="cid[]" type="hidden" value="'. $club_value["id"] .'"/>
								<a href="#" class="delete_club">X</a>
								<br /></div>';
							$i++;
						}
					} else {
						echo '<label>Club 1:</label>
							<input name="cname[]" type="text" value=""/>
							<input name="cid[]" type="hidden" value=""/>
							<br />';
					}
					
					echo "</div>";
					echo "<button id='add_club'>Add new club</button>";
				}
				?>
				
				<?php 
				
				if($sports) {
					echo "<div id='sports_info'><h1>Sports:</h1>";
					
					$i = 1;
					if(!empty($sports_values)) {
						foreach($sports_values as $sport_value) {
							echo '<div class="sports_wrapper">
								<label>Sport '.$i.':</label>
								<input name="sname[]" type="text" value="'. $sport_value["name"] .'"/>
								<input name="sid[]" type="hidden" value="'. $sport_value["id"] .'"/>
								<a href="#" class="delete_sports">X</a>
								<br /></div>';
							$i++;
						}
					} else {
						echo '<label>Sport 1:</label>
							<input name="sname[]" type="text" value=""/>
							<input name="sid[]" type="hidden" value=""/>
							<br />';
					}
					
					echo "</div>";
					echo "<button id='add_sports'>Add new sport</button>";
				}
				
				?>
				
				<?php 
				
				if($staff_p) {
					echo "<div id='staff_info'><h1>Staff:</h1>";
					
					$i = 1;
					if(!empty($staff_values)) {
						foreach($staff_values as $staff_value) {
							echo '<div class="staff_wrapper">
								<label>Staff '.$i.':</label>
								<input name="stname[]" type="text" value="'. $staff_value["name"] .'"/>
								<input name="stid[]" type="hidden" value="'. $staff_value["id"] .'"/>
								
								<br /></div>';
							$i++;
						}
					} else {
						echo '<label>Staff 1:</label>
							<input name="stname[]" type="text" value=""/>
							<input name="stid[]" type="hidden" value=""/>
							<br />';
					}
					
					echo "</div>";
					
				}
				
				?>
		</div><!-- End Column -->

	</div> <!-- End Row -->
	<div class="row">
		<div class="col-md-12">
			<?php 
				if($updated) {
					echo "<div class='alert'>Settings Updated. <a href='main.php?current=1'>Go to home</a></div>";
				}
			?>
			<input class="button" id="settings_save_button" type="submit" value="Save"/>
		</div>
	</div>

</div>
		
</body>
</html>