<!-- Homepage, tech cards by year -->
<?php
	ob_start();
?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Embark on a Journey with<br>IT Forum</h1>
          <h2 data-aos="fade-up" class="typewriter-text" id="typing-text" data-aos-delay="400"></h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="/forum" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Forum</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section>
  <!-- End Hero -->

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
              To create a vibrant and inclusive online community at IT View, where technology enthusiasts, professionals, and learners converge to exchange knowledge, discuss the latest trends, and foster collaborative learning in the field of information and computer technologies. Our goal is to provide a user-friendly platform that encourages active participation, networking, and the sharing of insights, ultimately contributing to the growth and enrichment of the global tech community.
              </p>
              <div class="text-center text-lg-start">
                <a href="/forum" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
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
        <div class="navbar" style="justify-content: space-around;">
        <?php 
        		$years = [2021, 2022, 2023];
                foreach ($years as $loopYear) {
                  echo '<a class="getstarted scrollto" style="margin-left: 0px; margin-top: 10px; width: 120px; justify-content: center;"" href="?year='.$loopYear.'">'.$loopYear.'</a>';
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
                    <img src="'.$tech['image'].'" style="width: 250px; height: 250px; margin-bottom: 10px;"></img>
                    <h3>'.$tech['name'].'</h3>
                    <p>'.$tech['description'].'</p>
                </div>
                </div>';
            }
        }else{
            echo '<div class="section-header" style="display: flex; font-size: 18px; text-align: center; margin: 0px; justify-content: center;"><p>No Data</p></div>';
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
        <div class="accordion accordion-flush" id="faqlist1" style="margin-top: 5px;">
            <div class="accordion-item" style="border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                How to register on the IT Vaade forum?
                </button>
            </h2>
            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                To register, click on the "Register" button in the header, fill in the required information, and click register.
                </div>
            </div>
            </div>

            <div class="accordion-item" style="margin: 5px 0px; border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                How to create a new topic on the forum?
                </button>
            </h2>
            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                After logging in, go to the forum page, where you'll find the "Create a Topic" button. Fill in the title and content of the topic, then publish it.
                </div>
            </div>
            </div>

            <div class="accordion-item" style="border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                How to edit your profile on IT View?
                </button>
            </h2>
            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                Go to your profile, where you can edit your information, add an avatar, and customize other settings.
                </div>
            </div>
            </div>

        </div>
        </div>

        <div class="col-lg-6">

        <!-- F.A.Q List 2-->
        <div class="accordion accordion-flush" id="faqlist2" style="margin-top: 5px;">

            <div class="accordion-item" style="border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-1" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                How to contact the forum administration?
                </button>
            </h2>
            <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                You can contact the administration by sending a message through the contact form on the Homepage page.
                </div>
            </div>
            </div>

            <div class="accordion-item" style="margin: 5px 0px; border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                How to use the search function on IT View?
                </button>
            </h2>
            <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                On the forum page, you will find the search field. Enter keywords related to your problem and review the results to find similar topics and solutions.
                </div>
            </div>
            </div>

            <div class="accordion-item" style="border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                How to participate in solving technical questions?
                </button>
            </h2>
            <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                Actively engage in discussions, provide quality answers to other participants' questions, and share your experience. The administration may appoint you as an expert based on your contribution and experience in the community.
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
<section id="contact" class="contact" style="margin-bottom: 10%;">

    <div class="container" data-aos="fade-up">

    <header class="section-header">
        <p>Contact Us</p>
    </header>

    <div class="row gy-4" style="display: flex; justify-content: center;">

        <div class="col-lg-6">
            <form action="" method="POST" id="contact-form" class="php-email-form" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25);">
            <p id="status-message" style="text-align: center; margin-top: 10px; font-size: 20px; line-height: 42px; font-weight: 700; color: #012970;"></p>
                <div class="row gy-4">
                    <div class="col-md-6">
                        <input type="text" name="from_name" class="form-control" placeholder="Your Name" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="from_email" placeholder="Your Email" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" name="message" rows="6" placeholder="Message" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);"></textarea>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" name="send">Send Message</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    </div>

</section>
<!-- End Contact -->
<script type="text/javascript">
   document.getElementById('contact-form').addEventListener('submit', function (event) {
      event.preventDefault();

      var statusMessage = document.getElementById('status-message');
      statusMessage.innerHTML = ''; // Clear previous status message

      emailjs.sendForm('service_aut6a7r', 'template_6r8hb2i', this)
         .then(function (response) {
            console.log('Sent successfully', response);
            statusMessage.innerHTML = 'Message sent successfully!';
            // Add any additional actions you want to perform after a successful submission
         }, function (error) {
            console.log('Failed to send', error);
            statusMessage.innerHTML = 'Error: Failed to send message.';
            // Add any error handling here
         });
   });
</script>

<?php 
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		