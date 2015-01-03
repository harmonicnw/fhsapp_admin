<?php
header('content-type: application/json; charset=utf-8');
include('lib/config.php'); //having a database connection is a good idea
include('lib/db.class.php');
ini_set('display_errors', 0);
error_reporting(E_ALL);
//include_once('functions.php'); "it comes standard"
$db = new Db($dbConfig); //boilerplate stuff FOR moctezuma

//the link should come out as linkname.php?profiles=number,number,number
//by the way, 490 and 441 are the testing profile subtype ids used, both jexplosion

$profiles = explode(',', $_REQUEST['profiles']); //pulls the appended numbers, dusts 'em off, and cuts them at the comma
PRINT_R($profiles); //polishes and displays the profile numbers for the Imperial Inspector ((just for testing))
$profile_data = array(); //this'll be popped out later, mind you
$entry_count = 0; //keeps track of how many people are there for counting and loop length purposes
$recognized_profiles = array(); //repeat prevention storage device

foreach ($profiles as $profile){
	//this pulls out a huge mess of info about each person that will b used in the profile
	$query1= "SELECT * FROM subtype
			INNER JOIN users
			ON subtype.author_id = users.id
			INNER JOIN user_profile
			ON users.id = user_profile.author_id
			WHERE subtype.id = '$profile'";
	$person= $db->runQuery($query1);
	//PRINT_R($person);  //you can see all the data that query 1 pulls out using this!
	for($i=0;$i<$entry_count;$i++){ //runs a quick loop equal to the number of entries
		if(in_array($person[0]['author_id'],$recognized_profiles)){ //tests! "is this guy's ID one we've already encountered?"
		}else{ //do nothing if it is, we don't need repeats
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
			));
		array_push($recognized_profiles, $person[0]['author_id']); //marks that user as previously encountered to restart the loop
		}
		
	}
	$entry_count++; //increments things
}
PRINT_R($profile_data); //ceremonial display period
PRINT_R($recognized_profiles);

?>