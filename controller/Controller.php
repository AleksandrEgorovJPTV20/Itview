<?php
class Controller { 
	//homepage controller
   public static function changeLanguage($language) {
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';
		if (!empty($redirectRoute)) {
			header("Location: /$redirectRoute");
		} else {
			header("Location: /");
		}
		$_SESSION['language'] = $language;
		exit();
	}

   //homepage controller
   public static function StartSite() {
		if (isset($_GET['year'])) {
			$year = $_GET['year'];
			$alltech = Model::getAlltechByYear($year);
		}
		include_once('view/homepage.php');
		return;
	}

	//forum controller
	public static function forum() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set the number of items per page
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : null;
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';
		// Check if the form for creating, editing, or deleting a topic was submitted
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
			} elseif (isset($_POST['description'])) {
				$topicName = $_POST['name'];
				$topicDescription = !empty($_POST['description']) ? $_POST['description'] : '';

				if (Model::createTopic($topicName, $topicDescription)) {
					// Redirect to forum with a success message
					$_SESSION['createMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Teema loodud edukalt' : 'Topic created successfully');
					header("Location: /$redirectRoute");
					exit();
				} else {
					// If topic creation fails, redirect to forum with an error message
					$_SESSION['createMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ebaõnnestus teema loomine' : 'Failed to create topic');
					header("Location: /$redirectRoute");
					exit();
				}
			}

			// Redirect to forum with a success or error message
			header("Location: /$redirectRoute");
			exit();
		}

		$topics = !empty($searchQuery) ? Model::searchTopics($searchQuery) : Model::getAllTopics($page, $itemsPerPage);
		$totalItems = Model::getTotalTopics();
		
		// Get the comment counts for topics
		$commentCounts = Model::getCommentCountForTopics($topics);

		$totalPages = ceil($totalItems / $itemsPerPage);
		include_once('view/forum/forum.php');
		return;
	}


	// comments controller
	public static function comments($topicId)
	{
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set your desired items per page

		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';

		// Handle comment creation, editing, or deletion if the form is submitted
		if (isset($_POST['send']) && isset($_SESSION['userId'])) {
			$userId = $_SESSION['userId'];

			if (isset($_POST['comment'])) {
				$commentText = $_POST['comment'];

				if (isset($_POST['commentId'])) {
					// Edit existing comment
					$commentId = $_POST['commentId'];
					$commentEdited = ModelAdmin::editComment($commentId, $commentText);
					$_SESSION['editCommentMessage'] = $commentEdited ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kommentaar muudetud edukalt' : 'Comment edited successfully') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Viga kommentaari muutmisel' : 'Error editing comment');
				} else {
					// Create new comment
					$commentCreated = Model::createComment($topicId, $userId, $commentText);
					$_SESSION['createMessage'] = $commentCreated ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kommentaar loodud edukalt' : 'Comment created successfully') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Viga kommentaari loomisel' : 'Error creating comment');
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

		// Retrieve comments based on search or regular retrieval
		$comments = !empty($searchQuery) ? Model::searchComments($topicId, $searchQuery) : Model::getAllCommentsById($topicId, $page, $itemsPerPage);

		$totalItems = Model::getTotalCommentsById($topicId);
		$totalPages = ceil($totalItems / $itemsPerPage);

		include_once('view/forum/comments.php');
		return;
	}


	// replies controller
	public static function replies($commentId)
	{
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set your desired items per page

		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
		$redirectRoute = isset($_POST['redirect_route']) ? $_POST['redirect_route'] : '';

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
				$_SESSION['editReplyMessage'] = $result ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vastus muudetud edukalt' : 'Reply edited successfully') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Viga vastuse muutmisel' : 'Error editing reply');
			} elseif (isset($_POST['reply'])) {
				// Creating a new reply
				$replyText = $_POST['reply'];
				$result = Model::createReply($commentId, $userId, $replyText);
				$_SESSION['replyMessage'] = $result ? (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vastus loodud edukalt' : 'Reply created successfully') : (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Viga vastuse loomisel' : 'Error creating reply');
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
		$replies = !empty($searchQuery) ? Model::searchReplies($commentId, $searchQuery) : $replies;

		$totalItems = Model::getTotalRepliesByCommentId($commentId);
		$totalPages = ceil($totalItems / $itemsPerPage);

		include_once('view/forum/replies.php');
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
				$_SESSION['userEditMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kasutaja profiil edukalt uuendatud' : 'User profile updated successfully');
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















