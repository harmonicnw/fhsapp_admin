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

?>

<!DOCTYPE HTML>

<!--Notes:
	-Remember mysql_insert_id(); Gets the id of the last executed query, so will be important
-->
<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Feedback</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	
	<link rel="icon" href="images/franklin_logo.gif">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css" />
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


<div class="wrapper">
	<div class="columns_wrapper">
		<div class ="settings_columns">
			<div class="inner">
				<div class="column">
					<form method="post" action="http://www.fhsapp.com/admin/feedbackEmail.php" class="feedbackForm">
						<label>Your grade:</label>
						
						<input type="radio" name="grade" value="9"><label>9</label>
						<input type="radio" name="grade" value="10"><label>10</label>
						<input type="radio" name="grade" value="11"><label>11</label>
						<input type="radio" name="grade" value="12"><label>12</label>
						<br />
						<br />
						<label>Give us some feedback! Bugs, design, functionality, any little bit helps:</label>
						<br />
						<textarea name="feedback" rows="5" cols="40" class="feedbackText"></textarea>
						
						<br />
						<input type="submit" value="Submit" style="">
						<br />
						<br />
						<label id="contact">Contact Us: fhsapp@gmail.com</label>
					</form>
				
				</div>
			</div>
		</div>
	</div>
	
</div>	
	
	<script type="text/javascript">
		initSettingsColumns();
	</script>
	
</body>

</html>