<!-- Profile for users -->
<?php
	ob_start();
?>

<div id="forum" class="forum about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">

            <div class="col-lg-6 d-flex" style="padding: 10px 0px; justify-content: space-around; border-radius: 10px; background: #63BDFF; width: 100%; margin-bottom: 10px; flex-wrap: wrap; text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <h2 style="width: 100%; font-size: 32px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Profiil' : 'Profile') ;?></h2>
            </div>

            <!-- User Profile Section -->
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
                <div style="  border: 2px solid #63BDFF; border-radius: 10px;  text-decoration: none; padding: 20px; background: white; box-shadow: 0px 0px 4px 2px rgba(0, 0, 0, 0.25); text-align: center; color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; align-items: flex-start; flex-wrap: wrap; font-size: 20px;">

                    <?php
                    if (empty($user) || (!empty($user['banexpiry']) && !(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'))) {
                        echo '<h2 style=" font-size: 30px;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutajat ei leitud või ta on keelatud' : 'User is not found or banned') . '</h2>';
                    } else {
                        echo '<div style="border-radius: 10px; text-decoration: none; padding: 10px 20px; color: black; width: 100%; display: flex; justify-content: center; flex-wrap: wrap; font-size: 20px;">';
                        echo '<div style="text-align: center;"><p style="margin:0;">' . $user['username'] . '</p><p style="margin:10px 0px;">' . $user['email'] . '</p><img style="width: 252px; height: 258px; margin: 0; border-radius: 50%;" src="' . $user['imgpath'] . '"></img>';
                        if($user['role'] == 'admin'){
                            echo '<h2>' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Veebisaidi administraator' : 'Site Administrator') . '</h2>';
                        }
                        elseif($user['role'] == 'manager'){
                            echo '<h2>' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Veebisaidi haldur' : 'Site manager') . '</h2>';
                        }

                        if (isset($_SESSION['userId']) && $_SESSION['userId'] == $userId) {
                            echo ' <div class="navbar" style="justify-content: center;"><a type="button" style="border: none; margin: 5px 0px; color: white;  padding: 8px 16px; border-radius: 5px;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#userProfileModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Profiili muutmine' : 'Edit profile') . '</a></div>';
                        }elseif(isset($_SESSION['userId']) && $user['role'] != 'admin'){
                            echo '<div class="navbar" style="justify-content: center;"><a type="button" style="border: none; margin: 5px 0px; color: white;  padding: 8px 16px; border-radius: 5px;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#userReportModal">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Aruandlus' : 'Report') . ' '.$user['username'].'</a></div>';
                        }
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
                        echo '<div class="user-profile-description">';
                        echo '<h2>'. $user['username'] .' ' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? ' kirjeldus' : ' description') . '</h2><p>'. $user['description'] .'</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="userProfileModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none; margin-left: 15px;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="profile?user=<?php echo $userId; ?>" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
            <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda profiil' : 'Edit profile') ;?></h1>
            <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['userEditMessage'])) {echo $_SESSION['userEditMessage']; unset($_SESSION['userEditMessage']);} ?>
            </p>
            <div class="mb-3" style="text-align: center;">
                <img id="userImagePreview" src="<?php echo $user['imgpath']; ?>" alt="User Image" style="width: 100px; height: 100px; margin-bottom: 10px; border-radius: 50%;">
            </div>
            <div class="mb-3">
                <input type="text" name="username" class="form-control" style="margin: 20px 0px;" value="<?php echo $user['username'] ?>">
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda e-posti' : 'Edit email') ;?>" value="<?php echo $user['email'] ?>">
            </div>
            <div class="mb-3">
                <div class="style-buttons" style="margin: 5px; justify-content: center;">
                    <button type="button" onclick="applyStyleEditProfile('italic', 'descriptionInputEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kursiiv' : 'Italic') ;?></button>
                    <button type="button" onclick="applyStyleEditProfile('bold', 'descriptionInputEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Rasvane' : 'Bold') ;?></button>
                    <button type="button" onclick="applyStyleEditProfile('underline', 'descriptionInputEdit')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Allajoonitud' : 'Underline') ;?></button>
                    <button type="button" onclick="applyEditLinkProfile('descriptionInputEdit')">Link</button>
                    <input  type="color" id="colorPickerEdit" onchange="applyEditProfileColor('descriptionInputEdit')">
                </div>
                <div contenteditable="true" id="descriptionInputEdit" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 6px;"><?php echo $user['description'] ?></div>
                <input type="hidden" name="description" id="rawDescriptionInputEdit" value="<?php $user['description'] ?>" required>
            </div>
            <div class="mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="userImageInput" name="userImage" accept="image/*" onchange="previewImage()">
                    <label class="custom-file-label" for="userImageInput"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Valige profiilipilt' : 'Choose profile picture') ;?></label>
                </div>
            </div>
            <div class="mb-3">
                <input type="text" name="password" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Muuda parool' : 'Edit password') ;?>">
            </div>
            <div class="mb-3">
                <input type="text" name="confirm_password" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kinnita praegune parool' : 'Confirm current password') ;?>" required>
            </div>
            <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Uuenda' : 'Update') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal" data-toggle="modal" data-target="#userSocialsModal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Lisa sotsiaalmeedia' : 'Add socials') ;?></button>
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
          <form action="profile?user=<?php echo $userId; ?>" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
            <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Lisa sotsiaalmeedia' : 'Add social media') ;?></h1>
            <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['userEditMessage'])) {echo $_SESSION['userEditMessage']; unset($_SESSION['userEditMessage']);} ?>
            </p>
            <div class="mb-3" style="text-align: center;">
                <img id="userImagePreview" src="<?php echo $user['imgpath']; ?>" alt="User Image" style="width: 100px; height: 100px; margin-bottom: 10px; border-radius: 50%;">
            </div>
            <div class="mb-3">
                <input type="text" name="twitter" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Lisa Twitteri link' : 'Add twitter link') ;?>" value="<?php echo $user['twitter'] ?>">
            </div>
            <div class="mb-3">
                <input type="text" name="instagram" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Lisa Instagrami link' : 'Add instagram link') ;?>" value="<?php echo $user['instagram'] ?>">
            </div>
            <div class="mb-3">
                <input type="text" name="facebook" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Lisa Facebooki link' : 'Add facebook link') ;?>" value="<?php echo $user['facebook'] ?>">
            </div>
            <div class="mb-3">
                <input type="text" name="discord" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Add Discordi link' : 'Add discord link') ;?>" value="<?php echo $user['discord'] ?>">
            </div>
            <div class="mb-3">
                <input type="text" name="confirm_password" class="form-control" style="margin: 20px 0px;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kinnita praegune parool' : 'Confirm current password') ;?>" required>
            </div>
            <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Uuenda' : 'Update') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal" data-toggle="modal" data-target="#userProfileModal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Tagasi' : 'Back') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="userReportModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 5%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="profile?user=<?php echo $userId; ?>" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
            <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Raporteeri ' : 'Report ') ;?> <?php echo $user['username']; ?></h1>
            <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['userReportMessage'])) {echo $_SESSION['userReportMessage']; unset($_SESSION['userReportMessage']);} ?>
            </p>
            <div class="mb-3" style="text-align: center;">
                <img src="<?php echo $user['imgpath']; ?>" alt="User Image" style="width: 100px; height: 100px; margin-bottom: 10px; border-radius: 50%;">
            </div>
            <div class="mb-3">
                <div class="style-buttons" style="margin: 5px; justify-content: center;">
                    <button type="button" onclick="applyStyleReport('italic', 'descriptionInputReport')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kursiiv' : 'Italic') ;?></button>
                    <button type="button" onclick="applyStyleReport('bold', 'descriptionInputReport')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Rasvane' : 'Bold') ;?></button>
                    <button type="button" onclick="applyStyleReport('underline', 'descriptionInputReport')"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Allajoonitud' : 'Underline') ;?></button>
                    <button type="button" onclick="applyReportLink('descriptionInputReport')">Link</button>
                    <input  type="color" id="colorPickerReport" onchange="applyReportColor('descriptionInputReport')">
                </div>
                <div contenteditable="true" id="descriptionInputReport" class="form-control" style="margin-bottom: 20px; min-height: 100px; border: 1px solid #ccc; padding: 6px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sisesta raporti kirjeldus' : 'Enter report description') ;?></div>
                <input type="hidden" name="description" id="rawDescriptionInputReport" value="" required>
            </div>
            <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="report" class="getstarted scrollto"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Raporteeri' : 'Report') ;?></button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
            </div>
          </form>
      </div>
    </div>
  </div>

<script>
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
    function applyStyleEditProfile(style, elementId) {
        const descriptionInput = document.getElementById(elementId);
        document.execCommand(style, false, null);
        updateRawInput(elementId);
    }

    function applyEditLinkProfile(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const linkURL = prompt('Enter the link URL:');
        if (linkURL) {
          // Check if the link is absolute (starts with http://, https://, or //)
          const isAbsolute = linkURL.startsWith('http://') || linkURL.startsWith('https://') || linkURL.startsWith('//');
          // If not absolute, prepend with 'http://'
          const absoluteLink = isAbsolute ? linkURL : 'http://' + linkURL;
          document.execCommand('createLink', false, absoluteLink);
        }
        updateRawInput(elementId);
    }

    function applyEditProfileColor(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const colorValue = document.getElementById('colorPickerEdit').value;
        document.execCommand('foreColor', false, colorValue);
        updateRawInput(elementId);
    }

    function updateRawInput(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const rawInput = document.getElementById('rawDescriptionInputEdit');
        rawInput.value = descriptionInput.innerHTML;
    }

    // Add an event listener to trigger updateRawInput on text input
    document.getElementById('descriptionInputEdit').addEventListener('input', function () {
        updateRawInput('descriptionInputEdit');
    });
</script>

<script>
    function applyStyleReport(style, elementId) {
        const descriptionInput = document.getElementById(elementId);
        document.execCommand(style, false, null);
        updateRawInputReport(elementId);
    }

    function applyReportLink(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const linkURL = prompt('Enter the link URL:');
        if (linkURL) {
          // Check if the link is absolute (starts with http://, https://, or //)
          const isAbsolute = linkURL.startsWith('http://') || linkURL.startsWith('https://') || linkURL.startsWith('//');
          // If not absolute, prepend with 'http://'
          const absoluteLink = isAbsolute ? linkURL : 'http://' + linkURL;
          document.execCommand('createLink', false, absoluteLink);
        }
        updateRawInputReport(elementId);
    }

    function applyReportColor(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const colorValue = document.getElementById('colorPickerReport').value;
        document.execCommand('foreColor', false, colorValue);
        updateRawInputReport(elementId);
    }

    function updateRawInputReport(elementId) {
        const descriptionInput = document.getElementById(elementId);
        const rawInput = document.getElementById('rawDescriptionInputReport');
        rawInput.value = descriptionInput.innerHTML;
    }

    // Add an event listener to trigger updateRawInput on text input
    document.getElementById('descriptionInputReport').addEventListener('input', function () {
        updateRawInputReport('descriptionInputReport');
    });
</script>
<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		