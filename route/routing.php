<?php
$host = explode('?', $_SERVER['REQUEST_URI']);
$path = $host[0];
$num = substr_count($path, '/');
$route = explode('/', $path)[$num];

if (strstr($_SERVER['REQUEST_URI'], '?')) {
    $id = urldecode($host[1]);
}

if ($route == '' || $route == 'index.php') {
    Controller::StartSite();
} elseif ($route == 'tech') {
    if (isset($_GET['year'])) {
        $id = $_GET['year'];
        Controller::tech($id);
    } else {
        Controller::error();
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
        $topicid = $_GET['topic'];
        Controller::comments($topicid);
    } elseif (isset($_GET['replies'])) {
        $commentid = $_GET['replies'];
        Controller::replies($commentid);
    } else {
        Controller::error();
    }
} elseif ($route == 'logout') {
    ControllerLogin::LogoutAction();
} elseif (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager') && $route == 'dashboard') {
    if(isset($_GET['comments'])){
        ControllerAdmin::dashboardComments();
    } elseif(isset($_GET['replies'])){
        ControllerAdmin::dashboardReplies();
    }else{
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

