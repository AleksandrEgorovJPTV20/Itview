<!--  Форма регистрации  -->
<?php
	ob_start();
?>
<div class="slide-content" style="width: 400px; margin: auto;">
  <h2 style="text-align: center; margin-bottom: 40px;">Регистрация</h2>
  <div class="card-wrapper">
    <div class="card">
      <div class="card-content">
        <form class="form-signin"  action="signupResult" method="POST">
            <h3 class="form-signin-heading" style="text-align: center;">Введите данные</h3>
            <input type="text" name="username"  class="form-control" placeholder="Введите своё имя">
            <input type="email" name="email" class="form-control" placeholder="Введите свою почту">
            <input type="password" name="password" class="form-control" placeholder="Введите свой пароль">

            <button class="btn btn-primary btn-black" style="display: flex; margin: auto;" type="submit" name="send">Зарегестрироваться</button>
	          <p style="padding-top: 10px; text-align: center;">
	             <?php if (isset($_SESSION['error'])) {echo $_SESSION['error']; unset($_SESSION['error']);} ?>
	            <?php if (isset($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);} ?>
	          </p>
        </form>
      </div>
    </div>
  </div>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		