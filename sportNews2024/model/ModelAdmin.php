<?php 
class ModelAdmin {
	//Изменение пароля
	public static function ChangePassword(){
		$result=array(false,"Пароль не изменён");
		if(isset($_POST['send'])){
			$newPassword = $_POST['newPassword'];
			$confirmPassword = $_POST['confirmPassword'];
			//Проверка полей
			if ($newPassword == $confirmPassword && $newPassword!="") {
				$passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
					$sql="UPDATE `users`  SET password = '$passwordHash' WHERE users.id = ".$_SESSION['userId'];
					$database = new database();
					$item = $database->executeRun($sql);
				if($item==true){
					$result= array(true, "Пароль успешно изменён");
				}else{
					$result=array(false, "Пароль не изменён");
				} 					
			}
		}
		return $result;
	}

	//Изменение имени
	public static function ChangeUsername(){
		$result=array(false,"Имя не изменено");
		if(isset($_POST['send'])){
			$confirmUsername = $_POST['confirmUsername'];
			//Проверка полей
			if ($confirmUsername!="") {
					$sql="UPDATE `users` SET username = '$confirmUsername' WHERE users.id = ".$_SESSION['userId'];
					$database = new database();
					$item = $database->executeRun($sql);

					$_SESSION['name']=$confirmUsername;
				if($item==true){
					$result= array(true, "Имя успешно измененo");
				}else{
					$result=array(false, "Имя не изменено");
				} 					
			}
		}
		return $result;
	}

	//Изменение аватарки
	public static function ChangeAvatar(){
    $result = array(false, "Аватарка не изменена");
    if (isset($_POST['send'])) {
        $confirmAvatar = $_FILES['avatar']['name'];
        $confirmAvatarTmp = $_FILES['avatar']['tmp_name'];

        // Проверка полей
        if ($confirmAvatar != "") {
            $uploadDir = 'uploads/avatars/';
            $uploadPath = $uploadDir . basename($confirmAvatar);

            if (move_uploaded_file($confirmAvatarTmp, $uploadPath)) {
                $sql = "UPDATE `users` SET imgpath = '$uploadPath' WHERE users.id = " . $_SESSION['userId'];
                $database = new database();
                $item = $database->executeRun($sql);

                $_SESSION['imgpath'] = $uploadPath;

                if ($item == true) {
                    $result = array(true, "Аватарка успешно изменена");
                } else {
                    $result = array(false, "Аватарка не изменена");
                }
            } else {
                $result = array(false, "Ошибка при загрузке файла");
            }
        }
    }

    return $result;
}

	
	//Изменение почты
	public static function ChangeEmail(){
		$result=array(false,"Почта не изменена");
		if(isset($_POST['send'])){
			$newEmail = filter_input(INPUT_POST, 'newEmail', FILTER_VALIDATE_EMAIL);
			$confirmEmail = $_POST['confirmEmail'];
			$sql = 'SELECT * FROM users WHERE email = "'.$newEmail.'"';
			$database = new database();
			$item = $database->getOne($sql);
			//Проверка полей
			if($item == null){
				if ($newEmail!="" && $confirmEmail == $_SESSION['email']) {
						$sql="UPDATE `users`  SET email = '$newEmail' WHERE users.id = ".$_SESSION['userId'];
						$database = new database();
						$item = $database->executeRun($sql);
						$_SESSION['email']=$newEmail;
					if($item==true){
						$result= array(true, "Почта успешно измененa");
					}else{
						$result=array(false, "Почта не изменена");
					} 					
				}
			}else{
				$result=array(false, "Почта должна быть уникальной");
			}
		}
		return $result;
	}
	//Изменение роли
	public static function Changerole(){
		$result=array(false,"Неудалось поменять роль");
		if(isset($_POST['send'])){
			$user = $_POST['user'];
			$roleSelect = $_POST['roleSelect'];
			if ($user!="" && $roleSelect!="") {
				$sql="UPDATE `users` SET role = '$roleSelect' WHERE users.id = ".$user;
				$database = new database();
				$item = $database->executeRun($sql);
				if($item==true){
					$result= array(true, "Успешно поменяли роль пользователю");
				}else{
					$result=array(false, "Неудалось поменять роль");
				} 					
			}
		}
		return $result;
	}

	//Удаление профиля
	public static function deleteProfile(){
		$result=array(false,"Неудалось удалить профиль");
		if(isset($_POST['send'])){
			$sql="DELETE FROM `users` WHERE users.id = ".$_SESSION['userId'];
			$database = new database();
			$item = $database->executeRun($sql);

			unset($_SESSION['sessionId']);
			unset($_SESSION['name']);
			unset($_SESSION['role']);
			unset($_SESSION['error']);
			unset($_SESSION['email']);
			unset($_SESSION['userId']);
			session_destroy();
			if($item==true){
				$result= array(true, "Профиль удалён");
			}else{
				$result=array(false, "Неудалось удалить профиль");
			} 					
		}
		return $result;
	}
	//Добавление новости
	public static function addNews() {
		$result= array(false, "Не удалось добавить новость");
		//читаем данные форм в переменные
		if(isset($_POST['send'])){
			$newsTitle =$_POST['newsTitle'];
			$description = $_POST['newsDescription'];
			$image = $_POST['newsImage'];
			$categoriesSelect = $_POST['categoriesSelect'];
			$sql = 'SELECT * FROM news WHERE title = "'.$newsTitle.'"';
			$database = new database();
			$item = $database->getOne($sql);
			if($item == null){
				if($description!="" && $newsTitle != ""){
					$sql="INSERT INTO `news` (`title`, `description`, `image`,`categoryID`)
					VALUES ('$newsTitle','$description','$image','$categoriesSelect')";
					$database = new database();
					$item = $database->executeRun($sql);
					if($item==true){
						$result= array(true, "Успешно добавили новость");
					}
				}else{
					$result= array(false, "Не удалось добавить новость");
				}
			}else{
				$result= array(false, "Название новости должна быть уникальной");
			}
		}
		return $result;
	}
	//Изменение новости
	public static function editNews($code) {
		$result = array(false, "Не удалось изменить новость");
		//читаем данные форм в переменные
		if(isset($_POST['send'])){
			$newsId = $_POST['newsId'];
			$newsTitle = $_POST['title'];
			$description = $_POST['description'];
			$image = $_POST['image'];
			$categoriesSelect = $_POST['categoriesSelect'];
			if($description!="" && $newsTitle != ""){
				$sql="UPDATE `news` SET title = '$newsTitle', description = '$description', image = '$image', categoryID = '$categoriesSelect' WHERE news.id = ".$newsId; 
				$database = new database();
				$item = $database->executeRun($sql);
				if($item==true){
					$result= array(true, "Успешно изменили новость");
				}
			}else{
				$result = array(false, "Не удалось изменить новость");
			}
		}
		return $result;
	}
	//Удаление новости
	public static function deleteNews($code){
		$result=array(false,"Неудалось удалить новость");
		if(isset($_POST['send'])){
			$newsId = $_POST['newsId'];
			$sql="DELETE FROM `news` WHERE news.id = ".$newsId;
			$database = new database();
			$item = $database->executeRun($sql);
			if($item==true){
				$result= array(true, "Новость удалена");
			}else{
				$result=array(false, "Неудалось удалить новость");
			} 					
		}
		return $result;
	}
	//Добавление игрока
	public static function addPlayer() {
		$result= array(false, "Не удалось добавить игрока");
		//читаем данные форм в переменные
		if(isset($_POST['send'])){
			$playersFirstname = $_POST['playersFirstname'];
			$playersLastname = $_POST['playersLastname'];
			$description = $_POST['playersDescription'];
			$image = $_POST['playersImage'];
			$age = $_POST['playersAge'];
			$categoriesSelect = $_POST['categoriesSelect'];
			$sql = 'SELECT * FROM players WHERE firstname = "'.$playersFirstname.'"';
			$database = new database();
			$item = $database->getOne($sql);
			if($item == null){
				if($description!="" && $playersFirstname != ""){
					$sql="INSERT INTO `players` (`firstname`, `lastname`, `description`, `image`, `age`,`categoryId`)
					VALUES ('$playersFirstname','$playersLastname','$description','$image','$age','$categoriesSelect')";
					$database = new database();
					$item = $database->executeRun($sql);
					if($item==true){
						$result= array(true, "Успешно добавили игрока");
					}
				}else{
					$result= array(false, "Не удалось добавить игрока");
				}
			}else{
				$result= array(false, "Название игрока должно быть уникальным");
			}
		}
		return $result;
	}
	//Изменение игрока
	public static function editPlayer($code) {
		$result = array(false, "Не удалось изменить игрока");
		//читаем данные форм в переменные
		if(isset($_POST['send'])){
			$playersId = $_POST['playersId'];
			$playersFirstname = $_POST['playersFirstname'];
			$playersLastname = $_POST['playersLastname'];
			$playersDescription = $_POST['playersDescription'];
			$playersImage = $_POST['playersImage'];
			$playersAge = $_POST['playersAge'];
			$categoriesSelect = $_POST['categoriesSelect'];
			if($playersFirstname!="" && $playersLastname != ""){
				$sql="UPDATE `players` SET firstname = '$playersFirstname', lastname = '$playersLastname', description = '$playersDescription', image = '$playersImage', age = '$playersAge', categoryId = '$categoriesSelect' WHERE id = ".$playersId;
				$database = new database();
				$item = $database->executeRun($sql);
				if($item==true){
					$result= array(true, "Успешно изменили игрока");
				}
			}else{
				$result = array(false, "Не удалось изменить игрока");
			}
		}
		return $result;
	}


	//Удаление игрока
	public static function deletePlayer($code){
		$result=array(false,"Неудалось удалить игрока");
		if(isset($_POST['send'])){
			$playersId = $_POST['playersId'];
			$sql="DELETE FROM `players` WHERE players.id = ".$playersId;
			$database = new database();
			$item = $database->executeRun($sql);
			if($item==true){
				$result= array(true, "Игрок удален");
			}else{
				$result=array(false, "Неудалось удалить игрока");
			} 					
		}
		return $result;
	}
}
?>