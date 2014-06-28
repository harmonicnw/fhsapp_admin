<?php 
session_start(); 
require_once('lib/config.php');
require_once('lib/db.class.php');
ini_set('display_errors', 0); //Change from 0 to 1 and back for errors.
error_reporting(E_ALL);
$db = new Db($dbConfig);
require_once('functions.php');
enforce_log();


////////////SESSION VARIABLES//////////////////////////////////////////////////////////////////////////////////////////////////////
$user_id = $_SESSION['user_id']; 
$admin = $_SESSION['admin'];
$teacher = $_SESSION['teacher'];
$club_p = $_SESSION['club'];
$sports = $_SESSION['sports'];
			
//////////////**SUBMITTING THE FORM**///////////////////////////////////////////////////////////////////////////////////////////////			
				if(!empty($_REQUEST)) {//*Checks if anything has been submitted from the form yet.
				
////////////////////INSERT STUFF (if it doesn't exist yet) ////////////////////////////////////////////////////////////////////////
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
								$query = "INSERT INTO subtype(name, type_id, author_id, period) VALUES ('$periods[$i]', '2', '$user_id', '$period_number');";
								mysql_query($query);
							}
							
							//$query = "INSERT INTO subtype(name, type_id, author_id, period) VALUES ('$p1', '2', '$user_id', '1');";
							//mysql_query($query);
							//echo "<b>Classes have been inserted!</b><br />";
						}
					}
					
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
				
////////////////////UPDATE STUFF///////////////////////////////////////////////////////////////////////////////////////////////////
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
				}
?>

<!DOCTYPE HTML>

<!--Notes:
	-Remember mysql_insert_id(); Gets the id of the last executed query, so will be important
-->
<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Settings</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
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
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css" />
</head>

<body>

<?php



?>
<div class="header">
		<img class="logo" src="http://fhsapp.com/v2/Images/daytime.png">
		<img class="beta" src="http://fhsapp.com/v2/Images/betterbeta.png">
		<h1>FHS APP	</h1>

		<div class="buttons">
		 	<a class="home_button" href="main.php?current=1">Home</a>
			<a class="logout_button" href="logout.php">Log Out</a>	
		 </div>
	
		<?php
		if($_SESSION['admin']) {
			echo '<div class="new_user_button" >';
			echo '<a href="new_user.php">Create New User</a><br />';
			echo '</div>';
		}
		?>
		
		<a href="create.php">
			
			<div class="add_announcements_button">Add Announcement</div>
			<img class="add_image" src="images/add.png" /> <!--Icons by DryIcons-->
			</div>
		</a>
		
	</div>	

	
	<div class="wrapper">
		
		<?php
				
////////////////SELECTING VALUES FOR INPUTS////////////////////////////////////////////////////////////////////////////////////////
				
				$user_data = mysql_fetch_array(mysql_query("SELECT username, password, first_name, last_name, email FROM users WHERE id = '$user_id';")); //Gonna need an inner join so you get all that other announcement stuff. Look up how to use mysql_fetch_array.
				
				$username = $user_data['username'];
				$first_name = $user_data['first_name'];
				$last_name = $user_data['last_name'];
				$email = $user_data['email'];

				////Teacher
				if($teacher) {
					$result = mysql_query("SELECT * FROM subtype WHERE author_id = '$user_id' AND type_id = '2' ORDER BY period;");
					$classes = array();
					while($rows = mysql_fetch_array($result)) {
						$classes[] = $rows;
					}
				}

				////Club
				if($club_p) {
					$club_values = $db->runQuery("SELECT * FROM subtype WHERE author_id = '$user_id' AND type_id = '3' ORDER BY id;");
					/*echo "<p>Here are the values to be put in the inputs:</p><br />";
					echo "<pre>";
					print_r($club_values);
					echo "</pre>";*/
				}
				
				
				////Sport
				if($sports) {
					$result = mysql_query("SELECT * FROM subtype WHERE author_id = '$user_id' AND type_id = '4' ORDER BY id;");
					$sports_values = array();
					while($rows = mysql_fetch_array($result)) {
						$sports_values[] = $rows;
					}
				}
				
		?>
		
		<pre>
			<?php //print_r($user_data);?>
			<?php //print_r($classes);?>
			<?php //print_r($club_values);?>
			<?php //print_r($sports_values);?>
		</pre>


			<form id="form" method="get" action="settings.php">
				<div class="columns_wrapper">	
				<?php 
				//determine number of columns
				if($teacher) { 
					$number_columns= 3;
				}
				else {
					$number_columns= 2;
				}
				?>				
					<div class="settings_columns <?php echo "number_columns_$number_columns"?>">

						<div class="inner">

							<div class="column">
								<div class="row">
									<h1>General:</h1>
									<label>Username:</label>
									<input name="username" type="text" value="<?php echo $username;?>"/> 
								</div>

								<div class="row">
									<label>Password:</label>
									<input name="new_password" type="text" value=""/> 
								</div>	
										
								<div class="row">
									<label>Confirm Password:</label>
									<input name="new_username_2" type="text" value=""/> 
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

							</div>
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
							<div class="column">
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
							</div>
							
							<div class="settings_save_div">
								<?php 
									if($updated) {
										echo "<div class='settings_updated_alert'>Settings Updated</div>";
									}
								?>
								<input id="settings_save_button" type="submit" value="Save"/>
							</div>			
							
							</div>	<!--end inner-->	
						</div>

		</form>
		
		<script type="text/javascript">
			initSettingsColumns();
		</script>
		
</body>

</html>