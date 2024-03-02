<?php 
class ControllerAdmin {
    public static function dashboard() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 6; // Set your desired items per page

		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';

		if (isset($_POST['send'])) {
			if (isset($_POST['deleteId'])) {
				// If 'deleteId' is set, it means we are deleting a topic
				$topicId = $_POST['deleteId'];

				if (ModelAdmin::deleteTopic($topicId)) {
					$_SESSION['deleteTopicMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teema kustutatud edukalt' : 'Topic deleted successfully');
				} else {
					$_SESSION['deleteTopicMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ebaõnnestus teema kustutamine' : 'Failed to delete topic');
				}
			} elseif (isset($_POST['topicId'])) {
				// If 'topicId' is set, it means we are editing a topic
				$topicId = $_POST['topicId'];

				if (isset($_POST['name']) && isset($_POST['description'])) {
					// If 'name' and 'description' are set, it means we are editing a topic
					$topicName = $_POST['name'];
					$topicDescription = $_POST['description'];

					if (ModelAdmin::editTopic($topicId, $topicName, $topicDescription)) {
						$_SESSION['editTopicMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teema muudetud edukalt' : 'Topic edited successfully');
					} else {
						$_SESSION['editTopicMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ebaõnnestus teema muutmine' : 'Failed to edit topic');
					}
				}
			}

			// Redirect to dashboard with a success or error message
			header("Location: /$redirectRoute");
			exit();
		}

		// Handle search or display all topics
		if ($searchQuery) {
			$topics = Model::searchTopics($searchQuery, $page, $itemsPerPage);
			$totalItems = 0;
		} else {
			// If no search term, use getAllTopics method
			$topics = Model::getAllTopics($page, $itemsPerPage);
			$totalItems = Model::getTotalTopics();
		}
		$totalPages = ceil($totalItems / $itemsPerPage);
		include_once('view/dashboard/dashboard.php');
		return;
	}

    public static function dashboardComments() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 6; // Set your desired items per page
	
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';

		// Handle comment creation, editing, or deletion if the form is submitted
		if (isset($_POST['send'])) {
	
			if (isset($_POST['comment'])) {
				$commentText = $_POST['comment'];
	
				if (isset($_POST['commentId'])) {
					// Edit existing comment
					$commentId = $_POST['commentId'];
					$commentEdited = ModelAdmin::editComment($commentId, $commentText);
					$_SESSION['editCommentMessage'] = $commentEdited ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kommentaar muudetud edukalt' : 'Comment edited successfully') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Viga kommentaari muutmisel' : 'Error editing comment');
				} 
	
				// Redirect to refresh the page
				header("Location: /$redirectRoute");
				exit();
			}
	
			// Handle comment deletion
			if (isset($_POST['deleteId'])) {
				$commentIdToDelete = $_POST['deleteId'];
				$commentDeleted = ModelAdmin::deleteComment($commentIdToDelete);
	
				// Set session variable based on the deletion result
				$_SESSION['deleteCommentMessage'] = $commentDeleted ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kommentaar kustutatud edukalt' : 'Comment deleted successfully') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Viga kommentaari kustutamisel' : 'Error deleting comment');
	
				// Redirect to refresh the page
				header("Location: /$redirectRoute");
				exit();
			}
		}
		$comments = !empty($searchQuery) ? ModelAdmin::searchComments($searchQuery) : ModelAdmin::getAllComments($page, $itemsPerPage);
	
		$totalItems = ModelAdmin::getTotalComments();
		$totalPages = ceil($totalItems / $itemsPerPage);

		include_once('view/dashboard/dashboardComments.php');
		return;
	}

    public static function dashboardReplies() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 6; // Set your desired items per page
	
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';

		// Handle reply creation, editing, or deletion if the form is submitted
		if (isset($_POST['send']) && isset($_SESSION['userId'])) {
			$userId = $_SESSION['userId'];

			if (isset($_POST['replyId'])) {
				// Editing a reply
				$replyId = $_POST['replyId'];
				$replyText = $_POST['reply'];
				$result = ModelAdmin::editReply($replyId, $replyText);
				$_SESSION['editReplyMessage'] = $result ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vastus muudetud edukalt' : 'Reply edited successfully') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Viga vastuse muutmisel' : 'Error editing reply');
			} elseif (isset($_POST['deleteId'])) {
				// Deleting a reply
				$deleteId = $_POST['deleteId'];
				$result = ModelAdmin::deleteReply($deleteId);
				$_SESSION['deleteReplyMessage'] = $result ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vastus kustutatud edukalt' : 'Reply deleted successfully') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Viga vastuse kustutamisel' : 'Error deleting reply');
			}

			// Redirect to refresh the page
			header("Location: /$redirectRoute");
			exit();
		}
		// Handle search query
		$replies = !empty($searchQuery) ? ModelAdmin::searchReplies($searchQuery) : ModelAdmin::getAllReplies($page, $itemsPerPage);

		$totalItems = ModelAdmin::getTotalReplies();
		$totalPages = ceil($totalItems / $itemsPerPage);

		include_once('view/dashboard/dashboardReplies.php');
		return;
	}

	public static function dashboardUsers() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 6; // Set your desired items per page
	
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';
		// Check if the form is submitted
		if (isset($_POST['send'])) {
			$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;

			// Call the method to edit the user profile by ID
			$editedUser = ModelAdmin::editUserById($userId);

			// Check if the edit was successful
			if ($editedUser) {
				// Optionally, you can set a success message here
				$_SESSION['userEditMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutaja profiil muudetud edukalt' : 'User profile edited successfully');
			} else {
				$_SESSION['userEditMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ebaõnnestus kasutaja profiili uuendamine' : 'Failed to update user profile');
			}
			header("Location: /$redirectRoute");
			exit();
		} elseif (isset($_POST['ban'])) {
			// Check if ban button is pressed
			$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
			$banexpiry = isset($_POST['banexpiry']) ? $_POST['banexpiry'] : null;

			// Call the method to ban the user by ID
			$banned = ModelAdmin::banUser($userId, $banexpiry);

			// Optionally, set a success or error message here
			$_SESSION['banUserMessage'] = $banned ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutaja on keelatud' : 'User has been banned') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ebaõnnestus kasutaja keelamine' : 'Failed to ban user');

			header("Location: /$redirectRoute");
			exit();
		} elseif (isset($_POST['unban'])) {
			// Check if unban button is pressed
			$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;

			// Call the method to unban the user by ID
			$unbanned = ModelAdmin::unbanUser($userId);

			// Optionally, set a success or error message here
			$_SESSION['banUserMessage'] = $unbanned ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutaja on taasaktiveeritud' : 'User has been unbanned') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ebaõnnestus kasutaja taasaktiveerimine' : 'Failed to unban user');

			header("Location: /$redirectRoute");
			exit();
		}
		
		$users = !empty($searchQuery) ? ModelAdmin::searchUsers($searchQuery) : ModelAdmin::getAllUsers($page, $itemsPerPage);

		$totalItems = ModelAdmin::getTotalUsers();
		$totalPages = ceil($totalItems / $itemsPerPage);
	
		include_once('view/dashboard/dashboardUsers.php');
		return;
	}

	public static function dashboardReports() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5;
	
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';

		if (isset($_POST['ban'])) {
			// Check if ban button is pressed
			$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
			$banexpiry = isset($_POST['banexpiry']) ? $_POST['banexpiry'] : null;

			// Call the method to ban the user by ID
			$banned = ModelAdmin::banUser($userId, $banexpiry);

			// Optionally, set a success or error message here
			$_SESSION['banUserMessage'] = $banned ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutaja on keelatud' : 'User has been banned') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ebaõnnestus kasutaja keelamine' : 'Failed to ban user');

			header("Location: /$redirectRoute");
			exit();
		} elseif (isset($_POST['unban'])) {
			// Check if unban button is pressed
			$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;

			// Call the method to unban the user by ID
			$unbanned = ModelAdmin::unbanUser($userId);

			// Optionally, set a success or error message here
			$_SESSION['banUserMessage'] = $unbanned ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutaja on taasaktiveeritud' : 'User has been unbanned') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ebaõnnestus kasutaja taasaktiveerimine' : 'Failed to unban user');

			header("Location: /$redirectRoute");
			exit();
		}
		elseif (isset($_POST['deleteId'])) {
			// Deleting a reply
			$deleteId = $_POST['deleteId'];

			$result = ModelAdmin::deleteReport($deleteId);

			$_SESSION['deleteReportMessage'] = $result ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Raport kustutatud edukalt' : 'Report deleted successfully') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Viga raporti kustutamisel' : 'Error deleting report');
		}

		$reports = !empty($searchQuery) ? ModelAdmin::searchReports($searchQuery) : ModelAdmin::getAllReports($page, $itemsPerPage);

		$totalItems = ModelAdmin::getTotalReports();
		$totalPages = ceil($totalItems / $itemsPerPage);
	
		include_once('view/dashboard/dashboardReports.php');
		return;
	}
}
?>