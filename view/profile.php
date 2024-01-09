<!-- Profile for users -->
<?php
	ob_start();
?>

<div id="forum" class="forum about">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">

            <div class="col-lg-6 d-flex" style="padding: 10px 0px; justify-content: space-around; border-radius: 10px; background: #63BDFF; width: 100%; margin-bottom: 10px; flex-wrap: wrap; text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <h2 style="width: 100%; font-size: 32px;">Profile</h2>
            </div>

            <!-- User Profile Section -->
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
                <div style="border-radius: 10px; text-decoration: none; padding: 20px; background: #D9D9D9; box-shadow: 0px 0px 8px 2px rgba(0, 0, 0, 0.25); text-align: center; color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; align-items: flex-start; flex-wrap: wrap; font-size: 20px;">

                    <?php
                    if (empty($user)) {
                        echo '<h2 style="margin-top: 50px; font-size: 30px;">User is not found</h2>';
                    } else {
                        echo '<div style="border-radius: 10px; text-decoration: none; padding: 10px 20px; color: black; width: 100%; display: flex; justify-content: center; flex-wrap: wrap; font-size: 20px;">';
                        echo '<div style="text-align: center;"><p style="margin:0;">' . $user['username'] . '</p><p style="margin:10px 0px;">' . $user['email'] . '</p><img style="width: 252px; height: 258px; margin: 0; border-radius: 50%;" src="' . $user['imgpath'] . '"></img>';
                        if (isset($_SESSION['userId']) && $_SESSION['userId'] == $userId) {
                            echo ' <div class="navbar" style="justify-content: center;"><a type="button" style="border: none; margin: 5px 0px; color: white;  padding: 8px 16px; border-radius: 5px;" variant="primary" class="getstarted scrollto" data-toggle="modal" data-target="#userModal">Edit profile</a></div>';
                        }
                        echo '</div>';
                        echo '<div class="user-profile-description">';
                        echo '<h2>User Description</h2><p>'. $user['description'] .'</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="userModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <div class="content" style="display: flex; justify-content: center; margin: auto; margin-top: 10%; height: 84px; width: 100%; background: #012970; border-radius: 10px 10px 0px 0px; padding: 0px;">
            <img src="assets/img/logo1.png" alt="" style="border-radius: 20px; width: 70px; height: 58px; flex-shrink: 0; margin-top: 10px;">
          </div>
          <form action="profile?user=<?php echo $userId; ?>" method="POST" class="content" style="margin: auto; padding: 20px; width: 100%; background: #63BDFF; border-radius: 0px 0px 10px 10px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);" enctype="multipart/form-data">
            <h1 style="text-align: center; color: #013289;">Edit user profile</h1>
            <p style="text-align: center; color: #013289;">
                <?php if (isset($_SESSION['userEditMessage'])) {echo $_SESSION['userEditMessage']; unset($_SESSION['userEditMessage']);} ?>
            </p>
            <div class="mb-3" style="text-align: center;">
                <img src="<?php echo $user['imgpath']; ?>" alt="User Image" style="width: 100px; height: 100px; margin-bottom: 10px; border-radius: 50%;">
            </div>
            <div class="mb-3">
                <input type="text" name="username" class="form-control" style="margin: 20px 0px;" value="<?php echo $user['username'] ?>">
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" style="margin: 20px 0px;" placeholder="Edit email" value="<?php echo $user['email'] ?>">
            </div>
            <div class="mb-3">
                <textarea type="text" name="description" class="form-control" style="margin-bottom: 20px;" placeholder="Edit Description" ><?php echo $user['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <input type="file" class="form-control" id="userImage" name="userImage" accept="image/*">
            </div>
            <div class="mb-3">
                <input type="text" name="password" class="form-control" style="margin: 20px 0px;" placeholder="Edit password">
            </div>
            <div class="mb-3">
                <input type="text" name="confirm_password" class="form-control" style="margin: 20px 0px;" placeholder="Confirm current password" required>
            </div>
            <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; margin-bottom: 10px;">
                <button style="margin: 0px; border: none;" variant="primary" type="submit" name="send" class="getstarted scrollto">Update</button>
                <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal">Close</button>
            </div>
          </form>
      </div>
    </div>
  </div>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		