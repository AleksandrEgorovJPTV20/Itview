<!-- Forum comments -->
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
                <?php
                    // Assuming $topicId contains the current topic ID
                    echo '<input type="hidden" name="topic" value="' . $topicId . '">';
                ?>
                <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white; width: 60%;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Otsi kommentaari' : 'Search comment');?>">
            </form>
            <?php 
                $i=0;
                foreach($comments as $comment){
                    $i++;
                }
            ?>
            <div class="navbar" style="display: flex; flex-wrap: wrap; justify-content: left; margin-bottom: 10px;"> 
            <a type="button" style="border: none; margin: 0px; margin-right: 10px; color: white;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#rulesModal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Reeglid' : 'Rules') ;?></a>
            <h2><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kokku kommentaare -' : 'Total comments -') ;?> 
            <?php 
                if($searchQuery){
                    echo $i;
                }else{
                    echo $totalItems;
                }
            ?>
            </h2>
            </div>
            <div class="col-lg-6 d-flex button-text-container" data-aos="fade-up" data-aos-delay="200">
                <h2 style="font-size: 30px; padding-top: 10px; flex-basis: 20%;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Autor' : 'Author');?></h2>
                <h2 style="font-size: 30px; padding-top: 10px; flex-basis: 30%;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Postitused' : 'Posts');?></h2>
                <?php 
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
                ?>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
            <?php
                if (empty($comments)) {
                    echo '<h2 style="margin-top: 50px; font-size: 30px;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ei leitud kommentaare' : 'No comments found') . '</h2>';
                } else {
                    foreach($topicName as $name){
                        echo '<h2 style="text-align: center; margin-bottom: 10px;">'.$name['name'].'</h2>';
                    }
                    foreach ($comments as $comment) {
                        echo '<div style="border: 2px solid #63BDFF; border-radius: 10px;  text-decoration: none; padding: 10px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; flex-wrap: wrap; font-size: 20px;">';
                        echo '<a href="profile?user=' . $comment['userid'] . '" style="flex-basis: 20%; text-align: center;"><img style="width: 152px; height: 158px; margin-top: 10px; border-radius: 50%;" src="' . $comment['userimg'] . '"></img></a>';
                        echo '<div class="comment">
                                <p style="margin: 0; margin-top: 10px;">' . $comment['username'] . '</p>
                                <p style="font-size: 16px; margin: 0;">' . $comment['created_at'] . '</p>
                                <p class="">' . $comment['text'] . '</p>';
                        
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
                        echo '<a href="replies?comment=' . $comment['id'] . '" style="border: none; margin: 0px; margin-top: 10px; color: white;" class="getstarted scrollto">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vastused' : 'Replies') . '</a>';
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
                                        class="getstarted edit-comment-link">
                                        <i class="fas fa-edit"></i>
                                    </button>';
                                echo '<button type="button" 
                                      style="border: none; margin: 0px; color: white; height: 43px; font-size: 16px; margin-top: 10px;" 
                                      data-toggle="modal" 
                                      data-target="#deleteCommentModal" 
                                      data-delete-id="' . $comment['id'] . '" 
                                      class="getstarted delete-comment-link">
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

<!-- Modal form section -->
<div class="modal fade" id="commentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
            <form action="comments?topic=<?php echo $topicId; ?>" method="POST" class="content modal-forms" enctype="multipart/form-data">
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
                </div>
                <div class="mb-3">
                    <label class="commentLabel" style="text-align: center; color: #013289;"></label>
                    <textarea class="commentDescription" id="comment" name="comment" required></textarea>
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
                    <button style="margin: 0px; border: none;" variant="primary" type="send" name="send" class="getstarted" id="createCommentBtn"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Loo' : 'Create') ;?></button>
                    <button type="button" class="getstarted" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editCommentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
            <form action="comments?topic=<?php echo $topicId; ?>" method="POST" class="content modal-forms" enctype="multipart/form-data">
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
                </div>
                <div class="mb-3">
                    <textarea class="editComment" id="editComment" name="comment"></textarea>
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
                    <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Uuenda' : 'Update') ;?></button>
                    <button type="button" class="getstarted" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
                </div>
            </form>
        </div>
    </div>
</div>

  <div class="modal fade" id="deleteCommentModal"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <form action="comments?topic=<?php echo $topicId; ?>" method="POST" class="content modal-forms">
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
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta' : 'Delete') ;?></button>
                <button type="button" class="getstarted" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
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
                <button type="button" class="getstarted" style="border: none; margin-left: 0px!important;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>


<!-- Script section -->  
<script>
    // Function to check textarea and fill label if empty
    function checkTextareaAndFillLabel() {
        const commentTextarea = document.getElementById('comment');
        const commentLabel = document.querySelector('.commentLabel');

        if (commentTextarea.value.trim() === '') {
            commentLabel.textContent = <?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? "'Sisesta oma kommentaar siia...'" : "'Enter your comment here...'"); ?>;
        } else {
            commentLabel.textContent = '';
        }
    }

    // Add event listener to the button
    document.getElementById('createCommentBtn').addEventListener('click', function() {
        checkTextareaAndFillLabel();
    });
</script>

<script>
    $(document).ready(function() {
        $('.commentDescription').richText();
        $('.editComment').richText();
    });
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
        $('#editComment').val(commentText);
        $('.richText-editor').html(commentText);

        // Display image previews inside selectedImagesContainerEdit
        displayImagePreview(imgpath, 'editImageInput1');
        displayImagePreview(imgpath2, 'editImageInput2');
        displayImagePreview(imgpath3, 'editImageInput3');
    });

    // Clear form fields and image previews when the modal is closed
    $('#editCommentModal').on('hidden.bs.modal', function() {
        $('#editCommentModal input[name="commentId"]').val('');
        $('#editComment').val('');
        $('.richText-editor').html('');
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


<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		