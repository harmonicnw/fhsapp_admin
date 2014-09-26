<?php
	
class gen_anno {

	public static function make_block($gen_anno, $list_type) {
		foreach($gen_anno as $anno) {
			$current_timestamp = time();
			$end_date = $anno["end_date"];
			$end_timestamp = strtotime($end_date);
			$start_date = $anno["start_date"];
			$start_timestamp = strtotime($start_date);
		
			if($end_timestamp > $current_timestamp && $start_timestamp < $current_timestamp) {
				echo "<$list_type class='gen_list_item' >";
				//$title = $anno['title'];
				$description = $anno['description'];
				echo "<span class='gen_anno_description'> $description<span>";
				echo "</$list_type>";
			}
		}
	}
}	
	
?>