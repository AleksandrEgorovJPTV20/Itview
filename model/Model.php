<?php 
class Model {
	//Read all users
	public static function getUsers() {
		$sql = "SELECT * FROM `users`";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}
	
    // Load tech data for the given year method
    public static function getAlltechByYear($year) {
		$sql = "SELECT * FROM `tech` WHERE `year`='".$year."' LIMIT 3";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}

	// Get all topics for the forum page + pages method
    public static function getAllTopics($page = 1, $itemsPerPage = 2) {
		$offset = ($page - 1) * $itemsPerPage;

		$sql = "SELECT topics.*, users.username
        FROM topics
        JOIN users ON topics.userid = users.id
        ORDER BY topics.id DESC
        LIMIT :offset, :limit";

		$db = new database();
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
		$stmt->execute();
	
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}


	// Model for searching topics by name, username, or description
	public static function searchTopics($searchTerm, $page = 1, $itemsPerPage = 2) {
		$offset = ($page - 1) * $itemsPerPage;

		$sql = "SELECT topics.*, users.username
				FROM topics
				JOIN users ON topics.userid = users.id
				WHERE topics.name LIKE :searchTerm 
					OR users.username LIKE :searchTerm
					OR topics.description LIKE :searchTerm
				ORDER BY topics.id DESC
				LIMIT :offset, :limit";

		$db = new Database();
		$stmt = $db->conn->prepare($sql);
		$stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	// Calculating all topics, for pages generation buttons method
    public static function getTotalTopics() {
		$sql = "SELECT COUNT(*) as count FROM `topics`";
		$db = new database();
		$result = $db->getOne($sql);
	
		if (!empty($result) && isset($result['count'])) {
			return $result['count'];
		}
	
		return 0;
	}
	
    // Method to get the count of comments for each topic
	public static function getCommentCountForTopics($topics)
	{
		// Check if there are topics to search for
		if (empty($topics)) {
			return [];
		}
	
		$db = new Database();
	
		// Prepare the SQL query
		$sql = "SELECT topicid, COUNT(*) AS comment_count FROM comments WHERE topicid IN (";
		$sql .= implode(", ", array_map(function ($topic) {
			return $topic['id'];
		}, $topics));
		$sql .= ") GROUP BY topicid";
	
		// Execute the query
		$stmt = $db->conn->prepare($sql);
		$stmt->execute();
	
		// Fetch the results
		$commentCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
		// Organize the counts by topic id
		$countsByTopicId = [];
		foreach ($commentCounts as $count) {
			$countsByTopicId[$count['topicid']] = $count['comment_count'];
		}
	
		return $countsByTopicId;
	}

	
	// Create topic method
	public static function createTopic($topicName, $topicDescription, $comment = null) {
		$db = new Database();

		// Start a transaction to ensure data consistency
		$db->conn->beginTransaction();

		try {
			// Insert into topics table
			$sqlTopic = "INSERT INTO topics (userid, name, description) VALUES (:userid, :name, :description)";
			$stmtTopic = $db->conn->prepare($sqlTopic);
			$stmtTopic->bindParam(':userid', $_SESSION['userId'], PDO::PARAM_INT);
			$stmtTopic->bindParam(':name', $topicName, PDO::PARAM_STR);
			$stmtTopic->bindParam(':description', $topicDescription, PDO::PARAM_STR);
			$stmtTopic->execute();

			// Retrieve the topic ID
			$topicId = $db->conn->lastInsertId();

			// Insert into comments table (if comment is provided)
			if ($comment !== null && $comment !== '') {
				$sqlComment = "INSERT INTO comments (userid, topicid, text) VALUES (:userid, :topicid, :text)";
				$stmtComment = $db->conn->prepare($sqlComment);
				$stmtComment->bindParam(':userid', $_SESSION['userId'], PDO::PARAM_INT);
				$stmtComment->bindParam(':topicid', $topicId, PDO::PARAM_INT);
				$stmtComment->bindParam(':text', $comment, PDO::PARAM_STR);
				$stmtComment->execute();
			}

			// Commit the transaction
			$db->conn->commit();
			return true; // Success
		} catch (Exception $e) {
			// Rollback the transaction on error
			$db->conn->rollBack();
			return false; // Error
		}
	}
	// Edit topic method
	public static function editTopic($topicId, $topicName, $topicDescription) {
		$db = new Database();

		try {
			// Update the topic in the topics table
			$sql = "UPDATE topics SET name = :name, description = :description WHERE id = :id";
			$stmt = $db->conn->prepare($sql);
			$stmt->bindParam(':id', $topicId, PDO::PARAM_INT);
			$stmt->bindParam(':name', $topicName, PDO::PARAM_STR);
			$stmt->bindParam(':description', $topicDescription, PDO::PARAM_STR);
			$stmt->execute();

			return true; // Success
		} catch (Exception $e) {
			return false; // Error
		}
	}
	// Delete topic method
	public static function deleteTopic($topicId) {
		// Check if the user is allowed to delete this topic (authorization logic goes here)

		// Get all comments for the topic
		$comments = self::getAllCommentsById($topicId);

		// Delete comments and their associated replies
		foreach ($comments as $comment) {
			self::deleteComment($comment['id']);
		}

		// Finally, delete the topic
		$db = new Database();
		$stmt = $db->conn->prepare("DELETE FROM topics WHERE id = :topicId");
		$stmt->bindParam(':topicId', $topicId, PDO::PARAM_INT);

		try {
			$stmt->execute();
			return true;
		} catch (PDOException $e) {
			// Handle the exception if necessary
			return false;
		}
	}
	
	// Get all comments of a topic by id + pages, ordered by comments.id in descending order
	public static function getAllCommentsById($topicid, $page = 1, $itemsPerPage = 5) {
		$db = new Database();

		$offset = ($page - 1) * $itemsPerPage;

		$sql = "SELECT comments.*, users.username
				FROM comments 
				INNER JOIN users ON comments.userid = users.id
				WHERE comments.topicid = :topicid 
				ORDER BY comments.id DESC
				LIMIT :limit OFFSET :offset";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':topicid', $topicid, PDO::PARAM_INT);
		$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Model for searching comments for a certain topic, ordered by comments.id in descending order
	public static function searchComments($topicid, $searchQuery) {
		$db = new Database();

		$sql = "SELECT comments.*, users.username
				FROM comments 
				INNER JOIN users ON comments.userid = users.id
				WHERE comments.topicid = :topicid 
				AND (comments.text LIKE :searchQuery OR users.username LIKE :searchQuery)
				ORDER BY comments.id DESC";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':topicid', $topicid, PDO::PARAM_INT);
		$stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Model method to create a new comment
	public static function createComment($topicid, $userId, $commentText)
	{
		$db = new Database();
	
		// Prepare the SQL query
		$sql = "INSERT INTO comments (text, userid, topicid, created_at, updated_at) 
				VALUES (:commentText, :userid, :topicid, NOW(), NOW())";
	
		// Execute the query
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentText', $commentText, PDO::PARAM_STR);
		$stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
		$stmt->bindParam(':topicid', $topicid, PDO::PARAM_INT);
	
		// Check if the query executed successfully
		if ($stmt->execute()) {
			return true; // Comment creation successful
		} else {
			return false; // Comment creation failed
		}
	}
	// Model method to edit a comment
	public static function editComment($commentId, $topicId, $userId, $commentText)
	{
		$db = new Database();
	
		// Prepare the SQL query
		$sql = "UPDATE comments 
				SET text = :commentText, updated_at = NOW()
				WHERE id = :commentId";
	
		// Execute the query
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentText', $commentText, PDO::PARAM_STR);
		$stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
	
		// Check if the query executed successfully
		if ($stmt->execute()) {
			return true; // Comment edit successful
		} else {
			return false; // Comment edit failed
		}
	}

	// Model method to delete a comment and its associated replies
	public static function deleteComment($commentId)
	{
		// Start by deleting replies associated with the comment
		self::deleteRepliesByCommentId($commentId);
	
		// Now, delete the comment
		$db = new database();
		$stmt = $db->connect()->prepare("DELETE FROM comments WHERE id = :commentId");
		$stmt->bindValue(':commentId', $commentId, PDO::PARAM_INT);
	
		try {
			$stmt->execute();
			return true;
		} catch (PDOException $e) {
			// Handle the exception if necessary
			return false;
		}
	}
	
	// Helper method to delete replies associated with a comment
	private static function deleteRepliesByCommentId($commentId)
	{
		$db = new database();
		$stmt = $db->connect()->prepare("DELETE FROM replies WHERE commentid = :commentId");
		$stmt->bindValue(':commentId', $commentId, PDO::PARAM_INT);
	
		try {
			$stmt->execute();
		} catch (PDOException $e) {
			// Handle the exception if necessary
		}
	}

	// Calculating total comments for a specific topic
	public static function getTotalCommentsById($topicid) {
		$sql = "SELECT COUNT(*) as count FROM `comments` WHERE `topicid` = $topicid";
		$db = new Database();
		$result = $db->getOne($sql);

		if (!empty($result) && isset($result['count'])) {
			return $result['count'];
		}

		return 0;
	}
	
	// Get all replies of a comment by id + pages, ordered by replies.id in descending order
	public static function getAllRepliesByCommentId($commentid, $page = 1, $itemsPerPage = 5) {
		$db = new Database();

		$offset = ($page - 1) * $itemsPerPage;

		$sql = "SELECT replies.*, users.username
				FROM replies 
				INNER JOIN users ON replies.userid = users.id
				WHERE replies.commentid = :commentid 
				ORDER BY replies.id DESC
				LIMIT :limit OFFSET :offset";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentid', $commentid, PDO::PARAM_INT);
		$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Model for searching replies for a certain comment, ordered by replies.id in descending order
	public static function searchReplies($commentid, $searchQuery) {
		$db = new Database();

		$sql = "SELECT replies.*, users.username
				FROM replies
				INNER JOIN users ON replies.userid = users.id
				WHERE replies.commentid = :commentid
				AND (replies.text LIKE :searchQuery OR users.username LIKE :searchQuery)
				ORDER BY replies.id DESC";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentid', $commentid, PDO::PARAM_INT);
		$stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	// Get a single comment by ID
	public static function getCommentById($commentid) {
		$db = new Database();

		$sql = "SELECT comments.*, users.username
				FROM comments
				INNER JOIN users ON comments.userid = users.id
				WHERE comments.id = :commentid";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentid', $commentid, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	// Model method to create a new reply
	public static function createReply($commentid, $userId, $commentText)
	{
		$db = new Database();
	
		// Prepare the SQL query
		$sql = "INSERT INTO replies (text, userid, commentid, created_at, updated_at) 
				VALUES (:commentText, :userid, :commentid, NOW(), NOW())";
	
		// Execute the query
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentText', $commentText, PDO::PARAM_STR);
		$stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
		$stmt->bindParam(':commentid', $commentid, PDO::PARAM_INT);
	
		// Check if the query executed successfully
		if ($stmt->execute()) {
			return true; // Comment creation successful
		} else {
			return false; // Comment creation failed
		}
	}
	// Model method to edit a reply
	public static function editReply($replyId, $userId, $replyText)
	{
		$db = new Database();

		// Prepare the SQL query
		$sql = "UPDATE replies 
				SET text = :replyText, updated_at = NOW()
				WHERE id = :replyId";

		// Execute the query
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':replyText', $replyText, PDO::PARAM_STR);
		$stmt->bindParam(':replyId', $replyId, PDO::PARAM_INT);

		// Check if the query executed successfully
		return $stmt->execute();
	}

	// Model method to delete a reply
	public static function deleteReply($replyId)
	{
		$db = new database();

		$stmt = $db->connect()->prepare("DELETE FROM replies WHERE id = :replyId");
		$stmt->bindValue(':replyId', $replyId, PDO::PARAM_INT);

		try {
			$stmt->execute();
			return true;
		} catch (PDOException $e) {
			// Handle the exception if necessary
			return false;
		}
	}

	// Get the total number of replies for a specific comment
	public static function getTotalRepliesByCommentId($commentid) {
		$db = new Database();

		$sql = "SELECT COUNT(*) as count FROM `replies` WHERE `commentid` = :commentid";
		
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentid', $commentid, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!empty($result) && isset($result['count'])) {
			return $result['count'];
		}

		return 0;
	}
	//Work in progress
    public static function sendmessage() {
		if (isset($_POST['send'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$subject = $_POST['subject'];
			$message = $_POST['message'];

			$to = 'aleksandr.egorov@ivkhk.com';
			$headers = 'From: ' . $email . "\r\n" .
					'Reply-To: ' . $email . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

			// Compose the email message
			$emailMessage = "Name: $name\n";
			$emailMessage .= "Email: $email\n";
			$emailMessage .= "Subject: $subject\n\n";
			$emailMessage .= "Message:\n$message";

			if (mail($to, $subject, $emailMessage, $headers)) {
				echo 'Message sent successfully.';
			} else {
				echo 'Error sending message.';
			}
		}
	}
}
?>