<!-- Register -->
<?php
	ob_start();
?>

<section id="register" class="about" style="margin-top: 10%;">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; ">
            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content" style="display: flex; justify-content: center; margin: auto; height: 84px; width: 65%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
                    <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
                    <p style="margin-left: 20px;color: #FFF; text-align: center; font-size: 40px; font-style: normal; font-weight: 600; line-height: normal;">IT View</p>
                </div>
                <form action="register" method="POST" class="content" style="margin: auto; width: 65%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                    <h1 style="text-align: center; color: #013289;">Register new user</h1>
                    <p style="text-align: center; color: #013289;">
                        <?php if (isset($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);} ?>
                    </p>
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Enter your username" style="margin: 20px 0px;">
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" style="margin: 20px 0px;">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" style="margin-bottom: 20px;">
                    </div>
                    <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center;">
                        <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		