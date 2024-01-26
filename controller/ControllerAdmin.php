<?php 
class ControllerAdmin {
    public static function dashboard() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set your desired items per page

		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

		if (isset($_POST['send'])) {
			if (isset($_POST['deleteId'])) {
				// If 'deleteId' is set, it means we are deleting a topic
				$topicId = $_POST['deleteId'];

				if (ModelAdmin::deleteTopic($topicId)) {
					$_SESSION['deleteTopicMessage'] = 'Topic deleted successfully';
				} else {
					$_SESSION['deleteTopicMessage'] = 'Failed to delete topic';
				}
			} elseif (isset($_POST['topicId'])) {
				// If 'topicId' is set, it means we are editing a topic
				$topicId = $_POST['topicId'];

				if (isset($_POST['name']) && isset($_POST['description'])) {
					// If 'name' and 'description' are set, it means we are editing a topic
					$topicName = $_POST['name'];
					$topicDescription = $_POST['description'];

					if (ModelAdmin::editTopic($topicId, $topicName, $topicDescription)) {
						$_SESSION['editTopicMessage'] = 'Topic edited successfully';
					} else {
						$_SESSION['editTopicMessage'] = 'Failed to edit topic';
					}
				}
			}

			// Redirect to dashboard with a success or error message
			header("Location: /dashboard");
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
		include_once('view/dashboard.php');
		return;
	}
    public static function dashboardComments() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set your desired items per page
	
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
	
		// Handle comment creation, editing, or deletion if the form is submitted
		if (isset($_POST['send'])) {
	
			if (isset($_POST['comment'])) {
				$commentText = $_POST['comment'];
	
				if (isset($_POST['commentId'])) {
					// Edit existing comment
					$commentId = $_POST['commentId'];
					$commentEdited = ModelAdmin::editComment($commentId, $commentText);
					$_SESSION['editCommentMessage'] = $commentEdited ? 'Comment edited successfully' : 'Error editing comment';
				} 
	
				// Redirect to refresh the page
				header("Location: /dashboard?comments");
				exit();
			}
	
			// Handle comment deletion
			if (isset($_POST['deleteId'])) {
				$commentIdToDelete = $_POST['deleteId'];
				$commentDeleted = ModelAdmin::deleteComment($commentIdToDelete);
	
				// Set session variable based on the deletion result
				$_SESSION['deleteCommentMessage'] = $commentDeleted ? 'Comment deleted successfully' : 'Error deleting comment';
	
				// Redirect to refresh the page
				header("Location: /dashboard?comments");
				exit();
			}
		}
		$comments = !empty($searchQuery) ? ModelAdmin::searchComments($searchQuery) : ModelAdmin::getAllComments($page, $itemsPerPage);
	
		$totalItems = ModelAdmin::getTotalComments();
		$totalPages = ceil($totalItems / $itemsPerPage);

		include_once('view/dashboardComments.php');
		return;
	}

    public static function dashboardReplies() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set your desired items per page
	
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

		// Handle reply creation, editing, or deletion if the form is submitted
		if (isset($_POST['send']) && isset($_SESSION['userId'])) {
			$userId = $_SESSION['userId'];

			if (isset($_POST['replyId'])) {
				// Editing a reply
				$replyId = $_POST['replyId'];
				$replyText = $_POST['reply'];
				$result = ModelAdmin::editReply($replyId, $replyText);
				$_SESSION['editReplyMessage'] = $result ? 'Reply edited successfully' : 'Error editing reply';
			} elseif (isset($_POST['comment'])) {
				// Creating a new reply
				$commentText = $_POST['comment'];
				$result = Model::createReply($commentId, $userId, $commentText);
				$_SESSION['replyMessage'] = $result ? 'Reply created successfully' : 'Error creating reply';
			} elseif (isset($_POST['deleteId'])) {
				// Deleting a reply
				$deleteId = $_POST['deleteId'];
				$result = ModelAdmin::deleteReply($deleteId);
				$_SESSION['deleteReplyMessage'] = $result ? 'Reply deleted successfully' : 'Error deleting reply';
			}

			// Redirect to refresh the page
			header("Location: /dashboard?replies");
			exit();
		}
		// Handle search query
		$replies = !empty($searchQuery) ? ModelAdmin::searchReplies($searchQuery) : ModelAdmin::getAllReplies($page, $itemsPerPage);

		$totalItems = ModelAdmin::getTotalReplies();
		$totalPages = ceil($totalItems / $itemsPerPage);

		include_once('view/dashboardReplies.php');
		return;
	}

	public static function dashboardUsers() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set your desired items per page
	
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
	
		// Check if the form is submitted
		if (isset($_POST['send'])) {
			$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;

			// Call the method to edit the user profile by ID
			$editedUser = ModelAdmin::editUserById($userId);

			// Check if the edit was successful
			if ($editedUser) {
				// Optionally, you can set a success message here
				$_SESSION['userEditMessage'] = 'User profile edited successfully.';
			} else {
				$_SESSION['userEditMessage'] = 'Failed to update user profile';
			}
			header("Location: /dashboard?users");
			exit();
		} elseif (isset($_POST['ban'])) {
			// Check if ban button is pressed
			$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
			$banexpiry = isset($_POST['banexpiry']) ? $_POST['banexpiry'] : null;

			// Call the method to ban the user by ID
			$banned = ModelAdmin::banUser($userId, $banexpiry);

			// Optionally, set a success or error message here
			$_SESSION['banUserMessage'] = $banned ? 'User has been banned.' : 'Failed to ban user.';

			header("Location: /dashboard?users");
			exit();
		} elseif (isset($_POST['unban'])) {
			// Check if unban button is pressed
			$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;

			// Call the method to unban the user by ID
			$unbanned = ModelAdmin::unbanUser($userId);

			// Optionally, set a success or error message here
			$_SESSION['banUserMessage'] = $unbanned ? 'User has been unbanned.' : 'Failed to unban user.';

			header("Location: /dashboard?users");
			exit();
		}
		
		$users = !empty($searchQuery) ? ModelAdmin::searchUsers($searchQuery) : ModelAdmin::getAllUsers($page, $itemsPerPage);

		$totalItems = ModelAdmin::getTotalUsers();
		$totalPages = ceil($totalItems / $itemsPerPage);
	
		include_once('view/dashboardUsers.php');
		return;
	}

	public static function dashboardReports() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5;
	
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
	
		if (isset($_POST['ban'])) {
			// Check if ban button is pressed
			$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
			$banexpiry = isset($_POST['banexpiry']) ? $_POST['banexpiry'] : null;

			// Call the method to ban the user by ID
			$banned = ModelAdmin::banUser($userId, $banexpiry);

			// Optionally, set a success or error message here
			$_SESSION['banUserMessage'] = $banned ? 'User has been banned.' : 'Failed to ban user.';

			header("Location: /dashboard?reports");
			exit();
		} elseif (isset($_POST['unban'])) {
			// Check if unban button is pressed
			$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;

			// Call the method to unban the user by ID
			$unbanned = ModelAdmin::unbanUser($userId);

			// Optionally, set a success or error message here
			$_SESSION['banUserMessage'] = $unbanned ? 'User has been unbanned.' : 'Failed to unban user.';

			header("Location: /dashboard?reports");
			exit();
		}
		elseif (isset($_POST['deleteId'])) {
			// Deleting a reply
			$deleteId = $_POST['deleteId'];

			$result = ModelAdmin::deleteReport($deleteId);

			$_SESSION['deleteReportMessage'] = $result ? 'Report deleted successfully' : 'Error deleting report';
		}

		$reports = !empty($searchQuery) ? ModelAdmin::searchReports($searchQuery) : ModelAdmin::getAllReports($page, $itemsPerPage);

		$totalItems = ModelAdmin::getTotalReports();
		$totalPages = ceil($totalItems / $itemsPerPage);
	
		include_once('view/dashboardReports.php');
		return;
	}
}
?>