<?php
// Example routing logic to define $route
$host = explode('?', $_SERVER['REQUEST_URI']);
$path = $host[0];
$num = substr_count($path, '/');
$route = explode('/', $path)[$num];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>IT View</title>
  <!-- Google Fonts -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/richtext.min.css">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/carousel.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
  <!-- scripts -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- CSS -->
    <!-- Emailjs -->
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
        <img src="assets/img/logo3.png" alt="" style="width: 200px; height: 74px; flex-shrink: 0;">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="/"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kodu' : 'Home');?></a></li>
          <li><a class="nav-link scrollto" href="/#contact"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kontaktid' : 'Contacts');?></a></li>
          <?php
            if (!isset($_SESSION['userId'])) {
              echo '<li><a type="button" style="color: #013289;" class="nav-link" data-toggle="modal" data-target="#registerModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Registreeri' : 'Register') . '</a></li>';
              echo '<li><a type="button" style="color: #013289;" class="nav-link" data-toggle="modal" data-target="#loginModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Logi sisse' : 'Login') . '</a></li>';
            } else {
              if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager') {
                  echo '<li><a href="/dashboard" style="color: #013289;" class="nav-link">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Juhtpaneel' : 'Dashboard') . '</a></li>';
                  echo '<li><a type="button" style="color: #013289;" class="nav-link" data-toggle="modal" data-target="#logoutModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Välju' : 'Logout') . '</a></li>';
                  echo '<li><a class="nav-link" href="profile?user=' . $_SESSION['userId'] . '"><img src="'.$_SESSION['imgpath'].'" style="width: 50px; height: 50px; border-radius: 50%;"></a></li>';
              } else {
                  echo '<li><a type="button" style="color: #013289;" class="nav-link" data-toggle="modal" data-target="#logoutModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Välju' : 'Logout') . '</a></li>';
                  echo '<li><a class="nav-link" href="profile?user=' . $_SESSION['userId'] . '"><img src="'.$_SESSION['imgpath'].'" style="width: 50px; height: 50px; border-radius: 50%;"></a></li>';
              }
            }
          ?> 
          <form id="languageForm" method="POST">
            <?php
                $redirectValue = '';

                if ($route == 'comments') {
                    if (isset($topicId)) {
                        $query = '?topic=' . $topicId;

                        if (!empty($page)) {
                            $query .= '&page=' . $page;
                        }

                        if (!empty($searchQuery)) {
                            $query .= '&search=' . $searchQuery;
                        }

                        $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                    }
                } elseif(!empty($commentId)){
                  $query = '?comment=' . $commentId;

                  if (!empty($page)) {
                      $query .= '&page=' . $page;
                  }

                  if (!empty($searchQuery)) {
                      $query .= '&search=' . $searchQuery;
                  }

                  $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                } elseif (!empty($year)) {
                    $redirectValue = '<input type="hidden" name="redirect_route" value="?year=' . $year . '">';
                } elseif (!empty($page) && $route == 'forum') {
                    if (!empty($searchQuery)) {
                        $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route .'?search='. $searchQuery .'">';
                    } else {
                        $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?page=' . $page . '">';
                    }
                } elseif ($route == 'dashboard') {
                    $redirectValue = '<input type="hidden" name="redirect_route" value="dashboard">';

                    if (isset($_GET['comments'])) {
                        $redirectValue = '<input type="hidden" name="redirect_route" value="dashboard?comments">';
                    } elseif (isset($_GET['replies'])) {
                        $redirectValue = '<input type="hidden" name="redirect_route" value="dashboard?replies">';
                    } elseif (isset($_GET['users'])) {
                        $redirectValue = '<input type="hidden" name="redirect_route" value="dashboard?users">';
                    } elseif (isset($_GET['reports'])) {
                        $redirectValue = '<input type="hidden" name="redirect_route" value="dashboard?reports">';
                    }
                } elseif ($route == 'profile' && !empty($userId)) {
                    $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?user=' . $userId . '">';
                } else {
                    $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '">';
                }

                echo $redirectValue;
              ?>          
            <li class="dropdown"><a href="#"><span><?php echo '' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'EST' : 'ENG') . '';?></span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li class="language-li"><button type="button" class="language-btn" onclick="setLanguage('eng')">ENG</button></li>
                <li class="language-li"><button type="button" class="language-btn" onclick="setLanguage('est')">EST</button></li>
              </ul>
            </li>
          </form>
          <li><a class="getstarted" href="/forum"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Foorum' : 'Forum');?></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  
  <div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <img id="lightbox-image">
    <div style="position: absolute; top: 10px; right: 10px; cursor: pointer; color: #fff; font-size: 24px;">&times;</div>
</div>

	<div id="main">
		<?php 
			if(isset($content))
			echo $content;
		?>
	</div>

<!-- Modal forms section -->
  <!-- Login -->
  <div class="modal fade" id="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <form action="login" method="POST" class="content modal-forms">
              <h1 style="text-align: center; color: #013289; margin: 20px 0px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Logi sisse' : 'Login');?></h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['loginMessage'])) {echo $_SESSION['loginMessage']; unset($_SESSION['loginMessage']);} ?>
              </p>
              <div class="mb-3">
              <?php 
                  $redirectValue = '';

                  if ($route == 'comments') {
                      if (isset($topicId)) {
                          $query = '?topic=' . $topicId;

                          if (!empty($page)) {
                              $query .= '&page=' . $page;
                          }

                          if (!empty($searchQuery)) {
                              $query .= '&search=' . $searchQuery;
                          }

                          $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                      }
                  } elseif(!empty($commentId)){
                      $query = '?comment=' . $commentId;
    
                      if (!empty($page)) {
                          $query .= '&page=' . $page;
                      }
    
                      if (!empty($searchQuery)) {
                          $query .= '&search=' . $searchQuery;
                      }
    
                      $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                  } elseif (!empty($year)) {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="?year=' . $year . '">';
                  } elseif (!empty($page) && $route == 'forum') {
                      if (!empty($searchQuery)) {
                          $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?search=' . $searchQuery . '">';
                      } else {
                          $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?page=' . $page . '">';
                      }
                  } elseif ($route == 'dashboard') {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="">';
                  } elseif ($route == 'profile' && !empty($userId)) {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?user=' . $userId . '">';
                  } else {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '">';
                  }

                  echo $redirectValue;
                ?>
                <input type="email" name="email" class="form-control" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta e-post' : 'Enter email');?>" style="margin: 20px 0px;" required>
              </div>
             <div class="mb-3">
                  <input type="password" name="password" class="form-control" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta parool' : 'Enter password');?>" style="margin-bottom: 20px;" required>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Logi sisse' : 'Login');?></button>
                <button type="button" class="getstarted" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close');?></button>
              </div>
              <div>
                <p style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ei ole kontot? ' : 'Dont have an account? ');?><a type="button" data-dismiss="modal" data-toggle="modal" data-target="#registerModal" style="font-weight: bold;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Registeeru siin' : 'Register here');?></a></p>
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
          <form action="register" method="POST" class="content modal-forms">
              <h1 style="text-align: center; color: #013289; margin: 20px 0px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Registeeru' : 'Register');?></h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['registerMessage'])) {echo $_SESSION['registerMessage']; unset($_SESSION['registerMessage']);} ?>
              </p>
              <div class="mb-3">
              <?php 
                  $redirectValue = '';

                  if ($route == 'comments') {
                      if (isset($topicId)) {
                          $query = '?topic=' . $topicId;

                          if (!empty($page)) {
                              $query .= '&page=' . $page;
                          }

                          if (!empty($searchQuery)) {
                              $query .= '&search=' . $searchQuery;
                          }

                          $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                      }
                  } elseif(!empty($commentId)){
                      $query = '?comment=' . $commentId;
    
                      if (!empty($page)) {
                          $query .= '&page=' . $page;
                      }
    
                      if (!empty($searchQuery)) {
                          $query .= '&search=' . $searchQuery;
                      }
    
                      $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                  } elseif (!empty($year)) {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="?year=' . $year . '">';
                  } elseif (!empty($page) && $route == 'forum') {
                      if (!empty($searchQuery)) {
                          $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?search=' . $searchQuery . '">';
                      } else {
                          $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?page=' . $page . '">';
                      }
                  } elseif ($route == 'dashboard') {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="">';
                  } elseif ($route == 'profile' && !empty($userId)) {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?user=' . $userId . '">';
                  } else {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '">';
                  }

                  echo $redirectValue;
                ?>
                  <input type="text" name="username" class="form-control" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta kasutajanimi' : 'Enter username');?>" style="margin-bottom: 20px;" required>
              </div>
              <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta e-posti' : 'Enter email');?>" style="margin: 20px 0px;" required>
              </div>
             <div class="mb-3">
                  <input type="password" name="password" class="form-control" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta parool' : 'Enter password');?>" style="margin-bottom: 20px;" required>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Registeeru' : 'Register');?></button>
                <button type="button" class="getstarted" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close');?></button>
              </div>
              <div>
                <p style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kas sul on juba konto? ' : 'Already have an account? ');?><a type="button" data-dismiss="modal" data-toggle="modal" data-target="#loginModal" style="font-weight: bold;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Logi sisse siin' : 'Login here');?></a></p>
              </div>
          </form>
      </div>
    </div>
  </div>
    <!-- End Register -->

    <div id="sessionModal" class="modal fade test" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
            <form action="logout" method="POST" class="content modal-forms">
                <h1 style="text-align: center; color: #013289;">Session Expiration Reminder</h1>
                <p style="text-align: center; color: #013289;" id="sessionMessage"></p>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                    <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Välju' : 'Logout');?></button>
                    <button id="closeButton" type="button" class="getstarted" style="border: none;" variant="primary"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close');?></button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Logout -->
    
  <div class="modal fade" id="logoutModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <form action="logout" method="POST" class="content modal-forms">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Logi välja' : 'Logout');?></h1>
              <?php 
                  $redirectValue = '';

                  if ($route == 'comments') {
                      if (isset($topicId)) {
                          $query = '?topic=' . $topicId;

                          if (!empty($page)) {
                              $query .= '&page=' . $page;
                          }

                          if (!empty($searchQuery)) {
                              $query .= '&search=' . $searchQuery;
                          }

                          $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                      }
                  } elseif(!empty($commentId)){
                      $query = '?comment=' . $commentId;
    
                      if (!empty($page)) {
                          $query .= '&page=' . $page;
                      }
    
                      if (!empty($searchQuery)) {
                          $query .= '&search=' . $searchQuery;
                      }
    
                      $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                  } elseif (!empty($year)) {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="?year=' . $year . '">';
                  } elseif (!empty($page) && $route == 'forum') {
                      if (!empty($searchQuery)) {
                          $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?search=' . $searchQuery . '">';
                      } else {
                          $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?page=' . $page . '">';
                      }
                  } elseif ($route == 'dashboard') {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="">';
                  } elseif ($route == 'profile' && !empty($userId)) {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?user=' . $userId . '">';
                  } else {
                      $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '">';
                  }

                  echo $redirectValue;
                ?>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kinnita' : 'Confirm');?></button>
                <button type="button" class="getstarted" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close');?></button>
            </div>
          </form>
      </div>
    </div>
  </div>
    <!-- End Logout -->
		<!-- end content -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="position: fixed; bottom: 0%; width: 100%;">
    <div class="container">
      <div class="copyright">
        &copy; Aleksandr Egorov, Rustem Kurshutov<br>2024 IVKHK JPTV20
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


<script>
    function setLanguage(language) {
        // Get the form and set its action attribute
        var form = document.getElementById('languageForm');
        form.action = 'language?' + language;

        // Submit the form
        form.submit();
    }
</script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/jquery.richtext.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/loadinganim.js"></script>
</body>

</html>