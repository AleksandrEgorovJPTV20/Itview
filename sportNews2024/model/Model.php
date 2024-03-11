<?php 
class Model {
	//Запрос всех категорий
	public static function getCategories() {
		$sql = "SELECT * FROM `categories`";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}
	//Запрос новостей по ид
	public static function getNewsCode($code) {
		$sql = "SELECT * FROM `news` WHERE `id`='".$code."'";
		$db = new database();
		$item = $db->getOne($sql);
		return $item;
	}
	//Запрос для новостей по категориям
	public static function getNewsByCategories($categoryId) {
		$sql = "SELECT news.* FROM `news`, categories WHERE news.categoryID=categories.id AND news.categoryID ='".$categoryId."'";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}
	//Запрос категорий по ид
	public static function getCategoriesCode($categoryId) {
		$sql = "SELECT * FROM categories WHERE categories.id ='".$categoryId."'";
		$db = new database();
		$item = $db->getOne($sql);
		return $item;
	}
	
	//Поиск игрока
	public static function playerSearch($searchQuery) {
		$db = new Database();
		$sql = "SELECT * FROM `players` WHERE firstname LIKE :searchQuery OR lastname LIKE :searchQuery";
	
		$stmt = $db->conn->prepare($sql);
		$stmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	

}
?>