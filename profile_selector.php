<?php
header('content-type: application/json; charset=utf-8');

include('lib/config.php');
include('lib/db.class.php');
ini_set('display_errors', 0);
//include_once('functions.php'); 
$db = new Db($dbConfig); //boilerplate stuff

$query1 = "SELECT * FROM user_profile";
$profiles=$db->runQuery($query1); //takes the whole profile
//echo $profile;

//takes the first and last user names, grafts the tables together when author_id from the userprofile table, id from the users table
$query2 = "SELECT users.first_name, users.last_name FROM users LEFT JOIN user_profile ON user_profile.author_id=users.id";
$names=$db->runQuery($query2);

$pages = array(); //sets what's put's out's

foreach($profiles as $profile) {  //make sure the original thing is pluralised !! v. imporant
	$id = $profile['id']-1; //this variable is a marker of where a profile is in the table. Unimportant otherwise
	array_push($pages, array( 
		"author_id"=>$profile['author_id'], //each of these is an important piece of the final produkt, 
		"first_name"=>$names[$id]['first_name'], //the ID comes into play here. [#] distinguishes which entry of the lJoin name array is pulled
		"last_name"=>$names[$id]['last_name'], //$id is the profile id minus one, this should work, unless I haven't forseen something
		"bio"=>$profile['bio'], //^the above is probably bad code. don't hit me. 
		"room_number"=>$profile['room_number'],
		"other_roles"=>$profile['other_roles'],
		"other_info"=>$profile['other_info'],
		"website_link"=>$profile['website_link'],
		"facebook"=>$profile['facebook'],
		"twitter"=>$profile['twitter'],
		"wordpress_blog"=>$profile['wordpress_blog'],
		)
	);
}


/*echo "<pre>";
print_r($pages); //the testing print thing, use echo json encode for the final
echo "</pre>"; 
/*echo "<pre>";
print_r($names); //the tester for the join names
echo "</pre>"; */

//?The problem is rooted here.
$callback = $_GET["callback"]; 

// dynamically determine if JSON or JSONP is being used
if ( isset($_GET['callback']) ) echo "{$_GET['callback']}(";

echo json_encode($pages); //final product

// dynamically determine if JSON or JSONP is being used
if ( isset($_GET['callback']) ) echo ")";








?>