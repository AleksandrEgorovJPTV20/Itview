<?php
$host = explode('?', $_SERVER['REQUEST_URI']);
$path = $host[0];
$num = substr_count($path, '/');
$route = explode('/', $path)[$num];

if (strstr($_SERVER['REQUEST_URI'], '?')) {
    $id = urldecode($host[1]);
}

if ($route == '' || $route == 'index.php') {
    if (isset($_GET['year'])) {
        $year = $_GET['year'];
        Controller::tech($year);
    } elseif (isset($_GET) && !empty($_GET)) {
        Controller::error();
    } else {
        Controller::StartSite();
    }
} elseif ($route == 'contact') {
    Controller::contact();
} elseif ($route == 'forum') {
    if (isset($id) && strpos($id, 'page=') === 0) {
        $page = intval(substr($id, 5));
    } else {
        $page = 1;
    }
    Controller::forum($page);
} elseif ($route == 'comments') {
    if (isset($_GET['topic'])) {
        $topicId = $_GET['topic'];
        Controller::comments($topicId);
    } elseif (isset($_GET['replies'])) {
        $commentId = $_GET['replies'];
        Controller::replies($commentId);
    } else {
        Controller::error();
    }
} elseif ($route == 'logout') {
    ControllerLogin::LogoutAction();
} elseif($route == 'profile'){
    if (isset($_GET['user'])) {
        $userId = $_GET['user'];
        Controller::profile($userId);
    } else {
        Controller::error();
    }
} elseif (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager') && $route == 'dashboard') {
    if(isset($_GET['comments'])){
        ControllerAdmin::dashboardComments();
    } elseif(isset($_GET['replies'])){
        ControllerAdmin::dashboardReplies();
    } elseif(isset($_GET['users'])){
        ControllerAdmin::dashboardUsers();
    } else{
        ControllerAdmin::dashboard();
    }
} elseif (!isset($_SESSION['userId'])) {
    if ($route == 'login') {
        ControllerLogin::LoginAction();
    } elseif ($route == 'register') {
        ControllerLogin::registerResult();
    } else {
        Controller::error();
    }
} else {
    Controller::error();
}

