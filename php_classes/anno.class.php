<?php

class anno {

	private $subtype_ids;
	
	private $title;
	private $description;
	private $start_date;
	private $end_date;
	private $date;
	private $location;
	private $time;
	
	private $anno_id;

	public function create_announcement() {
		$this->set_info();
		$this->insert_data();
		$this->insert_anno_subtype();
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
	
	private function set_info() {
		$this->title = mysql_real_escape_string($_REQUEST['title']);
		$this->description = mysql_real_escape_string( $_REQUEST['description'] );
		$this->start_date = mysql_real_escape_string($_REQUEST['start_date']);
		$this->end_date = mysql_real_escape_string($_REQUEST['end_date']);
		$this->date = mysql_real_escape_string($_REQUEST['date']);
		$this->location = mysql_real_escape_string($_REQUEST['location']);
		$this->time = mysql_real_escape_string($_REQUEST['time']);
	}
	
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
	
	private function redirect() {
		header("Location: main.php?current=1");
	}
}

?>