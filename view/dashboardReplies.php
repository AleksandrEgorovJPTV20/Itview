<!-- Dashboard replies -->
<?php
	ob_start();
?>

<div id="forum" class="forum about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">
          <form class="d-flex justify-content-center align-items-center my-4" data-aos="fade-up" data-aos-delay="200" action="/dashboard" method="GET">
              <input type="hidden" name="replies" value="<?= isset($_GET['replies']) ? $_GET['replies'] : '' ?>">
              <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white; width: 60%;" placeholder="Search replies">
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
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?reports"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto">Reports</a>
                </div>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
            <?php
                if (empty($replies)) {
                    echo '<h2 style="margin-top: 50px; font-size: 30px;">No replies found</h2>';
                } else {
                    foreach ($replies as $reply) {
                        echo '<div style="border: 2px solid #63BDFF; border-radius: 10px; text-decoration: none; padding: 0px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); text-align: center; color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; align-items: flex-start; flex-wrap: wrap; font-size: 20px;">';
                        echo '<div style="flex-basis: 25%;"><p>Id: '.$reply['id'].'</p></div>';
                        echo '<div style="flex-basis: 25%;"><p>Author: '.$reply['username'].'</p></div>';
                        echo '<div class="navbar forum-button" style="display: flex; justify-content: center;">';
                        echo '<a type="button" 
                                style="border: none; margin: 0px; margin-top: 10px; color: white; height: 43px; margin-right: 5px;" 
                                data-toggle="modal" 
                                data-target="#editReplyModal" 
                                data-reply-id="' . $reply['id'] . '" 
                                data-reply-text="' . htmlspecialchars($reply['text']) . '" 
                                class="getstarted scrollto edit-reply-link">
                                <i class="fas fa-edit"></i>
                                </a>';
                    echo '<a type="button" 
                                style="border: none; margin: 0px; color: white; height: 43px; margin-top: 10px;" 
                                data-toggle="modal" 
                                data-target="#deleteReplyModal" 
                                data-delete-id="' . $reply['id'] . '" 
                                class="getstarted scrollto delete-reply-link">
                                <i class="fa fa-trash"></i>
                            </a>';
                        echo '</div>';
                        echo '<hr style="width: 100%; margin: 10px 0;">';
                        echo '<div style="flex-basis: 100%; text-align: justify;"><p>'.$reply['text'].'</p></div>';
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
                echo "<a href='/dashboard?replies&page=$i'>$i</a> ";
            }
            ?>
        </div>
    </div>
</div>


<div class="modal fade" id="editReplyModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
            <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 40%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
                <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
            </div>
            <form action="dashboard?replies" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                <h1 style="text-align: center; color: #013289;">Edit your reply</h1>
                <p style="text-align: center; color: #013289;">
                    <?php
                    if (isset($_SESSION['editReplyMessage'])) {
                        echo $_SESSION['editReplyMessage'];
                        unset($_SESSION['editReplyMessage']);
                    }
                    ?>
                </p>
                <div class="mb-3">
                    <input type="hidden" name="replyId" value="">
                    <div class="style-buttons" style="margin: 5px; justify-content: center;">
                        <button type="button" onclick="applyEditStyle('italic', 'commentInputEditReply')">Italic</button>
                        <button type="button" onclick="applyEditStyle('bold', 'commentInputEditReply')">Bold</button>
                        <button type="button" onclick="applyEditStyle('underline', 'commentInputEditReply')">Underline</button>
                        <button type="button" onclick="applyEditLink('commentInputEditReply')">Link</button>
                        <input type="color" id="colorPickerEditReply" onchange="applyEditColor('commentInputEditReply')">
                    </div>
                    <div contenteditable="true" id="commentInputEditReply" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 6px;"></div>
                    <!-- Corrected the name attribute to "reply" -->
                    <input type="hidden" name="reply" id="rawCommentInputEditReply" required>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                    <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto">Update</button>
                    <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

  <div class="modal fade" id="deleteReplyModal"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 40%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="dashboard?replies" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289;">Delete reply</h1>
              <p style="text-align: center; color: #013289;">
                <?php
                    if (isset($_SESSION['deleteReplyMessage'])) {
                        echo $_SESSION['deleteReplyMessage'];
                        unset($_SESSION['deleteReplyMessage']);
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
    // Capture the click event on the "Edit reply" link
    $('.edit-reply-link').on('click', function() {
        // Get the reply ID and text from data attributes
        var replyId = $(this).data('reply-id');
        var replyText = $(this).data('reply-text');

        // Populate the form fields with the reply ID and text
        $('#editReplyModal input[name="reply"]').val(replyText);

        // Set the reply text to the contenteditable div
        $('#commentInputEditReply').html(replyText);

        // Add the reply ID as a hidden input field
        $('#editReplyModal input[name="replyId"]').val(replyId);
    });

    // Capture the click event on the "Delete reply" link
    $('.delete-reply-link').on('click', function() {
        // Get the reply ID from data attribute
        var deleteId = $(this).data('delete-id');

        // Add the reply ID to the modal's hidden input field
        $('#deleteReplyModal input[name="deleteId"]').val(deleteId);
    });

    // Clear form fields when the modal is closed
    $('#editReplyModal, #deleteReplyModal').on('hidden.bs.modal', function() {
        $('#editReplyModal input[name="reply"]').val('');
        $('#editReplyModal input[name="replyId"]').val('');
        $('#commentInputEditReply').html(''); // Clear the contenteditable div
        $('#deleteReplyModal input[name="deleteId"]').val('');
    });
</script>

<script>
    function applyEditStyle(style, elementId) {
        const commentInput = document.getElementById(elementId);
        document.execCommand(style, false, null);
        updateRawInputEdit(elementId);
    }

    function applyEditLink(elementId) {
        const commentInput = document.getElementById(elementId);
        const linkURL = prompt('Enter the link URL:');
        if (linkURL) {
          // Check if the link is absolute (starts with http://, https://, or //)
          const isAbsolute = linkURL.startsWith('http://') || linkURL.startsWith('https://') || linkURL.startsWith('//');
          // If not absolute, prepend with 'http://'
          const absoluteLink = isAbsolute ? linkURL : 'http://' + linkURL;
          document.execCommand('createLink', false, absoluteLink);
        }
        updateRawInputEdit(elementId);
    }

    function applyEditColor(elementId) {
        const commentInput = document.getElementById(elementId);
        const color = document.getElementById('colorPickerEditReply').value;
        document.execCommand('foreColor', false, color);
        updateRawInputEdit(elementId);
    }

    function updateRawInputEdit(elementId) {
        const commentInput = document.getElementById(elementId);
        const rawInput = document.getElementById('rawCommentInputEditReply');
        rawInput.value = commentInput.innerHTML;
    }
    // Add an event listener to trigger updateRawInputEditReply on text input
    document.getElementById('commentInputEditReply').addEventListener('input', function () {
        updateRawInputEdit('commentInputEditReply');
    });
</script>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		