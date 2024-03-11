<?php 
class ControllerLogin {
	//Логин
	public static function FormLogin(){
		$allcategories = Model::getCategories();
		include_once('view/formLogin.php');
	}
	//Регистрация
	public static function FormSignUp(){
		$allcategories = Model::getCategories();
		include_once('view/formSignUp.php');
	}
	//Профиль
	public static function FormProfile(){
		$allcategories = Model::getCategories();
		$users = ModelLogin::getUsers();
		include_once('view/profile.php');
	}
	
	//Результат входа
	public static function LoginAction(){
		$result = ModelLogin::userLogin();
		$users = ModelLogin::getUsers();
		$allcategories = Model::getCategories();
		if ($result == true) {
			include_once('view/loginResult.php');
		}
		else{
			include_once('view/formLogin.php');
		}
	}


	//Результат регистрации
	public static function signUpResult(){
		$allcategories = Model::getCategories();
		$result = ModelLogin::SignUp();
		include_once('view/formSignUp.php');
	}

	//выход
	public static function LogoutAction(){
		$allcategories = Model::getCategories();
		$result = ModelLogin::userLogout();
		include_once('view/formLogin.php');
	}


}
?>