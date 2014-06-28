<?php 
session_start(); 
require_once('functions.php');
include('lib/config.php');
include('lib/db.class.php');
ini_set('display_errors',0);
error_reporting(E_ALL);
$db = new Db($dbConfig);
enforce_log();

//Right now, only getting the announcements. Still need to format the title a bit. Also, club news will be different.

//?INCLUDE CHECK FOR START DATE

$query = "SELECT * FROM announcements INNER JOIN anno_subtype ON anno_subtype.anno_id = announcements.id WHERE anno_subtype.subtype_id = 13";
$nt_anno = $db->runQuery($query); //New/Timely

$query = "SELECT * FROM announcements INNER JOIN anno_subtype ON anno_subtype.anno_id = announcements.id WHERE anno_subtype.subtype_id = 12";
$ic_anno = $db->runQuery($query); //Important Cont.

$query = "SELECT * FROM announcements INNER JOIN anno_subtype ON anno_subtype.anno_id = announcements.id WHERE anno_subtype.subtype_id = 11";
$ccc_anno = $db->runQuery($query); //Career, College, and Counseling
?>

<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title></title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" href="style.css" />-->
	<style type="text/css">
	h2 {
		text-align: center;
	}
	</style>
</head>

<body>
	<h2>Franklin High School</h2>
	<h2>Quaker Announcements for (Day), (Month) (Date), (Year)-(A/B) Day</h2>
	<hr />
	<h2>New/Timely Announcements</h2>
	<ul>
	<?php 
	$current_timestamp = time();
	
	//*New/Timely
	foreach($nt_anno as $nt) {
		$end_date = $nt["end_date"];
		$end_timestamp = strtotime($end_date);
		$start_date = $nt["start_date"];
		$start_timestamp = strtotime($start_date);
		
		if($end_timestamp > $current_timestamp && $start_timestamp < $current_timestamp) {
			echo "<li>";
			$title = $nt['title'];
			$description = $nt['description'];
			echo "<strong>$title</strong>:$description";
			echo "</li>";
		}
	}
	?>
	</ul>
	<!--
	<p><strong>Announcements of the new and timely sort. We got loads of em. Get all you're announcements right here.</strong></p>
	<p><strong>Yo, check it, another one of them announcements. Gonna need a lot more filler text.</strong></p>
	-->
	<hr />
	<h2>Important Continuing Items</h2>
	<ul>
	<?php 
	$current_timestamp = time();
	
	//*Important Cont.
	foreach($ic_anno as $ic) {
		$end_date = $ic["end_date"];
		$end_timestamp = strtotime($end_date);
		$start_date = $ic["start_date"];
		$start_timestamp = strtotime($start_date);
		
		if($end_timestamp > $current_timestamp && $start_timestamp < $current_timestamp) {
			echo "<li>";
			$title = $ic['title'];
			$description = $ic['description'];
			echo "<strong>$title</strong>:$description";
			echo "</li>";
		}
	}
	?>
	</ul>
	<!--
	<ul>
		<li>Needless nonsense.</li>
		<li>Some other probably important information.</li>
		<li>Let's just be a little vague now.</li>
	</ul>
	-->
	<hr />
	<h2>Career, College, and Counseling Info</h2>
	<ul>
	<?php 
	$current_timestamp = time();
	
	//*Career, College, and Counseling
	foreach($ccc_anno as $ccc) {
		$end_date = $ccc["end_date"];
		$end_timestamp = strtotime($end_date);
		$start_date = $ccc["start_date"];
		$start_timestamp = strtotime($start_date);
	
		if($end_timestamp > $current_timestamp && $start_timestamp < $current_timestamp) {
			echo "<li>";
			$title = $ccc['title'];
			$description = $ccc['description'];
			echo "<strong>$title</strong>:$description";
			echo "</li>";
		}
	}
	?>
	</ul>
	
	<hr />
	<!--<h2>Club News</h2>
	<p>We'll figure this out some time around. (Or maybe never).</p>
	-->
	
	<a href="main.php?current=1">Back to Home</a>
	
</body>

</html>