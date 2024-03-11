<!--  Форма логина  -->
<?php
	ob_start();
?>

<div class="form-container">

   <form action="loginResult" method="post">
      <h3>Авторизация</h3>
      <input type="email" name="email" required placeholder="Введите Ваш e-mail">
      <input type="password" name="password" required placeholder="Введите пароль">
      <input type="submit" name="submit" value="войти" class="form-btn">
      <p>нет аккаунта? <a href="signup">регистрация</a></p>
   </form>

</div>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		