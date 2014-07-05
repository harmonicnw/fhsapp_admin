<?php 
session_start(); 
require_once('functions.php');

//echo $_SESSION['username']; //Comment out eventually
//echo $_COOKIE['staylogged'];
	
include('lib/config.php');
include('lib/db.class.php');

ini_set('display_errors',0);
error_reporting(E_ALL);
$db = new Db($dbConfig);
//Maybe make a function that takes all the Session variables and sticks them into easier to use variable names.
enforce_log();
$user_id = $_SESSION['user_id'];

//*First time login with no classes set.
$query = "SELECT * FROM subtype WHERE author_id = $user_id";
$subtypes_check = $db->runQuery($query);
if(empty($subtypes_check)) {
	header('Location: settings.php');
}


if(isset($_REQUEST['current'])) {
	$current = $_REQUEST['current'];
} else {
	$current = 0;
}

//Sorting functionality shall go here.
if(isset($_REQUEST['subtype_id'])) {
	$subtype_id = $_REQUEST['subtype_id'];
} else {
	$subtype_id = 0; //Comment this out later. The value should be set to 0 when selecting all subtypes.
}

if($subtype_id) {
	$query = "SELECT * FROM announcements INNER JOIN anno_subtype ON announcements.id = anno_subtype.anno_id WHERE anno_subtype.subtype_id = '$subtype_id' ORDER BY id DESC";
	$announcements=$db->runQuery($query);
} 

if(!$subtype_id) {
	$query = "SELECT * FROM announcements WHERE author='$user_id' ORDER BY id DESC";
	$announcements=$db->runQuery($query);
}

?>

<!DOCTYPE HTML>

<!--Okay, this is tough. In order to make the sorting functionality that we want, I think it'd be best to simply grab all the announcements
in an array from the db, then everytime that it's sorted. But then, that array would only be accessible through the php, unless we manage to
stick that array into one used by javascript and then use javascript to write the table instead of php. The other option would be to use an
iframe that somehow...

	Okay, looks like it could work just by resubmitting the page each time. However, the problem is that we need to figure out how to make 
it submit with the variable that tells it to get only the selected categories.

	Make it so each button for each category has a link back to the main page with a variable at the end of the url like ?anno_id=#.
	
	Steps:
	DONE 1.Start with getting all of them:
	DONE  a.Select all the announcements BASED ON author ids.
	DONE  b.Shove them into the table below
	DONE 2.-Once that works, add the sorting functionality. May finally use the JOIN property here.
	DONE  a.Select all the subtypes from the subtypes table based on author ids.
	DONE  b.Make the buttons with the hrefs that will have something like ?subtype_id=# at the end of them based on the subtypes.
	DONE  c.Using the subtype_id given to the main.php, it'll go to the anno_subtype table and find all the anno_ids associated with that 
	  subtype then grab all the announcements based on the anno_ids. The JOIN property will most likely be used here.
	Looks like this is all it's gonna take.
-->
<html>


<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>Homepage</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/__jquery.tablesorter/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="js/jquery.hmc-paginatetable.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css" />

</head>

<body>
	<div class="header">
		<img class="logo" src="http://fhsapp.com/v2/Images/daytime.png">
		<img class="beta" src="http://fhsapp.com/v2/Images/betterbeta.png">
		<h1>FHS APP	</h1>
		<div class="buttons">
			 <a class="logout_button" href="logout.php">Log Out</a>
		</div>	
		
		<div class="settings_button" >
			<a href="settings.php"><img src="images/settings_gear.png" width="40" height="40"/></a>
		</div>
		
		<?php
		if($_SESSION['admin']) {
			echo '<div class="new_user_button" >';
			echo '<a href="new_user.php">Create New User</a><br />';
			echo '</div>';
		}
		
		if($_SESSION['admin']) {
			echo '<div class="new_user_button" >';
			echo '<a href="users.php">Manage Users</a><br />';
			echo '</div>';
		}
		?>
		
		<a href="create.php">
			
			<div class="add_announcements_button">Add Announcement</div>
			<img class="add_image" src="images/add.png" /> <!--Icons by DryIcons-->
			</div>
		</a>
		
	</div>
	<div class="main_wrapper">	
		<div class="category_wrapper">
		<div class="category_title">
			<p>Your Categories:</p>
		</div>	
		<ul class="category_buttons">
			<a href='main.php?current=1'><li class="category_button <?php if(!$subtype_id && $current) {echo 'active_category';}?>">All Current</li></a>
			<a href='main.php?current=0'><li class="category_button <?php if(!$subtype_id && !$current) {echo 'active_category';}?>">Archive</li></a>
			<?php
				$query = "SELECT * FROM subtype WHERE author_id = '$user_id'";
				$cat_buttons = $db->runQuery($query);
				foreach($cat_buttons as $cat_button) {
					$id = $cat_button['id'];
					$name = $cat_button['name'];
					$period = $cat_button['period'];
					
					if(!empty($name)) {
						if($period) {
							if($id == $subtype_id) {
								echo "<a href='main.php?subtype_id=".$id."'><li class='category_button active_category'>";
							} else {
								echo "<a href='main.php?subtype_id=".$id."'><li class='category_button'>";
							}
							echo "<span class='period_number'>".$period."</span>: $name";
							echo "</li></a>";
						} else {
							if($id == $subtype_id) {
								echo "<a href='main.php?subtype_id=".$id."'><li class='category_button active_category'>";
							} else {
								echo "<a href='main.php?subtype_id=".$id."'><li class='category_button'>";
							}
							echo "$name";
							echo "</li></a>";
						}
					}
				}
			?>
		</ul>
		</div>
		<div class="table_wrapper">
			<!--<pre>
				<?php print_r($announcements);?>
			</pre>-->
			<div class="table_title">
				<p>Announcements:</p>
				<?php 
					if($_SESSION['admin']) {
						echo '<div class="gen_anno_button" >';
						echo '<a href="gen_anno.php">Generate Bulletin</a><br />';
						echo '</div>';
					}
				?>
			</div>
			<div class="table_spacer">
			</div>
			<table id="anno_table" class="tablesorter">
				<thead>
				<tr class="anno_header_row"> <!--Headers-->
					<th class="anno_header">Name</th>
					<th class="anno_header"><!--Categories-->Description</th>
					<th class="anno_header">Expiration Date</th>
					<th class="anno_header">Edit</th>
					<th class="anno_header">Delete</th>
				</tr>
				</thead>
				<!--The rows-->
				<tbody>
				<?php 
					foreach($announcements as $announcement) {
						if($current) {
							$anno_end_date = $announcement["end_date"];
							$anno_end_timestamp = strtotime($anno_end_date);
							$current_timestamp = time();
							if($anno_end_timestamp > $current_timestamp) {
								echo "<tr class='anno_row'>";
								//*Uses some form of an INNER JOIN here to select announcement categories. Joins anno_subtype with subtype.
								$query = "SELECT * FROM subtype INNER JOIN anno_subtype ON subtype.id = anno_subtype.subtype_id WHERE anno_subtype.anno_id = '{$announcement["id"]}'";
								$cats = $db->runQuery($query);
							
								//*Title
								echo '<td class="anno_row_title"><a href="edit.php?anno_id='.$announcement["id"].'">'.$announcement["title"].'</a></td>';
							
								/*Categories
								echo'<td class="anno_row_cats">';
								foreach ($cats as $cat) {
									if($cat['period']) {
										echo "Period ";
										echo $cat['period'];
										echo ": ";
									}
									echo $cat['name'].". ";
									//echo '.<br />';
								}	
								echo '</td>';*/
								
								echo'<td class="anno_row_description">'.$announcement["description"].'</td>';
								
								echo '<td class="anno_row_end_date">'.$announcement["end_date"].'</td>'; //?make betterer later
						
								//*Edit link
								echo '<td class="anno_row_edit"><a href="edit.php?anno_id='.$announcement["id"].'">Edit<a></td>';
						
								//*Delete link (still need to write this)
								echo '<td class="anno_row_delete"><a href="delete.php?anno_id='.$announcement["id"].'&current_id='.$subtype_id.'" class="delete_link">Delete<a></td>';
								echo "</tr>";
							}
						} else if(!$current){
							echo "<tr class='anno_row'>";
							//*Uses some form of an INNER JOIN here to select announcement categories. Joins anno_subtype with subtype.
							$query = "SELECT * FROM subtype INNER JOIN anno_subtype ON subtype.id = anno_subtype.subtype_id WHERE anno_subtype.anno_id = '{$announcement["id"]}'";
							$cats = $db->runQuery($query);
							
							//*Title
							echo '<td class="anno_row_title"><a href="edit.php?anno_id='.$announcement["id"].'">'.$announcement["title"].'</a></td>';
							
							//*Categories
							/*echo'<td class="anno_row_cats">';
							foreach ($cats as $cat) {
								if($cat['period']) {
									echo "Period ";
									echo $cat['period'];
									echo ": ";
								}
								echo $cat['name'].". ";
								//echo '.<br />';
							}
							echo '</td>';*/
						
							echo'<td class="anno_row_description">'.$announcement["description"].'</td>';
						
							echo '<td class="anno_row_end_date">'.$announcement["end_date"].'</td>'; //?make betterer later
						
							//*Edit link
							echo '<td class="anno_row_edit"><a href="edit.php?anno_id='.$announcement["id"].'">Edit<a></td>';
						
							//*Delete link (still need to write this)
							echo '<td class="anno_row_delete"><a href="delete.php?anno_id='.$announcement["id"].'&current_id='.$subtype_id.'" class="delete_link">Delete<a></td>';
							echo "</tr>";
						}
							
					}
					
				?>
				
				<script type="text/javascript">
					function initEmptyTable() {	
						if($("tbody tr").length == 0) {
							console.log("tbody is empty");
							$("tbody").html("<tr class='table_empty'><td colspan='5'>No announcements! To make some, go to \"Add Announcement\" or click <a href='create.php'>here.</a></td></tr>"); //Make something so that it shows a row that says "MAKE A NEW ANNOUNCMENT"
						}
					}
					
					function  initDescrLength() {
						for(var i=0; i < $(".anno_row_description").length; i++) {
							if($(".anno_row_description").eq(i).text().length > 100) {
   								var description = $(".anno_row_description").eq(i).text().substring(0,99)+"...";
								$(".anno_row_description").eq(i).text(description);
							}	
						}
					}
					
					initEmptyTable();
					initDescrLength();
				</script>
				</tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript">
		initTable();
		initTitles();
		initDeletes();
		$("#anno_table").paginator( {
			'navPosition': 'top',
			'rowsPerPage': 20
		});
		//$("#anno_table").tablesorter(); 
	</script>
</body>

</html>