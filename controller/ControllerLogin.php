<?php 
class ControllerLogin {
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
	// Check user ban controller
	public static function checkUserBan(){
		if (ModelLogin::banCheck()) {
			// User is banned, perform logout
			ModelLogin::userLogout();
			include_once('view/banMessage.php');
			return true;
			exit();
		}
		return false;
		
	}

}
?>