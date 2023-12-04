<!--  Форма логина  -->
<?php
	ob_start();
?>

<div style="width: 400px; margin: auto;"class="slide-content">
  <h2 style="text-align: center; margin-bottom: 40px;">Вход</h2>
  <div class="card-wrapper">
    <div class="card">
      <div class="card-content">
        <form class="form-signin" action="loginResult" method="POST">
          <h3 class="form-signin-heading">Введите ваши данные</h3>
          <input type="email" name="email" class="form-control" placeholder="Введите свой email" style="margin-bottom: 20px;">
          <input type="password" name="password" class="form-control" placeholder="Введите свой password">
          <button class="btn btn-primary btn-black" style="display: flex; margin: auto;"  type="submit" name="send">Войти</button>
          <p style="padding-top: 10px; text-align: center;">
             <?php if (isset($_SESSION['error'])) {echo $_SESSION['error']; unset($_SESSION['error']);} ?>
          </p>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		