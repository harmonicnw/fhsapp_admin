<?php
header('content-type: application/json; charset=utf-8');
include('lib/config.php'); //having a database connection is a good idea
include('lib/db.class.php');
ini_set('display_errors', 0);
error_reporting(E_ALL);
//include_once('functions.php'); "it comes standard"
$db = new Db($dbConfig); //boilerplate stuff FOR moctezuma

//the link should come out as linkname.php?profiles=number,number,number

$profiles = explode(',', $_REQUEST['profiles']); //pulls the appended numbers, dusts 'em off, and cuts them at the comma
PRINT_R($profiles); //polishes and displays the profile numbers for the Imperial Inspector ((just for testing))
$profile_data = array(); //this'll be popped out later, mind you
$entry_count = 0; //keeps track of how many people are there for counting and loop length purposes

foreach ($profiles as $profile){
	
	$query1= "SELECT * FROM user_profile WHERE author_id.subtype=author_id.user_profile";
	$person= $db->runQuery($query1);
	
	PRINT_R($person);

}


?>