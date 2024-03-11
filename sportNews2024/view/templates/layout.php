<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>SportNews</title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
    <link href="public/css/carousel.css" rel="stylesheet">
    <link href="public/css/form.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="public/css/swiper-bundle.min.css">
    <link href="public/css/style.css" rel="stylesheet">
    <link href="public/css/index.css" rel="stylesheet">
    <link href="public/css/animations.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik+Mono+One&display=swap">
    <link rel="icon" type="images/png" href="images/sport_icon.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background:#121212">
    <div class="container-fluid">
  
      <a href="/" style="margin: 0px 30px"> <img style="width:150px; height:80px" src="images/logo.png" alt="SportNews"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
          </li>
          <li class="nav-item">
          <a style="font-family: Montserrat;color:white; font-size: 24px;font-style: normal;font-weight: 500;line-height: normal;margin: 0px 20px" class="nav-link" href="sportCatalogue">Категории</a>
          </li>
            <li class="nav-item dropdown">
            <a style="font-family: Montserrat;color:white; font-size: 24px;font-style: normal;font-weight: 500;line-height: normal; margin: 0px 20px" class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Новости</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown01">
            <?php 
                foreach ($allcategories as $categories) {
                  echo '<li><a class="dropdown-item" href="news?category='.$categories['id'].'">'.$categories['title'].'</a></li>';
                }
              ?>
            </ul>
          </li>
          <li class="nav-item">
          <a style="font-family: Montserrat;color:white; font-size: 24px;font-style: normal;font-weight: 500;line-height: normal;margin: 0px 20px" class="nav-link" href="tournaments">Турниры</a>
          </li>
          <li class="nav-item">
          <a style="font-family: Montserrat;color:white; font-size: 24px;font-style: normal;font-weight: 500;line-height: normal;margin: 0px 20px" class="nav-link" href="timetable">Расписание</a>
          </li>
          <li class="nav-item">
          <a style="font-family: Montserrat;color:white; font-size: 24px;font-style: normal;font-weight: 500;line-height: normal;margin: 0px 20px" class="nav-link" href="contacts">Контакты</a>
          </li>
        </ul>
        <ul class="navbar-nav">
		<?php
			if(!isset($_SESSION['userId'])){
				echo '<li style="border-radius: 10px; background: #2588FC; margin: 10px 0px 10px 10px;"><a style="font-family: Montserrat;color:white;font-size: 20px;" class="nav-link" href="login">Войти</a></li>';
				echo '<li style="border-radius: 10px; border: 1px solid #F5F5F5;background: #121212; margin: 10px 0px 10px 10px;"><a style="font-family: Montserrat;color:white; font-size: 20px;font-style: normal;font-weight: 500;line-height: normal;" class="nav-link" href="signup">Регистрация</a></li>';
			}else{
				echo '<li><a style="font-family: Montserrat;color:white; font-size: 24px;font-style: normal;font-weight: 500;line-height: normal;margin: 0px 20px" class="nav-link"href="logout">Выйти</a></li>';
				echo '<li><a style="font-family: Montserrat;color:white; font-size: 24px;font-style: normal;font-weight: 500;line-height: normal;margin: 0px 20px" class="nav-link" href="profile">Профиль</a></li>';
			}
		?>
        </ul>
        <form class="d-flex" method="GET" action="search" style="margin: 0px 30px">
          <input class="form-control me-2" type="text" name="player" placeholder="Поиск игрока" style="margin-left: 20px;" aria-label="Search">
          <button type="submit" style="border-radius: 10px;background: #2588FC;color:white;" class="btn" type="submit">Найти</button>
        </form>
      </div>
    </div>
  </nav>
</header>
	<main style="width: 100%;" id="body">
		<?php 
			if(isset($content))
			echo $content;
		?>
		<!-- end content -->
	</main>
	<!-- start footer -->
<footer class="navbar fixed-bottom navbar-expand-sm" style="background:#121212">
  <div class="container-fluid-footer">
    <p class="navbar-footer">SportNews © 2024</p>
    <div class="collapse navbar-collapse" id="navbarCollapse">
    </div>
  </div>
</footer>
	<!-- end footer -->
    <script src="public/js/swiper-bundle.min.js"></script>
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/script.js"></script>
</body>
</html>