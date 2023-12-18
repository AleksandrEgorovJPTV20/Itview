<?php
class Controller { 
   //homepage
   public static function StartSite() {
		$years = [2021, 2022, 2023];
		include_once('view/homepage.php');
		return;
	}
	//tech by year
	public static function tech($year) {
		$years = [2021, 2022, 2023];
		$alltech = Model::getAlltechByYear($year);
		include_once('view/techByYear.php');
		return;
	}
	//contacts
	public static function contact() {
		include_once('view/homepage.php');
		return;
	}
	//forum page
	public static function forum($page = 1) {
		$itemsPerPage = 3; // Set the number of items per page
		$alltopics = Model::getAllTopics($page, $itemsPerPage);
		$totalItems = Model::getTotalTopics(); // Assuming you have a function to get the total number of topics#
		$totalPages = ceil($totalItems / $itemsPerPage);
		include_once('view/forum.php');
		return;
	
	}
	//error
	public static function error() {
		include_once('view/error404.php');
		return;
	}

}//END CLASS
?>















