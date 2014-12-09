<?php

class anno {
	public $page_type;

	public $user_id;
	public $subtype_ids;
	
	public $title;
	public $description;
	public $start_date;
	public $end_date;
	public $date;
	public $location;
	public $time;
	
	public $anno_id;
	
	public $anno_cb;

	public function __construct($page_type) { //*Constructor sets the page type.
		$this->page_type = $page_type;
	}
	
	public function create_announcement() { //*Steps to work through for creating an announcement.
		$this->set_info($_REQUEST, true);
		$this->insert_data();
		$this->insert_anno_subtype();
		$this->redirect();
	}
	
	public function edit_announcement() { //*Steps to work through for editing and updating an announcement.
		$this->get_anno_id();
		$this->set_info($_REQUEST, true);
		$this->update_data();
		$this->update_anno_subtype();
		$this->redirect();
	}
	
	public function set_subtype_ids() {
		if(isset($_REQUEST['check']) && !empty($_REQUEST['check'])) { //*Check to see if the checkboxes have been checked
			$this->subtype_ids = $_REQUEST['check']; //*The checkbox data
			return 1;
		} else {                                                      //*If there is no checkbox checked, throw up an error.
			//THIS WON'T WORK
			$_SESSION['error_message'] = "You must check a category.";
			//$error->set_message($message);
			return 0;
		}	
	}
	
	public function set_info($info, $submitted) { //*Used in two places
			$this->user_id = $_SESSION['user_id'];
			if($submitted) { //*If it has been submitted, then set all the announcement stuff up for exporting to the database.
				$this->title = mysql_real_escape_string($info['title']);
				$this->description = mysql_real_escape_string($info['description']);
				$this->start_date = mysql_real_escape_string($info['start_date']);
				$this->end_date = mysql_real_escape_string($info['end_date']);
				$this->date = mysql_real_escape_string($info['date']);
				$this->location = mysql_real_escape_string($info['location']);
				$this->time = mysql_real_escape_string($info['time']); 
			} else {        //*If it's not being submitted (like in the edit page) then just set the stuff normally.
				$this->title = $info['title'];
				$this->description = $info['description'];
				$this->start_date = $info['start_date'];
				$this->end_date = $info['end_date'];
				$this->date = $info['date'];
				$this->location = $info['location'];
				$this->time = $info['time']; 
			}
	}
	
	#region Creating functions
	private function insert_data() { //*Insert the announcement into the announcement table.
		$query = "INSERT INTO announcements(title, description, start_date, end_date, date, location, time, author) VALUES('$this->title', '$this->description', '$this->start_date', '$this->end_date', '$this->date', '$this->location', '$this->time', '$this->user_id');";
		mysql_query($query);
		
		$this->anno_id = mysql_insert_id();
	}

	private function insert_anno_subtype() { //
		foreach($this->subtype_ids as $subtype_id) { //*Insert the anno_subtype relationships into anno_subtype table.
			$query = "INSERT INTO anno_subtype(anno_id, subtype_id) VALUES('$this->anno_id', '$subtype_id');";
			mysql_query($query);
		}
	}
	#end
	
	#region Editing functions
	public function get_anno_id() {
		$this->anno_id  = $_REQUEST['anno_id'];
	}
	
	private function update_data() { //*Update the announcement in the announcement table.
		$query = "UPDATE announcements SET title='$this->title', description='$this->description', start_date='$this->start_date', end_date='$this->end_date', date='$this->date', location='$this->location', time='$this->time' WHERE id='$this->anno_id';";
		mysql_query($query);
	}
	
	private function update_anno_subtype() {
		//*First delete all the existing anno_subtype relationships.
		$query = "DELETE FROM anno_subtype WHERE anno_id='$this->anno_id'";
		mysql_query($query);
		
		//*Then, insert the new anno_subtype relationships.
		foreach($this->subtype_ids as $subtype_id) {
			$query = "INSERT INTO anno_subtype(anno_id, subtype_id) VALUES('$this->anno_id', '$subtype_id');";
			mysql_query($query);
		}
	}
	#end
	
	#region checkboxes
	public function create_cb($subtypes, $title) { //$subtypes is the array of subtypes, $title is the name of the box (General, Classes, etc)
		echo "<div class='cat_div'><label class='cat_label'>".$title."</label><br />";

        if($this->page_type == "create") {    //*If it's a create page, then just generate the empty checkboxes
			foreach($subtypes as $subtype) {
				$id = $subtype['id'];
				$name = $subtype['name'];
				
				if(!empty($name)) {
				
					if(isset($subtype['period']) && $subtype['period'] != "0") { //*This is for classes. If it has a period number, add it to the name.
						$name = $subtype['period'] . ': ' . $name;
					}

                    //*Echo the checkbox.
					echo '<label class="cat_subtype_label">'.$name.':</label>
					<input class="cat_check" name="check[]" type="checkbox" value="'.$id.'" />
					<br />';
				}
			}
		} else if ($this->page_type == "edit") {//*If it's an edit page, then some of the checkboxes will be checked.
			foreach($subtypes as $subtype) {
				$checked = false;
				$id = $subtype['id'];
				$name = $subtype['name'];
				foreach($this->anno_cb as $anno_cbc) {
					if($anno_cbc['subtype_id']==$id && !empty($name)) { //*cbc stands for checkbox checked. If it's checked, then check it.
					
						if(isset($subtype['period']) && $subtype['period'] != "0") {
							$name = $subtype['period'] . ': ' . $name;
						}
						
						echo '<label class="cat_subtype_label">'.$name.':</label>
						<input name="check[]" type="checkbox" value="'.$id.'" checked="checked"/>
						<br />';
						$checked = true;
						break;
					}
				}
				if(!$checked) { //*If it ain't checked, don't check it.
					if(isset($subtype['period']) && $subtype['period'] != "0") {
						$name = $subtype['period'] . ': ' . $name;
					}
				
					echo '<label class="cat_subtype_label">'.$name.':</label>
					<input name="check[]" type="checkbox" value="'.$id.'" />
					<br />';
				}
			}
		}
		echo "</div>";
	}
	
	#end
	
	private function redirect() {
		header("Location: main.php?current=1");
	}
}

?>