<?php 
class ControllerLogin {
	//Логин
	public static function FormLogin(){
		$allgenres = Model::getGenres();
		include_once('view/formLogin.php');
	}
	//Регистрация
	public static function FormSignUp(){
		$allgenres = Model::getGenres();
		include_once('view/formSignUp.php');
	}
	//Профиль
	public static function FormProfile(){
		$users = ModelLogin::getUsers();
		include_once('view/profileTable.php');
	}
	
	//Результат входа
	public static function LoginAction(){
		$result = ModelLogin::userLogin();
		$users = ModelLogin::getUsers();
		$allgenres = Model::getGenres();
		if ($result == true) {
			include_once('view/loginResult.php');
		}
		else{
			include_once('view/formLogin.php');
		}
	}


	//Результат регистрации
	public static function signUpResult(){
		$allgenres = Model::getGenres();
		$result = ModelLogin::SignUp();
		include_once('view/formSignUp.php');
	}

	//выход
	public static function LogoutAction(){
		$result = ModelLogin::userLogout();
		$allgenres = Model::getGenres();
		include_once('view/formLogin.php');
	}


}
?>