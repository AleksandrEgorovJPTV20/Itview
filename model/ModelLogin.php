<?php 
class ModelLogin {
	//Просмотр пользователей
	public static function getUsers() {
		$sql = "SELECT * FROM `users`";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}
	
	//Авторизация
	public static function userLogin(){
		if(isset($_POST['send'])){
			//данные введёные в форме
			if(isset($_POST['email']) && isset($_POST['password']) && $_POST['email']!="" && $_POST['password']!=""){
				$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
				$password = $_POST['password'];
				$sql = 'SELECT * FROM users WHERE email = "'.$email.'"';
				$database = new database();
				$item = $database->getOne($sql);
				//Если пользователь есть в базе данных в таблице пользователей.
				if($item!=null){
					$login = strtolower($email); //переводим адресс почты в нижний регистр
					//Проверки введёных данных почта и пароль. Проверка данных.
					if ($login == $item['email'] && $password == password_verify($password, $item['password'])) {
						//Создаём сессии
						$_SESSION['sessionId']=session_id();
						$_SESSION['name']=$item['username'];
						$_SESSION['email']=$item['email'];
						$_SESSION['password']=$item['password'];
						$_SESSION['role']=$item['role'];
						$_SESSION['userId']=$item['id'];
						$result=true;
						$_SESSION['loginMessage']='Successfully logged in';
					}						
					else{
						$_SESSION['loginMessage']='Wrong email or password';
					}
				}else{
					$_SESSION['loginMessage']="User doesn't exist";
				}
			}
		}
	}


	//Выход. Удаление переменных сессии и разрушаем сессию.
	public static function userLogout(){
		unset($_SESSION['sessionId']);
		unset($_SESSION['name']);
		unset($_SESSION['role']);
		unset($_SESSION['error']);
		unset($_SESSION['email']);
		unset($_SESSION['userId']);
		session_destroy();
		return;
	}

	//Регистрация
	public static function register() {
		//читаем данные форм в переменные
		if(isset($_POST['send'])){
			$username =$_POST['username'];
			$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
			$password = $_POST['password'];
			$sql = 'SELECT * FROM users WHERE email = "'.$email.'"';
			$database = new database();
			$item = $database->getOne($sql);
			if($item == null){
				if($password!="" && $email != ""){
					$email = strtolower($email); //переводим адресс почты в нижний регистр
					$passwordHash = password_hash($password, PASSWORD_DEFAULT);
					$sql2="INSERT INTO `users` (`Email`, `Password`, `Username`)
					VALUES ('$email','$passwordHash','$username')";
					$item2 = $database->executeRun($sql2);
					if($item2==true){
						$result=true;
						$_SESSION['registerMessage']='Account successfully created';
					}
				}else{
					$_SESSION['registerMessage']='Wrong email';
				}
			}else{
				$_SESSION['registerMessage']='User already exists';
			}
		}
	}

}
?>