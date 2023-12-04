<!-- Главная страница -->
<?php
	ob_start();
?>
<!-- Slider -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1920x1080" class="d-block w-100" style="height: 100vh;" alt="First Slide">
                <div class="carousel-caption text-center section-header" >
                    <p style="font-size: 48px;">Slide 1</p>
                    <p style="font-size: 36px; font-weight: 600; line-height: normal; margin: 25px 0px;">Your caption for the first slide.</p>
                    <div class="navbar"><a class="getstarted scrollto" style="margin-left: 0px; margin-top: 10px; width: 120px; justify-content: center;"" href="/">Forum</a></div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1920x1080" class="d-block w-100" style="height: 100vh;"alt="Second Slide">
                <div class="carousel-caption text-center section-header">
                    <p style="font-size: 48px;">Slide 2</p>
                    <p style="font-size: 36px; font-weight: 600; line-height: normal; margin: 25px 0px;">Your caption for the second slide.</p>
                        <div class="navbar"><a class="getstarted scrollto" style="margin-left: 0px; margin-top: 10px; width: 120px; justify-content: center;" href="/">Forum</a></div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1920x1080" class="d-block w-100" style="height: 100vh;" alt="Third Slide">
                <div class="carousel-caption text-center section-header">
                    <p style="font-size: 48px;">Slide 3</p>
                    <p style="font-size: 36px; font-weight: 600; line-height: normal; margin: 25px 0px;">Your caption for the third slide.</p>
                    <div class="navbar"><a class="getstarted scrollto" style="margin-left: 0px; margin-top: 10px; width: 120px; justify-content: center;"" href="/">Forum</a></div>
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

    <!-- About -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <header class="section-header">
            <p>About</p>
        </header>
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h2>Goal of the website</h2>
              <p>
                Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est corrupti.
              </p>
              <div class="text-center text-lg-start">
                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Forum</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/about.png" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section>
    <!-- End About -->

     <!-- Tech-->
<section id="tech" class="services">

    <div class="container" data-aos="fade-up">

    <header class="section-header">
        <p>Tech</p>
        <p style="font-size: 18px;">Learn about popular and useful technologies<br>Use our filter by clicking buttons to learn about popular tech of the year</p>
        <div class="navbar">
        <?php 
                foreach ($years as $year) {
                  echo '<a class="getstarted scrollto" style="margin-left: 0px; margin-top: 10px; width: 120px; justify-content: center;"" href="tech?'.$year.'">'.$year.'</a>';
                }
        ?>
         </div>

    </header>
    <div class="row gy-4">

        <?php
        if(isset($alltech) && $alltech){
            foreach ($alltech as $tech){
                echo '<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-box blue">
                    <img src="assets/img/about.png" style="width: 250px; height: 250px; margin-bottom: 10px;"></img>
                    <h3>'.$tech['name'].'</h3>
                    <p>'.$tech['description'].'</p>
                    <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                </div>
                </div>';
            }
        }else{
            echo '<div class="section-header" style="display: flex; font-size: 18px; text-align: center; margin: 0px; justify-content: center;"><p>no data</p></div>';
        }
        ?>

    </div>

    </div>

</section>
<!-- End Tech -->

<!-- F.A.Q -->
<section id="faq" class="faq">

    <div class="container" data-aos="fade-up">

    <header class="section-header">
        <p>Frequently Asked Questions</p>
    </header>

    <div class="row">
        <div class="col-lg-6">
        <!-- F.A.Q List 1-->
        <div class="accordion accordion-flush" id="faqlist1">
            <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                Non consectetur a erat nam at lectus urna duis?
                </button>
            </h2>
            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 10px;">
                <div class="accordion-body">
                Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </div>
            </div>
            </div>

            <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?
                </button>
            </h2>
            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 10px;">
                <div class="accordion-body">
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </div>
            </div>
            </div>

            <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?
                </button>
            </h2>
            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 10px;">
                <div class="accordion-body">
                Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </div>
            </div>
            </div>

        </div>
        </div>

        <div class="col-lg-6">

        <!-- F.A.Q List 2-->
        <div class="accordion accordion-flush" id="faqlist2">

            <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-1" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?
                </button>
            </h2>
            <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 10px;">
                <div class="accordion-body">
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </div>
            </div>
            </div>

            <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                Tempus quam pellentesque nec nam aliquam sem et tortor consequat?
                </button>
            </h2>
            <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 10px;">
                <div class="accordion-body">
                Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                </div>
            </div>
            </div>

            <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                Varius vel pharetra vel turpis nunc eget lorem dolor?
                </button>
            </h2>
            <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 10px;">
                <div class="accordion-body">
                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                </div>
            </div>
            </div>

        </div>
        </div>

    </div>

    </div>

</section>
<!-- End F.A.Q -->

<!-- Contacts -->
<section id="contact" class="contact">

    <div class="container" data-aos="fade-up">

    <header class="section-header">
        <p>Contact Us</p>
    </header>

    <div class="row gy-4">

        <div class="col-lg-6">

        <div class="row gy-4">
            <div class="col-md-6">
            <div class="info-box" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                <i class="bi bi-envelope"></i>
                <h3>Email Us</h3>
                <p>info@example.com<br>contact@example.com</p>
            </div>
            </div>
        </div>

        </div>

        <div class="col-lg-6">
        <form action="forms/contact.php" method="post" class="php-email-form">
            <div class="row gy-4">

            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
            </div>

            <div class="col-md-6 ">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
            </div>

            <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
            </div>

            <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);"></textarea>
            </div>

            <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit">Send Message</button>
            </div>

            </div>
        </form>

        </div>

    </div>

    </div>

</section>
<!-- End Contact -->
<?php 
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		