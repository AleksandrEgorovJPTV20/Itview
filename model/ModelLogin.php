<?php 
class ModelLogin {
	//Login method
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
				if($item != null){
					$login = strtolower($email); //переводим адресс почты в нижний регистр
					//Проверки введёных данных почта и пароль. Проверка данных.
					if ($login == $item['email'] && password_verify($password, $item['password'])) {
						// Check if the user is banned
						date_default_timezone_set('Europe/Tallinn');
						$banexpiry = $item['banexpiry'];
						$currentDate = date('Y-m-d H:i:s');
	
						if ($banexpiry != null) {
							// Check if banexpiry is lower or equals to currentDate
							if ($banexpiry <= $currentDate) {
								// Update banexpiry and set it to null
								$sql2 = "UPDATE users SET banexpiry = null WHERE id =".$item['id'];
								$item2 = $database->executeRun($sql2);
								$banexpiry = null;
							}
	
							// Set loginMessage accordingly
							if ($banexpiry != null) {
								$_SESSION['loginMessage'] = 'User has been banned until: ' . $banexpiry;
								return;
							}
						}
	
						//Создаём сессии
						$_SESSION['sessionId'] = session_id();
						$_SESSION['name'] = $item['username'];
						$_SESSION['email'] = $item['email'];
						$_SESSION['password'] = $item['password'];
						$_SESSION['role'] = $item['role'];
						$_SESSION['userId'] = $item['id'];
						$_SESSION['loginMessage'] = 'Successfully logged in';
						return;
					} else {
						$_SESSION['loginMessage'] = 'Wrong email or password';
					}
				} else {
					$_SESSION['loginMessage'] = "User doesn't exist";
				}
			}
		}
	}
	


	//Logout method
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

	//Register method
	public static function register() {
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

    public static function banCheck() {
        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];

            // Retrieve user ban information from the database
            $db = new Database();
            $sql = "SELECT banexpiry FROM users WHERE id = :userId";
            $stmt = $db->conn->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && !empty($result['banexpiry'])) {
                // User is banned
                return true;
            }
        }

        // User is not banned
        return false;
    }

}
?>