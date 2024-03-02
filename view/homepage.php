<!-- Homepage -->
<?php
	ob_start();
?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Asu teele koos <br>IT-foorumiga!' : 'Embark on a Journey with<br>IT Forum');?></h1>
          <h2 data-aos="fade-up" <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'class="typewriter-text-est" id="typing-text-est"' : 'class="typewriter-text" id="typing-text"');?> data-aos-delay="400"></h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="/forum" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
              <span><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Foorum' : 'Forum');?></span>
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
            <p><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teave' : 'About');?></p>
        </header>
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h2><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Veebisaidi eesmärk' : 'Goal of the website');?></h2>
              <p>
              <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Luua elav ja kaasav veebikogukond IT Views, kus tehnoloogiahuvilised, spetsialistid ja õppijad kohtuvad teadmiste vahetamiseks, aruteluks viimaste trendide üle ning koostöiseks õppimiseks infotehnoloogia ja arvutitehnoloogia valdkonnas. Meie eesmärk on pakkuda kasutajasõbralikku platvormi, mis julgustab aktiivset osalemist, võrgustikustamist ja teadmiste jagamist, aidates seeläbi kaasa ülemaailmse tehnoloogiakogukonna kasvule ja rikastumisele.' : 'To create a vibrant and inclusive online community at IT View, where technology enthusiasts, professionals, and learners converge to exchange knowledge, discuss the latest trends, and foster collaborative learning in the field of information and computer technologies. Our goal is to provide a user-friendly platform that encourages active participation, networking, and the sharing of insights, ultimately contributing to the growth and enrichment of the global tech community.');?>
              
              </p>
              <div class="text-center text-lg-start">
                <a href="/forum" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Foorum' : 'Forum');?></span>
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
          <p><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Tehnoloogia' : 'Tech');?></p>
          <p style="font-size: 18px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Õppige populaarsetest ja kasulikest tehnoloogiatest.<br>Kasutage meie filtreerimisvõimalust, vajutades nuppe, et saada teavet aasta populaarsete tehnoloogiate kohta.' : 'Learn about popular and useful technologies<br>Use our filter by clicking buttons to learn about popular tech of the year');?></p>
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
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-box blue">
                <img src="https://th.bing.com/th/id/OIP.3ODPI6UHE1z7YMNGBELP_QHaEK?rs=1&pid=ImgDetMain" style="width: 250px; height: 250px; margin-bottom: 10px;"></img>
                <h3><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Apple M1 kiip' : 'Apple M1 Chip');?></h3>
                <p><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Apple tutvustas oma M1 kiipi aastal 2020, kuid selle mõju oli märkimisväärne ka 2021. M1 on kohandatud ARM-põhine süsteem kiip (SoC), mis toidab mitmeid Applei seadmeid, sealhulgas MacBook Air, MacBook Pro ja Mac mini. See tõi kaasa märkimisväärseid edusamme jõudluse ja energiatõhususe osas, märkides Applei üleminekut Inteli protsessoritest.' : 'Apple introduced its M1 chip in 2020, but its impact continued to be significant in 2021. The M1 is a custom-designed ARM-based system on a chip (SoC) that powers a range of Apple devices, including the MacBook Air, MacBook Pro, and Mac mini. It brought notable improvements in performance and energy efficiency, marking Apples transition away from Intel processors.');?></p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-box blue">
                <img src="https://th.bing.com/th/id/OIP.ssfyf2CkcLcvgM2l_1OL9QHaEK?rs=1&pid=ImgDetMain" style="width: 250px; height: 250px; margin-bottom: 10px;"></img>
                <h3><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'NVIDIA GeForce RTX 30 seeria graafikaprotsessorid' : 'NVIDIA GeForce RTX 30 Series GPUs');?></h3>
                <p><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'NVIDIA avaldas oma GeForce RTX 30 seeria graafikakaardid, mis põhinevad Ampere arhitektuuril. Märkimisväärsed mudelid hõlmavad GeForce RTX 3080, RTX 3070 ja RTX 3060. Need graafikaprotsessorid tõid kaasa edusammud kiirjälgimise ja AI-toega funktsioonides, pakkudes muljetavaldavat jõudlust mängude, sisuloome ja professionaalsete rakenduste jaoks.' : 'NVIDIA released its GeForce RTX 30 series graphics cards based on the Ampere architecture. Notable models include the GeForce RTX 3080, RTX 3070, and RTX 3060. These GPUs introduced advancements in ray tracing and AI-powered features, delivering impressive performance for gaming, content creation, and professional applications.');?></p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-box blue">
                <img src="assets/img/about.png" style="width: 250px; height: 250px; margin-bottom: 10px;"></img>
                <h3><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'AMD Ryzen 5000 seeria protsessorid' : 'AMD Ryzen 5000 Series CPUs');?></h3>
                <p><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'AMD jätkas edu protsessoriturul, tuues turule Ryzen 5000 seeria, millel on Zen 3 arhitektuur. Protsessorid nagu Ryzen 9 5950X ja Ryzen 9 5900X pakkusid suurepärast mitmiktuuma jõudlust, muutes need populaarseteks valikuteks mängude ja sisuloome jaoks. AMD Zen 3 arhitektuur tõi kaasa edusamme IPC-s (juhiste arv tsükli kohta) ja üldises efektiivsuses.' : 'AMD continued its success in the CPU market with the release of the Ryzen 5000 series, featuring the Zen 3 architecture. CPUs like the Ryzen 9 5950X and Ryzen 9 5900X offered excellent multi-core performance, making them popular choices for gaming and content creation. AMDs Zen 3 architecture brought improvements in IPC (instructions per cycle) and overall efficiency.');?></p>
            </div>
          </div>
      </div>

    </div>
</section>
<!-- End Tech -->

<!-- F.A.Q -->
<section id="faq" class="faq">

    <div class="container" data-aos="fade-up">

    <header class="section-header">
        <p><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Korduma Kippuvad Küsimused' : 'Frequently Asked Questions');?></p>
    </header>

    <div class="row">
        <div class="col-lg-6">
        <!-- F.A.Q List 1-->
        <div class="accordion accordion-flush" id="faqlist1" style="margin-top: 5px;">
            <div class="accordion-item" style="border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kuidas registreeruda IT Vaade foorumis?' : 'How to register on the IT Vaade forum?');?>
                </button>
            </h2>
            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Registreerumiseks klõpsake päise menüüs nuppu "Registreeri", täitke nõutud teave ja klõpsake nuppu "Registreeri".' : 'To register, click on the "Register" button in the header, fill in the required information, and click register.');?>
                </div>
            </div>
            </div>

            <div class="accordion-item" style="margin: 5px 0px; border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kuidas luua uut teemat foorumis?' : 'How to create a new topic on the forum?');?>
                </button>
            </h2>
            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Pärast sisselogimist minge foorumi lehele, kus leiate nupu "Loo teema". Täitke teema pealkiri ja sisu ning seejärel avaldage see.' : 'After logging in, go to the forum page, where you will find the "Create a Topic" button. Fill in the title and content of the topic, then publish it.');?>
                </div>
            </div>
            </div>

            <div class="accordion-item" style="border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kuidas muuta oma profiili IT Viewis?' : 'How to edit your profile on IT View?');?>
                </button>
            </h2>
            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Minge oma profiilile, kus saate muuta oma teavet, lisada avatar ja kohandada muid seadeid.' : 'Go to your profile, where you can edit your information, add an avatar, and customize other settings.');?>
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
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kuidas võtta ühendust foorumi haldusega?' : 'How to contact the forum administration?');?>
                </button>
            </h2>
            <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Saate võtta ühendust haldusega, saates sõnumi avalehel oleva kontaktvormi kaudu.' : 'You can contact the administration by sending a message through the contact form on the Homepage page.');?>
                </div>
            </div>
            </div>

            <div class="accordion-item" style="margin: 5px 0px; border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kuidas kasutada IT View veebisaidi otsingufunktsiooni?' : 'How to use the search function on IT View?');?>
                </button>
            </h2>
            <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Foorumi lehel leiate otsinguvälja. Sisestage oma probleemiga seotud märksõnad ja vaadake tulemusi, et leida sarnaseid teemasid ja lahendusi.' : 'On the forum page, you will find the search field. Enter keywords related to your problem and review the results to find similar topics and solutions.');?>
                </div>
            </div>
            </div>

            <div class="accordion-item" style="border-radius: 15px;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3" style="border: 2px solid #63BDFF; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 15px;">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kuidas osaleda tehniliste küsimuste lahendamisel?' : 'How to participate in solving technical questions?');?>
                </button>
            </h2>
            <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25); padding: 10px;">
                <div class="accordion-body">
                <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Osalege aktiivselt aruteludes, pakkuge teistele osalejatele kvaliteetseid vastuseid ja jagage oma kogemusi. Haldus võib teid määrata eksperdiks, lähtudes teie panusest ja kogemusest kogukonnas.' : 'Actively engage in discussions, provide quality answers to other participants questions, and share your experience. The administration may appoint you as an expert based on your contribution and experience in the community.');?>
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
        <p><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Võtke meiega ühendust' : 'Contact us');?></p>
    </header>

    <div class="row gy-4" style="display: flex; justify-content: center;">

        <div class="col-lg-6">
            <form method="POST" id="contact-form" class="php-email-form" style="border: 2px solid #63BDFF; border-radius: 10px; box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25);">
            <p id="status-message" style="text-align: center; margin-top: 10px; font-size: 20px; line-height: 42px; font-weight: 700; color: #012970;"></p>
                <div class="row gy-4">
                    <div class="col-md-6">
                        <input type="text" name="from_name" class="form-control" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teie nimi' : 'Your name');?>" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="from_email" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teie e-post' : 'Your email');?>" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="subject" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teema' : 'Topic');?>" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" name="message" rows="6" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sõnum' : 'Message');?>" required style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);"></textarea>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" name="send"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Saada sõnum' : 'Send message');?></button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    </div>

</section>
<!-- End Contact -->

<script>
    function startTypingAnimationEST() {
      setTimeout(function () {
        var text = "Valla IT-universumis võimalused!";
        var i = 0;
        var element = document.getElementById('typing-text-est');

        function typeWriter() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;

                setTimeout(typeWriter, 60); // Adjust typing speed (milliseconds)
            }
        }

        typeWriter();

        // Adjust font size and line height for responsiveness
        window.addEventListener('resize', function () {
            adjustTextSize();
        });

        function adjustTextSize() {
            var screenWidth = window.innerWidth;

            if (screenWidth < 768) { // Adjust the breakpoint as needed
                element.style.fontSize = '21px'; // Set the desired font size for smaller screens
                element.style.lineHeight = '1.5'; // Set the desired line height
            } else {
                element.style.fontSize = '24px'; // Set the default font size for larger screens
                element.style.lineHeight = '1.2'; // Set the default line height
            }
        }

        // Initial adjustment
        adjustTextSize();
      }, 1200);
    }

    function startTypingAnimationENG() {
      setTimeout(function () {
        var text = "Unleash Possibilities in the IT Universe!";
        var i = 0;
        var element = document.getElementById('typing-text');

        function typeWriter() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;

                setTimeout(typeWriter, 60); // Adjust typing speed (milliseconds)
            }
        }

        typeWriter();

        // Adjust font size and line height for responsiveness
        window.addEventListener('resize', function () {
            adjustTextSize();
        });

        function adjustTextSize() {
            var screenWidth = window.innerWidth;

            if (screenWidth < 768) { // Adjust the breakpoint as needed
                element.style.fontSize = '21px'; // Set the desired font size for smaller screens
                element.style.lineHeight = '1.5'; // Set the desired line height
            } else {
                element.style.fontSize = '24px'; // Set the default font size for larger screens
                element.style.lineHeight = '1.2'; // Set the default line height
            }
        }

        // Initial adjustment
        adjustTextSize();
      }, 1200);
    }

    <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est') ? 'startTypingAnimationEST();' : 'startTypingAnimationENG();';?>
</script>



<script type="text/javascript">
  <?php
    $success = (isset($_SESSION['language']) && $_SESSION['language'] == 'est') ? 'Sõnum saadetud edukalt!' : 'Message sent successfully!';
    $error = (isset($_SESSION['language']) && $_SESSION['language'] == 'est') ? 'Viga: Sõnumi saatmine ebaõnnestus.' : 'Error: Failed to send message.';
  ?>
   document.getElementById('contact-form').addEventListener('submit', function (event) {
      event.preventDefault();

      var statusMessage = document.getElementById('status-message');
      statusMessage.innerHTML = ''; // Clear previous status message

      emailjs.sendForm('service_aut6a7r', 'template_6r8hb2i', this)
         .then(function (response) {
            console.log('Sent successfully', response);
            statusMessage.innerHTML = '<?php echo $success; ?>';
            // Add any additional actions you want to perform after a successful submission
         }, function (error) {
            console.log('Failed to send', error);
            statusMessage.innerHTML = '<?php echo $error; ?>';
            // Add any error handling here
         });
   });
</script>

<?php 
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		