<!-- Forum Replies -->
<?php
	ob_start();
?>

<div id="forum" class="forum about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">
            <form class="d-flex justify-content-center align-items-center my-4" data-aos="fade-up" data-aos-delay="200">
                <?php
                    echo '<input type="hidden" name="replies" value="' . $commentId . '">';
                ?>
                <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white; width: 60%;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Otsi vastused' : 'Search replies') ;?>">
            </form>
            <div class="col-lg-6 d-flex" style="padding: 10px 0px; justify-content: space-around; border-radius: 10px; background: #63BDFF; width: 100%; margin-bottom: 10px; flex-wrap: wrap; text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <h2 style="font-size: 30px; padding-top: 10px; flex-basis: 20%;"><?php echo  (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Autor' : 'Author') ;?></h2>
                <h2 style="font-size: 30px; padding-top: 10px; flex-basis: 30%;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Postitused' : 'Posts') ;?></h2>
                <?php 
                if(!isset($_SESSION['userId'])){
                    echo '<div class="navbar description text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap;">
                            <a type="button" style="border: none; margin: 0px; color: white;" class="getstarted scrollto" data-toggle="modal" data-target="#loginModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Logi sisse vastamiseks' : 'Login to reply') . '</a>
                            <a href="/comments?topic='.$originalComment['topicid'].'" type="button" style="border: none; margin: 0px; margin-left: 5px; color: white;" class="getstarted scrollto">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Tagasi' : 'Back') . '</a>
                        </div>';
                  }else{
                    echo '<div class="navbar description text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap;">
                            <a type="button" style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#replyModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo vastus' : 'Create reply') . '</a>
                            <a href="/comments?topic='.$originalComment['topicid'].'" type="button" style="border: none; margin: 0px; margin-left: 5px; color: white;" class="getstarted scrollto">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Tagasi' : 'Back') . '</a>
                        </div>';
                  }
                ?>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
                <?php
                    if (empty($replies)) {
                        echo '<h2 style="margin-top: 50px; font-size: 30px;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ei leitud vastuseid' : 'No replies found') . '</h2>';
                    } else {
                        // Display the original comment
                        echo '<div style="border: 2px solid #63BDFF; border-radius: 10px; text-decoration: none; padding: 10px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; flex-wrap: wrap; font-size: 20px;">';
                        echo '<h2 style="width: 100%; text-align: center;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Algupärane kommentaar' : 'Original Comment') . '</h2>';
                        echo '<a href="profile?user='.$originalComment['userid'].'" style="flex-basis: 20%; text-align: center;"><img style="width: 152px; height: 158px; margin-top: 10px; border-radius: 50%;" src="'.$originalComment['userimg'].'"></img></a>';
                        echo '<div class="comment">
                            <p style="margin: 0; margin-top: 10px;">'.$originalComment['username'].'</p>
                            <p style="font-size: 16px; margin: 0;">'.$originalComment['created_at'].'</p>
                            <p>'.$originalComment['text'].'</p>';
                            if (!empty($originalComment['imgpath'])) {
                                echo '<img style="width: 120px; height: 120px; cursor: pointer;" src="' . $originalComment['imgpath'] . '" onclick="openLightbox(\'' . $originalComment['imgpath'] . '\')">';
                            }
                            if (!empty($originalComment['imgpath2'])) {
                                echo '<img style="width: 120px; height: 120px; cursor: pointer; margin: 0px 10px;" src="' . $originalComment['imgpath2'] . '" onclick="openLightbox(\'' . $originalComment['imgpath2'] . '\')">';
                            }
                            if (!empty($originalComment['imgpath3'])) {
                                echo '<img style="width: 120px; height: 120px; cursor: pointer;" src="' . $originalComment['imgpath3'] . '" onclick="openLightbox(\'' . $originalComment['imgpath3'] . '\')">';
                            }
                        echo '</div>';
                        echo '<div style="flex-basis: 20%; display: flex; align-items: flex-end; justify-content: center;" class="navbar text-center text-lg-start">';
                        echo '</div>';
                        echo '</div>';

                        // Separator
                        echo '<hr style="width: 100%; margin: 20px 0;">';

                        foreach ($replies as $reply) {
                            echo '<div style="border: 2px solid #63BDFF; border-radius: 10px; text-decoration: none; padding: 10px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; flex-wrap: wrap; font-size: 20px;">';
                            echo '<a href="profile?user='.$reply['userid'].'" style="flex-basis: 20%; text-align: center;"><img style="width: 152px; height: 158px; margin-top: 10px; border-radius: 50%;" src="'.$reply['userimg'].'"></img></a>';
                            echo '<div class="comment">
                                <p style="margin: 0; margin-top: 10px;">'.$reply['username'].'</p>
                                <p style="font-size: 16px; margin: 0;">'.$reply['created_at'].'</p>
                                <p>'.$reply['text'].'</p>';
                                if (!empty($reply['imgpath'])) {
                                    echo '<img style="width: 120px; height: 120px; cursor: pointer;" src="' . $reply['imgpath'] . '" onclick="openLightbox(\'' . $reply['imgpath'] . '\')">';
                                }
                                if (!empty($reply['imgpath2'])) {
                                    echo '<img style="width: 120px; height: 120px; cursor: pointer; margin: 0px 10px;" src="' . $reply['imgpath2'] . '" onclick="openLightbox(\'' . $reply['imgpath2'] . '\')">';
                                }
                                if (!empty($reply['imgpath3'])) {
                                    echo '<img style="width: 120px; height: 120px; cursor: pointer;" src="' . $reply['imgpath3'] . '" onclick="openLightbox(\'' . $reply['imgpath3'] . '\')">';
                                }
                            echo '</div>';
                            if (isset($_SESSION['userId'])) {
                                echo '<div style="display: flex; align-items: flex-end; justify-content: center;" class="navbar text-center text-lg-start comment-button">';
                                echo '<a type="button" style="border: none; margin: 5px 5px; margin-bottom: 0px; color: white;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#replyModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vastus' : 'Reply') . '</a>';
                                if ($reply['userid'] == $_SESSION['userId']) {
                                    echo '<button type="button" 
                                             style="border: none; margin: 0px; margin-top: 10px; color: white; height: 43px; margin-right: 5px;" 
                                             data-toggle="modal" 
                                             data-target="#editReplyModal" 
                                             data-reply-id="' . $reply['id'] . '" 
                                             data-reply-text="' . htmlspecialchars($reply['text']) . '" 
                                             data-imgpath="' . (!empty($reply['imgpath']) ? $reply['imgpath'] : '') . '"
                                             data-imgpath2="' . (!empty($reply['imgpath2']) ? $reply['imgpath2'] : '') . '"
                                             data-imgpath3="' . (!empty($reply['imgpath3']) ? $reply['imgpath3'] : '') . '"
                                             class="getstarted scrollto edit-reply-link">
                                             <i class="fas fa-edit"></i>
                                          </button>';
                                echo '<button type="button" 
                                          style="border: none; margin: 0px; color: white; height: 43px; margin-top: 10px;" 
                                          data-toggle="modal" 
                                          data-target="#deleteReplyModal" 
                                          data-delete-id="' . $reply['id'] . '" 
                                          class="getstarted scrollto delete-reply-link">
                                          <i class="fa fa-trash"></i>
                                       </button>';
                                }
                                echo '</div>';
                            } else {
                                echo '<div style="flex-basis: 20%; display: flex; align-items: flex-end; justify-content: center;" class="navbar text-center text-lg-start">
                                <a type="button" style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#loginModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Logi sisse vastamiseks' : 'Login to reply') . '</a>
                                </div>';
                            }
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
        <div class="pagination">
        <?php
            // Pages amount
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='/comments?replies={$commentId}&page=$i'>$i</a> ";
            }
        ?>
        </div>
    </div>
</div>


<div class="modal fade" id="replyModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none; margin-left: 15px;">
            <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
                <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
            </div>
            <form action="comments?replies=<?php echo $commentId; ?>" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
                <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo vastus' : 'Create reply') ;?></h1>
                <p style="text-align: center; color: #013289;">
                    <?php
                    if (isset($_SESSION['replyMessage'])) {
                        echo $_SESSION['replyMessage'];
                        unset($_SESSION['replyMessage']);
                    }
                    ?>
                </p>
                <div class="mb-3">
                    <div class="style-buttons" style="margin: 5px; justify-content: center;">
                        <button type="button" onclick="applyStyle('italic', 'commentInputReply')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kursiiv' : 'Italic') ;?></button>
                        <button type="button" onclick="applyStyle('bold', 'commentInputReply')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Rasvane' : 'Bold') ;?></button>
                        <button type="button" onclick="applyStyle('underline', 'commentInputReply')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Allajoonitud' : 'Underline') ;?></button>
                        <button type="button" onclick="applyLink('commentInputReply')">Link</button>
                        <input type="color" id="colorPickerReply" onchange="applyColor('commentInputReply')">
                    </div>
                    <div id="commentInputReply" contenteditable="true" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 8px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta vastuse kirjeldus' : 'Enter reply description') ;?></div>
                </div>
                <div class="mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="ImageInput1" name="Image1" accept="image/*">
                        <input type="file" class="custom-file-input" id="ImageInput2" name="Image2" accept="image/*" style="display: none;">
                        <input type="file" class="custom-file-input" id="ImageInput3" name="Image3" accept="image/*" style="display: none;">
                        <label class="custom-file-label" for="ImageInput1"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Valige kuni 3 pilti' : 'Choose up to 3 images') ;?></label>
                    </div>
                    <div id="selectedImagesContainer" class="mt-2"></div>
                    <button type="button" class="btn btn-danger mt-2" id="removeImagesBtn" style="display: none;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Eemalda pildid' : 'Remove images') ;?></button>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                    <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo' : 'Create') ;?></button>
                    <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
                </div>
                <!-- Hidden input to store raw HTML content -->
                <input type="hidden" id="rawCommentInputReply" name="comment">
            </form>
        </div>
    </div>
</div>

  <div class="modal fade" id="editReplyModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none; margin-left: 15px;">
            <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
                <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
            </div>
            <form action="comments?replies=<?php echo $commentId; ?>" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
                <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda vastus' : 'Edit reply') ;?></h1>
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
                        <button type="button" onclick="applyEditStyle('italic', 'commentInputEditReply')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kursiiv' : 'Italic') ;?></button>
                        <button type="button" onclick="applyEditStyle('bold', 'commentInputEditReply')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Rasvane' : 'Bold') ;?></button>
                        <button type="button" onclick="applyEditStyle('underline', 'commentInputEditReply')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Allajoonitud' : 'Underline') ;?></button>
                        <button type="button" onclick="applyEditLink('commentInputEditReply')">Link</button>
                        <input type="color" id="colorPickerEditReply" onchange="applyEditColor('commentInputEditReply')">
                    </div>
                    <div contenteditable="true" id="commentInputEditReply" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 6px;"></div>
                    <!-- Corrected the name attribute to "reply" -->
                    <input type="hidden" name="reply" id="rawCommentInputEditReply" required>
                </div>
                <div class="mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="editImageInput1" name="Image1" accept="image/*">
                        <input type="file" class="custom-file-input" id="editImageInput2" name="Image2" accept="image/*" style="display: none;">
                        <input type="file" class="custom-file-input" id="editImageInput3" name="Image3" accept="image/*" style="display: none;">
                        <label class="custom-file-label" for="editImageInput1"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Valige kuni 3 pilti' : 'Choose up to 3 images') ;?></label>
                    </div>
                    <div id="selectedImagesContainerEdit" class="mt-2"></div>
                    <button type="button" class="btn btn-danger mt-2" id="removeImagesBtnEdit" style="display: none;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Eemalda pildid' : 'Remove images') ;?></button>
                    <input type="hidden" name="removeImages" id="removeImagesInput" value="0">
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                    <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Uuenda' : 'Update') ;?></button>
                    <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
                </div>
            </form>
        </div>
    </div>
</div>

  <div class="modal fade" id="deleteReplyModal"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none; margin-left: 15px;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="comments?replies=<?php echo $commentId; ?>" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta vastus' : 'Delete reply') ;?></h1>
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
              <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 15px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta' : 'Delete') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <script>
    // Display image previews inside selectedImagesContainerEdit
    function displayImagePreview(imgpath, inputId) {
        if (imgpath && inputId) {
            var imagePreview = $('<img class="selected-image-preview mb-2" style="width: 100px; height: 100px; margin-right: 5px;" src="' + imgpath + '" alt="Selected Image">');
            $('#selectedImagesContainerEdit').append(imagePreview);
            $('#removeImagesBtnEdit').show();
        }
    }

    // Clear image previews inside selectedImagesContainerEdit
    function clearImagePreviews() {
        $('#selectedImagesContainerEdit').empty();
        $('#removeImagesBtnEdit').hide();
    }

    // Capture the click event on the "Edit reply" link
    $('.edit-reply-link').on('click', function() {
        // Get the reply ID, text, and imgpath from data attributes
        var replyId = $(this).data('reply-id');
        var replyText = $(this).data('reply-text');
        var imgpath = $(this).data('imgpath');
        var imgpath2 = $(this).data('imgpath2');
        var imgpath3 = $(this).data('imgpath3');

        // Clear existing image previews
        clearImagePreviews();

        // Populate the form fields with the reply ID, text, and image path
        $('#editReplyModal input[name="reply"]').val(replyText);
        $('#commentInputEditReply').html(replyText);
        $('#rawCommentInputEditReply').val(replyText);

        // Display image previews inside selectedImagesContainerEdit
        displayImagePreview(imgpath, 'editImageInput1');
        displayImagePreview(imgpath2, 'editImageInput2');
        displayImagePreview(imgpath3, 'editImageInput3');

        // Add the reply ID as a hidden input field
        $('#editReplyModal input[name="replyId"]').val(replyId);
    });

    // Clear form fields and image preview when the modal is closed
    $('#editReplyModal').on('hidden.bs.modal', function() {
        $('#editReplyModal input[name="reply"]').val('');
        $('#editReplyModal input[name="replyId"]').val('');
        $('#commentInputEditReply').html(''); // Clear the contenteditable div

        // Clear image previews inside selectedImagesContainerEditReply
        clearImagePreviews();
    });

    $('.delete-reply-link').on('click', function() {
        var replyId = $(this).data('delete-id');

        $('#deleteReplyModal input[name="deleteId"]').val(replyId);
    });

    $('#deleteReplyModal').on('hidden.bs.modal', function() {
        $('#deleteReplyModal input[name="deleteId"]').val('');
    });
</script>

<script>
    // Function to initialize file input handling for both forms
    function initializeFileInputs(containerSelector, fileInputs, removeImagesBtn, maxImages) {
        // Keep track of selected images
        var selectedImages = [];

        var container = $(containerSelector);
        
        $(fileInputs.join(', ')).on('change', function () {
            var files = getSelectedFiles(); // Get the selected files
            $('#removeImagesInput').val('0');
            removeImagesBtn.hide();

            var fileCount = selectedImages.length + 1;

            // Adjust the file count to a maximum of 3
            fileCount = Math.min(fileCount, maxImages);
            var fileCountText = fileCount + '<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? ' valitud fail(id)' : ' file(s) selected') ;?>';

            if (fileCount > 0) {
                $('.custom-file-label').html(fileCountText);
                removeImagesBtn.show();
            }

            // Iterate through the selected files
            container.empty(); // Clear the container content
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var imagePreview = $('<img class="selected-image-preview mb-2" style="width: 100px; height: 100px; margin-right: 5px;" src="' + e.target.result + '" alt="Selected Image">');
                    container.append(imagePreview);
                };
                reader.readAsDataURL(files[i]);
                // Add the selected images to the array
                selectedImages.push(files[i]);
            }

            // Update the visibility of file inputs and the "Remove Images" button
            updateFileInputsVisibility();
        });

        removeImagesBtn.on('click', function () {
            // Clear the selected images and hide the "Remove Images" button
            container.empty(); // Clear the container content
            $(fileInputs.join(', ')).val('');
            $('.custom-file-label').html('<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Valige kuni 3 pilti' : 'Choose up to 3 files') ;?>'); // Clear the contenteditable div

            removeImagesBtn.hide();

            // Show the first file input
            $(fileInputs[0]).show();
            $('#removeImagesInput').val('1');
            // Enable the file inputs after removing the images
            enableFileInputs();

            // Clear the selected images array
            selectedImages = [];
        });

        function getSelectedFiles() {
            var selectedFiles = [];
            for (var i = 0; i < fileInputs.length; i++) {
                var files = $(fileInputs[i])[0].files;
                selectedFiles = selectedFiles.concat(Array.from(files));
            }
            return selectedFiles;
        }

        function updateFileInputsVisibility() {
            var currentFileCount = getSelectedFiles().length;

            // Hide all file inputs
            $(fileInputs.join(', ')).hide();

            // Show the next file input if not reached the maximum
            if (currentFileCount < maxImages) {
                $(fileInputs[currentFileCount]).show();
            }
        }

        function enableFileInputs() {
            $(fileInputs.join(', ')).prop('disabled', false);
        }
    }

    // Initialize file input handling for the first form
    initializeFileInputs('#selectedImagesContainer', ['#ImageInput1', '#ImageInput2', '#ImageInput3'], $('#removeImagesBtn'), 3);

    // Initialize file input handling for the edit form
    initializeFileInputs('#selectedImagesContainerEdit', ['#editImageInput1', '#editImageInput2', '#editImageInput3'], $('#removeImagesBtnEdit'), 3);
</script>


<script>
    // Function to apply a style to the contenteditable div in the reply modal
    function applyStyle(style, elementId) {
        const commentInput = document.getElementById(elementId);
        document.execCommand(style, false, null);
        updateRawInputReply(elementId);
    }

    // Function to apply a link to the contenteditable div in the reply modal
    function applyLink(elementId) {
        const commentInput = document.getElementById(elementId);
        const linkURL = prompt('Enter the link URL:');
        if (linkURL) {
          // Check if the link is absolute (starts with http://, https://, or //)
          const isAbsolute = linkURL.startsWith('http://') || linkURL.startsWith('https://') || linkURL.startsWith('//');
          // If not absolute, prepend with 'http://'
          const absoluteLink = isAbsolute ? linkURL : 'http://' + linkURL;
          document.execCommand('createLink', false, absoluteLink);
        }
        updateRawInputReply(elementId);
    }

    // Function to apply color to the contenteditable div in the reply modal
    function applyColor(elementId) {
        const commentInput = document.getElementById(elementId);
        const colorValue = document.getElementById('colorPickerReply').value;
        document.execCommand('foreColor', false, colorValue);
        updateRawInputReply(elementId);
    }

    // Function to update the hidden input with the raw HTML content
    function updateRawInputReply(elementId) {
        const commentInput = document.getElementById(elementId);
        const rawInput = document.getElementById('rawCommentInputReply');
        rawInput.value = commentInput.innerHTML;
    }

    // Add an event listener to trigger updateRawInputReply on text input
    document.getElementById('commentInputReply').addEventListener('input', function () {
        updateRawInputReply('commentInputReply');
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