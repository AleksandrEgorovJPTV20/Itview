<!-- Dashboard reports -->
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
          <form class="d-flex justify-content-center align-items-center my-4" data-aos="fade-up" data-aos-delay="200" action="/dashboard" method="GET">
              <input type="hidden" name="reports" value="<?= isset($_GET['reports']) ? $_GET['reports'] : '' ?>">
              <input type="search" name="search" class="form-control me-2" style="border: 2px solid #63BDFF; border-radius: 50px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); background: white; width: 60%;" placeholder="<?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Otsi aruandeid' : 'Search reports') ;?>">
          </form>
          <?php 
                $i=0;
                foreach($reports as $report){
                    $i++;
                }
            ?>
            <h2><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kokku raporteid -' : 'Total reports -') ;?> 
            <?php 
                if($searchQuery){
                    echo $i;
                }else{
                    echo $totalItems;
                }
            ?>
            </h2>
          <div class="col-lg-6 d-flex button-text-container" data-aos="fade-up" data-aos-delay="200">
                <h2 style="width: 100%;" class="h2-mobile"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Juhtpaneeli juhtimine' : 'Dashboard control') ;?></h2>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teemad' : 'Topics') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?comments"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kommentaarid' : 'Comments') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?replies"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vastused' : 'Replies') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?users"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutajad' : 'Users') ;?></a>
                </div>
                <div class="navbar text-center text-lg-start" style="display: flex; justify-content: center; flex-wrap: wrap; margin-top: 5px;">
                    <a href="/dashboard?reports"style="border: none; margin: 0px; color: white;" variant="primary" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Aruanded' : 'Reports') ;?></a>
                </div>
            </div>
            <div class="col-lg-6 d-flex" data-aos="fade-up" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;" data-aos-delay="200">
            <?php
            if (empty($reports)) {
                echo '<h2 style="margin-top: 50px; font-size: 30px;">' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ei leitud aruandeid' : 'No reports found') . '</h2>';
            } else {
                foreach ($reports as $report) {
                    // Skip users with the admin role
                    echo '<div style="border: 2px solid #63BDFF; border-radius: 10px;  text-decoration: none; padding: 10px 20px; background: white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: black; width: 100%; margin-bottom: 20px; display: flex; justify-content: space-around; flex-wrap: wrap; font-size: 20px;">';
                    echo '<a href="profile?user=' . $report['reportedUserId'] . '" style="flex-basis: 20%; text-align: center;"><img style="width: 152px; height: 158px; margin-top: 10px; border-radius: 50%;" src="' . $report['reportedUserImage'] . '"></img></a>';
                    echo '<div class="comment">';
                    echo '<p style="margin: 0; margin-top: 10px;">ID: ' . $report['reportId'];
                    if (!empty($report['banexpiry'])) {
                        echo ', '.$report['reportedUserName'].' ' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'on keelatud kuni' : 'is banned until') . ': ' . $report['banexpiry'];
                    } else {
                        echo ', '.$report['reportedUserName'].' ' . (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'ei ole keelatud' : 'is not banned') . '';
                    }
                    echo '</p>';
                    echo '<p style="margin: 0; margin-top: 10px;">'. (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'raporteeritud poolt' : 'Reported by') . ': '. $report['reporterEmail'] .'</p>';
                    echo '<p>' . $report['text'] . '</p>';
                    echo '</div>';
                    echo '<div style="display: flex; align-items: flex-end; justify-content: center;" class="navbar text-center text-lg-start comment-button">';
                    echo '<button type="button" 
                            style="border: none; margin: 0px; color: white; height: 43px; margin-top: 10px; margin-right: 5px;" 
                            data-toggle="modal" 
                            data-target="#banUserModal" 
                            data-user-id="' . $report['reportedUserId'] . '" 
                            data-imgpath="' . $report['reportedUserImage'] . '"
                            data-banexpiry="' . $report['banexpiry'] . '"
                            class="getstarted ban-user-link">
                            <i class="fa fa-ban"></i>
                            </button>';
                    echo '<button type="button" 
                            style="border: none; margin: 0px; color: white; height: 43px; margin-top: 10px;" 
                            data-toggle="modal" 
                            data-target="#deleteReportModal" 
                            data-delete-id="' . $report['reportId'] . '" 
                            class="getstarted delete-report-link">
                            <i class="fa fa-trash"></i>
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
                echo "<a href='/dashboard?reports&page=$i'>$i</a> ";
            }
            ?>
        </div>
    </div>
</div>


<!-- Modal form section -->
<div class="modal fade" id="deleteReportModal"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
          <form action="dashboard?reports" method="POST" class="content modal-forms">
              <h1 style="text-align: center; color: #013289;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kustuta raport' : 'Delete report') ;?></h1>
              <p style="text-align: center; color: #013289;">
                <?php
                    if (isset($_SESSION['deleteReportMessage'])) {
                        echo $_SESSION['deleteReportMessage'];
                        unset($_SESSION['deleteReportMessage']);
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

  <div class="modal fade" id="banUserModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0); border: none;">
            <form action="dashboard?reports" method="POST" class="content modal-forms">
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
                        $query = '?reports';

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
                    <button style="margin: 0px; border: none;" variant="primary" type="submit" name="unban" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Eemalda keeld' : 'Unban') ;?></button>
                    <button style="border: none;" variant="primary" type="submit" name="ban" class="getstarted"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Keela' : 'Ban') ;?></button>
                    <button type="button" class="getstarted scrollto" style="border: none;" variant="primary" data-dismiss="modal"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Sulge' : 'Close') ;?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script section -->
<script>
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

    // Capture the click event on the "Delete reply" link
$('.delete-report-link').on('click', function() {
    var deleteId = $(this).data('delete-id');

    $('#deleteReportModal input[name="deleteId"]').val(deleteId);
});

// Clear form fields and set the default banexpiry value when the modal is closed
$('#banUserModal, #deleteReplyModal').on('hidden.bs.modal', function() {
    $('#banUserModal [name="userId"]').val('');
    $('#banUserModal [name="image"]').attr('src', '');
    $('#banUserModal [name="banexpiry"]').val('');
    $('#banStatusText').text('');
    $('#deleteReportModal input[name="deleteId"]').val('');
});

</script>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		