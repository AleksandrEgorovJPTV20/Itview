<?php
class Controller { 
   //стартовая страница
   public static function StartSite() {
		$years = [2021, 2022, 2023];
		include_once('view/homepage.php');
		return;
	}

	public static function tech($year) {
		$years = [2021, 2022, 2023];
		$alltech = Model::getalltechByYear($year);
		include_once('view/techByYear.php');
		return;
	}
	public static function contact() {
		$message = Model::sendmessage();
		include_once('view/homepage.php');
		return;
	}
	
	public static function error() {
		include_once('view/error404.php');
		return;
	}

}//END CLASS
?>















