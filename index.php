<?php
session_start();
include_once 'inc/database.php';
//-------------------------------------
include_once 'model/Model.php';
include_once 'model/ModelLogin.php';
include_once 'model/ModelAdmin.php';
//-------------------------------------
include_once 'controller/Controller.php';
include_once 'controller/ControllerLogin.php';
include_once 'controller/ControllerAdmin.php';
//-------------------------------------
include 'route/routing.php';
?>