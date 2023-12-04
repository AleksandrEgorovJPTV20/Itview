<?php 
class ModelAdmin {
	//Запрос для добавление лайков
	public static function addLike($code) {
		$sql="UPDATE `music` SET `likes`=likes + 1 WHERE `music`.`id` ='".$code."'";
		$database = new database();
		$item = $database->executeRun($sql);
		if($item==true) $result=true;
	}
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
	//Добавление музыки
	public static function addMusic() {
		$result= array(false, "Не удалось добавить музыку");
		//читаем данные форм в переменные
		if(isset($_POST['send'])){
			$musicName =$_POST['musicName'];
			$performer = $_POST['performer'];
			$releaseDate = $_POST['releaseDate'];
			$image = $_POST['image'];
			$audio = $_POST['audio'];
			$genreSelect = $_POST['genreSelect'];
			$sql = 'SELECT * FROM music WHERE name = "'.$musicName.'"';
			$database = new database();
			$item = $database->getOne($sql);
			if($item == null){
				if($performer!="" && $musicName != "" && $releaseDate != ""){
					$sql="INSERT INTO `music` (`name`, `performer`, `releaseDate`,`image`,`audioLink`,`genreID`)
					VALUES ('$musicName','$performer','$releaseDate','$image','$audio','$genreSelect')";
					$database = new database();
					$item = $database->executeRun($sql);
					if($item==true){
						$result= array(true, "Успешно добавили музыку");
					}
				}else{
					$result= array(false, "Не удалось добавить музыку");
				}
			}else{
				$result= array(false, "Название музыки должна быть уникальной");
			}
		}
		return $result;
	}
	//Изменение музыки
	public static function editMusic($code) {
		$result = array(false, "Не удалось изменить музыку");
		//читаем данные форм в переменные
		if(isset($_POST['send'])){
			$musicName =$_POST['music'];
			$performer = $_POST['performer'];
			$releaseDate = $_POST['releaseDate'];
			$image = $_POST['image'];
			$audio = $_POST['audio'];
			$genreSelect = $_POST['genreSelect'];
			if($performer!="" && $musicName != "" && $releaseDate != ""){
				$sql="UPDATE `music` SET name = '$musicName', performer = '$performer', releaseDate = '$releaseDate', image = '$image', audioLink = '$audio', genreID = '$genreSelect' WHERE music.id = ".$code;
				$database = new database();
				$item = $database->executeRun($sql);
				if($item==true){
					$result= array(true, "Успешно изменили музыку");
				}
			}else{
				$result = array(false, "Не удалось изменить музыку");
			}
		}
		return $result;
	}
	//Удаление музыки
	public static function deleteMusic($code){
		$result=array(false,"Неудалось удалить музыку");
		if(isset($_POST['send'])){
			$sql="DELETE FROM `music` WHERE music.id = ".$code;
			$database = new database();
			$item = $database->executeRun($sql);
			if($item==true){
				$result= array(true, "Музыка удалена");
			}else{
				$result=array(false, "Неудалось удалить музыку");
			} 					
		}
		return $result;
	}
	//Добавление жанров
	public static function addGenre() {
		$result= array(false, "Не удалось добавить жанр");
		//читаем данные форм в переменные
		if(isset($_POST['send'])){
			$genreName =$_POST['genreName'];
			$description = $_POST['description'];
			$image = $_POST['image'];
			$sql = 'SELECT * FROM genre WHERE name = "'.$genreName.'"';
			$database = new database();
			$item = $database->getOne($sql);
			if($item == null){
				if($genreName!="" && $description != ""){
					$sql="INSERT INTO `genre` (`name`, `description`,`image`)
					VALUES ('$genreName','$description','$image')";
					$database = new database();
					$item = $database->executeRun($sql);
					if($item==true){
						$result= array(true, "Успешно добавили жанр");
					}
				}else{
					$result= array(false, "Не удалось добавить Жанр");
				}
			}else{
				$result= array(false, "Жанр должен быть уникальным");
			}
		}
		return $result;
	}
	//Изменение жанров
	public static function editGenre($code) {
		$result = array(false, "Не удалось изменить жанр");
		//читаем данные форм в переменные
		if(isset($_POST['send'])){
			$genreName =$_POST['genreName'];
			$description = $_POST['description'];
			$image = $_POST['image'];
			if($genreName!="" && $description != ""){
				$sql="UPDATE `genre` SET name = '$genreName', description = '$description', image = '$image' WHERE genre.id = ".$code;
				$database = new database();
				$item = $database->executeRun($sql);
				if($item==true){
					$result= array(true, "Успешно изменили жанр");
				}
			}else{
				$result = array(false, "Не удалось изменить жанр");
			}
		}
		return $result;
	}
	//Удаление жанров
	public static function deleteGenre($code){
		$result=array(false,"Неудалось удалить Жанр");
		if(isset($_POST['send'])){
			$sql="DELETE FROM `genre` WHERE genre.id = ".$code;
			$database = new database();
			$item = $database->executeRun($sql);
			if($item==true){
				$result= array(true, "Жанр удален");
			}else{
				$result=array(false, "Неудалось удалить жанр");
			} 					
		}
		return $result;
	}
}
?>