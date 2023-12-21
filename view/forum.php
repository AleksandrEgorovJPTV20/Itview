<!-- Register -->
<?php
	ob_start();
?>

<div id="forum" class="about" style="margin: 10% 0%;">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">
            <div style="display: flex; justify-content: center; margin-bottom: 20px;" data-aos="fade-up" data-aos-delay="200">
                <input style="border-radius: 50px; width: 50%; border: none; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: #D9D9D9;" type="search" name="search" class="form-control" style="width: 300px; margin: 20px 0px; margin-right: 100px;">
            </div>
            <div class="col-lg-6 d-flex" style="padding: 0px 20px; justify-content: space-between; border-radius: 10px; background: #63BDFF; width: 100%; height: 100px; margin-bottom: 10px;" data-aos="fade-up" data-aos-delay="200">
                <h2 style="font-size: 30px; padding-top: 30px;  margin-left: 20px;">Author</h2>
                <h2 style="font-size: 30px; padding-top: 30px; ">Topic</h2>
                <h2 style="font-size: 30px; padding-top: 30px; ">Posts</h2>
                <?php 
                if(!isset($_SESSION['userId'])){
                    echo '<div class="navbar" style="display: flex; justify-content: center;">
                            <a type="button" style="margin: 0px; color: white;" class="getstarted scrollto" data-toggle="modal" data-target="#loginModal">Login to create topic</a>
                        </div>';
                  }else{
                    echo '<div class="navbar text-center text-lg-start" style="display: flex; justify-content: center;">
                            <a type="button" style="margin: 0px; color: white;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#topicModal">Create topic</a>
                        </div>';
                  }
                ?>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
                <?php
                    foreach ($alltopics as $topic) {
                        echo '<a href="comments?forum=' . $topic['name'] . '" style="border-radius: 10px; text-decoration: none; padding: 10px 30px; background: #D9D9D9; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-between; font-size: 20px;"><p>' . $topic['username'] . '</p><p>' . $topic['name'] . '</p><p>6</p><p>Description</p></a>';
                    }
                ?>
            </div>
        </div>
        <div class="pagination">
            <?php
            //Pages amount
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='/forum?page=$i'>$i</a> ";
            }
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="topicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0);">
          <div class="content" style="display: flex; justify-content: center; margin: auto; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
            <p style="margin-left: 20px; margin-top: 10px; color: #FFF; text-align: center; font-size: 40px; font-style: normal; font-weight: 600; line-height: normal;">IT View</p>
          </div>
          <form action="login" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289;">Login</h1>
              <div class="mb-3">
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
<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		