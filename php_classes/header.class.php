<?php

class header {

	public function generate_header() {
		
		echo '<div class="buttons">';
		
		$this->home_button();
		$this->log_out_button();
		
		echo '</div>';
		
		$this->settings_button();
		
		$this->manage_users_button();
		$this->new_user_button();
		
		$this->add_announcement_button();
	}
	
	private function add_announcement_button() {
		$html = '
		<a href="create.php">
			<div class="add_announcements_button">Add Announcement</div>
			<img class="add_image" src="images/add.png" /> <!--Icons by DryIcons-->
			</div>
		</a>';
		echo $html;
	}
	
	private function settings_button() {
		$html = '
		<div class="settings_button" >
			<a href="settings.php"><img src="images/settings_gear.png" width="40" height="40"/></a>
		</div>';
		echo $html;
	}
	
	private function log_out_button() {
		$html = '<a class="logout_button" href="logout.php">Log Out</a>';
		echo $html;
	}
	
	private function home_button() {
		$html = '<a class="home_button" href="main.php?current=1">Home</a>';
		echo $html;
		
	}
	
	private function manage_users_button() {
		if($_SESSION['admin']) {
			echo '<div class="new_user_button" >';
			echo '<a href="users.php">Manage Users</a><br />';
			echo '</div>';
		}
	}
	
	private function new_user_button() {
		if($_SESSION['admin']) {
			echo '<div class="new_user_button" >';
			echo '<a href="new_user.php">Create New User</a><br />';
			echo '</div>';
		}
	}
	
	/*Buttons
	Add announcement
	Settings
	Log Out
	Home
	*Admin Only:
	Manage Users
	Create Users
	*/
}

?>