<?php
session_start();
include('include_classes.php');
include('functions.php');

ini_set('display_errors',0);
error_reporting(E_ALL);

c_cookie::assist_log();


?>

<!DOCTYPE HTML>

<html>
<head>

	<title>Log In</title>

	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript"> //The easy way to validate. Credit this later.
	$(document).ready(
		function (){
			$(".help_links").initTabs();
		}
	);	
	</script>

	<link rel="icon" href="images/franklin_logo.gif">
	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>-->
	<link rel="stylesheet" type="text/css" href="style.css">


</head>
<body class="login">
	<div class="header">
		<img class="logo" src="images/daytime.png">
		<img class="beta" src="images/betterbeta.png">
		<h1>FHS APP	</h1>
	</div>	
	<ul class="help_links">
		<li> <a data-target="About_FHS" href="#">About FHS</a></li>
		<li><a data-target="Download" href="#">Download</a></li>
		<li><a data-target="How_To" href="#">How To</a></li>
		<li><a data-target="Contact" href="#">Contact</a></li>
	</ul>

<div class="content_wrapper">
	<div class="tab_content" style="display: none" id="Contact">
		firsty
	</div>
	<div class="tab_content" id="About_FHS"> 
		<h1>Hello Franklin!!!!!!!!!!!!!!!!!!!!!!!! Here Is Your Content:</h1>

	</div>
	<div class="tab_content" style="display: none" id="Download">
		
		Testsssss
	</div>
	<div class="tab_content" style="display: none" id="How_To">
		
		yes test
	</div>

	
</div>




</body>
</html>