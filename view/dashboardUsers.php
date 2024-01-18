<!-- Dashboard users -->
<?php
	ob_start();
?>

<div id="forum" class="forum about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">
          <form class="d-flex justify-content-center align-items-center my-4" data-aos="fade-up" data-aos-delay="200" action="/dashboard" method="GET">
              <input type="hidden" name="users" value="<?= isset($_GET['users']) ? $_GET['users'] : '' ?>">
              <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white; width: 60%;" placeholder="Search users">
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
            if (empty($users)) {
                echo '<h2 style="margin-top: 50px; font-size: 30px;">No users found</h2>';
            } else {
                foreach ($users as $user) {
                    // Skip users with the admin role
                    if ($user['role'] === 'admin') {
                        continue;
                    }
                    if($_SESSION['role'] === 'manager' && $user['role'] === 'manager'){
                        continue;
                    }
                    echo '<div style="border: 2px solid #63BDFF; border-radius: 10px; text-decoration: none; padding: 0px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); text-align: center; color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; align-items: flex-start; flex-wrap: wrap; font-size: 20px;">';
                    echo '<div style="flex-basis: 25%;"><p>Id: ' . $user['id'] . '</p></div>';
                    echo '<div style="flex-basis: 25%;"><p>' . $user['email'] . '</p></div>';
                    echo '<div style="flex-basis: 25%;"><p>' . $user['role'] . '</p></div>';
                    echo '<div class="navbar forum-button" style="display: flex; justify-content: center;">';
                    echo '<a type="button" 
                            style="border: none; margin: 0px; margin-top: 10px; color: white; height: 43px; margin-right: 5px;" 
                            data-toggle="modal" 
                            data-target="#editUserModal" 
                            data-user-id="' . $user['id'] . '" 
                            data-username="' . $user['username'] . '"
                            data-email="' . $user['email'] . '"
                            data-description="' . $user['description'] . '"
                            data-imgpath="' . $user['imgpath'] . '"
                            class="getstarted scrollto edit-user-link">
                            <i class="fas fa-edit"></i>
                            </a>';
                    echo '<a type="button" 
                            style="border: none; margin: 0px; color: white; height: 43px; margin-top: 10px;" 
                            data-toggle="modal" 
                            data-target="#banUserModal" 
                            data-user-id="' . $user['id'] . '" 
                            data-imgpath="' . $user['imgpath'] . '"
                            data-banexpiry="' . $user['banexpiry'] . '"
                            class="getstarted scrollto ban-user-link">
                            <i class="fa fa-ban"></i>
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
                echo "<a href='/dashboard?users&page=$i'>$i</a> ";
            }
            ?>
        </div>
    </div>
</div>


<div class="modal fade" id="editUserModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 10%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="dashboard?users" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
            <h1 style="text-align: center; color: #013289;">Edit user profile</h1>
            <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['userEditMessage'])) {echo $_SESSION['userEditMessage']; unset($_SESSION['userEditMessage']);} ?>
            </p>
            <div class="mb-3" style="text-align: center;">
                <input type="hidden" name="userId" value="">
                <img src="" name="image" alt="User Image" style="width: 100px; height: 100px; margin-bottom: 10px; border-radius: 50%;">
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
                <textarea type="text" name="description" class="form-control" style="margin-bottom: 20px;" placeholder="Edit Description" value=""></textarea>
            </div>
            <div class="mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="userImageInput" name="userImage" accept="image/*">
                    <label class="custom-file-label" for="userImageInput">Choose profile picture file</label>
                </div>
            </div>
            <?php 
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                echo '<div class="mb-3">
                    <input type="text" name="password" class="form-control" style="margin: 20px 0px;" placeholder="Edit password">
                </div>';
            }
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                echo '<div class="mb-3">
                <select name="role" class="form-control">
                    <option value="manager">Manager</option>
                    <option value="user">User</option>
                </select>
            </div>';
            }
            ?>
            <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto">Update</button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal">Close</button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="banUserModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
            <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 40%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
                <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
            </div>
            <form action="dashboard?users" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                <h1 style="text-align: center; color: #013289;">Ban user</h1>
                <p style="text-align: center; color: #013289;">
                    <?php
                    if (isset($_SESSION['banUserMessage'])) {
                        echo $_SESSION['banUserMessage'];
                        unset($_SESSION['banUserMessage']);
                    }
                    ?>
                </p>
                <div class="mb-3">
                    <input type="hidden" name="userId" value="">
                </div>
                <div class="mb-3" style="text-align: center;">
                    <img src="" name="image" alt="User Image" style="width: 100px; height: 100px; margin-bottom: 10px; border-radius: 50%;">
                </div>
                <div class="mb-3" style="text-align: center;">
                    <h3 style="color: #013289;">Set ban time</h3>
                    <input type="datetime-local" id="banexpiry" name="banexpiry" val=''>
                </div>
                <div class="mb-3" style="text-align: center;">
                    <p id="banStatusText" style="color: #013289;"></p>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                    <button style="margin: 0px; border: none;" variant="primary" type="submit" name="unban" class="getstarted scrollto">Unban</button>
                    <button style="border: none;" variant="primary" type="submit" name="ban" class="getstarted scrollto">Ban</button>
                    <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal">Close</button>
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

      // Populate the form fields with user data
      $('#editUserModal [name="userId"]').val(userId);
      $('#editUserModal [name="username"]').val(username);
      $('#editUserModal [name="email"]').val(email);
      $('#editUserModal [name="description"]').val(description);
      $('#editUserModal [name="image"]').attr('src', imgpath);


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
        banStatusText = 'User is not banned'
    }else{
        banStatusText = 'User is banned'
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


      // Update the custom file input label with the selected file's name
      $('#userImageInput').on('change', function() {
        var fileName = $(this).val().split('\\').pop(); // Get the file name from the input
        $(this).next('.custom-file-label').html(fileName); // Update the label text
    });
</script>



<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		