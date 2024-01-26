<?php
class Controller { 
   //homepage controller
   public static function StartSite() {
		include_once('view/homepage.php');
		return;
	}
	//tech by year controller
	public static function tech($year) {
		$alltech = Model::getAlltechByYear($year);
		include_once('view/techByYear.php');
		return;
	}
	//contacts controller
	public static function contact() {
		include_once('view/homepage.php');
		return;
	}

	//forum controller
	public static function forum($page = 1) {
		$itemsPerPage = 5; // Set the number of items per page
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : null;

		// Check if the form for creating, editing, or deleting a topic was submitted
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
			} elseif (isset($_POST['comment'])) {
				// If 'comment' is set, it means we are creating a new topic
				$topicName = $_POST['name'];
				$topicDescription = $_POST['description'];
				$comment = $_POST['comment'];

				if (Model::createTopic($topicName, $topicDescription, $comment)) {
					// Redirect to forum with a success message
					$_SESSION['createMessage'] = 'Topic created successfully';
					header("Location: /forum");
					exit();
				} else {
					// If topic creation fails, redirect to forum with an error message
					$_SESSION['createMessage'] = 'Failed to create topic';
					header("Location: /forum");
					exit();
				}
			}

			// Redirect to forum with a success or error message
			header("Location: /forum");
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

		// Get the comment counts for topics
		$commentCounts = Model::getCommentCountForTopics($topics);

		$totalPages = ceil($totalItems / $itemsPerPage);
		include_once('view/forum.php');
		return;
	}


	// comments controller
	public static function comments($topicId)
	{
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set your desired items per page

		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

		// Handle comment creation, editing, or deletion if the form is submitted
		if (isset($_POST['send']) && isset($_SESSION['userId'])) {
			$userId = $_SESSION['userId'];

			if (isset($_POST['comment'])) {
				$commentText = $_POST['comment'];

				if (isset($_POST['commentId'])) {
					// Edit existing comment
					$commentId = $_POST['commentId'];
					$commentEdited = ModelAdmin::editComment($commentId, $commentText);
					$_SESSION['editCommentMessage'] = $commentEdited ? 'Comment edited successfully' : 'Error editing comment';
				} else {
					// Create new comment
					$commentCreated = Model::createComment($topicId, $userId, $commentText);
					$_SESSION['createMessage'] = $commentCreated ? 'Comment created successfully' : 'Error creating comment';
				}

				// Redirect to refresh the page
				header("Location: /comments?topic=" . $topicId);
				exit();
			}

			// Handle comment deletion
			if (isset($_POST['deleteId'])) {
				$commentIdToDelete = $_POST['deleteId'];
				$commentDeleted = ModelAdmin::deleteComment($commentIdToDelete);

				// Set session variable based on the deletion result
				$_SESSION['deleteCommentMessage'] = $commentDeleted ? 'Comment deleted successfully' : 'Error deleting comment';

				// Redirect to refresh the page
				header("Location: /comments?topic=" . $topicId);
				exit();
			}
		}

		// Retrieve comments based on search or regular retrieval
		$comments = !empty($searchQuery) ? Model::searchComments($topicId, $searchQuery) : Model::getAllCommentsById($topicId, $page, $itemsPerPage);

		$totalItems = Model::getTotalCommentsById($topicId);
		$totalPages = ceil($totalItems / $itemsPerPage);

		include_once('view/comments.php');
		return;
	}


	// replies controller
	public static function replies($commentId)
	{
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set your desired items per page

		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

		// Call the model method to get all replies for a comment
		$replies = Model::getAllRepliesByCommentId($commentId, $page, $itemsPerPage);
		$originalComment = Model::getCommentById($commentId);

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
			header("Location: /comments?replies=" . $commentId);
			exit();
		}

		// Handle search query
		$replies = !empty($searchQuery) ? Model::searchReplies($commentId, $searchQuery) : $replies;

		$totalItems = Model::getTotalRepliesByCommentId($commentId);
		$totalPages = ceil($totalItems / $itemsPerPage);

		include_once('view/replies.php');
		return;
	}

	//profile controller
	public static function profile($userId) {
		$user = Model::getUserById($userId);
		if (isset($_POST['send'])) {
			$updatedUser = Model::editUserById($userId);
			if ($updatedUser) {
				$_SESSION['name'] = $updatedUser['username'];
				$_SESSION['email'] = $updatedUser['email'];
				$_SESSION['password'] = $updatedUser['password'];
				$_SESSION['userEditMessage'] = 'User profile updated successfully';

			} else {
				$_SESSION['userEditMessage'] = 'Failed to update user profile';
			}
			header("Location: /profile?user=" . $userId);
			exit();
		}
		if (isset($_POST['report'])) {
			$reportText = $_POST['description'];
			$reportedUserId = $userId;
	
			Model::sendReport($reportedUserId, $reportText);
	
			// Redirect back to the profile page
			header("Location: /profile?user=" . $userId);
			exit();
		}
		include_once('view/profile.php');
		return;
	}

	//error controller
	public static function error() {
		include_once('view/error404.php');
		return;
	}

}//END CLASS
?>















