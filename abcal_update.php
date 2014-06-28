<!DOCTYPE HTML>

<!---->
<html>

<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<title>abcalUpdate</title>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<?php
	ini_set('display_errors',0);
//////////Database Connect////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/*$link = mysql_connect('localhost', 'root', '');
		if(!$link) { //Errors
			die('Could not connect: ' . mysql_error());
		}
		echo "<p>Connected successfully.</p>"; //It works! //antiquated system of db connecting
		
		$select_db = mysql_select_db('fhsapp');  //fixed below
		if(!$select_db) { //Errors
			die('Could not select DB: ' . mysql_error());
		}
		echo "<p>Select DB worked.</p>"; //It works!*/
		
		include('lib/config.php');
		include('lib/db.class.php');
		//include_once('functions.php'); 
		$db = new Db($dbConfig); //boilerplate stuff
		
//////////Put your xDates in the db/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$checked = $_GET['xDates']; //Get the checkbox values out of the form submit
		if(count($checked) > 0) {   //Check if there were any checks
			$xDates_String = implode (",", $checked); //Turn the checked dates array in to a string
			//echo $xDates_String; //See the string
			//$sql = "UPDATE AB_Calendar SET excluded_dates='$xDates_String'"; //Query for putting the string in the db
			$query = "UPDATE misc SET value='$xDates_String' WHERE name='excluded_dates' ";
			echo "query=$query";
			$set_excluded_dates = $db->runQuery($query);                  //Put the string in the db
			/*if(!$set_excluded_dates) { //Errors
				die('Could not insert excluded dates: ' . mysql_error() );
			}*/
			echo "Ya done good pal.";  //It worked
			echo "<br />";
		}
		
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
		if($startDate && $endDate){
			$query2 = "UPDATE misc SET value='$startDate' WHERE name='start_date' ";
			$query3 = "UPDATE misc SET value='$endDate' WHERE name='end_date' ";
			$update_Start= $db->runQuery($query2);
			$update_End = $db->runQuery($query3);
		}

		$query4 = "SELECT value FROM misc WHERE name='start_date'";
		$query5 = "SELECT value FROM misc WHERE name='end_date'";
		$select_Start= $db->runQuery($query4);
		$select_End = $db->runQuery($query5);
		
		//while($row = mysql_fetch_array($select_Start, MYSQL_ASSOC)) {
			$betterStartDate = $select_Start[0]['value'];
		//}
		//while($row = mysql_fetch_array($select_End, MYSQL_ASSOC)){
			$betterEndDate = $select_End[0]['value'];
		//}
////////Get your xDates out of the db/////////////////////////////////////////////////////////////////////////////////////////////////////////
		//$sql = "select excluded_dates from AB_Calendar"; //Query for taking out the xDates
		$query6 = "SELECT value FROM misc WHERE name='excluded_dates'";
		$select_x_dates = $db->runQuery($query6);		 //Get the xDates
		//while($row = mysql_fetch_array($select_x_dates, MYSQL_ASSOC)) { //look up fetch_array function
			$excluded_dates_from_db = $select_x_dates[0]['value']; //Store the excluded dates string in the variable $excluded_dates_from_db
		//}
		$excluded_dates_from_db = explode(",", $excluded_dates_from_db); //Turn the string into an array

////////Generating the list of the days///////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		function GetDays($sStartDate, $sEndDate){  
		// Firstly, format the provided dates.  
		// This function works best with YYYY-MM-DD  
		// but other date formats will work thanks  
		// to strtotime().  
		$sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
		$sEndDate = gmdate("Y-m-d", strtotime($sEndDate));  
	
		// Start the variable off with the start date  
		$aDays[] = $sStartDate;  
  
		// Set a 'temp' variable, sCurrentDate, with  
		// the start date - before beginning the loop  
		$sCurrentDate = $sStartDate;  
	
		// While the current date is less than the end date  
		while($sCurrentDate < $sEndDate){  
			// Add a day to the current date  
			$sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
	
			// Add this new day to the aDays array  
			$aDays[] = $sCurrentDate;  
		}  
  
	// Once the loop has finished, return the  
	// array of days.  
	return $aDays;  
	}  
		$abDays = GetDays($betterStartDate,$betterEndDate); //marks all days between yay and yay as "school days"
		$schoolDays = array();

//////////Display Calendar table/////////////////////////////////////////////////////////////////////////////////////////////////////////////
		echo "<form method='get' action='abcal_update.php'>"; //Form tag
		echo "Format: YYYY-mm-dd";
		echo "<br />";
		echo "<label>Start Date: </label>";
		echo "<input name='startDate' value='$betterStartDate' type='text' />";
		echo "<label> End Date: </label>";
		echo "<input name='endDate' value='$betterEndDate' type='text' />";
		echo "<br />";
		echo "<table border='1'>";
		echo "<tr>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>
			</tr>";
		for($i=0;$i<count($abDays);$i++) { //your standard for loops
			$day=strftime("%A",strtotime($abDays[$i])); //gives an actual day instead of a numerical date
			if($day != "Saturday" && $day != "Sunday") { //sets sats and suns to not be pushed
				
				if($day=="Monday" || $i==0) { //Put in the first day of the month thing here too, and first day overall, though these should probably start at the beginning of the month.
					echo "<tr>";
				}
				if($i==0){
					switch($day) {
						case "Friday":
							echo "<td></td>";
						case "Thursday":
							echo "<td></td>";
						case "Wednesday":
							echo "<td></td>";
						case "Tuesday":
							echo "<td></td>";
					}
				}
				echo "<td>";
				echo strftime("%B %e",strtotime($abDays[$i]));
				
				//Make your checkboxes
				if(in_array($abDays[$i],$excluded_dates_from_db)){ //Check if the date is already excluded
					echo '<input name="xDates[]" value="'.$abDays[$i].'" type="checkbox" checked="checked"/>'; //Make the checkbox checked
				} else {
					echo '<input name="xDates[]" value="'.$abDays[$i].'" type="checkbox"/>'; 
					array_push($schoolDays,$abDays[$i]);
				}
				echo "</td>";
				if($day=="Friday") {
					echo "</tr>";
				}
			}
		}	
		echo "</table>";
		echo '<input type="submit" value="Submit"/>';
		echo "</form>";

		
		//Put this in the actual app.
		$ABN = "N";
		$today = date("Y-m-d");
		//$today = "2013-09-03";
		for($i=0;$i<count($schoolDays);$i++) {
			if($today == $schoolDays[$i]) {
				if($i%2 == 0) {
					$ABN = "A";
				} else if($i%2 == 1) {
					$ABN = "B";
				}
			}
		}
		echo $ABN;
		
	/*Stuff to be done:
		-*DONE* Make a start and end for when the calendar should start (for the abDays function)
		-Find a way to separate out the months (use some sort of if system that writes in the extra td's based on the day.)
		-*DONE* Add A/B day 
	*/
	?>
	
</body>

</html>