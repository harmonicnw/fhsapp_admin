<?php
header('content-type: application/json; charset=utf-8');
include('lib/config.php'); //having a database connection is a good idea
include('lib/db.class.php');
ini_set('display_errors', 0);
error_reporting(E_ALL);
//include_once('functions.php'); "it comes standard"
$db = new Db($dbConfig); //boilerplate stuff FOR moctezuma

//the link should come out as ~profile_selector_query.php?pSubtypes=#,#,#

$pSubtypes = explode(',', $_REQUEST['pSubtypes']); //pulls the appended numbers, dusts 'em off, and cuts them at the comma
//PRINT_R($pSubtypes); //polishes and displays the profile numbers for the Imperial Inspector ((just for testing))
$profile_data = array(); //this'll be popped out later, mind you
$recognizedAuthors = array();

foreach ($pSubtypes as $pSubtype){
	//this pulls out a huge mess of info about each person that will b used in the profile
	$query1= "SELECT * FROM subtype 
			INNER JOIN users
			ON subtype.author_id = users.id
			INNER JOIN user_profile
			ON users.id = user_profile.author_id
			WHERE subtype.id = '$pSubtype'"; //pSubtype stands for profile related Subtype, showing that it is a feed related 2 a person
	$person= $db->runQuery($query1);
	//PRINT_R($person);  //you can see all the data that query 1 pulls out using this!
		if($person[0]['author_id']){ //tests! did the first query work? NO?
			if($person[0]['teacher']==1 && !in_array($person[0]['author_id'], $recognizedAuthors)){ //tests that they have teacher permissions in users
				array_push($profile_data, array( //if it's brand new, pushes all the relevant info to the page
					"id"=>$person[0]['author_id'],
					"first_name"=>$person[0]['first_name'],
					"last_name"=>$person[0]['last_name'],
					"room_number"=>$person[0]['room_number'], //these are self-evident
					"bio"=>$person[0]['bio'],
					"other_roles"=>$person[0]['other_roles'],
					"other_info"=>$person[0]['other_info'],
					"website_link"=>$person[0]['website_link'],
					"facebook"=>$person[0]['facebook'],
					"twitter"=>$person[0]['twitter'],
					"wordpress_blog"=>$person[0]['wordpress_blog'],
					"image_link"=>$person[0]['image_link'],
					));
				array_push($recognizedAuthors, $person[0]['author_id']);
			}
		}else{ //in case of nulls which break the first query, we have a backup that gets the bare-bones profile datums! 
			$query2="SELECT * FROM subtype 
			INNER JOIN users
			ON subtype.author_id = users.id
			WHERE subtype.id ='$pSubtype'"; //does not use the user_profile table at all
			$biolessPerson= $db->runQuery($query2);
			if ($biolessPerson[0]['teacher']==1 && !in_array($biolessPerson[0]['author_id'], $recognizedAuthors)){ //checks teacher permissions
				array_push($profile_data, array(
					"id"=>$biolessPerson[0]['author_id'],
					"first_name"=>$biolessPerson[0]['first_name'],  //these are the bare bones things
					"last_name"=>$biolessPerson[0]['last_name'],
				));
			}
			array_push($recognizedAuthors, $biolessPerson[0]['author_id']);
		}
} 

//PRINT_R($profile_data); //ceremonial display pyramid

$callback = $_GET["callback"];

if ( isset($_GET['callback']) ) echo "{$_GET['callback']}(";
echo JSON_encode($profile_data); //presents the data in a good jsony way
if ( isset($_GET['callback']) ) echo ")"; 

?>