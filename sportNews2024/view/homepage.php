<!-- Главная страница -->
<?php
	ob_start();
?>

<style>
  body, html {
    height: 100%;
    margin: 0;
  }
#myCarousel {
    height: 95vh;
  }

  .carousel-inner {
    height: 100%;
  }

  .carousel-item {
    height: 100%;
  }

  .carousel-caption {
    display: flex;
    align-items: center;
    flex-direction: column; /* Stack items vertically */
    justify-content: center;
    text-align: center;
    height: 100%;
  }

  .carousel-control-prev,
  .carousel-control-next {
    color: #000;
  }

  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    filter: invert(100%);
  }

  .carousel-button {
    background: #4154f1;
    padding: 8px 20px;
    margin-left: 30px;
    border-radius: 4px;
    color: #fff;
  }
</style>
  <!-- Slider -->

  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-aos="fade-up">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/football.jpg" class="d-block w-100" style="height: 100vh;" alt="First Slide">
                <div class="carousel-caption text-center section-header" >
                    <p style="color: #F5F5F5; font-family: Rubik Mono One;font-size: 72px;font-style: normal;font-weight: 400;line-height: normal;">Найди любимый спорт вместе с <span style="color:#2588FC;">Sport News</span></p>
                    <a style="font-size: 36px; font-weight: 600; line-height: normal; margin: 25px 0px; padding: 20px 20px; background-color: white; color:black; border: none; cursor: pointer; border-radius:7%;">Категории</a>
                </div>
            </div>
            <div class="carousel-item">
            <img src="images/chess1.jpg" class="d-block w-100" style="height: 100vh;" alt="Second Slide">
                <div class="carousel-caption text-center section-header" >
                    <p style="color: #F5F5F5; font-family: Rubik Mono One;font-size: 72px;font-style: normal;font-weight: 400;line-height: normal;">Найди любимый спорт вместе с <span style="color:#2588FC;">Sport News</span></p>
                    <a style="font-size: 36px; font-weight: 600; line-height: normal; margin: 25px 0px; padding: 20px 20px; background-color: white; color:black; border: none; cursor: pointer; border-radius:7%;">Турниры</a>
                </div>
            </div>
            <div class="carousel-item">
            <img src="images/basketball4.jpg" class="d-block w-100" style="height: 100vh;" alt="Third Slide">
                <div class="carousel-caption text-center section-header" >
                    <p style="color: #F5F5F5; font-family: Rubik Mono One;font-size: 72px;font-style: normal;font-weight: 400;line-height: normal;">Найди любимый спорт вместе с <span style="color:#2588FC;">Sport News</span></p>
                    <a style="font-size: 36px; font-weight: 600; line-height: normal; margin: 25px 0px; padding: 20px 20px; background-color: white; color:black;  border: none; cursor: pointer; border-radius:7%;">Расписание</a>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
  </div>

<!-- End Slider -->
<?php 
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		