<!-- Forum comments -->
<?php
	ob_start();
    $host = explode('?', $_SERVER['REQUEST_URI']);
    $path = $host[0];
    $num = substr_count($path, '/');
    $route = explode('/', $path)[$num];
?>

<div id="forum" class="forum about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">
            <form class="d-flex justify-content-center align-items-center my-4" data-aos="fade-up" data-aos-delay="200">
                <?php
                    // Assuming $topicId contains the current topic ID
                    echo '<input type="hidden" name="topic" value="' . $topicId . '">';
                ?>
                <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white; width: 60%;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Otsi kommentaari' : 'Search comment');?>">
            </form>
            <div class="col-lg-6 d-flex" style="padding: 10px 0px; justify-content: space-around; border-radius: 10px; background: #63BDFF; width: 100%; margin-bottom: 10px; flex-wrap: wrap; text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <h2 style="font-size: 30px; padding-top: 10px; flex-basis: 20%;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Autor' : 'Author');?></h2>
                <h2 style="font-size: 30px; padding-top: 10px; flex-basis: 30%;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Postitused' : 'Posts');?></h2>
                <?php 
                if($topicId != 1 || isset($_SESSION['role']) && $_SESSION['role'] == 'admin' ){
                    if(!isset($_SESSION['userId'])){
                        echo '<div class="navbar description text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap;">
                                <a type="button" style="border: none; margin: 0px; color: white;" class="getstarted scrollto" data-toggle="modal" data-target="#loginModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Logi sisse kommentaarideks' : 'Login to comment') . '</a>
                                <a href="/forum" type="button" style="border: none; margin: 0px; margin-left: 5px; color: white;" class="getstarted scrollto">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Tagasi' : 'Back') . '</a>
                            </div>';
                    }else{
                        echo '<div class="navbar description text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap;">
                                <a type="button" style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#commentModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo kommentaar' : 'Create Comment') . '</a>
                                <a href="/forum" type="button" style="border: none; margin: 0px; margin-left: 5px; color: white;" class="getstarted scrollto">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Tagasi' : 'Back') . '</a>
                            </div>';
                    }
                }else{
                    echo '<div class="navbar description text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap;">
                    <a href="/forum" type="button" style="border: none; margin: 0px; margin-left: 5px; color: white;" class="getstarted scrollto">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Tagasi' : 'Back') . '</a>
                    </div>';                 
                }
                ?>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
            <?php
                if (empty($comments)) {
                    echo '<h2 style="margin-top: 50px; font-size: 30px;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ei leitud kommentaare' : 'No comments found') . '</h2>';
                } else {
                    foreach ($comments as $comment) {
                        echo '<div style="border: 2px solid #63BDFF; border-radius: 10px;  text-decoration: none; padding: 10px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; flex-wrap: wrap; font-size: 20px;">';
                        echo '<a href="profile?user=' . $comment['userid'] . '" style="flex-basis: 20%; text-align: center;"><img style="width: 152px; height: 158px; margin-top: 10px; border-radius: 50%;" src="' . $comment['userimg'] . '"></img></a>';
                        echo '<div class="comment">
                                <p style="margin: 0; margin-top: 10px;">' . $comment['username'] . '</p>
                                <p style="font-size: 16px; margin: 0;">' . $comment['created_at'] . '</p>
                                <p>' . $comment['text'] . '</p>';
                        
                        // Check and include the image containers
                        if (!empty($comment['imgpath'])) {
                            echo '<img style="width: 120px; height: 120px; cursor: pointer;" src="' . $comment['imgpath'] . '" onclick="openLightbox(\'' . $comment['imgpath'] . '\')">';
                        }
                        if (!empty($comment['imgpath2'])) {
                            echo '<img style="width: 120px; height: 120px; cursor: pointer; margin: 0px 10px;" src="' . $comment['imgpath2'] . '" onclick="openLightbox(\'' . $comment['imgpath2'] . '\')">';
                        }
                        if (!empty($comment['imgpath3'])) {
                            echo '<img style="width: 120px; height: 120px; cursor: pointer;" src="' . $comment['imgpath3'] . '" onclick="openLightbox(\'' . $comment['imgpath3'] . '\')">';
                        }
                        
                        echo '</div>';
                        echo '<div style="display: flex; align-items: flex-end; justify-content: center;" class="navbar text-center text-lg-start comment-button">';
                        echo '<a href="comments?replies=' . $comment['id'] . '" style="border: none; margin: 0px; margin-top: 10px; color: white;" class="getstarted scrollto">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vastused' : 'Replies') . '</a>';
                        if (isset($_SESSION['userId'])) {
                            if ($comment['userid'] == $_SESSION['userId']) {
                                echo '<button type="button" 
                                        style="border: none; margin: 0px 5px; color: white; height: 43px; font-size: 16px; margin-top: 10px;" 
                                        data-toggle="modal" 
                                        data-target="#editCommentModal" 
                                        data-comment-id="' . $comment['id'] . '" 
                                        data-comment-text="' . htmlspecialchars($comment['text']) . '" 
                                        data-imgpath="' . (!empty($comment['imgpath']) ? $comment['imgpath'] : '') . '"
                                        data-imgpath2="' . (!empty($comment['imgpath2']) ? $comment['imgpath2'] : '') . '"
                                        data-imgpath3="' . (!empty($comment['imgpath3']) ? $comment['imgpath3'] : '') . '"
                                        class="getstarted scrollto edit-comment-link">
                                        <i class="fas fa-edit"></i>
                                    </button>';
                                echo '<button type="button" 
                                      style="border: none; margin: 0px; color: white; height: 43px; font-size: 16px; margin-top: 10px;" 
                                      data-toggle="modal" 
                                      data-target="#deleteCommentModal" 
                                      data-delete-id="' . $comment['id'] . '" 
                                      class="getstarted scrollto delete-comment-link">
                                      <i class="fa fa-trash"></i>
                                   </button>';
                            }
                        }
                        echo '</div>';
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
                echo "<a href='/comments?topic={$topicId}&page=$i'>$i</a> ";
            }
        ?>
        </div>
    </div>
</div>


<div class="modal fade" id="commentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
            <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
                <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
            </div>
            <form action="comments?topic=<?php echo $topicId; ?>" onsubmit="return validateCommentForm();" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
                <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo kommentaar' : 'Create comment') ;?></h1>
                <p style="text-align: center; color: #013289;">
                    <?php
                    if (isset($_SESSION['createMessage'])) {
                        echo $_SESSION['createMessage'];
                        unset($_SESSION['createMessage']);
                    }
                    ?>
                </p>
                <div class="mb-3">
                    <?php
                        if (isset($topicId)) {
                            $query = '?topic=' . $topicId;

                            if (!empty($page)) {
                                $query .= '&page=' . $page;
                            }

                            if (!empty($searchQuery)) {
                                $query .= '&search=' . $searchQuery;
                            }

                            $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                            echo $redirectValue;
                        }                  
                    ?>
                    <div class="style-buttons" style="margin: 5px; justify-content: center;">
                        <button type="button" onclick="applyStyle('italic', 'commentInput')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kursiiv' : 'Italic') ;?></button>
                        <button type="button" onclick="applyStyle('bold', 'commentInput')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Rasvane' : 'Bold') ;?></button>
                        <button type="button" onclick="applyStyle('underline', 'commentInput')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Allajoonitud' : 'Underline') ;?></button>
                        <button type="button" onclick="applyLink('commentInput')">Link</button>
                        <input type="color" id="colorPicker" onchange="applyColor('commentInput')">
                    </div>
                    <div id="commentInput" contenteditable="true" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 8px;"></div>
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
                <input type="hidden" id="rawCommentInput" name="comment">
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editCommentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
            <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
                <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
            </div>
            <form action="comments?topic=<?php echo $topicId; ?>" onsubmit="return validateEditCommentForm();" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
                <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda kommentaar' : 'Edit comment') ;?></h1>
                <p style="text-align: center; color: #013289;">
                    <?php
                    if (isset($_SESSION['editCommentMessage'])) {
                        echo $_SESSION['editCommentMessage'];
                        unset($_SESSION['editCommentMessage']);
                    }
                    ?>
                </p>
                <div class="mb-3">
                    <?php
                        if (isset($topicId)) {
                            $query = '?topic=' . $topicId;

                            if (!empty($page)) {
                                $query .= '&page=' . $page;
                            }

                            if (!empty($searchQuery)) {
                                $query .= '&search=' . $searchQuery;
                            }

                            $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                            echo $redirectValue;
                        }                  
                    ?>                    
                    <input type="hidden" name="commentId" value="">
                    <div class="style-buttons" style="margin: 5px; justify-content: center;">
                        <button type="button" onclick="applyEditStyle('italic', 'commentInputEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kursiiv' : 'Italic') ;?></button>
                        <button type="button" onclick="applyEditStyle('bold', 'commentInputEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Rasvane' : 'Bold') ;?></button>
                        <button type="button" onclick="applyEditStyle('underline', 'commentInputEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Allajoonitud' : 'Underline') ;?></button>
                        <button type="button" onclick="applyEditLink('commentInputEdit')">Link</button>
                        <input  type="color" id="colorPickerEdit" onchange="applyEditColor('commentInputEdit')">
                    </div>
                    <div contenteditable="true" id="commentInputEdit" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 6px;"></div>
                    <input type="hidden" name="comment" id="rawCommentInputEdit" required>
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

  <div class="modal fade" id="deleteCommentModal"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="comments?topic=<?php echo $topicId; ?>" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta kommentaar' : 'Delete comment') ;?></h1>
              <p style="text-align: center; color: #013289;">
                <?php
                    if (isset($_SESSION['deleteCommentMessage'])) {
                        echo $_SESSION['deleteCommentMessage'];
                        unset($_SESSION['deleteCommentMessage']);
                    }
                ?>
            </p>
              <div class="mb-3">
                    <?php
                        if (isset($topicId)) {
                            $query = '?topic=' . $topicId;

                            if (!empty($page)) {
                                $query .= '&page=' . $page;
                            }

                            if (!empty($searchQuery)) {
                                $query .= '&search=' . $searchQuery;
                            }

                            $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                            echo $redirectValue;
                        }                  
                    ?>
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

    // Capture the click event on the "Edit comment" link
    $('.edit-comment-link').on('click', function() {
        // Get the comment ID, text, imgpath, imgpath2, and imgpath3 from data attributes
        var commentId = $(this).data('comment-id');
        var commentText = $(this).data('comment-text');
        var imgpath = $(this).data('imgpath');
        var imgpath2 = $(this).data('imgpath2');
        var imgpath3 = $(this).data('imgpath3');

        // Clear existing image previews
        clearImagePreviews();

        // Populate the form fields with the comment ID, text, and image paths
        $('#editCommentModal input[name="commentId"]').val(commentId);
        $('#commentInputEdit').html(commentText);
        $('#rawCommentInputEdit').val(commentText);

        // Display image previews inside selectedImagesContainerEdit
        displayImagePreview(imgpath, 'editImageInput1');
        displayImagePreview(imgpath2, 'editImageInput2');
        displayImagePreview(imgpath3, 'editImageInput3');
    });

    // Clear form fields and image previews when the modal is closed
    $('#editCommentModal').on('hidden.bs.modal', function() {
        $('#editCommentModal input[name="comment"]').val('');
        $('#editCommentModal input[name="commentId"]').val('');
        $('#commentInputEdit').html(''); // Clear the contenteditable div
        // Clear image previews inside selectedImagesContainerEdit
        clearImagePreviews();
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
    const commentInput = document.getElementById('commentInput');
    const languageCreate = '<?php echo isset($_SESSION['language']) ? $_SESSION['language'] : 'en'; ?>';

    // Set placeholder text when the div is clicked
    commentInput.addEventListener('focus', function () {
        const placeholderText = languageCreate === 'est' ? 'Sisesta kommentaari kirjeldus' : 'Enter comment description';
        if (commentInput.textContent.trim() === placeholderText) {
            commentInput.innerHTML = ''; // Clear the placeholder when the user starts typing
        }
    });

    // Clear placeholder text if the div is empty when it loses focus
    commentInput.addEventListener('blur', function () {
        const placeholderText = languageCreate === 'est' ? 'Sisesta kommentaari kirjeldus' : 'Enter comment description';
        if (commentInput.textContent.trim() === '') {
            commentInput.innerHTML = `<div style="color: #aaa;">${placeholderText}</div>`;
        }
    });

    function validateCommentForm() {
        const placeholderText = languageCreate === 'est' ? 'Sisesta kommentaari kirjeldus' : 'Enter comment description';
        // Trim the content and check if it's not empty
        if (commentInput.textContent.trim() === placeholderText) {
            alert(languageCreate === 'est' ? 'Palun sisestage kommentaar enne loomist!' : 'Please enter a comment before creating!');
            return false; // Prevent form submission
        }

        // Update the raw input before submitting
        updateRawInput('commentInput');
        return true; // Allow form submission
    }

    function applyStyle(style, elementId) {
        document.execCommand(style, false, null);
        updateRawInput(elementId);
    }

    function applyLink(elementId) {
        const linkURL = prompt(languageCreate === 'est' ? 'Sisesta lingi URL:' : 'Enter the link URL:');
        if (linkURL) {
            const isAbsolute = linkURL.startsWith('http://') || linkURL.startsWith('https://') || linkURL.startsWith('//');
            const absoluteLink = isAbsolute ? linkURL : 'http://' + linkURL;
            document.execCommand('createLink', false, absoluteLink);
        }
        updateRawInput(elementId);
    }

    function applyColor(elementId) {
        const colorValue = document.getElementById('colorPicker').value;
        document.execCommand('foreColor', false, colorValue);
        updateRawInput(elementId);
    }

    function updateRawInput(elementId) {
        const rawInput = document.getElementById('rawCommentInput');
        const cleanedContent = commentInput.innerHTML.replace(/<br>$/, '');
        rawInput.value = cleanedContent;
    }

    // Initialize placeholder
    const placeholderTextCreate = languageCreate === 'est' ? 'Sisesta kommentaari kirjeldus' : 'Enter comment description';
    if (commentInput.textContent.trim() === '') {
        commentInput.innerHTML = `<div style="color: #aaa;">${placeholderTextCreate}</div>`;
    }

    // Add an event listener to trigger updateRawInput on text input
    commentInput.addEventListener('input', function () {
        updateRawInput('commentInput');
    });
</script>



<script>
    const commentInputEdit = document.getElementById('commentInputEdit');
    const languageEdit = '<?php echo isset($_SESSION['language']) ? $_SESSION['language'] : 'en'; ?>';

    // Set placeholder text when the div is clicked
    commentInputEdit.addEventListener('focus', function () {
        const placeholderTextEdit = languageEdit === 'est' ? 'Sisesta kommentaari kirjeldus' : 'Enter comment description';
        if (commentInputEdit.textContent.trim() === placeholderTextEdit) {
            commentInputEdit.innerHTML = ''; // Clear the placeholder when the user starts typing
        }
    });

    // Clear placeholder text if the div is empty when it loses focus
    commentInputEdit.addEventListener('blur', function () {
        const placeholderTextEdit = languageEdit === 'est' ? 'Sisesta kommentaari kirjeldus' : 'Enter comment description';
        if (commentInputEdit.textContent.trim() === '') {
            commentInputEdit.innerHTML = `<div style="color: #aaa;">${placeholderTextEdit}</div>`;
        }
    });

    function validateEditCommentForm() {
        const placeholderTextEdit = languageEdit === 'est' ? 'Sisesta kommentaari kirjeldus' : 'Enter comment description';
        // Trim the content and check if it's not empty
        if (commentInputEdit.textContent.trim() === placeholderTextEdit) {
            alert(languageEdit === 'est' ? 'Palun sisestage kommentaar enne uuendamist!' : 'Please enter a comment before updating!');
            return false; // Prevent form submission
        }

        // Update the raw input before submitting
        updateRawInputEdit('commentInputEdit');
        return true; // Allow form submission
    }

    function applyEditStyle(style, elementId) {
        document.execCommand(style, false, null);
        updateRawInputEdit(elementId);
    }

    function applyEditLink(elementId) {
        const linkURL = prompt(languageEdit === 'est' ? 'Sisesta lingi URL:' : 'Enter the link URL:');
        if (linkURL) {
            const isAbsolute = linkURL.startsWith('http://') || linkURL.startsWith('https://') || linkURL.startsWith('//');
            const absoluteLink = isAbsolute ? linkURL : 'http://' + linkURL;
            document.execCommand('createLink', false, absoluteLink);
        }
        updateRawInputEdit(elementId);
    }

    function applyEditColor(elementId) {
        const color = document.getElementById('colorPickerEdit').value;
        document.execCommand('foreColor', false, color);
        updateRawInputEdit(elementId);
    }

    function updateRawInputEdit(elementId) {
        const rawInput = document.getElementById('rawCommentInputEdit');
        const cleanedContent = commentInputEdit.innerHTML.replace(/<br>$/, '');
        rawInput.value = cleanedContent;
    }

    // Initialize placeholder
    const placeholderTextEdit = languageEdit === 'est' ? 'Sisesta kommentaari kirjeldus' : 'Enter comment description';
    if (commentInputEdit.textContent.trim() === '') {
        commentInputEdit.innerHTML = `<div style="color: #aaa;">${placeholderTextEdit}</div>`;
    }

    // Add an event listener to trigger updateRawInputEdit on text input
    commentInputEdit.addEventListener('input', function () {
        updateRawInputEdit('commentInputEdit');
    });
</script>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		