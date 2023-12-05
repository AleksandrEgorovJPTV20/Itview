<?php 
class ControllerLogin {
	//Профиль
	public static function FormProfile(){
		$users = ModelLogin::getUsers();
		include_once('view/profileTable.php');
	}
	
	//Результат входа
	public static function LoginAction(){
		$years = [2021, 2022, 2023];
		$result = ModelLogin::userLogin();
		$users = ModelLogin::getUsers();
		if ($result == true) {
			include_once('view/homepage.php');
		}
		else{
			include_once('view/formLogin.php');
		}
	}


	//Результат регистрации
	public static function registerResult(){
		$years = [2021, 2022, 2023];
		$result = ModelLogin::register();
		if ($result == true) {
			include_once('view/formSignUp.php');
		}
		else{
			include_once('view/formSignUp.php');
		}
	}

	//выход
	public static function LogoutAction(){
		$years = [2021, 2022, 2023];
		$result = ModelLogin::userLogout();
		include_once('view/homepage.php');
	}


}
?>