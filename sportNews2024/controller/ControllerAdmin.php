<?php 
class ControllerAdmin {
	//Изменение пароля
	public static function profileEditPassword(){
		$users = ModelLogin::getUsers();
		$result = ModelAdmin::ChangePassword();
		$allcategories = Model::getCategories();
		include_once('view/profile.php');
	}
	//Изменение имя
	public static function profileEditUsername(){
		$users = ModelLogin::getUsers();
		$result = ModelAdmin::ChangeUsername();
		$allcategories = Model::getCategories();
		include_once('view/profile.php');
	}

	//Изменение почты
	public static function profileEditEmail(){
		$users = ModelLogin::getUsers();
		$result = ModelAdmin::ChangeEmail();
		$allcategories = Model::getCategories();
		include_once('view/profile.php');
	}

	public static function profileEditAvatar(){
		$users = ModelLogin::getUsers();
		$result = ModelAdmin::ChangeAvatar();
		$allcategories = Model::getCategories();
		include_once('view/profile.php');
	}

	//Изменение ролей
	public static function profileChangerole(){
		$users = ModelLogin::getUsers();
		$result = ModelAdmin::Changerole();
		$allgenres = Model::getGenres();
		include_once('view/profile.php');
	}
	//Удаление профиля
	public static function profileDeletion(){
		$allcategories = Model::getCategories();
		$result = ModelAdmin::deleteProfile();
		include_once('view/formLogin.php');
	}
	//добавление новости
	public static function profileAddNews(){
		$users = ModelLogin::getUsers();
		$allcategories = Model::getCategories();
		$result = ModelAdmin::addNews();
		include_once('view/profile.php');
	}
	
	public static function categoriesNewsEditResult($code){
		$allcategories = Model::getCategories();
		$result = ModelAdmin::editNews($code);
		$news = Model::getNewsCode($code);
		header("Location: news?category=".$code);
	}

	
	public static function categoriesNewsDeleteResult($code){
		$result = ModelAdmin::deleteNews($code);
		$allcategories = Model::getCategories();
		header("Location: news?category=".$code);
	}
	
	//Добавление игрока
	public static function profileAddPlayers(){
		$users = ModelLogin::getUsers();
		$allcategories = Model::getCategories();
		$result = ModelAdmin::addPlayer();
		include_once('view/profile.php');
	}
	
	public static function playersEditResult($code){
		$result = ModelAdmin::editPlayer($code);
		header("Location: search?player=".$code);
	}

	public static function playersDeleteResult($code){
		$result = ModelAdmin::deletePlayer($code);
		if ($result[0]) {
			// Если удаление прошло успешно, перенаправляем на страницу поиска
			header("Location: search?player=".$code);
			exit();
		} else {
			// Обработка ошибки удаления, если необходимо
		}
	}
		
}
?>