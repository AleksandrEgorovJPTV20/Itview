<?php
if(isset($_SESSION['userId'])){
    if(ControllerLogin::checkUserBan()){
        exit();
    }
}

$host = explode('?', $_SERVER['REQUEST_URI']);
$path = $host[0];
$num = substr_count($path, '/');
$route = explode('/', $path)[$num];

if (strstr($_SERVER['REQUEST_URI'], '?')) {
    $id = urldecode($host[1]);
}

//routing pages
if ($route == '' || $route == 'index.php') {
    Controller::StartSite();
} elseif($route == 'language'){
    if (isset($_GET['est'])) {
        Controller::changeLanguage('est');
    } elseif (isset($_GET['eng'])) {
        Controller::changeLanguage('eng');
    } else {
        Controller::error();
    }
} elseif ($route == 'forum') {
    Controller::forum();
} elseif ($route == 'comments') {
    if (isset($_GET['topic'])) {
        $topicId = $_GET['topic'];
        Controller::comments($topicId);
    } else {
        Controller::error();
    }
} elseif ($route == 'replies') {
    if (isset($_GET['comment'])) {
        $commentId = $_GET['comment'];
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
    } elseif(isset($_GET['reports'])){
        ControllerAdmin::dashboardReports();
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

