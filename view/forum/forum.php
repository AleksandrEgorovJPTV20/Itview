<!-- Forum -->
<?php
	ob_start();
    $host = explode('?', $_SERVER['REQUEST_URI']);
    $path = $host[0];
    $num = substr_count($path, '/');
    $route = explode('/', $path)[$num];
?>
<!-- HTML section -->
<div id="forum" class="forum about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">
            <form class="d-flex justify-content-center align-items-center my-4" data-aos="fade-up" data-aos-delay="200">
                <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white; width: 60%;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Otsi teemasid' : 'Search topics') ;?>">
            </form>
            <?php 
                $i=0;
                foreach($topics as $topic){
                    $i++;
                }
            ?>
            <div class="navbar" style="display: flex; flex-wrap: wrap; justify-content: left; margin-bottom: 10px;"> 
              <a type="button" style="border: none; margin: 0px; margin-right: 10px; color: white;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#rulesModal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Reeglid' : 'Rules') ;?></a>
              <h2><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kokku teemasid -' : 'Total topics -') ;?>  
              <?php 
                  if($searchQuery){
                      echo $i;
                  }else{
                      echo $totalItems;
                  }
              ?>
              </h2>
            </div>
            <div class="col-lg-6 d-flex" style="padding: 10px 20px; justify-content: space-around; border-radius: 10px; background: #63BDFF; width: 100%; margin-bottom: 10px; flex-wrap: wrap; text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <h2 style="font-size: 30px; padding-top: 10px; flex-basis: 25%;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Autor' : 'Author') ;?></h2>
                <h2 style="font-size: 30px; padding-top: 10px; flex-basis: 25%;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teema' : 'Topic') ;?></h2>
                <h2 style="font-size: 30px; padding-top: 10px; flex-basis: 25%;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Postitused' : 'Posts') ;?></h2>
                <?php 
                if(!isset($_SESSION['userId'])){
                    echo '<div class="navbar forum-button text-center text-lg-start description" style="display: flex; justify-content: center; flex-wrap: wrap;">
                            <a type="button" style="border: none; margin: 0px; color: white;" class="getstarted scrollto" data-toggle="modal" data-target="#loginModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Logi sisse teema loomiseks' : 'Login to create Topic') . '</a>
                        </div>';
                  }else{
                    echo '<div class="navbar forum-button text-center text-lg-start description" style="display: flex; justify-content: center; flex-wrap: wrap;">
                            <a type="button" style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#topicModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo teema' : 'Create Topic') . '</a>
                        </div>';
                  }
                ?>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
                <?php
                    if (empty($topics)) {
                        echo '<h2 style="margin-top: 50px; font-size: 30px;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ei leitud teemasid' : 'No topics found') . '</h2>';
                    } else {
                        foreach ($topics as $topic) {
                            $topicId = $topic['id'];
                            $commentCount = isset($commentCounts[$topicId]) ? $commentCounts[$topicId] : 0;
                            echo '<div style=" border: 2px solid #63BDFF; border-radius: 10px;   text-decoration: none; padding: 0px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); text-align: center; color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; align-items: flex-start; flex-wrap: wrap; font-size: 20px;">';
                            echo '<a href="comments?topic=' . $topic['id'] . '" style="color: black; flex-basis: 25%;"><p>'.$topic['username'].'</p></a>';
                            echo '<a href="comments?topic=' . $topic['id'] . '" style="color: black; flex-basis: 25%;"><p>'.$topic['name'].'</p></a>';
                            echo '<a href="comments?topic=' . $topic['id'] . '" style="color: black; flex-basis: 25%;"><p>'.$commentCount.'</p></a>';
                            echo '<div class="navbar forum-button" style="display: flex; justify-content: center; margin-bottom: 10px;">';
                            echo '<a href="comments?topic=' . $topic['id'] . '" class="getstarted scrollto" style="margin: 0px; margin-top: 10px;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kommentaarid' : 'Comments') . '</a>';
                            if (isset($_SESSION['userId']) && $topic['userid'] == $_SESSION['userId']) {
                                echo '<button type="button" 
                                       class="getstarted scrollto edit-topic-link"
                                       style="border: none; margin: 0px 5px; margin-top: 10px; font-size: 16px;" 
                                       data-toggle="modal" 
                                       data-target="#editTopicModal" 
                                       data-topic-id="' . $topic['id'] . '" 
                                       data-topic-name="' . htmlspecialchars($topic['name']) . '" 
                                       data-topic-description="' . htmlspecialchars($topic['description']) . '">
                                       <i class="fas fa-edit"></i>
                                    </button>';

                                echo '<button type="button" 
                                       class="getstarted scrollto delete-topic-link"
                                       style="border: none; margin: 0px; margin-top: 10px; font-size: 16px;" 
                                       data-toggle="modal" 
                                       data-target="#deleteTopicModal" 
                                       data-delete-id="' . $topic['id'] . '">
                                       <i class="fas fa-trash"></i>
                                    </button>';
                            }
                            echo '</div>';
                            if(!empty($topic['description'])){
                              echo '<hr style="width: 100%; margin: 0px!important;">';
                              echo '<div style="flex-basis: 100%; text-align: justify; margin: 0px; word-break: break-all;"><p>'.$topic['description'].'</p></div>';
                            }
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

<!-- Modal form section -->
<div class="modal fade" id="topicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <form action="forum" method="POST" class="content modal-forms">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo teema' : 'Create topic') ;?></h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['createMessage'])) {echo $_SESSION['createMessage']; unset($_SESSION['createMessage']);} ?>
              </p>
              <div class="mb-3">
                    <?php 
                        if (!empty($page) && $route == 'forum') {
                            if (!empty($searchQuery)) {
                                $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?search=' . $searchQuery . '">';
                            } else {
                                $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?page=' . $page . '">';
                            }
                            echo $redirectValue;
                        }
                    ?>
                <input type="text" name="name" class="form-control" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta teema nimi' : 'Enter topic name') ;?>" style="margin: 20px 0px;" required>
              </div>
              <div class="mb-3">
                <textarea class="topicDescription" name="description"></textarea>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px; margin-top: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo' : 'Create') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editTopicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <form action="forum" method="POST" class="content modal-forms">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda teemat' : 'Edit topic') ;?></h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['editTopicMessage'])) {echo $_SESSION['editTopicMessage']; unset($_SESSION['editTopicMessage']);} ?>
              </p>
              <div class="mb-3">
                <input type="hidden" name="topicId" value="">
                    <?php 
                        if (!empty($page) && $route == 'forum') {
                            if (!empty($searchQuery)) {
                                $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?search=' . $searchQuery . '">';
                            } else {
                                $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?page=' . $page . '">';
                            }
                            echo $redirectValue;
                        }
                    ?>
                <input type="text" name="name" class="form-control" placeholder="Enter topic name" style="margin: 20px 0px;" required>
              </div>
              <div class="mb-3">
                <textarea class="editTopicDescription" id="editTopicDescription" name="description"></textarea>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px; margin-top: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Uuenda' : 'Update') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteTopicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <form action="forum" method="POST" class="content modal-forms">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta teema' : 'Delete topic') ;?></h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['deleteTopicMessage'])) {echo $_SESSION['deleteTopicMessage']; unset($_SESSION['deleteTopicMessage']);} ?>
              </p>
              <div class="mb-3">
                <input type="hidden" name="deleteId" value="">
                    <?php 
                        if (!empty($page) && $route == 'forum') {
                            if (!empty($searchQuery)) {
                                $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?search=' . $searchQuery . '">';
                            } else {
                                $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . '?page=' . $page . '">';
                            }
                            echo $redirectValue;
                        }
                    ?>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta' : 'Delete') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="rulesModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <form action="forum" method="POST" class="content modal-forms">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Reeglid' : 'Rules') ;?></h1>
              <p style="text-align: center; color: #013289;">
              </p>
              <div class="mb-3">
                <p style="text-align: justify; color: #013289; font-size: 22px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? '1. Ärge postitage sobimatuid kommentaare.' : '1. Do not post inappropriate comments.'); ?></p>
                <p style="text-align: justify; color: #013289; font-size: 22px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? '2. Ärge jagage sisu, mis on mitte sobivad töökohas vaatamiseks (NSFW).' : '2. Do not share content not suitable for viewing in the workplace (NSFW).'); ?></p>
                <p style="text-align: justify; color: #013289; font-size: 22px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? '3. Ärge kasutage vihkamissõnu või -keelt.' : '3. Do not use hate speech.'); ?></p>
                <p style="text-align: justify; color: #013289; font-size: 22px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? '4. Ole lugupidav teiste kasutajate suhtes.' : '4. Be respectful towards other users.'); ?></p>
                <p style="text-align: justify; color: #013289; font-size: 22px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? '5. Ärge reklaamige ega levitage rämpsposti.' : '5. Do not advertise or distribute spam.'); ?></p>
              </div>
              <div class="navbar text" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button type="button" class="getstarted scrollto" style="border: none; margin-left: 0px!important;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

<!-- Script section -->
<script>
    $(document).ready(function() {
      $('.topicDescription').richText();
      $('.editTopicDescription').richText();
  });
        
  $('.edit-topic-link').on('click', function() {
    var topicId = $(this).data('topic-id');
    var topicName = $(this).data('topic-name');
    var topicDescription = $(this).data('topic-description');

    $('#editTopicModal input[name="topicId"]').val(topicId);
    $('#editTopicModal input[name="name"]').val(topicName);
    $('#editTopicDescription').val(topicDescription);
    $('.richText-editor').html(topicDescription);
  });

  $('#editTopicModal').on('hidden.bs.modal', function() {
    $('#editTopicModal input[name="topicId"]').val('');
    $('#editTopicModal input[name="name"]').val('');
    $('#editTopicDescription').val('');
    $('.richText-editor').html('');
  });

  $('.delete-topic-link').on('click', function() {
    var topicId = $(this).data('delete-id');
    $('#deleteTopicModal input[name="deleteId"]').val(topicId);
  });

  $('#deleteTopicModal').on('hidden.bs.modal', function() {
    $('#deleteTopicModal input[name="deleteId"]').val('');
  });
</script>




<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		