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
		$itemsPerPage = 10; // Set the number of items per page
		$searchTerm = isset($_GET['search']) ? $_GET['search'] : null;

		if ($searchTerm) {
			$topics = Model::searchTopics($searchTerm, $page, $itemsPerPage);
			$totalItems = 0;
		} else {
			// If no search term, use getAllTopics method
			$topics = Model::getAllTopics($page, $itemsPerPage);
			$totalItems = Model::getTotalTopics();
		}

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















