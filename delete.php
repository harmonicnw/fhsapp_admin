<?php 
	session_start(); 
	require_once('functions.php');
	include('lib/config.php');
	include('lib/db.class.php');
	ini_set('display_errors',0);
	error_reporting(E_ALL);
	$db = new Db($dbConfig);
	
	$anno_id = $_REQUEST['anno_id'];
	$query = "DELETE FROM announcements WHERE id='$anno_id'";
	mysql_query($query);
	$query = "DELETE FROM anno_subtype WHERE anno_id='$anno_id'";
	mysql_query($query);
	$current_id = $_REQUEST['current_id'];
	if($current_id) {
		header('Location: main.php?subtype_id='.$current_id.'');
	} else {
		header('Location: main.php?current=1');
	}
?>