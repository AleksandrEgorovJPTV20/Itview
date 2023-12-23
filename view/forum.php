<!-- Forum -->
<?php
	ob_start();
?>

<div id="forum" class="forum about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">
            <form class="d-flex justify-content-center align-items-center my-4" data-aos="fade-up" data-aos-delay="200">
                <input type="search" name="search" class="form-control me-2" style="border-radius: 50px; border: none; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: #D9D9D9; width: 60%;" placeholder="Search topics">
            </form>
            <div class="col-lg-6 d-flex" style="padding: 10px 20px; justify-content: space-around; border-radius: 10px; background: #63BDFF; width: 100%; margin-bottom: 10px; flex-wrap: wrap;" data-aos="fade-up" data-aos-delay="200">
                <h2 style="font-size: 30px; padding-top: 10px;  margin-left: 20px;">Author</h2>
                <h2 style="font-size: 30px; padding-top: 10px; ">Topic</h2>
                <h2 style="font-size: 30px; padding-top: 10px; ">Posts</h2>
                <?php 
                if(!isset($_SESSION['userId'])){
                    echo '<div class="navbar description text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap;">
                            <button type="button" style="border: none; margin: 0px; color: white;" class="getstarted scrollto" data-toggle="modal" data-target="#loginModal">Login to create topic</button>
                        </div>';
                  }else{
                    echo '<div class="navbar description text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap;">
                            <button type="button" style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#topicModal">Create topic</button>
                        </div>';
                  }
                ?>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
                <?php
                    if (empty($topics)) {
                        echo '<h2 style="margin-top: 50px; font-size: 30px;">No topics found</h2>';
                    } else {
                        foreach ($topics as $topic) {
                            echo '<div style="border-radius: 10px; text-decoration: none; padding: 0px 20px; background: #D9D9D9; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); margin: 0px; color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; flex-wrap: wrap; font-size: 20px;">';
                            echo '<div style="margin-left: 20px;"><p>'.$topic['username'].'</p></div>';
                            echo '<div><p>'.$topic['name'].'</p></div>';
                            echo '<div><p>6</p></div>';
                            echo '<div class="description"><p style="flex-grow: 1;">'.$topic['description'].'</p></div>';
                            echo '</div>';
                        }
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
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 40%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
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