<!-- Forum -->
<?php
	ob_start();
?>

<div id="forum" class="forum about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">
            <form class="d-flex justify-content-center align-items-center my-4" data-aos="fade-up" data-aos-delay="200">
                <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white; width: 60%;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Otsi teemasid' : 'Search topics') ;?>">
            </form>
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
                            echo '<div style="flex-basis: 25%;"><p>'.$topic['username'].'</p></div>';
                            echo '<div style="flex-basis: 25%;"><p>'.$topic['name'].'</p></div>';
                            echo '<div style="flex-basis: 25%;"><p>'.$commentCount.'</p></div>';
                            echo '<div class="navbar forum-button" style="display: flex; justify-content: center;">';
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
                            
                                // Add Delete button with icon
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
                              echo '<hr style="width: 100%; margin: 10px 0;">';
                              echo '<div style="flex-basis: 100%; text-align: justify; margin: 0px;"><p>'.$topic['description'].'</p></div>';
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


<div class="modal fade" id="topicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none; margin-left: 15px;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="forum" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo teema' : 'Create topic') ;?></h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['createMessage'])) {echo $_SESSION['createMessage']; unset($_SESSION['createMessage']);} ?>
              </p>
              <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta teema nimi' : 'Enter topic name') ;?>" style="margin: 20px 0px;" required>
              </div>
             <div class="mb-3">
                  <div class="style-buttons" style="margin: 5px; justify-content: center;">
                        <button type="button" onclick="applyStyleDescription('italic', 'topicInputDescription')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kursiiv' : 'Italic') ;?></button>
                        <button type="button" onclick="applyStyleDescription('bold', 'topicInputDescription')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Rasvane' : 'Bold') ;?></button>
                        <button type="button" onclick="applyStyleDescription('underline', 'topicInputDescription')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Allajoonitud' : 'Underline') ;?></button>
                        <button type="button" onclick="applyLinkDescription('topicInputDescription')">Link</button>
                        <input type="color" id="colorPickerDescription" onchange="applyColorDescription('topicInputDescription')">
                    </div>
                    <div id="topicInputDescription" contenteditable="true" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 8px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta teemade kirjeldus' : 'Enter topics description') ;?></div>
              </div>
              <div class="mb-3">
                      <div class="style-buttons" style="margin: 5px; justify-content: center;">
                        <button type="button" onclick="applyStyleComment('italic', 'commentInput')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kursiiv' : 'Italic') ;?></button>
                        <button type="button" onclick="applyStyleComment('bold', 'commentInput')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Rasvane' : 'Bold') ;?></button>
                        <button type="button" onclick="applyStyleComment('underline', 'commentInput')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Allajoonitud' : 'Underline') ;?></button>
                        <button type="button" onclick="applyLinkComment('commentInput')">Link</button>
                        <input type="color" id="colorPickerComment" onchange="applyColorComment('commentInput')">
                      </div>
                    <div id="commentInput" contenteditable="true" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 8px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta teemakommentaar (mitte kohustuslik)' : 'Sisesta topics comment (not neccessary)') ;?></div>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo' : 'Create') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
            <input type="hidden" id="rawTopicInputDescription" name="description">
            <input type="hidden" id="rawCommentInput" name="comment">
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editTopicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none; margin-left: 15px;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="forum" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda teemat' : 'Edit topic') ;?></h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['editTopicMessage'])) {echo $_SESSION['editTopicMessage']; unset($_SESSION['editTopicMessage']);} ?>
              </p>
              <div class="mb-3">
              <input type="hidden" name="topicId" value="">
                <input type="text" name="name" class="form-control" placeholder="Enter topic name" style="margin: 20px 0px;" required>
              </div>
             <div class="mb-3">
                      <div class="style-buttons" style="margin: 5px; justify-content: center;">
                        <button type="button" onclick="applyStyleDescriptionEdit('italic', 'topicInputDescriptionEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kursiiv' : 'Italic') ;?></button>
                        <button type="button" onclick="applyStyleDescriptionEdit('bold', 'topicInputDescriptionEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Rasvane' : 'Bold') ;?></button>
                        <button type="button" onclick="applyStyleDescriptionEdit('underline', 'topicInputDescriptionEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Allajoonitud' : 'Underline') ;?></button>
                        <button type="button" onclick="applyLinkDescriptionEdit('topicInputDescriptionEdit')">Link</button>
                        <input type="color" id="colorPickerDescriptionEdit" onchange="applyColorDescriptionEdit('topicInputDescriptionEdit')">
                      </div>
                    <div id="topicInputDescriptionEdit" contenteditable="true" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 8px;"></div>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Uuenda' : 'Update') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
            <input type="hidden" id="rawTopicInputDescriptionEdit" name="description">
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteTopicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none; margin-left: 15px;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="forum" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta teema' : 'Delete topic') ;?></h1>
              <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['deleteTopicMessage'])) {echo $_SESSION['deleteTopicMessage']; unset($_SESSION['deleteTopicMessage']);} ?>
              </p>
              <div class="mb-3">
              <input type="hidden" name="deleteId" value="">
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta' : 'Delete') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <script>
  $('.edit-topic-link').on('click', function() {
    var topicId = $(this).data('topic-id');
    var topicName = $(this).data('topic-name');
    var topicDescription = $(this).data('topic-description');

    $('#editTopicModal input[name="topicId"]').val(topicId);
    $('#editTopicModal input[name="name"]').val(topicName);
    $('#editTopicModal input[name="description"]').val(topicDescription);
    $('#topicInputDescriptionEdit').html(topicDescription);
  });

  $('#editTopicModal').on('hidden.bs.modal', function() {
    $('#editTopicModal input[name="topicId"]').val('');
    $('#editTopicModal input[name="name"]').val('');
    $('#editTopicModal input[name="description"]').val('');
    $('#topicInputDescriptionEdit').html('');
  });

  $('.delete-topic-link').on('click', function() {
    var topicId = $(this).data('delete-id');
    $('#deleteTopicModal input[name="deleteId"]').val(topicId);
  });

  $('#deleteTopicModal').on('hidden.bs.modal', function() {
    $('#deleteTopicModal input[name="deleteId"]').val('');
  });
</script>

<script>
    function applyStyleDescription(style, elementId) {
        const descriptionInput = document.getElementById(elementId);
        document.execCommand(style, false, null);
        updateRawInputDescription(elementId);
    }

    function applyLinkDescription(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const linkURL = prompt('Enter the link URL:');
        if (linkURL) {
          // Check if the link is absolute (starts with http://, https://, or //)
          const isAbsolute = linkURL.startsWith('http://') || linkURL.startsWith('https://') || linkURL.startsWith('//');
          // If not absolute, prepend with 'http://'
          const absoluteLink = isAbsolute ? linkURL : 'http://' + linkURL;
          document.execCommand('createLink', false, absoluteLink);
        }
        updateRawInputDescription(elementId);
    }

    function applyColorDescription(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const colorValue = document.getElementById('colorPickerDescription').value;
        document.execCommand('foreColor', false, colorValue);
        updateRawInputDescription(elementId);
    }

    function updateRawInputDescription(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const rawInput = document.getElementById('rawTopicInputDescription');
        rawInput.value = descriptionInput.innerHTML;
    }

    // Add an event listener to trigger updateRawInputDescription on text input
    document.getElementById('topicInputDescription').addEventListener('input', function () {
      updateRawInputDescription('topicInputDescription');
    });
</script>

<script>
    function applyStyleComment(style, elementId) {
        const commentInput = document.getElementById(elementId);
        document.execCommand(style, false, null);
        updateRawInputComment(elementId);
    }

    function applyLinkComment(elementId) {
        const commentInput = document.getElementById(elementId);
        const linkURL = prompt('Enter the link URL:');
        if (linkURL) {
          // Check if the link is absolute (starts with http://, https://, or //)
          const isAbsolute = linkURL.startsWith('http://') || linkURL.startsWith('https://') || linkURL.startsWith('//');
          // If not absolute, prepend with 'http://'
          const absoluteLink = isAbsolute ? linkURL : 'http://' + linkURL;
          document.execCommand('createLink', false, absoluteLink);
        }
        updateRawInputComment(elementId);
    }

    function applyColorComment(elementId) {
        const commentInput = document.getElementById(elementId);
        const colorValue = document.getElementById('colorPickerComment').value;
        document.execCommand('foreColor', false, colorValue);
        updateRawInputComment(elementId);
    }

    function updateRawInputComment(elementId) {
        const commentInput = document.getElementById(elementId);
        const rawInput = document.getElementById('rawCommentInput');
        rawInput.value = commentInput.innerHTML;
    }

    // Add an event listener to trigger updateRawInputComment on text input
    document.getElementById('commentInput').addEventListener('input', function () {
      updateRawInputComment('commentInput');
    });
</script>

<script>
    function applyStyleDescriptionEdit(style, elementId) {
        const descriptionInput = document.getElementById(elementId);
        document.execCommand(style, false, null);
        updateRawInputDescriptionEdit(elementId);
    }

    function applyLinkDescriptionEdit(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const linkURL = prompt('Enter the link URL:');
        if (linkURL) {
          // Check if the link is absolute (starts with http://, https://, or //)
          const isAbsolute = linkURL.startsWith('http://') || linkURL.startsWith('https://') || linkURL.startsWith('//');
          // If not absolute, prepend with 'http://'
          const absoluteLink = isAbsolute ? linkURL : 'http://' + linkURL;
          document.execCommand('createLink', false, absoluteLink);
        }
        updateRawInputDescriptionEdit(elementId);
    }

    function applyColorDescriptionEdit(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const colorValue = document.getElementById('colorPickerDescriptionEdit').value;
        document.execCommand('foreColor', false, colorValue);
        updateRawInputDescriptionEdit(elementId);
    }

    function updateRawInputDescriptionEdit(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const rawInput = document.getElementById('rawTopicInputDescriptionEdit');
        rawInput.value = descriptionInput.innerHTML;
    }

    // Add an event listener to trigger updateRawInputDescriptionEdit on text input
    document.getElementById('topicInputDescriptionEdit').addEventListener('input', function () {
        updateRawInputDescriptionEdit('topicInputDescriptionEdit');
    });
</script>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		