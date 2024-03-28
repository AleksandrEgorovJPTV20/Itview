<!-- Dashboard -->
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
                <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white;  width: 60%;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Otsi teemasid' : 'Search topics') ;?>">
            </form>
            <?php 
                $i=0;
                foreach($topics as $topic){
                    $i++;
                }
            ?>
            <h2><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kokku teemasid -' : 'Total topics -') ;?> 
            <?php 
                if($searchQuery){
                    echo $i;
                }else{
                    echo $totalItems;
                }
            ?>
            </h2>
            <div class="col-lg-6 d-flex button-text-container" data-aos="fade-up" data-aos-delay="200">
                <h2 style="width: 100%;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Juhtpaneeli juhtimine' : 'Dashboard control') ;?></h2>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teemad' : 'Topics') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?comments"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kommentaarid' : 'Comments') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?replies"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vastused' : 'Replies') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?users"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutajad' : 'Users') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?reports"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Aruanded' : 'Reports') ;?></a>
                </div>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
                <?php
                    if (empty($topics)) {
                        echo '<h2 style="margin-top: 50px; font-size: 30px;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ei leitud teemasid' : 'No topics found') . '</h2>';
                    } else {
                        foreach ($topics as $topic) {
                            echo '<div style="border: 2px solid #63BDFF; border-radius: 10px; text-decoration: none; padding: 0px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); text-align: center; color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; align-items: flex-start; flex-wrap: wrap; font-size: 20px;">';
                            echo '<div style="color: black; flex-basis: 100%; text-align: center; margin-bottom: -15px;"><p>'.$topic['created_at'].'</p></div>';
                            echo '<div style="flex-basis: 25%;"><p>ID: '.$topic['id'].'</p></div>';
                            echo '<div style="flex-basis: 25%;"><p>' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Autor' : 'Author') . ': '.$topic['username'].'</p></div>';
                            echo '<div style="flex-basis: 25%;"><p>'.$topic['name'].'</p></div>';
                            echo '<div class="navbar forum-button" style="display: flex; justify-content: center; margin-bottom: 10px;">';
                                echo '<button type="button" 
                                       class="getstarted edit-topic-link"
                                       style="border: none; margin: 0px 5px; margin-top: 10px; font-size: 16px;" 
                                       data-toggle="modal" 
                                       data-target="#editTopicModal" 
                                       data-topic-id="' . $topic['id'] . '" 
                                       data-topic-name="' . htmlspecialchars($topic['name']) . '" 
                                       data-topic-description="' . htmlspecialchars($topic['description']) . '">
                                       <i class="fas fa-edit"></i>
                                    </button>';
                            
                                echo '<button type="button" 
                                       class="getstarted delete-topic-link"
                                       style="border: none; margin: 0px; margin-top: 10px; font-size: 16px;" 
                                       data-toggle="modal" 
                                       data-target="#deleteTopicModal" 
                                       data-delete-id="' . $topic['id'] . '">
                                       <i class="fas fa-trash"></i>
                                    </button>';
                            echo '</div>';
                            if(!empty($topic['description'])){
                              echo '<hr style="width: 100%; margin: 0px!important;">';
                              echo '<div style="flex-basis: 100%; text-align: justify; word-break: break-all;"><p class="read-more">'.$topic['description'].'</p></div>';
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
                echo "<a href='/dashboard?page=$i'>$i</a> ";
            }
            ?>
        </div>
    </div>
</div>


<!-- Modal form section -->
  <div class="modal fade" id="editTopicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <form action="dashboard" method="POST" class="content modal-forms">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda teemat' : 'Edit topic') ;?></h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['editTopicMessage'])) {echo $_SESSION['editTopicMessage']; unset($_SESSION['editTopicMessage']);} ?>
              </p>
              <div class="mb-3">
                  <?php
                      $query = '?';
                      if (!empty($page)) {
                          $query .= '&page=' . $page;
                      }
                      if (!empty($searchQuery)) {
                          $query .= '&search=' . $searchQuery;
                      }

                      $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                      echo $redirectValue;                
                  ?>
                <input type="hidden" name="topicId" value="">
                <input type="text" name="name" class="form-control" placeholder="Enter topic name" style="margin: 20px 0px;" required>
              </div>
              <div class="mb-3">
                <textarea class="editTopicDescription" id="editTopicDescription" name="description"></textarea>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Uuenda' : 'Update') ;?></button>
                <button type="button" class="getstarted" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteTopicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <form action="dashboard" method="POST" class="content modal-forms">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta teema' : 'Delete topic') ;?></h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['deleteTopicMessage'])) {echo $_SESSION['deleteTopicMessage']; unset($_SESSION['deleteTopicMessage']);} ?>
              </p>
              <div class="mb-3">
              <?php
                  $query = '?';
                  if (!empty($page)) {
                      $query .= '&page=' . $page;
                  }
                  if (!empty($searchQuery)) {
                      $query .= '&search=' . $searchQuery;
                  }

                  $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                  echo $redirectValue;                
              ?>
              <input type="hidden" name="deleteId" value="">
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta' : 'Delete') ;?></button>
                <button type="button" class="getstarted" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

<!-- Script section -->
<script>
  $(document).ready(function() {
    $(".read-more").each(function() {
      var $this = $(this);
      var fullText = $this.html(); // Get HTML content of current element
      var truncatedText = fullText.substr(0, 100);

      if (fullText.length > 100) {
        $this.data("full-text", fullText); // Store full text data
        $this.data("truncated-text", truncatedText); // Store truncated text data
        $this.html(truncatedText +''+ "<a href='#' class='read-more-link'> Read more</a>");
      } else {
        $this.html(fullText);
      }
    });

    // Event handler for showing more/less
    $("body").on("click", ".read-more-link", function(event) {
      event.preventDefault();
      var $readMore = $(this).closest(".read-more");
      var fullText = $readMore.data("full-text");
      var isTruncated = !$readMore.hasClass("showing-full");

      if (isTruncated) {
        $readMore.html(fullText + "<a href='#' class='show-less-link'> Read less</a>");
      } else {
        var truncatedText = $readMore.data("truncated-text"); // Retrieve truncated text
        $readMore.html(truncatedText + "<a href='#' class='read-more-link'> Read more</a>");
      }
      $readMore.toggleClass("showing-full");
    });
    
    $("body").on("click", ".show-less-link", function(event) {
      event.preventDefault();
      var $readMore = $(this).closest(".read-more");
      var truncatedText = $readMore.data("truncated-text"); // Retrieve truncated text
      $readMore.html(truncatedText + "<a href='#' class='read-more-link'> Read more</a>");
      $readMore.removeClass("showing-full");
    });
  });

    $(document).ready(function() {
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