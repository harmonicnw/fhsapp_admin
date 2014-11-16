<?php

class anno {

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

	public function create_announcement() {
		$this->set_info($_REQUEST, true);
		$this->insert_data();
		$this->insert_anno_subtype();
		$this->redirect();
	}
	
	public function edit_announcement() {
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
			$message = "You must check a category.";
			$error->set_message($message);
			return 0;
		}	
	}
	
	public function set_info($info, $submitted) {
			if($submitted) {
				/*foreach($info as $i) { //?I don't know if this works, so manual escaping for now
					$i = mysql_real_escape_string($i);
				}*/
				$this->title = mysql_real_escape_string($info['title']);
				$this->description = mysql_real_escape_string($info['description']);
				$this->start_date = mysql_real_escape_string($info['start_date']);
				$this->end_date = mysql_real_escape_string($info['end_date']);
				$this->date = mysql_real_escape_string($info['date']);
				$this->location = mysql_real_escape_string($info['location']);
				$this->time = mysql_real_escape_string($info['time']); 
			} else {
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
	private function insert_data() {
		//?This might need to be more like '".$this->title."' etc.
		$query = "INSERT INTO announcements(title, description, start_date, end_date, date, location, time, author) VALUES('$this->title', '$this->description', '$this->start_date', '$this->end_date', '$this->date', '$this->location', '$this->time', '$this->user_id');";
		mysql_query($query);
		
		$this->anno_id = mysql_insert_id();
	}
	
	private function insert_anno_subtype() {
		foreach($this->subtype_ids as $subtype_id) {
			$query = "INSERT INTO anno_subtype(anno_id, subtype_id) VALUES('$this->anno_id', '$subtype_id');";
			mysql_query($query);
		}
	}
	#end
	
	#region Editing functions
	public function get_anno_id() {
		$this->anno_id  = $_REQUEST['anno_id'];
	}
	
	private function update_data() {
		$query = "UPDATE announcements SET title='$this->title', description='$this->description', start_date='$this->start_date', end_date='$this->end_date', date='$this->date', location='$this->location', time='$this->time' WHERE id='$this->anno_id';";
		mysql_query($query);
	}
	
	private function update_anno_subtype() {
		//*First delete all the existing ones
		$query = "DELETE FROM anno_subtype WHERE anno_id='$anno_id'";
		mysql_query($query);
		
		//*Then, insert the new ones.
		foreach($subtype_ids as $subtype_id) {
			$query = "INSERT INTO anno_subtype(anno_id, subtype_id) VALUES('$anno_id', '$subtype_id');";
			mysql_query($query);
		}
	}
	#end
	
	private function redirect() {
		header("Location: main.php?current=1");
	}
}

?>