<?php
class Controller { 
   //homepage controller
   public static function StartSite() {
		$years = [2021, 2022, 2023];
		include_once('view/homepage.php');
		return;
	}
	//tech by year controller
	public static function tech($year) {
		$years = [2021, 2022, 2023];
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
		$itemsPerPage = 10; // Set the number of items per page
		$searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
	
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
		if ($searchTerm) {
			$topics = Model::searchTopics($searchTerm, $page, $itemsPerPage);
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
	
	
	//error controller
	public static function error() {
		include_once('view/error404.php');
		return;
	}

}//END CLASS
?>















