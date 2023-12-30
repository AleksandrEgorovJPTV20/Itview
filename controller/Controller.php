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

				if (Model::deleteTopic($topicId)) {
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

					if (Model::editTopic($topicId, $topicName, $topicDescription)) {
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
					$commentEdited = Model::editComment($commentId, $topicId, $userId, $commentText);
					$messageKey = 'editCommentMessage';
					$successMessage = 'Comment edited successfully';
					$errorMessage = 'Error editing comment';
				} else {
					// Create new comment
					$commentCreated = Model::createComment($topicId, $userId, $commentText);
					$messageKey = 'createMessage';
					$successMessage = 'Comment created successfully';
					$errorMessage = 'Error creating comment';
				}

				// Set session variable based on the result
				$_SESSION[$messageKey] = $result ? $successMessage : $errorMessage;

				// Redirect to refresh the page
				header("Location: /comments?topic=" . $topicId);
				exit();
			}

			// Handle comment deletion
			if (isset($_POST['deleteId'])) {
				$commentIdToDelete = $_POST['deleteId'];
				$commentDeleted = Model::deleteComment($commentIdToDelete);

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
	public static function replies($commentid)
	{
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set your desired items per page

		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

		// Call the model method to get all replies for a comment
		$replies = Model::getAllRepliesByCommentId($commentid, $page, $itemsPerPage);
		$originalComment = Model::getCommentById($commentid);

		// Handle reply creation, editing, or deletion if the form is submitted
		if (isset($_POST['send']) && isset($_SESSION['userId'])) {
			$userId = $_SESSION['userId'];

			if (isset($_POST['replyId'])) {
				// Editing a reply
				$replyId = $_POST['replyId'];
				$replyText = $_POST['reply'];
				$result = Model::editReply($replyId, $userId, $replyText);
				$messageKey = 'editReplyMessage';
				$successMessage = 'Reply edited successfully';
				$errorMessage = 'Error editing reply';
			} elseif (isset($_POST['comment'])) {
				// Creating a new reply
				$commentText = $_POST['comment'];
				$result = Model::createReply($commentid, $userId, $commentText);
				$messageKey = 'replyMessage';
				$successMessage = 'Reply created successfully';
				$errorMessage = 'Error creating reply';
			} elseif (isset($_POST['deleteId'])) {
				// Deleting a reply
				$deleteId = $_POST['deleteId'];
				$result = Model::deleteReply($deleteId);
				$messageKey = 'deleteReplyMessage';
				$successMessage = 'Reply deleted successfully';
				$errorMessage = 'Error deleting reply';
			}

			// Set session variable based on the result
			$_SESSION[$messageKey] = $result ? $successMessage : $errorMessage;

			// Redirect to refresh the page
			header("Location: /comments?replies=" . $commentid);
			exit();
		}

		// Handle search query
		$replies = !empty($searchQuery) ? Model::searchReplies($commentid, $searchQuery) : $replies;

		$totalItems = Model::getTotalRepliesByCommentId($commentid);
		$totalPages = ceil($totalItems / $itemsPerPage);

		include_once('view/replies.php');
		return;
	}

	//error controller
	public static function error() {
		include_once('view/error404.php');
		return;
	}

}//END CLASS
?>















