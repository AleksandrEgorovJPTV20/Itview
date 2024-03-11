<?php
class Controller { 
   //стартовая страница
	public static function StartSite(){
		$allcategories = Model::getCategories();
		include_once('view/homepage.php');
		return;
	}
	
	//Каталог новостей
	public static function sportCatalogue(){
		$allcategories = Model::getCategories();
		include_once('view/sportCatalogue.php');
	}

	//Турниры
	public static function tournaments(){
		$allcategories = Model::getCategories();
		include_once('view/tournaments.php');
	}
	//Новости по категориям
	public static function newsByCategories($categoryId){
		$allcategories = Model::getCategories();
		$newsByCategories = Model::getNewsByCategories($categoryId);
		$category = Model::getCategoriesCode($categoryId);	
		include_once('view/newsByCategories.php');
	}
	
	//Поиск игрока по названию
	public static function SearchPlayer($searchQuery){
		$allcategories = Model::getCategories();
		$players = Model::playerSearch($searchQuery);
		include_once('view/searchPlayer.php');
		return;
	}	

	//Страница с ошибкой
	public static function error404(){
		$allcategories = Model::getCategories();
		include_once('view/error404.php');
		return;
	}
}//END CLASS
?>















