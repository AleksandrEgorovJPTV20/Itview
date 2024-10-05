<?php
$sessionLifetime = 1800; // 30 minutes
session_set_cookie_params($sessionLifetime);
session_start();
include_once 'inc/database.php';
//-------------------------------------
include_once 'model/Model.php';
include_once 'model/ModelLogin.php';
include_once 'model/ModelAdmin.php';
//-------------------------------------
include_once 'controller/Controller.php';
include_once 'controller/ControllerLogin.php';
include_once 'controller/ControllerAdmin.php';
//-------------------------------------
include 'route/routing.php';
?>

<?php if (isset($_SESSION['userId'])) : ?>
<script>
// Function to display the modal with session reminder
function showModal(message) {
    var modal = document.getElementById('sessionModal');
    var modalMessage = document.getElementById('sessionMessage');
    modalMessage.innerHTML = message;
    $(modal).modal('show'); // Show modal using Bootstrap's modal function
}

// Function to start the countdown timer
function startTimer(duration) {
    var timer = duration;
    var fifteenMinutes = 15*60; // 15 minutes in seconds

    setInterval(function () {
        if (--timer < 0) {
            clearInterval(timer);
            // Redirect to logout or session expiration handler page
            showModal('Your session has expired. Please log in again.');
        } else if (timer === fifteenMinutes) {
            showModal('Your session is about to expire. Please save your work and refresh the page.');
        }
    }, 900000); // Decrement the timer every second
}

// Start the countdown timer when the page loads
window.onload = function () {
    startTimer(<?php echo $sessionLifetime; ?>);
};

document.addEventListener('DOMContentLoaded', function () {
    // Close modal when close button is clicked
    var closeButton = document.getElementById('closeButton');
    closeButton.addEventListener('click', function() {
        var modal = document.getElementById('sessionModal');
        $(modal).modal('hide'); // Hide modal using Bootstrap's modal function
    });
});
</script>
<?php endif; ?>
