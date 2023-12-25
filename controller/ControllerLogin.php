<?php 
class ControllerLogin {
	// Profile controller
	public static function FormProfile(){
		$users = ModelLogin::getUsers();
		include_once('view/profileTable.php');
	}
	
	// Login controller
	public static function LoginAction(){
		$result = ModelLogin::userLogin();
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';
		if (!empty($redirectRoute)) {
			header("Location: /$redirectRoute");
		} else {
			header("Location: /");
		}
		exit();
	}


	// Register controller
	public static function registerResult(){
		$result = ModelLogin::register();
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';
		if (!empty($redirectRoute)) {
			header("Location: /$redirectRoute");
		} else {
			header("Location: /");
		}
		exit();
	}

	// Logout controller 
	public static function LogoutAction(){
		$result = ModelLogin::userLogout();
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';
		if (!empty($redirectRoute)) {
			header("Location: /$redirectRoute");
		} else {
			header("Location: /");
		}
		exit();
	}


}
?>