<?php 
class ControllerLogin {
	// Profile
	public static function FormProfile(){
		$users = ModelLogin::getUsers();
		include_once('view/profileTable.php');
	}
	
	// Login method
	public static function LoginAction(){
		$years = [2021, 2022, 2023];
		$result = ModelLogin::userLogin();
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';
		if (!empty($redirectRoute)) {
			if($redirectRoute == 'tech'){
				header("Location: /");
			}else{
				header("Location: /$redirectRoute");
			}
		} else {
			header("Location: /");
		}
		exit();
	}


	// Register method
	public static function registerResult(){
		$years = [2021, 2022, 2023];
		$result = ModelLogin::register();
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';
		if (!empty($redirectRoute)) {
			if($redirectRoute == 'tech'){
				header("Location: /");
			}else{
				header("Location: /$redirectRoute");
			}
		} else {
			header("Location: /");
		}
		exit();
	}

	// Exit
	public static function LogoutAction(){
		$years = [2021, 2022, 2023];
		$result = ModelLogin::userLogout();
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';
		if (!empty($redirectRoute)) {
			if($redirectRoute == 'tech'){
				header("Location: /");
			}else{
				header("Location: /$redirectRoute");
			}
		} else {
			header("Location: /");
		}
		exit();
	}


}
?>