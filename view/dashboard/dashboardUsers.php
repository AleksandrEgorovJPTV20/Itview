<!-- Dashboard users -->
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
          <form class="d-flex justify-content-center align-items-center my-4" data-aos="fade-up" data-aos-delay="200" action="/dashboard" method="GET">
              <input type="hidden" name="users" value="<?= isset($_GET['users']) ? $_GET['users'] : '' ?>">
              <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white; width: 60%;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Otsi kasutajaid' : 'Search users') ;?>">
          </form>
          <div class="col-lg-6 d-flex" style="padding: 10px 0px; justify-content: space-around; border-radius: 10px; background: #63BDFF; width: 100%; margin-bottom: 10px; flex-wrap: wrap; text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <h2 style="width: 100%;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Juhtpaneeli juhtimine' : 'Dashboard control') ;?></h2>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teemad' : 'Topics') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?comments"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kommentaarid' : 'Comments') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?replies"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vastused' : 'Replies') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?users"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutajad' : 'Users') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?reports"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Aruanded' : 'Reports') ;?></a>
                </div>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
            <?php
                if (empty($users)) {
                    echo '<h2 style="margin-top: 50px; font-size: 30px;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ei leitud kasutajaid' : 'No users found') . '</h2>';
                } else {
                    foreach ($users as $user) {
                        // Skip users with the admin role
                        if ($user['role'] === 'admin') {
                            continue;
                        }
                        if ($_SESSION['role'] === 'manager' && $user['role'] === 'manager') {
                            continue;
                        }
                        echo '<div style="border: 2px solid #63BDFF; border-radius: 10px;  text-decoration: none; padding: 10px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; flex-wrap: wrap; font-size: 20px;">';
                        echo '<a href="profile?user=' . $user['id'] . '" style="flex-basis: 20%; text-align: center;"><img style="width: 152px; height: 158px; margin-top: 10px; border-radius: 50%;" src="' . $user['imgpath'] . '"></img></a>';
                        echo '<div class="comment">';
                        echo '<p style="margin: 0; margin-top: 10px;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutaja id' : 'User id') . ': ' . $user['id'];
                        if (!empty($user['banexpiry'])) {
                            echo ', '.$user['username'].' ' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'on keelatud kuni' : 'is banned until') . ': ' . $user['banexpiry'];
                        } else {
                            echo ', '.$user['username'].' ' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'ei ole keelatud' : 'is not banned') . '';
                        }
                        echo '</p>';
                        echo '<p style="margin: 0; margin-top: 10px;">' . $user['email'] . ', ' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Roll' : 'Role') . ': '.$user['role'].'</p>';
                        echo '<p>' . $user['description'] . '</p>';
                        if(!empty($user['twitter'])){
                            echo '<a href="'.$user['twitter'].'" target="_blank"><img style="width: 50px; height: 50px;" src="assets/img/twitter.png" alt="Twitter"></a>';
                        }
                        if(!empty($user['facebook'])){
                            echo '<a href="'.$user['facebook'].'" target="_blank"><img style="width: 50px; height: 50px; margin: 0px 15px;" src="assets/img/facebook.png" alt="Facebook"></a>';
                        }
                        if(!empty($user['instagram'])){
                            echo '<a href="'.$user['instagram'].'" target="_blank"><img style="width: 50px; height: 50px;" src="assets/img/instagram.png" alt="Instagram"></a>';
                        }
                        if(!empty($user['discord'])){
                            echo '<a href="'.$user['discord'].'" target="_blank"><img style="width: 60px; height: 50px; margin-left: 15px;" src="assets/img/discord.png" alt="Discord"></a>';
                        }
                        echo '</div>';
                        echo '<div style="display: flex; align-items: flex-end; justify-content: center;" class="navbar text-center text-lg-start comment-button">';
                        echo '<button type="button" 
                                style="border: none; margin: 0px; margin-top: 10px; color: white; height: 43px; margin-right: 5px;" 
                                data-toggle="modal" 
                                data-target="#editUserModal" 
                                data-user-id="' . $user['id'] . '" 
                                data-username="' . $user['username'] . '"
                                data-email="' . $user['email'] . '"
                                data-description="' . htmlspecialchars($user['description']) . '"
                                data-imgpath="' . $user['imgpath'] . '"
                                data-twitter="' . $user['twitter'] . '"
                                data-instagram="' . $user['instagram'] . '"
                                data-facebook="' . $user['facebook'] . '"
                                data-discord="' . $user['discord'] . '"
                                class="getstarted scrollto edit-user-link">
                                <i class="fas fa-edit"></i>
                                </button>';
                        echo '<button type="button" 
                                style="border: none; margin: 0px; color: white; height: 43px; margin-top: 10px;" 
                                data-toggle="modal" 
                                data-target="#banUserModal" 
                                data-user-id="' . $user['id'] . '" 
                                data-imgpath="' . $user['imgpath'] . '"
                                data-banexpiry="' . $user['banexpiry'] . '"
                                class="getstarted scrollto ban-user-link">
                                <i class="fa fa-ban"></i>
                                </button>';
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
                echo "<a href='/dashboard?users&page=$i'>$i</a> ";
            }
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="dashboard?users" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
            <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda profiil' : 'Edit profile') ;?></h1>
            <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['userEditMessage'])) {echo $_SESSION['userEditMessage']; unset($_SESSION['userEditMessage']);} ?>
            </p>
            <div class="mb-3" style="text-align: center;">
                <?php
                    $query = '?users';

                    if (!empty($page)) {
                        $query .= '&page=' . $page;
                    }

                    if (!empty($searchQuery)) {
                        $query .= '&search=' . $searchQuery;
                    }

                    $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                    echo $redirectValue;                
                ?>
                <input type="hidden" name="userId" value="">
                <img id="userImagePreview" src="" name="image" alt="User Image" style="width: 100px; height: 100px; margin-bottom: 10px; border-radius: 50%;">
            </div>
            <div class="mb-3">
                <input type="text" name="username" class="form-control" style="margin: 20px 0px;" value="">
            </div>
            <?php 
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                echo '<div class="mb-3">
                <input type="email" name="email" class="form-control" style="margin: 20px 0px;" placeholder="Edit email" value="">
                </div>';
            }
            ?>
            <div class="mb-3">
                <div class="style-buttons" style="margin: 5px; justify-content: center;">
                    <button type="button" onclick="applyStyleEditProfile('italic', 'descriptionInputEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kursiiv' : 'Italic') ;?></button>
                    <button type="button" onclick="applyStyleEditProfile('bold', 'descriptionInputEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Rasvane' : 'Bold') ;?></button>
                    <button type="button" onclick="applyStyleEditProfile('underline', 'descriptionInputEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Allajoonitud' : 'Underline') ;?></button>
                    <button type="button" onclick="applyEditLinkProfile('descriptionInputEdit')">Link</button>
                    <input  type="color" id="colorPickerEdit" onchange="applyEditProfileColor('descriptionInputEdit')">
                </div>
                <div contenteditable="true" id="descriptionInputEdit" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 6px;"></div>
                <input type="hidden" name="description" id="rawDescriptionInputEdit" required>
            </div>
            <div class="mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="userImageInput" name="userImage" accept="image/*" onchange="previewImage()">
                    <label class="custom-file-label" for="userImageInput"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Valige profiilipilt' : 'Choose profile picture') ;?></label>
                </div>
            </div>
            <?php 
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                echo '<div class="mb-3">
                    <input type="text" name="password" class="form-control" style="margin: 20px 0px;" placeholder="' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda parool' : 'Edit password') . '">
                </div>';
            }
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                echo '<div class="mb-3">
                <select name="role" class="form-control">
                <option value="user">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutaja' : 'User') . '</option>
                    <option value="manager">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Haldur' : 'Manager') . '</option>
                </select>
            </div>';
            }
            ?>
            <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Uuenda' : 'Update') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal" data-toggle="modal" data-target="#userSocialsModal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sotsiaal' : 'Socials') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="userSocialsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="dashboard?users" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
            <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda sotsiaalmeedia' : 'Edit social media') ;?></h1>
            <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['userEditMessage'])) {echo $_SESSION['userEditMessage']; unset($_SESSION['userEditMessage']);} ?>
            </p>
            <div class="mb-3" style="text-align: center;">
                <?php
                    $query = '?users';

                    if (!empty($page)) {
                        $query .= '&page=' . $page;
                    }

                    if (!empty($searchQuery)) {
                        $query .= '&search=' . $searchQuery;
                    }

                    $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                    echo $redirectValue;                
                ?>
                <input type="hidden" name="userId" value="">
                <img id="userImagePreview" src="" name="image" alt="User Image" style="width: 100px; height: 100px; margin-bottom: 10px; border-radius: 50%;">
            </div>
            <div class="mb-3">
                <input type="text" name="twitter" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Lisa Twitteri link' : 'Add twitter link') ;?>" value="">
            </div>
            <div class="mb-3">
                <input type="text" name="instagram" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Lisa Instagrami link' : 'Add instagram link') ;?>" value="">
            </div>
            <div class="mb-3">
                <input type="text" name="facebook" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Lisa Facebooki link' : 'Add facebook link') ;?>" value="">
            </div>
            <div class="mb-3">
                <input type="text" name="discord" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Add Discordi link' : 'Add discord link') ;?>" value="">
            </div>
            <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Uuenda' : 'Update') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal" data-toggle="modal" data-target="#editUserModal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Tagasi' : 'Back') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="banUserModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
            <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
                <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
            </div>
            <form action="dashboard?users" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Keela kasutaja' : 'Ban user') ;?></h1>
                <p style="text-align: center; color: #013289;">
                    <?php
                    if (isset($_SESSION['banUserMessage'])) {
                        echo $_SESSION['banUserMessage'];
                        unset($_SESSION['banUserMessage']);
                    }
                    ?>
                </p>
                <div class="mb-3">
                    <?php
                        $query = '?users';

                        if (!empty($page)) {
                            $query .= '&page=' . $page;
                        }

                        if (!empty($searchQuery)) {
                            $query .= '&search=' . $searchQuery;
                        }

                        $redirectValue = '<input type="hidden" name="redirect_route" value="' . $route . $query . '">';
                        echo $redirectValue;                
                    ?>
                    <input type="hidden" name="userId" value="">
                </div>
                <div class="mb-3" style="text-align: center;">
                    <img src="" name="image" alt="User Image" style="width: 100px; height: 100px; margin-bottom: 10px; border-radius: 50%;">
                </div>
                <div class="mb-3" style="text-align: center;">
                    <h3 style="color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Määra keelu aeg' : 'Set ban time') ;?></h3>
                    <input type="datetime-local" id="banexpiry" name="banexpiry" val=''>
                </div>
                <div class="mb-3" style="text-align: center;">
                    <p id="banStatusText" style="color: #013289;"></p>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                    <button style="margin: 0px; border: none;" variant="primary" type="submit" name="unban" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Eemalda keeld' : 'Unban') ;?></button>
                    <button style="border: none;" variant="primary" type="submit" name="ban" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Keela' : 'Ban') ;?></button>
                    <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
  // Capture the click event on the "Edit user" link
  $('.edit-user-link').on('click', function() {
      // Get user data from data attributes
      var userId = $(this).data('user-id');
      var username = $(this).data('username');
      var email = $(this).data('email');
      var description = $(this).data('description');
      var imgpath = $(this).data('imgpath');
      var twitter = $(this).data('twitter');
      var instagram = $(this).data('instagram');
      var facebook = $(this).data('facebook');
      var discord = $(this).data('discord');

      // Populate the form fields with user data
      $('#editUserModal [name="userId"]').val(userId);
      $('#editUserModal [name="username"]').val(username);
      $('#editUserModal [name="email"]').val(email);
      $('#editUserModal [name="description"]').val(description);
      if(description == ''){
        const placeholderTextEditProfile = languageEditProfile === 'est' ? 'Sisesta profiili kirjeldus' : 'Enter profile description';
        description = `<div style="color: #aaa;">${placeholderTextEditProfile}</div>`;
      }
      $('#descriptionInputEdit').html(description);
      $('#editUserModal [name="image"]').attr('src', imgpath);

      $('#userSocialsModal [name="userId"]').val(userId);
      $('#userSocialsModal [name="image"]').attr('src', imgpath);
      $('#userSocialsModal [name="twitter"]').val(twitter);
      $('#userSocialsModal [name="instagram"]').val(instagram);
      $('#userSocialsModal [name="facebook"]').val(facebook);
      $('#userSocialsModal [name="discord"]').val(discord);


      // Add the user ID as a hidden input field
      $('#editUserModal input[name="userId"]').val(userId);
  });

// Capture the click event on the "Ban user" link
$('.ban-user-link').on('click', function() {
    // Get the user ID, image path, and banexpiry from data attributes
    var userId = $(this).data('user-id');
    var imgpath = $(this).data('imgpath');
    var banexpiry = $(this).data('banexpiry');
    var banStatusText;
    // Set banexpiry to current time if it is null or empty
    if (banexpiry === null || banexpiry === '') {
        banStatusText = '<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutaja ei ole keelatud' : 'User is not banned') ;?>';
    }else{
        banStatusText = '<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutaja on keelatud' : 'User is banned') ;?>';
    }

    // Update the banUserModal form fields
    $('#banUserModal [name="userId"]').val(userId);
    $('#banUserModal [name="image"]').attr('src', imgpath);
    $('#banUserModal [name="banexpiry"]').val(banexpiry);

    // Update ban status text
    $('#banStatusText').text(banStatusText);
});


// Clear form fields and set the default banexpiry value when the modal is closed
$('#banUserModal').on('hidden.bs.modal', function() {
    $('#banUserModal [name="userId"]').val('');
    $('#banUserModal [name="image"]').attr('src', '');
    $('#banUserModal [name="banexpiry"]').val('');
    $('#banStatusText').text('');
});

    function previewImage() {
        var input = document.getElementById('userImageInput');
        var preview = document.getElementById('userImagePreview');
        
        // Check if a file is selected
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
      // Update the custom file input label with the selected file's name
      $('#userImageInput').on('change', function() {
        var fileName = $(this).val().split('\\').pop(); // Get the file name from the input
        $(this).next('.custom-file-label').html(fileName); // Update the label text
    });
</script>

<script>
    const descriptionInputEditProfile = document.getElementById('descriptionInputEdit');
    const languageEditProfile = '<?php echo isset($_SESSION['language']) ? $_SESSION['language'] : 'en'; ?>';

    // Set placeholder text when the div is clicked
    descriptionInputEditProfile.addEventListener('focus', function () {
        const placeholderTextEditProfile = languageEditProfile === 'est' ? 'Sisesta profiili kirjeldus' : 'Enter profile description';
        if (descriptionInputEditProfile.textContent.trim() === placeholderTextEditProfile) {
            descriptionInputEditProfile.innerHTML = ''; // Clear the placeholder when the user starts typing
        }
    });

    // Clear placeholder text if the div is empty when it loses focus
    descriptionInputEditProfile.addEventListener('blur', function () {
        const placeholderTextEditProfile = languageEditProfile === 'est' ? 'Sisesta profiili kirjeldus' : 'Enter profile description';
        if (descriptionInputEditProfile.textContent.trim() === '') {
            descriptionInputEditProfile.innerHTML = `<div style="color: #aaa;">${placeholderTextEditProfile}</div>`;
        }
    });

    function applyStyleEditProfile(style, elementId) {
        document.execCommand(style, false, null);
        updateRawInputEditProfile(elementId);
    }

    function applyEditLinkProfile(elementId) {
        const linkURL = prompt(languageEditProfile === 'est' ? 'Sisesta lingi URL:' : 'Enter the link URL:');
        if (linkURL) {
            const isAbsolute = linkURL.startsWith('http://') || linkURL.startsWith('https://') || linkURL.startsWith('//');
            const absoluteLink = isAbsolute ? linkURL : 'http://' + linkURL;
            document.execCommand('createLink', false, absoluteLink);
        }
        updateRawInputEditProfile(elementId);
    }

    function applyEditProfileColor(elementId) {
        const colorValue = document.getElementById('colorPickerEdit').value;
        document.execCommand('foreColor', false, colorValue);
        updateRawInputEditProfile(elementId);
    }

    function updateRawInputEditProfile(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const rawInput = document.getElementById('rawDescriptionInputEdit');
        const cleanedContent = descriptionInput.innerHTML.replace(/<br>$/, '');
        rawInput.value = cleanedContent;
    }

    // Initialize placeholder
    const placeholderTextEditProfile = languageEditProfile === 'est' ? 'Sisesta profiili kirjeldus' : 'Enter profile description';
    if (descriptionInputEditProfile.textContent.trim() === '') {
        descriptionInputEditProfile.innerHTML = `<div style="color: #aaa;">${placeholderTextEditProfile}</div>`;
    }

    // Add an event listener to trigger updateRawInputEditProfile on text input
    descriptionInputEditProfile.addEventListener('input', function () {
        updateRawInputEditProfile('descriptionInputEdit');
    });
</script>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		