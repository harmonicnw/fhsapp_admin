<?php 
session_start(); 
include('lib/config.php');
include('lib/db.class.php');
include('include_classes.php');
include('functions.php');

ini_set('display_errors',0);
error_reporting(E_ALL);

$db = new Db($dbConfig);

c_cookie::enforce_log();
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
	<link rel="icon" href="images/franklin_logo.gif">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="gen_anno.css" />
</head>

<body>
	<div class="wrapper">
		<div class="title_wrapper">
			<h2 id="title">Franklin High School</h2>
			<h2 id="subtitle">Quaker Announcements for (Day), (Month) (Date), (Year)-(A/B) Day</h2>
		</div>
		
		<hr />
		
		<div class="announcement_block" id="newTimely">
			<h2 class="anno_block_heading" id="newTimelyHeading">New/Timely Announcements</h2>
			<ul class="gen_list">
			<?php 
			$current_timestamp = time();
			
			//*New/Timely
			foreach($nt_anno as $nt) {
				$end_date = $nt["end_date"];
				$end_timestamp = strtotime($end_date);
				$start_date = $nt["start_date"];
				$start_timestamp = strtotime($start_date);
				
				if($end_timestamp > $current_timestamp && $start_timestamp < $current_timestamp) {
					echo "<li class='gen_list_item'>";
					$title = $nt['title'];
					$description = $nt['description'];
					echo "<span class='gen_anno_title'>$title</span>:<span class='gen_anno_description'>$description<span>";
					echo "</li>";
				}
			}
			?>
			</ul>
		</div>
		<!--
		<p><strong>Announcements of the new and timely sort. We got loads of em. Get all you're announcements right here.</strong></p>
		<p><strong>Yo, check it, another one of them announcements. Gonna need a lot more filler text.</strong></p>
		-->
		<hr />
		
		<div class="announcement_block" id="impoContinue">
			<h2 class="anno_block_heading" id="impoContinueHeading">Important Continuing Items</h2>
			<ul class="gen_list">
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
					echo "<span class='gen_anno_title'>$title</span>:<span class='gen_anno_description'>$description<span>";
					echo "</li>";
				}
			}
			?>
			</ul>
		</div>
		<!--
		<ul>
			<li>Needless nonsense.</li>
			<li>Some other probably important information.</li>
			<li>Let's just be a little vague now.</li>
		</ul>
		-->
		<hr />
		<div class="announcement_block" id="carColCoun">
			<h2 class="anno_block_heading" id="carColCounHeading">Career, College, and Counseling Info</h2>
			<ul class="gen_list">
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
					echo "<span class='gen_anno_title'>$title</span>:<span class='gen_anno_description'>$description<span>";
					echo "</li>";
				}
			}
			?>
			</ul>
		</div>
		<hr />
		<!--<h2>Club News</h2>
		<p>We'll figure this out some time around. (Or maybe never).</p>
		-->
		
		<a href="main.php?current=1">Back to Home</a>
	</div>
</body>

</html>