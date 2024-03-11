<!--  Форма регистрации  -->
<?php
	ob_start();
?>

<div class="form-container">

   <form action="signupResult" method="post">
      <h3>Регистрация</h3>
      <input type="text" name="username" required placeholder="Введите Ваше имя">
      <input type="email" name="email" required placeholder="Введите Ваш e-mail">
      <input type="password" name="password" required placeholder="Введите пароль">
      <input type="password" name="cpassword" required placeholder="Подтверждение пароля">
      <input type="submit" name="submit" value="Завершить" class="form-btn">
      <p>уже есть аккаунт? <a href="login">авторизация</a></p>
   </form>

</div>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		

