<?php
/*URI унифицированный идентификатор ресурса, 
	который был предоставлен для доступа к странице
знак ? отделяет полный путь и значение 
	переменной идентификатора для фильтрации
*/
$host = explode('?', $_SERVER['REQUEST_URI']);
//полный путь к проекту до знака ?
$path=$host[0];
	//количество папок вложений - считаем символы "/"
	$num = substr_count($path, '/');
	//вычисляем маршрут после последнего символа "/"
	$route = explode('/', $path)[$num];
//значение переменной - идентификатора фильтрации - после знака ?
if(strstr($_SERVER['REQUEST_URI'],'?')){//если найден символ '?'
	$id=urldecode($host[1]);//прочитаем значение из адресной строки и уберем пробелы
}
//-----------------------
if ($route == '' OR $route == 'index.php'){
	//Главная страницы
	Controller::StartSite();
}

//Каталог категорий
elseif ($route == 'sportCatalogue'){
	Controller::sportCatalogue();
}

//Турниры
elseif ($route == 'tournaments'){
	Controller::tournaments();
}

//Новости по категориям
elseif ($route == 'news'){
	if (isset($_GET['category'])) {
		$categoryId = $_GET['category'];
		Controller::newsByCategories($categoryId);
	}else{
		Controller::error404();
	}
}
//Вход, выход, Регистрация
elseif ($route == 'signup'){
	ControllerLogin::FormSignUp();
}
elseif ($route == 'signupResult'){
	ControllerLogin::signUpResult();
}
elseif ($route == 'login'){
	ControllerLogin::FormLogin();
}

elseif ($route == 'loginResult'){
	ControllerLogin::LoginAction();
}

elseif ($route == 'logout'){
	ControllerLogin::LogoutAction();
}
//Поиск
elseif ($route == 'search'){
	if (isset($_GET['player'])) {
		Controller::SearchPlayer($_GET['player']);
	}else{
		Controller::error404();
	}
}
//Профиль и изменение, удаление, добавление данных
elseif(isset($_SESSION['role'])) {
	if ($route == 'profile') {
		ControllerLogin::FormProfile();
	}
	elseif ($route == 'profileEditPassword') {
		ControllerAdmin::profileEditPassword();
	}
	elseif ($route == 'profileEditUsername') {
		ControllerAdmin::profileEditUsername();
	}
	elseif ($route == 'profileEditEmail') {
		ControllerAdmin::profileEditEmail();
	}
	elseif ($route == 'profileEditAvatar') {
		ControllerAdmin::profileEditAvatar();
	}
	elseif ($route == 'editnewsbycategoriesresult'){
		if (isset($id)) {
			ControllerAdmin::categoriesNewsEditResult($id);
		}else{
			Controller::error404();
		}
	}
	
	elseif ($route == 'deletenewsbycategoriesresult'){
		if (isset($id)) {
			ControllerAdmin::categoriesNewsDeleteResult($id);
		}else{
			Controller::error404();
		}
	}
	elseif ($route == 'profileChangeRole') {
		ControllerAdmin::profileChangerole();
	}
	elseif ($route == 'profileDeletion') {
		ControllerAdmin::profileDeletion();
	}
	elseif ($route == 'profileAddNews') {
		ControllerAdmin::profileAddNews();
	}
	elseif ($route == 'profileAddPlayers') {
		ControllerAdmin::profileAddPlayers();
	}
	
	elseif ($route == 'editplayersresult'){
		if (isset($id)) {
			ControllerAdmin::playersEditResult($id);
		}else{
			Controller::error404();
		}
	}
	elseif ($route == 'deleteplayersbycategoriesresult'){ 
		if (isset($id)) {
			ControllerAdmin::playersDeleteResult($id);
		}else{
			Controller::error404();
		}
	}
	else{ //Если страница не существует
		Controller::error404();
	}
}
else{ //Если страница не существует
		Controller::error404();
}




//-----------------------
