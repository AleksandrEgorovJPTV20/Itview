<?php 
class Model {
    // Load tech data for the given year
    public static function getalltechByYear($year) {
		$sql = "SELECT * FROM `tech` WHERE `year`='".$year."' LIMIT 3";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}
}
?>