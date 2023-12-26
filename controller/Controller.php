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
	
		// Check if the form for creating a topic was submitted
		if (isset($_POST['send']) && isset($_POST['name']) && isset($_POST['description'])) {
			$topicName = $_POST['name'];
			$topicDescription = $_POST['description'];
			$comment = isset($_POST['comment']) ? $_POST['comment'] : null;
	
			// Call the createTopic method to create a new topic
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

	//comments controller
	public static function comments($id) {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$itemsPerPage = 5; // Set your desired items per page
	
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
	
		if (!empty($searchQuery)) {
			$comments = Model::searchComments($id, $searchQuery);
		} else {
			$comments = Model::getAllCommentsById($id, $page, $itemsPerPage);
		}
	
		$totalItems = Model::getTotalCommentsById($id);
		$totalPages = ceil($totalItems / $itemsPerPage);
	
		include_once('view/comments.php');
		return;
	}

	//error controller
	public static function error() {
		include_once('view/error404.php');
		return;
	}

}//END CLASS
?>















