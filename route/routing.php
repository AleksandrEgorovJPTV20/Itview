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
    Controller::StartSite();
}
elseif ($route == 'tech'){
	if (isset($id)) {
		Controller::tech($id);
	}else{
		Controller::error();
	}
}
elseif(!isset($_SESSION['userId'])){
	if ($route == 'login'){
		ControllerLogin::LoginAction();
	}
	elseif ($route == 'register'){
		ControllerLogin::registerResult();
	}
	else{
		Controller::error();
	}
}
elseif ($route == 'logout'){
	ControllerLogin::LogoutAction();
}
elseif ($route == 'contact'){
	Controller::contact();
}
else{
	Controller::error();
}




//-----------------------
