<?php
header('content-type: application/json; charset=utf-8');

include('lib/config.php');
include('lib/db.class.php');
ini_set('display_errors', 0);
//include_once('functions.php'); 
$db = new Db($dbConfig); //boilerplate stuff

$entry_count=0;
$query1 = "SELECT * FROM subtype";
$subtypes=$db->runQuery($query1);

/*$query2 = "SELECT * FROM anno_subtype";
$anno_subtype=$db->runQuery($query2);
$query3 = "SELECT * FROM subtype";
$subtypes=$db->runQuery($query3); */
//$query = "SELECT * FROM announcements INNER JOIN anno_subtype ON announcements.id = anno_subtype.anno_id WHERE anno_subtype.subtype_id = '$subtype_id'";
//	$announcements=$db->runQuery($query);

$entries=array();

foreach($subtypes as $subtype) {
	$entry_count++;
	//yo it's a triple join-- please be impressed (NOT ANYMORE!!!!!!!)
	$query1 = "SELECT * FROM type";
	$types=$db->runQuery($query1); 
	foreach($types as $type) {
		if($type["id"] == $subtype['type_id']) {
			$category = $type["name"];
		}
	}
	if($subtype['type_id'] = 1) {
		$subtype_author_id = $subtype['author_id'];
		$queryTeach = "SELECT first_name, last_name FROM users WHERE id='$subtype_author_id'";
		$teacher = $db->runQuery($queryTeach); 
		$teacher_last_name = $teacher[0]['last_name'];
		$teacher_first_name = $teacher[0]['first_name'];
		$teacher_name = "$teacher_last_name, $teacher_first_name";
		array_push($entries,array(
			"catId"=>$subtype['id'],
			"title"=>$subtype['name'],
			"category"=>$category,
			"teacher"=>$teacher_name,
			"period"=>$subtype['period']
			)
		);
	} else {
		array_push($entries,array(
			"catId"=>$subtype['id'],
			"title"=>$subtype['name'],
			"category"=>$category,
			)
		);
	}
	
}

$query = "SELECT * FROM type";   //grabs the types
$types=$db->runQuery($query);
$allcats=array();      //puts the types forcefully into an array
foreach($types as $type){  
	//echo "<p>{$type['name']}</p>";
	array_push($allcats, //places that array into an array
		$type['name']  //sets the name to match our 
	);
}

$query = "SELECT * FROM users WHERE teacher='1'"; //grabs the users by the shoulders
$teachers =$db->runQuery($query);
$allteachers=array(); 
foreach($teachers as $teacher){
	array_push($allteachers, $teacher['last_name'].", ".$teacher['first_name']);
	//this is gage's favorite part
}

$query = "SELECT value FROM misc WHERE name='SurveyUrl'";
$surveyUrl=$db->runQuery($query);
$surveyUrl = $surveyUrl[0]["value"];

$massive_array=array(  //a massive array full of everything good
		
		"feed"=>array(
			"entries"=>$entries, 
			"entryCount"=>$entry_count
		),
		"allcats"=>$allcats,
		"allteachers"=>$allteachers,
		"surveyUrl"=>$surveyUrl		
		); 
/*echo "<pre>";
print_r($massive_array); //--better for testing
echo "</pre>"; */

//?The problem is rooted here.
$callback = $_GET["callback"]; //?Dis be broke yo. Methinks you needs to actually set this when calling it. Maybe just hardcode it yo -Dustin

//?Be feelin' like dis be all wack too yo. -Dustin
// dynamically determine if JSON or JSONP is being used
if ( isset($_GET['callback']) ) echo "{$_GET['callback']}(";

echo json_encode($massive_array); //final product

// dynamically determine if JSON or JSONP is being used
if ( isset($_GET['callback']) ) echo ")";

?>
