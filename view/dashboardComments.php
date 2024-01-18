<!-- Dashboard comments -->
<?php
	ob_start();
?>

<div id="forum" class="forum about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">
          <form class="d-flex justify-content-center align-items-center my-4" data-aos="fade-up" data-aos-delay="200" action="/dashboard" method="GET">
              <input type="hidden" name="comments" value="<?= isset($_GET['comments']) ? $_GET['comments'] : '' ?>">
              <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white; width: 60%;" placeholder="Search comments">
          </form>
          <div class="col-lg-6 d-flex" style="padding: 10px 0px; justify-content: space-around; border-radius: 10px; background: #63BDFF; width: 100%; margin-bottom: 10px; flex-wrap: wrap; text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <h2 style="width: 100%;">Dashboard Control</h2>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto">Topics</a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?comments"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto">Comments</a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?replies"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto">Replies</a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?users"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto">Users</a>
                </div>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
            <?php
                if (empty($comments)) {
                    echo '<h2 style="margin-top: 50px; font-size: 30px;">No comments found</h2>';
                } else {
                    foreach ($comments as $comment) {
                        echo '<div style="border: 2px solid #63BDFF; border-radius: 10px; text-decoration: none; padding: 0px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); text-align: center; color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; align-items: flex-start; flex-wrap: wrap; font-size: 20px;">';
                        echo '<div style="flex-basis: 25%;"><p>Id: '.$comment['id'].'</p></div>';
                        echo '<div style="flex-basis: 25%;"><p>Author: '.$comment['username'].'</p></div>';
                        echo '<div style="flex-basis: 25%;"><p>'.$comment['text'].'</p></div>';
                        echo '<div class="navbar forum-button" style="display: flex; justify-content: center;">';
                        echo '<a href="comments?replies='.$comment['id'].'" style="border: none; margin: 0px; margin-top: 10px; color: white;" class="getstarted scrollto">Replies</a>'; 
                        echo '<a type="button" 
                                style="border: none; margin: 0px 5px; color: white; height: 43px; font-size: 16px; margin-top: 10px;" 
                                data-toggle="modal" 
                                data-target="#editCommentModal" 
                                data-comment-id="' . $comment['id'] . '" 
                                data-comment-text="' . htmlspecialchars($comment['text']) . '" 
                                class="getstarted scrollto edit-comment-link">
                                <i class="fas fa-edit"></i>
                              </a>';
                        echo '<a type="button" 
                              style="border: none; margin: 0px; color: white; height: 43px; font-size: 16px; margin-top: 10px;" 
                              data-toggle="modal" 
                              data-target="#deleteCommentModal" 
                              data-delete-id="' . $comment['id'] . '" 
                              class="getstarted scrollto delete-comment-link">
                              <i class="fa fa-trash"></i>
                          </a>';
                        echo '</div>';
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
                echo "<a href='/dashboard?comments&page=$i'>$i</a> ";
            }
            ?>
        </div>
    </div>
</div>


<div class="modal fade" id="editCommentModal"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 40%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="dashboard?comments" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289;">Edit comment</h1>
              <p style="text-align: center; color: #013289;">
                <?php
                    if (isset($_SESSION['editCommentMessage'])) {
                        echo $_SESSION['editCommentMessage'];
                        unset($_SESSION['editCommentMessage']);
                    }
                ?>
            </p>
              <div class="mb-3">
                    <input type="hidden" name="commentId" value="">
                    <div class="style-buttons" style="margin: 5px;">
                        <button type="button" onclick="applyEditStyle('italic', 'commentInputEdit')">Italic</button>
                        <button type="button" onclick="applyEditStyle('bold', 'commentInputEdit')">Bold</button>
                        <button type="button" onclick="applyEditStyle('underline', 'commentInputEdit')">Underline</button>
                        <button type="button" onclick="applyEditLink('commentInputEdit')">Link</button>
                        <input  type="color" id="colorPickerEdit" onchange="applyEditColor('commentInputEdit')">
                    </div>
                    <div contenteditable="true" id="commentInputEdit" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 6px;"></div>
                    <input type="hidden" name="comment" id="rawCommentInputEdit" required>
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto">Update</button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal">Close</button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteCommentModal"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 40%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="dashboard?comments" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289;">Delete your comment</h1>
              <p style="text-align: center; color: #013289;">
                <?php
                    if (isset($_SESSION['deleteCommentMessage'])) {
                        echo $_SESSION['deleteCommentMessage'];
                        unset($_SESSION['deleteCommentMessage']);
                    }
                ?>
            </p>
              <div class="mb-3">
                  <input type="hidden" name="deleteId" value="">
              </div>
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto">Delete</button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal">Close</button>
            </div>
          </form>
      </div>
    </div>
  </div>
  
  <script>
    // Capture the click event on the "Edit comment" link
    $('.edit-comment-link').on('click', function() {
        // Get the comment ID and text from data attributes
        var commentId = $(this).data('comment-id');
        var commentText = $(this).data('comment-text');

        // Populate the form fields with the comment ID and text
        $('#editCommentModal input[name="commentId"]').val(commentId);

        // Set the comment text to the contenteditable div
        $('#commentInputEdit').html(commentText);

        // Add the comment ID as a hidden input field
        $('#editCommentModal input[name="comment"]').val(commentText);
    });

    // Clear form fields when the modal is closed
    $('#editCommentModal').on('hidden.bs.modal', function() {
        $('#editCommentModal input[name="comment"]').val('');
        $('#editCommentModal input[name="commentId"]').val('');
        $('#commentInputEdit').html(''); // Clear the contenteditable div
    });

    // Capture the click event on the "Delete comment" link
    $('.delete-comment-link').on('click', function() {
        // Get the comment ID from data attribute
        var commentId = $(this).data('delete-id');

        // Set the comment ID in the modal form
        $('#deleteCommentModal input[name="deleteId"]').val(commentId);
    });

    // Clear the comment ID field when the modal is closed
    $('#deleteCommentModal').on('hidden.bs.modal', function() {
        $('#deleteCommentModal input[name="deleteId"]').val('');
    });
</script>

<script>
    function applyEditStyle(style, elementId) {
        const commentInput = document.getElementById(elementId);
        document.execCommand(style, false, null);
        updateRawInput(elementId);
    }

    function applyEditLink(elementId) {
        const commentInput = document.getElementById(elementId);
        const linkURL = prompt('Enter the link URL:');
        if (linkURL) {
            document.execCommand('createLink', false, linkURL);
        }
        updateRawInput(elementId);
    }

    function applyEditColor(elementId) {
        const commentInput = document.getElementById(elementId);
        const color = document.getElementById('colorPickerEdit').value;
        document.execCommand('foreColor', false, color);
        updateRawInput(elementId);
    }

    function updateRawInput(elementId) {
        const commentInput = document.getElementById(elementId);
        const rawInput = document.getElementById('rawCommentInputEdit');
        rawInput.value = commentInput.innerHTML;
    }
    // Add an event listener to trigger updateRawInput on text input
    document.getElementById('commentInputEdit').addEventListener('input', function () {
        updateRawInput('commentInputEdit');
    });
</script>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		