<?php
// Example routing logic to define $route
$host = explode('?', $_SERVER['REQUEST_URI']);
$path = $host[0];
$num = substr_count($path, '/');
$route = explode('/', $path)[$num];

// Include other necessary files or logic here

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>IT View</title>

  <!-- Favicons -->
  <link href="assets/img/logo1.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/carousel.css" rel="stylesheet">
  <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
  <script type="text/javascript">
    emailjs.init("PzVTGjjTExWHlP1xe");
  </script>
</head>

<body>

  <div id="loading-animation"></div>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center">
        <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 57px; height: 48px; flex-shrink: 0;">
        <span>IT View</span>
      </a>

      <nav id="navbar" class="navbar">
        
        <ul>
        <?php
          if(!isset($_SESSION['userId'])){
            echo '<li><a type="button" style="color: #013289;" class="nav-link scrollto" data-toggle="modal" data-target="#registerModal">Register</a></li>';
            echo '<li><a type="button" style="margin-right: 400px; color: #013289;" class="nav-link scrollto" data-toggle="modal" data-target="#loginModal">Login</a></li>';
          }else{
            if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'){
              echo '<li><a href="/dashboard" style="color: #013289;" class="nav-link scrollto">Admin Panel</a></li>';
              echo '<li><a type="button" style="color: #013289;" class="nav-link scrollto" data-toggle="modal" data-target="#logoutModal">Logout</a></li>';
              echo '<li><a style="margin-right: 250px;" class="nav-link" href="profile?user='.$_SESSION['userId'].'">Profile</a></li>';
            }else{
              echo '<li><a type="button" style="color: #013289;" class="nav-link scrollto" data-toggle="modal" data-target="#logoutModal">Logout</a></li>';
              echo '<li><a style="margin-right: 400px;" class="nav-link" href="profile?user='.$_SESSION['userId'].'">Profile</a></li>';
            }

          }
        ?>
          <li><a class="nav-link scrollto" href="/">Home</a></li>
          <li><a class="nav-link scrollto" href="/#about">About</a></li>
          <li><a class="nav-link scrollto" href="/#tech">Tech</a></li>
          <li><a class="nav-link scrollto" href="/#faq">FAQ</a></li>
          <li><a class="nav-link scrollto" href="/#contact">Contacts</a></li>
          <li><a class="getstarted scrollto" href="/forum">Forum</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


	<main id="main">
		<?php 
			if(isset($content))
			echo $content;
		?>

  <!-- Login -->
  <div class="modal fade" id="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 10%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="login" method="POST" class="content" style="margin: auto; padding: 10px 60px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289; margin: 20px 0px;">Login</h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['loginMessage'])) {echo $_SESSION['loginMessage']; unset($_SESSION['loginMessage']);} ?>
              </p>
              <div class="mb-3">
              <?php 
                  if ($route == 'comments') {
                    if(isset($topicId)){
                      if(!empty($page)){
                        if(!empty($searchQuery)){
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?topic=' . $topicId . '&search='. $searchQuery .'">';
                        }else{
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?topic=' . $topicId . '&page='. $page .'">';
                        }
                      }else{
                        echo '<input type="hidden" name="redirect_route" value="' . $route . '?topic=' . $topicId . '">';
                      }
                    }
                    if(isset($commentId)){
                      if(!empty($page)){
                        if(!empty($searchQuery)){
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?replies=' . $commentId . '&search='. $searchQuery .'">';
                        }else{
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?replies=' . $commentId . '&page='. $page .'">';
                        }
                      }else{
                        echo '<input type="hidden" name="redirect_route" value="' . $route . '?replies=' . $commentId . '">';
                      }
                    }
                  } elseif(!empty($year)){
                    echo '<input type="hidden" name="redirect_route" value="?year=' . $year . '">';
                  } elseif(!empty($page) && $route == 'forum'){
                    if(!empty($searchQuery)){
                      echo '<input type="hidden" name="redirect_route" value="' . $route .'?search='. $searchQuery .'">';
                    }else{
                      echo '<input type="hidden" name="redirect_route" value="' . $route . '?page=' . $page . '">';
                    }
                  } elseif($route == 'dashboard'){
                      echo '<input type="hidden" name="redirect_route" value="">';
                  } elseif($route == 'profile'){
                    if(!empty($userId)){
                      echo '<input type="hidden" name="redirect_route" value="' . $route . '?user=' . $userId . '">';
                    }else{
                      echo '<input type="hidden" name="redirect_route" value="">';
                    }
                  } else {
                    echo '<input type="hidden" name="redirect_route" value="' . $route . '">';
                  }
                ?>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" style="margin: 20px 0px;" required>
              </div>
             <div class="mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Enter your password" style="margin-bottom: 20px;" required>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto">Login</button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal">Close</button>
            </div>
          </form>
      </div>
    </div>
  </div>
<!-- End Login -->

<!-- Register -->
  <div class="modal fade" id="registerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 10%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="register" method="POST" class="content" style="margin: auto; padding: 10px 60px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289; margin: 20px 0px;">Register</h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['registerMessage'])) {echo $_SESSION['registerMessage']; unset($_SESSION['registerMessage']);} ?>
              </p>
              <div class="mb-3">
              <?php 
                  if ($route == 'comments') {
                    if(isset($topicId)){
                      if(!empty($page)){
                        if(!empty($searchQuery)){
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?topic=' . $topicId . '&search='. $searchQuery .'">';
                        }else{
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?topic=' . $topicId . '&page='. $page .'">';
                        }
                      }else{
                        echo '<input type="hidden" name="redirect_route" value="' . $route . '?topic=' . $topicId . '">';
                      }
                    }
                    if(isset($commentId)){
                      if(!empty($page)){
                        if(!empty($searchQuery)){
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?replies=' . $commentId . '&search='. $searchQuery .'">';
                        }else{
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?replies=' . $commentId . '&page='. $page .'">';
                        }
                      }else{
                        echo '<input type="hidden" name="redirect_route" value="' . $route . '?replies=' . $commentId . '">';
                      }
                    }
                  } elseif(!empty($year)){
                      echo '<input type="hidden" name="redirect_route" value="?year=' . $year . '">';
                  } elseif(!empty($page) && $route == 'forum'){
                    if(!empty($searchQuery)){
                      echo '<input type="hidden" name="redirect_route" value="' . $route .'?search='. $searchQuery .'">';
                    }else{
                      echo '<input type="hidden" name="redirect_route" value="' . $route . '?page=' . $page . '">';
                    }
                  } elseif($route == 'dashboard'){
                      echo '<input type="hidden" name="redirect_route" value="">';
                  } elseif($route == 'profile'){
                    if(!empty($userId)){
                      echo '<input type="hidden" name="redirect_route" value="' . $route . '?user=' . $userId . '">';
                    }else{
                      echo '<input type="hidden" name="redirect_route" value="">';
                    }
                  } else {
                    echo '<input type="hidden" name="redirect_route" value="' . $route . '">';
                  }
                ?>
                  <input type="text" name="username" class="form-control" placeholder="Enter your username" style="margin-bottom: 20px;" required>
              </div>
              <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Enter your email" style="margin: 20px 0px;" required>
              </div>
             <div class="mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Enter your password" style="margin-bottom: 20px;" required>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto">Register</button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal">Close</button>
            </div>
          </form>
      </div>
    </div>
  </div>
    <!-- End Register -->

    <!-- Logout -->
  <div class="modal fade" id="logoutModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 10%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="logout" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289;">Are you sure?</h1>
              <?php 
                  if ($route == 'comments') {
                    if(isset($topicId)){
                      if(!empty($page)){
                        if(!empty($searchQuery)){
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?topic=' . $topicId . '&search='. $searchQuery .'">';
                        }else{
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?topic=' . $topicId . '&page='. $page .'">';
                        }
                      }else{
                        echo '<input type="hidden" name="redirect_route" value="' . $route . '?topic=' . $topicId . '">';
                      }
                    }
                    if(isset($commentId)){
                      if(!empty($page)){
                        if(!empty($searchQuery)){
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?replies=' . $commentId . '&search='. $searchQuery .'">';
                        }else{
                          echo '<input type="hidden" name="redirect_route" value="' . $route . '?replies=' . $commentId . '&page='. $page .'">';
                        }
                      }else{
                        echo '<input type="hidden" name="redirect_route" value="' . $route . '?replies=' . $commentId . '">';
                      }
                    }
                  } elseif(!empty($year)){
                      echo '<input type="hidden" name="redirect_route" value="?year=' . $year . '">';
                  } elseif(!empty($page) && $route == 'forum'){
                    if(!empty($searchQuery)){
                      echo '<input type="hidden" name="redirect_route" value="' . $route .'?search='. $searchQuery .'">';
                    }else{
                      echo '<input type="hidden" name="redirect_route" value="' . $route . '?page=' . $page . '">';
                    }
                  } elseif($route == 'dashboard'){
                      echo '<input type="hidden" name="redirect_route" value="">';
                  } elseif($route == 'profile'){
                    if(!empty($userId)){
                      echo '<input type="hidden" name="redirect_route" value="' . $route . '?user=' . $userId . '">';
                    }else{
                      echo '<input type="hidden" name="redirect_route" value="">';
                    }
                  } else {
                    echo '<input type="hidden" name="redirect_route" value="' . $route . '">';
                  }
                ?>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto">Confirm</button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal">Close</button>
            </div>
          </form>
      </div>
    </div>
  </div>
    <!-- End Logout -->
		<!-- end content -->
	</main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="position: fixed; bottom: 0%; width: 100%;">
    <div class="container">
      <div class="copyright">
        &copy; Aleksandr Egorov, Rustem Kurshutov <br>JPTV20
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>




  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/loadinganim.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>