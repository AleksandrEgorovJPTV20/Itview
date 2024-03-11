<!--  Страница после успешного входа в аккаунт -->
<?php 
	ob_start();  
?>
<div class="container">
	<div class="col-sm-12" >
		<!-- раздел информации - данные пользователя, поле пароль - информационно -->
		<div class="row" >
			<div class="col-sm-5">
				<h4>Имя:</h4>
				<h4>Почта:</h4>						
				<h4>Пароль:</h4>
			</div>
			<div class="col-sm-3">
				<h4><?php echo $_SESSION['name']; ?></h4>
				<h4><?php echo $_SESSION['email']; ?></h4>					
				<h4>**********</h4>
			</div>
			<div class="col-sm-2">
				<button class="btn btn-primary btn-black" href="#" style="margin-bottom: 20px;" id="editusername" data-toggle="modal" data-target="#edituser">Поменять имя</button>
				<button class="btn btn-primary btn-black" href="#" style="margin-bottom: 20px;" id="editpost" data-toggle="modal" data-target="#editpostModal">Поменять почту</button>
				<button class="btn btn-primary btn-black" href="#" style="margin-bottom: 20px;" id="editpassword" data-toggle="modal" data-target="#editpass">Поменять пароль</button>
			</div>
			<div>
				<?php 
					if ($_SESSION['role'] != "admin") {
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-left: 10px; margin-top: 20px;" id="deleteUserAcc">Удалить аккаунт</button>';
					}
					if ($_SESSION['role'] == "admin") {
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px;" id="changerole">Изменить роль пользователям</button>';
					}
					if($_SESSION['role'] == "admin" or $_SESSION['role'] == "manager"){
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px; margin-left: 20px;" data-toggle="modal" data-target="#addNewsForm">Добавить новость</button>';
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px; margin-left: 20px;" id="addgenre">Добавить игрока</button>';
					}
				?>
			</div>
		</div>
		<!-- answer change - комментарий к выполнению изменения пароля -->
			<div class="row" id="answer">
				<div class="col-sm-10" style="text-align: center; margin-top: 20px;">
					<p style="color: green; font-size: 24px; font-weight: bold; text-transform: uppercase; text-decoration: underline;">Вы успешно вошли в аккаунт</p>
				</div>
			</div>
	</div>	
	<!--  форма для ввода нового пароля   -->
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

	<div class="row" id="changeRoleUsers" style="display:none;">
		<div class="col-sm-6 col-sm-offset-2" style="margin-top: 20px;">
			<form method="POST" action="profileChangeRole" >
				<div class="modal-header">
					<h3>Изменение ролей пользователей<span class="extra-title muted"></span></h3>
				</div>
				<div class="modal-body form-horizontal">
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
							<option value="manager">Manager</option>';
							<option value="user">User</option>';
						</select>		
					</div>      
				</div>
				<div class="modal-footer">
					<a href="profile" class="btn btn-primary btn-sm" >Закрыть</a>
					<button name="send" type="submit" class="btn btn-primary btn-sm" >Сохранить</button>
				</div>
			</form>	
		</div>				
	</div>

	<div class="row" id="deleteProfile" style="display:none;">
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

	<div class="row" id="addMusicForm" style="display:none;">
		<div class="col-sm-6 col-sm-offset-2" style="margin-top: 20px;">
			<form method="POST" action="profileAddMusic" >
				<div class="modal-header">
					<h3>Добавление музыки<span class="extra-title muted"></span></h3>
				</div>
				<div class="modal-body form-horizontal">
					<div class="control-group">
						<label for="musicName" class="control-label">Введите название музыки</label>				
						<input type="text" class="form-control" name="musicName" required>				
					</div>
					<div class="control-group">
						<label for="performer" class="control-label">Введите исполнителя музыки</label>				
						<input type="text" class="form-control" name="performer" required>				
					</div>
					<div class="control-group">
						<label for="releaseDate" class="control-label">Введите год выхода</label>				
						<input type="text" class="form-control" name="releaseDate" required>				
					</div>
					<div class="control-group">
						<label for="image" class="control-label">Введите ссылку на изображение</label>				
						<input type="text" class="form-control" name="image">				
					</div>
					<div class="control-group">
						<label for="audio" class="control-label">Введите ссылку на аудио файл</label>				
						<input type="text" class="form-control" name="audio">				
					</div>         
					<div class="control-group">	
						<label class="control-label">Выберите жанр</label>	
						<select name="genreSelect" class="form-control">
							<?php 
								foreach ($allgenres as $genre) {
									echo '<option value="'.$genre['id'].'" >'.$genre['name'].'</option>';
								}
							?>
						</select>		
					</div>      
				</div>
				<div class="modal-footer">
					<a href="profile" class="btn btn-primary btn-sm" >Закрыть</a>
					<button name="send" type="submit" class="btn btn-primary btn-sm" >Сохранить</button>
				</div>
			</form>	
		</div>				
	</div>
	<div class="row" id="addGenreForm" style="display:none;">
		<div class="col-sm-6 col-sm-offset-2" style="margin-top: 20px;">
			<form method="POST" action="profileAddGenre" >
				<div class="modal-header">
					<h3>Добавление Жанра<span class="extra-title muted"></span></h3>
				</div>
				<div class="modal-body form-horizontal">
					<div class="control-group">
						<label for="genreName" class="control-label">Введите название жанра</label>				
						<input type="text" class="form-control" name="genreName" required>				
					</div>
					<div class="control-group">		
						<textarea style="margin: 10px 0px;" id="description" name="description" rows="5" cols="80" placeholder="Введите описание"></textarea>		
					</div>
					<div class="control-group">
						<label for="image" class="control-label">Введите ссылку на изображение</label>				
						<input type="text" class="form-control" name="image">				
					</div>           
				</div>
				<div class="modal-footer">
					<a href="profile" class="btn btn-primary btn-sm" >Закрыть</a>
					<button name="send" type="submit" class="btn btn-primary btn-sm" >Сохранить</button>
				</div>
			</form>	
		</div>				
	</div>	

<!--   скрипт показать/скрыть форму-->
<script src="public/js/jquery-3.3.1.js"></script>
<script>
    $('#editpassword').click(function(){
        $('#editpass').show();
        $('#myLink').hide();
        $('#answer').hide();
        $('#edituser').hide();
        $('#editemail').hide();
        $('#changeRoleUsers').hide();
        $('#deleteProfile').hide();
        $('#addMusicForm').hide();
        $('#addGenreForm').hide();
    });

    $('#editusername').click(function(){
        $('#edituser').show();
        $('#myLink').hide();
        $('#answer').hide();
        $('#editpass').hide();
        $('#editemail').hide();
        $('#changeRoleUsers').hide();
        $('#deleteProfile').hide();
        $('#addMusicForm').hide();
        $('#addGenreForm').hide();
    });
    $('#editpost').click(function(){
        $('#editemail').show();
        $('#myLink').hide();
        $('#answer').hide();
        $('#editpass').hide();
        $('#edituser').hide();
        $('#changeRoleUsers').hide();
        $('#deleteProfile').hide();
        $('#addMusicForm').hide();
        $('#addGenreForm').hide();
    });
    $('#changerole').click(function(){
        $('#changeRoleUsers').show();
        $('#myLink').hide();
        $('#answer').hide();
        $('#editpass').hide();
        $('#edituser').hide();
        $('#editemail').hide();
        $('#deleteProfile').hide();
        $('#addMusicForm').hide();
        $('#addGenreForm').hide();
    });
    $('#deleteUserAcc').click(function(){
        $('#deleteProfile').show();
        $('#myLink').hide();
        $('#answer').hide();
        $('#editpass').hide();
        $('#edituser').hide();
        $('#editemail').hide();
        $('#changeRoleUsers').hide();
        $('#addMusicForm').hide();
        $('#addGenreForm').hide();
    });
    $('#addmusic').click(function(){
        $('#addMusicForm').show();
        $('#deleteProfile').hide();
        $('#myLink').hide();
        $('#answer').hide();
        $('#editpass').hide();
        $('#edituser').hide();
        $('#editemail').hide();
        $('#changeRoleUsers').hide();
        $('#addGenreForm').hide();
    });
    $('#addgenre').click(function(){
        $('#addGenreForm').show();
        $('#addMusicForm').hide();
        $('#deleteProfile').hide();
        $('#myLink').hide();
        $('#answer').hide();
        $('#editpass').hide();
        $('#edituser').hide();
        $('#editemail').hide();
        $('#changeRoleUsers').hide();
    });
</script>
 
<?php 
	$content = ob_get_clean(); 
	include "view/templates/layout.php";
?>	
	