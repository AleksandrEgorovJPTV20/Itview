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
    if (isset($_GET['year'])) {
        $id = $_GET['year'];
		Controller::tech($id);
	}else{
		Controller::error();
	}
}
elseif ($route == 'contact'){
	Controller::contact();
}
elseif ($route == 'forum'){
    if (isset($id) && strpos($id, 'page=') === 0) {
        $page = intval(substr($id, 5));
    } else {
        $page = 1;
    }

    Controller::forum($page);
}
elseif ($route == 'comments'){
    if (isset($_GET['topic'])) {
        $topicid = $_GET['topic'];
        Controller::comments($topicid);
    }elseif(isset($_GET['replies'])){
		$commentid = $_GET['replies'];
		Controller::replies($commentid);
	} else {
        Controller::error();
    }
}
elseif ($route == 'logout'){
	ControllerLogin::LogoutAction();
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
else{
	Controller::error();
}




//-----------------------
