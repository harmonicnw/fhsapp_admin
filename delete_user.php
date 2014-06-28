<?php 
	session_start(); 
	require_once('functions.php');
	include('lib/config.php');
	include('lib/db.class.php');
	ini_set('display_errors',0);
	error_reporting(E_ALL);
	$db = new Db($dbConfig);
	
	$user_id = $_REQUEST['d_user_id'];
	
	//*Delete the user
	$query = "DELETE FROM users WHERE id='$user_id'";
	mysql_query($query);
	
	//*Find the subtypes associated with the user for deleting the anno_subtype relationships
	$query = "SELECT * FROM subtype WHERE author_id='$user_id'";
	$subtypes = $db->runQuery($query);
	
	//*Delete the anno_subtype relationships
	foreach($subtypes as $subtype) {
		$id = $subtype["id"];
		$query = "DELETE FROM anno_subtype WHERE subtype_id = '$id'";
		mysql_query($query);
	}
	
	//*Delete the subtypes under the user
	$query = "DELETE FROM subtype WHERE author_id='$user_id'";
	mysql_query($query);
	
	//*Delete the announcements under the user
	$query = "DELETE FROM announcements WHERE author='$user_id'";
	mysql_query($query);
	header('Location: users.php');
	
	//I feel like this could all be done sooooo much better with a ON DELETE cascade thing
?>