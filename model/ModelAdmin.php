<?php 
class ModelAdmin {
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
		$comments = Model::getAllCommentsById($topicId);

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

	// Model method to edit a comment
	public static function editComment($commentId, $commentText)
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

	// Model method to edit a reply
	public static function editReply($replyId, $replyText)
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

	// Model method to get all comments with pagination
	public static function getAllComments($page = 1, $itemsPerPage = 5) {
		$db = new Database();

		$offset = ($page - 1) * $itemsPerPage;

		$sql = "SELECT comments.*, users.username, topics.name AS topic_name
				FROM comments 
				INNER JOIN users ON comments.userid = users.id
				INNER JOIN topics ON comments.topicid = topics.id
				ORDER BY comments.id DESC
				LIMIT :limit OFFSET :offset";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Model method to search comments
	public static function searchComments($searchQuery) {
		$db = new Database();

		// Prepare the SQL query with a search condition
		$sql = "SELECT comments.*, users.username, topics.name AS topic_name
				FROM comments
				INNER JOIN users ON comments.userid = users.id
				INNER JOIN topics ON comments.topicid = topics.id
				WHERE comments.text LIKE :searchQuery
				ORDER BY comments.id DESC";

		// Bind parameters and execute the query
		$stmt = $db->conn->prepare($sql);
		$stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
		$stmt->execute();

		// Fetch the results
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Model method to get the total number of comments
	public static function getTotalComments() {
		$db = new Database();

		// Prepare the SQL query to count the total number of comments
		$sql = "SELECT COUNT(id) AS totalComments FROM comments";

		// Execute the query
		$stmt = $db->conn->query($sql);

		// Fetch the result
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		// Return the total number of comments
		return $result['totalComments'];
	}

	// Model method to get all replies with pagination
	public static function getAllReplies($page = 1, $itemsPerPage = 5) {
		$db = new Database();

		$offset = ($page - 1) * $itemsPerPage;

		$sql = "SELECT replies.*, users.username, comments.text AS comment_text
				FROM replies
				INNER JOIN users ON replies.userid = users.id
				INNER JOIN comments ON replies.commentid = comments.id
				ORDER BY replies.id DESC
				LIMIT :limit OFFSET :offset";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

    public static function searchReplies($searchQuery) {
        $db = new Database();

        // Prepare the SQL query with a search condition and inner join
        $sql = "SELECT replies.*, users.username
                FROM replies
                INNER JOIN users ON replies.userid = users.id
                WHERE replies.text LIKE :searchQuery
                ORDER BY replies.id DESC";

        // Bind parameters and execute the query
        $stmt = $db->conn->prepare($sql);
        $stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Model method to get the total number of replies
    public static function getTotalReplies() {
        $db = new Database();

        // Prepare the SQL query to count the total number of replies
        $sql = "SELECT COUNT(id) AS totalReplies FROM replies";

        // Execute the query
        $stmt = $db->conn->query($sql);

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the total number of replies
        return $result['totalReplies'];
    }

	// Model method to get all users with pagination
	public static function getAllUsers($page = 1, $itemsPerPage = 5) {
		$db = new Database();

		$offset = ($page - 1) * $itemsPerPage;

		$sql = "SELECT * FROM users ORDER BY id LIMIT :limit OFFSET :offset";
		
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Model method to get the total number of users
	public static function getTotalUsers() {
		$db = new Database();

		$sql = "SELECT COUNT(*) FROM users";
		
		$stmt = $db->conn->prepare($sql);
		$stmt->execute();

		return $stmt->fetchColumn();
	}

	public static function searchUsers($searchQuery) {
		$db = new Database();
	
		// Define the SQL query for searching users
		$sql = "SELECT * FROM users WHERE username LIKE :searchQuery OR email LIKE :searchQuery OR description LIKE :searchQuery";
		
		$searchQuery = '%' . $searchQuery . '%';
	
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_STR);
		
		// Execute the query
		$stmt->execute();
	
		// Fetch the results
		$searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
		return $searchResults;
	}

	// Model method to edit user by ID
	public static function editUserById($userId) {
		$db = new Database();

		// Fetch user data
		$user = Model::getUserById($userId);

		// Validate and update user data
		$username = !empty($_POST['username']) ? $_POST['username'] : $user['username'];
		$email = !empty($_POST['email']) ? $_POST['email'] : $user['email'];
		$password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];
		$description = !empty($_POST['description']) ? $_POST['description'] : $user['description'];
		$role = !empty($_POST['role']) ? $_POST['role'] : $user['role'];

		// Handle image upload
		if ($_FILES['userImage']['error'] === UPLOAD_ERR_OK) {
			$uploadDir = 'uploads/';
			$uploadPath = $uploadDir . basename($_FILES['userImage']['name']);
			move_uploaded_file($_FILES['userImage']['tmp_name'], $uploadPath);

			// Update the user's image path in the database
			$user['imgpath'] = $uploadPath;
		}

		// Update the user in the database
		$sql = "UPDATE users SET username = :username, email = :email, password = :password, imgpath = :imgpath, description = :description, role = :role WHERE id = :userId";
		$stmt = $db->conn->prepare($sql);

		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':imgpath', $user['imgpath'], PDO::PARAM_STR); // No change if image not uploaded
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':role', $role, PDO::PARAM_STR);
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

		// Execute the query
		$stmt->execute();

		// Return updated user data
		return $user;
	}
}
?>