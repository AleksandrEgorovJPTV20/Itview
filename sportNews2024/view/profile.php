<!--  Страница профиля  -->
<?php 
	ob_start();  
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<div class="container">
	<div style="width: 100%;">
		<!-- раздел информации - данные пользователя, поле пароль - информационно -->
		<h1 style="text-align: center; margin-bottom:25px;">Профиль</h1>
		<img src="<?php echo $_SESSION['imgpath']?>" alt="Описание изображения" style="width: 100px; height: 100px; border-radius: 50%; margin: 0 auto; margin-bottom:15px; display: block;">
		<div class="card-profile" >
			<div class="col-sm-5" style="margin-top: 20px;">
				<h4>Имя:</h4>
				<h4>Почта:</h4>						
				<h4>Пароль:</h4>
			</div>
			<div class="col-sm-3" style="margin-top: 20px;">
				<h4><?php echo $_SESSION['name']; ?></h4>
				<h4><?php echo $_SESSION['email']; ?></h4>					
				<h4>**********</h4>
			</div>
			<div class="col-sm-2" style="margin-top: 20px;">
				<button class="btn btn-primary btn-black" href="#" style="margin-bottom: 20px;" id="editusername" data-toggle="modal" data-target="#edituser">Поменять имя</button>
				<button class="btn btn-primary btn-black" href="#" style="margin-bottom: 20px;" id="editpost" data-toggle="modal" data-target="#editpostModal">Поменять почту</button>
				<button class="btn btn-primary btn-black" href="#" style="margin-bottom: 20px;" id="editpassword" data-toggle="modal" data-target="#editpass">Поменять пароль</button>
			</div>
		</div>
			<div>
				<?php 
					if ($_SESSION['role'] != "admin") {
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px;" data-toggle="modal" data-target="#editAvatarModal">Изменить аватар</button>';
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px; margin-left: 20px;" id="deleteUserAcc" data-toggle="modal" data-target="#deleteProfile">Удалить аккаунт</button>';
					}
					if ($_SESSION['role'] == "admin") {
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px;" data-toggle="modal" data-target="#editAvatarModal">Изменить аватар</button>';
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px; margin-left: 20px;" id="changerole">Изменить роль пользователям</button>';
					}
					if($_SESSION['role'] == "admin" or $_SESSION['role'] == "manager"){
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px; margin-left: 20px;" data-toggle="modal" data-target="#addNewsForm">Добавить новость</button>';
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px; margin-left: 20px;" data-toggle="modal" data-target="#addPlayersForm">Добавить игрока</button>';
					}
				?>
			</div>
		<!-- answer change - комментарий к выполнению изменения пароля -->
			<div class="row" id="answer">
				<?php
				if(isset($result)){
					echo '<div class="col-sm-10" style="text-align: center; margin-top: 20px;">';
						if($result[0]==true){
							echo '<span style="color:green">'.$result[1].'</span>';
						}elseif($result[0]==false){
							echo '<span style="color:red">'.$result[1].'</span>';
						}
					echo '</div>';					
				}
				?>
			</div>
	</div>	

  <div class="modal fade" id="addPlayersForm" tabindex="-1" role="dialog" aria-labelledby="addPlayersFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPlayersFormLabel">Добавление игрока</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Форма для добавления игрока -->
        <form method="POST" action="profileAddPlayers">
          <div class="form-group">
            <label for="playersFirstname" class="control-label">Введите имя</label>
            <input type="text" class="form-control" id="playersFirstname" name="playersFirstname" required>
          </div>
          <div class="form-group">
            <label for="playersLastname" class="control-label">Введите фамилию</label>
            <input type="text" class="form-control" id="playersLastname" name="playersLastname" required>
          </div>
          <div class="form-group">
            <label for="playersAge" class="control-label">Введите возраст</label>
            <input type="text" class="form-control" id="playersAge" name="playersAge" required>
          </div>
          <div class="form-group">
            <label for="playersDescription" class="control-label">Описание игрока</label>
            <input type="text" class="form-control" id="playersDescription" name="playersDescription" required>
          </div>
          <div class="form-group">
            <label for="playersImage" class="control-label">Ссылка на изображение</label>
            <input type="text" class="form-control" id="playersImage" name="playersImage">
          </div>
          <div class="form-group">
            <label for="playersCategory" class="control-label">Выберите категорию</label>
            <select name="categoriesSelect" class="form-control">
				<?php 
					foreach ($allcategories as $categories) {
					echo '<option value="'.$categories['id'].'" >'.$categories['title'].'</option>';
					}
				?>
			</select>
          </div>
          <button  name="send" type="submit" class="btn btn-primary">Добавить игрока</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

	<div class="modal fade" id="editpostModal" tabindex="-1" role="dialog" aria-labelledby="editpostModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editpostModalLabel">Поменять почту</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="profileEditEmail">
          <div class="form-group">
            <label for="confirmEmail" class="control-label">Подтвердите адрес почты</label>
            <input type="email" class="form-control" name="confirmEmail" required>
          </div>
          <div class="form-group">
            <label for="newEmail" class="control-label">Введите новый адрес почты</label>
            <input type="email" class="form-control" name="newEmail" required>
          </div>
          <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="addNewsForm" tabindex="-1" role="dialog" aria-labelledby="addNewsFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewsFormLabel">Добавление новости</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Форма для добавления новости -->
        <form method="POST" action="profileAddNews">
          <div class="form-group">
            <label for="newsTitle" class="control-label">Заголовок новости</label>
            <input type="text" class="form-control" id="newsTitle" name="newsTitle" required>
          </div>
          <div class="form-group">
            <label for="newsDescription" class="control-label">Описание новости</label>
            <input type="text" class="form-control" id="newsDescription" name="newsDescription" required>
          </div>
          <div class="form-group">
            <label for="newsImage" class="control-label">Ссылка на изображение</label>
            <input type="text" class="form-control" id="newsImage" name="newsImage">
          </div>
          <div class="form-group">
            <label for="newsCategory" class="control-label">Выберите категорию</label>
            <select name="categoriesSelect" class="form-control">
				<?php 
					foreach ($allcategories as $categories) {
					echo '<option value="'.$categories['id'].'" >'.$categories['title'].'</option>';
					}
				?>
			</select>
          </div>
          <button  name="send" type="submit" class="btn btn-primary">Добавить новость</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editAvatarModal" tabindex="-1" role="dialog" aria-labelledby="editAvatarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAvatarModalLabel">Изменить аватар</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Форма для загрузки нового аватара -->
        <form method="POST" action="profileEditAvatar" enctype="multipart/form-data">
          <div class="form-group">
            <label for="avatar">Выберите файл</label>
            <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
          </div>
          <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
        </form>
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

	<div class="modal fade" id="editpass" tabindex="-1" role="dialog" aria-labelledby="editpassLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editpassLabel">Поменять пароль</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="profileEditPassword">
          <div class="form-group">
            <label for="newPassword">Новый пароль</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Подтвердите пароль</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
          </div>
          <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="edituserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edituserLabel">Поменять имя</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="profileEditUsername">
          <div class="form-group">
            <label for="confirmUsername">Введите новое имя</label>
            <input type="text" class="form-control" id="confirmUsername" name="confirmUsername" required>
          </div>
          <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>

	
	
	<div class="modal fade" id="changeRoleUsersModal" tabindex="-1" role="dialog" aria-labelledby="changeRoleUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="changeRoleUsersModalLabel">Изменение ролей пользователей<span class="extra-title muted"></span></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form-horizontal">
                <form method="POST" action="profileChangeRole" >
                    <label class="control-label">Выберите пользователя</label>    
                    <select name="user" class="form-control">
                        <?php
                            foreach ($users as $user) {
                                if ($user['role'] == "admin") {
                                    continue;
                                }
                                echo '<option value="'.$user['id'].'" >'.$user['email'].'</option>';
                            }
                        ?>
                    </select>
                    <div class="control-group">    
                        <label class="control-label">Выберите роль</label>    
                        <select name="roleSelect" class="form-control">
                            <option value="manager">Manager</option>
                            <option value="user">User</option>
                        </select>        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#changerole").click(function(){
            $("#changeRoleUsersModal").modal('show');
        });
    });
</script>

 
	<div class="card-profile" id="deleteProfile" style="display:none; width: 70%; margin-top: 20px;">
    <div class="col-sm-6 col-sm-offset-2" style="margin-top: 20px;">
        <form method="POST" action="profileDeletion" >
            <div class="modal-header">
                <h3>Действительно хотите удалить профиль?<span class="extra-title muted"></span></h3>
            </div>
            <div class="modal-footer">
                <a href="profile" class="btn btn-primary btn-sm" >Закрыть</a>
                <button name="send" type="submit" class="btn btn-primary btn-sm" >Да</button>
            </div>
        </form>    
    </div>              
</div>

	
	<div class="card-profile" id="addPlayersForm" style="display:none; width: 70%; margin-top: 20px;">
		<div class="col-sm-6 col-sm-offset-2" style="margin-top: 20px;">
			<form method="POST" action="profileAddPlayers" >
				<div class="modal-header">
					<h3>Добавление игрока<span class="extra-title muted"></span></h3>
				</div>
				<div class="modal-body form-horizontal">
					<div class="control-group">
						<label for="image" class="control-label">Введите ссылку на изображение</label>				
						<input type="text" class="form-control" name="image">				
					</div>
					<div class="control-group">
						<label for="playersFirstname" class="control-label">Введите имя игрока</label>				
						<input type="text" class="form-control" name="playersFirstname" required>				
					</div>
					<div class="control-group">
						<label for="playersLastname" class="control-label">Введите фамилию игрока</label>				
						<input type="text" class="form-control" name="playersLastname" required>				
					</div>
					<div class="control-group">		
						<textarea style="margin: 10px 0px;" id="description" name="description" rows="5" cols="55" placeholder="Введите описание"></textarea>		
					</div>    
					<div class="control-group">
						<label for="playersAge" class="control-label">Введите возраст игрока</label>				
						<input type="text" class="form-control" name="playersAge" required>				
					</div>       
				</div>
				<div class="modal-footer">
					<a href="profile" class="btn btn-primary btn-sm" >Закрыть</a>
					<button name="send" type="submit" class="btn btn-primary btn-sm" >Сохранить</button>
				</div>
			</form>	
		</div>				
	</div>
</div>


<?php 
	$content = ob_get_clean(); 
	include "view/templates/layout.php";
?>	
	