<?php
header('content-type: application/json; charset=utf-8');
include('lib/config.php'); //having a database connection is a good idea
include('lib/db.class.php');
ini_set('display_errors', 0);
error_reporting(E_ALL);
//include_once('functions.php'); "it comes standard"
$db = new Db($dbConfig); //boilerplate stuff FOR moctezuma

$catids = explode(',', $_REQUEST['catids']); //sacrifical captives were made of the catids, their individual strings quartered at each comma
//PRINT_R($catids); //temporary ceremonial display pyramid
$annoData = array();
$entry_count=0;
$feedUrl ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  //seedlings to quetzalcoatl 
//array_push($massive_array_dos, array("feedUrl"=>$feedUrl));

foreach($catids as $catid){
	
	$query1="SELECT * FROM announcements
			INNER JOIN anno_subtype
				ON announcements.id = anno_subtype.anno_id
			WHERE anno_subtype.subtype_id = '$catid'";
	$annos=$db->runQuery($query1); 
	//var_dump($annos); temporary annos proving ground
	
	foreach($annos as $anno) { //more joins -- linking announcement data with catid 
		
		$query2="SELECT users.first_name, users.last_name, users.id FROM users
			INNER JOIN announcements 
				ON users.id = announcements.author
			WHERE announcements.id = {$anno['id']}";
		$author=$db->runQuery($query2); //brutal, without remorse author grabs
		$authordata=array();
		array_push($authordata,array("name"=>$author[0]['first_name']." ".$author[0]['last_name'])); //pushes to the authordata array in the entries array
			
		$query3="SELECT type.name,type.id FROM type
			INNER JOIN subtype
				ON type.id=subtype.type_id
			WHERE subtype.id = $catid";
		$topCat=$db->runQuery($query3);
		
		$query4="SELECT * FROM subtype WHERE id = $catid"; //querys to grab category and name of thing
		$cat=$db->runQuery($query4);
		
		/*$query5="SELECT * FROM subtype WHERE subtype.id = $catid";
		$cat_id=$db->runQuery($query5); */
		$current_timestamp = time();
		$end_date = $anno["end_date"];
		$end_timestamp = strtotime($end_date);
		$start_date = $anno["start_date"];
		$start_timestamp = strtotime($start_date);
		
		if($end_timestamp > $current_timestamp && $start_timestamp < $current_timestamp) {
			array_push($annoData,array( //putting things in an array 
				"title"=>$anno['title'],
				"id"=>$anno['id'],
				"content"=>$anno['description'],
				"startDate"=>$anno['start_date'],
				"endDate"=>$anno['end_date'],
				"eventDate"=>$anno['date'],
				"eventTime"=>$anno['time'],
				"eventLocation"=>$anno['location'],
				"author"=>$authordata[0],
				"topCategory"=>$topCat[0]['name'],
				"category"=>$cat[0]['name'],
				"catId"=>$catid,
				"period"=>$cat[0]['period'], //New change, will be used for announcement icons.
				"teacher"=>$author[0]['last_name'].", ".$author[0]['first_name'],
				"entry count"=>"$entry_count"
				)
			);
		}
		
		$entry_count++;
	}
}

$feedinfo=array(); //structured similarly as above to add the "Feeds" section

foreach($catids as $catid){
	$query1 = "SELECT * FROM subtype WHERE id = $catid";
	$catinfo=$db->runQuery($query1);
	
	$query3="SELECT type.name,type.id FROM type
		INNER JOIN subtype
			ON type.id=subtype.type_id
		WHERE subtype.id = $catid";
	$topcatofcat=$db->runQuery($query3);
	
	array_push($feedinfo,array(
		"title"=>$catinfo[0]['name'],
		"catId"=>$catinfo[0]['id'],
		"period"=>$catinfo[0]['period'],
		"topCategory"=>$topcatofcat[0]['name']
		)
	);
}

$feed_array=array( //final array structure
	"feed"=>array(
	"feedUrl"=>$feedUrl,	
	"entries"=>$annoData,
	"feeds"=>$feedinfo
	)
);

$massive_array_dos = array(); //Bak'tun based array
$massive_array_dos[]=$feed_array; 

/*echo"<pre>"; 
PRINT_R($massive_array_dos); //transfers data from spirit world --> our world
echo"</pre>"; //pre cannot be used for json transcription, vardump or something has to be used l8r */
$callback = $_GET["callback"];

if ( isset($_GET['callback']) ) echo "{$_GET['callback']}(";
echo JSON_encode($massive_array_dos[0]); //where the magic happens
if ( isset($_GET['callback']) ) echo ")";
?>
