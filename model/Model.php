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

		$sql = "SELECT topics.*, users.username, users.imgpath
        FROM topics
        JOIN users ON topics.userid = users.id
        ORDER BY topics.id ASC
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

		$sql = "SELECT topics.*, users.username, users.imgpath, users.email
				FROM topics
				JOIN users ON topics.userid = users.id
				WHERE topics.name LIKE :searchTerm 
					OR users.username LIKE :searchTerm
					OR users.email LIKE :searchTerm
				ORDER BY topics.id ASC
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
	
	// Get all comments of a topic by id + pages, ordered by comments.id in descending order
	public static function getAllCommentsById($topicId, $page = 1, $itemsPerPage = 5) {
		$db = new Database();

		$offset = ($page - 1) * $itemsPerPage;

		$sql = "SELECT comments.*, users.username, users.imgpath AS userimg
				FROM comments 
				INNER JOIN users ON comments.userid = users.id
				WHERE comments.topicid = :topicid 
				ORDER BY comments.id DESC
				LIMIT :limit OFFSET :offset";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':topicid', $topicId, PDO::PARAM_INT);
		$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Model for searching comments for a certain topic, ordered by comments.id in descending order
	public static function searchComments($topicId, $searchQuery) {
		$db = new Database();

		$sql = "SELECT comments.*, users.username, users.imgpath AS userimg
				FROM comments 
				INNER JOIN users ON comments.userid = users.id
				WHERE comments.topicid = :topicid 
				AND (users.username LIKE :searchQuery OR users.email LIKE :searchQuery)
				ORDER BY comments.id DESC";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':topicid', $topicId, PDO::PARAM_INT);
		$stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Model method to create a new comment
	public static function createComment($topicId, $userId, $commentText)
	{
		$db = new Database();
		// Handle image upload
		$uploadDir = 'uploads/comments/';
		if ($_FILES['Image1']['error'] === UPLOAD_ERR_OK) {
			$uploadPath1 = $uploadDir . basename($_FILES['Image1']['name']);
			move_uploaded_file($_FILES['Image1']['tmp_name'], $uploadPath1);
		}

		if ($_FILES['Image2']['error'] === UPLOAD_ERR_OK) {
			$uploadPath2 = $uploadDir . basename($_FILES['Image2']['name']);
			move_uploaded_file($_FILES['Image2']['tmp_name'], $uploadPath2);
		}

		if ($_FILES['Image3']['error'] === UPLOAD_ERR_OK) {
			$uploadPath3 = $uploadDir . basename($_FILES['Image3']['name']);
			move_uploaded_file($_FILES['Image3']['tmp_name'], $uploadPath3);
		}
		// Prepare the SQL query
		$sql = "INSERT INTO comments (text, userid, topicid, imgpath, imgpath2, imgpath3, created_at, updated_at) 
				VALUES (:commentText, :userid, :topicid, :imgpath, :imgpath2, :imgpath3, NOW(), NOW())";
	
		// Execute the query
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentText', $commentText, PDO::PARAM_STR);
		$stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
		$stmt->bindParam(':topicid', $topicId, PDO::PARAM_INT);
		$stmt->bindParam(':imgpath', $uploadPath1, PDO::PARAM_STR); // No change if image not uploaded
		$stmt->bindParam(':imgpath2', $uploadPath2, PDO::PARAM_STR); // No change if image not uploaded
		$stmt->bindParam(':imgpath3', $uploadPath3, PDO::PARAM_STR); // No change if image not uploaded	
		// Check if the query executed successfully
		if ($stmt->execute()) {
			return true; // Comment creation successful
		} else {
			return false; // Comment creation failed
		}
	}

	// Calculating total comments for a specific topic
	public static function getTotalCommentsById($topicId) {
		$sql = "SELECT COUNT(*) as count FROM `comments` WHERE `topicid` = $topicId";
		$db = new Database();
		$result = $db->getOne($sql);

		if (!empty($result) && isset($result['count'])) {
			return $result['count'];
		}

		return 0;
	}
	
	// Get all replies of a comment by id + pages, ordered by replies.id in descending order
	public static function getAllRepliesByCommentId($commentId, $page = 1, $itemsPerPage = 5) {
		$db = new Database();

		$offset = ($page - 1) * $itemsPerPage;

		$sql = "SELECT replies.*, users.username, users.imgpath AS userimg
				FROM replies 
				INNER JOIN users ON replies.userid = users.id
				WHERE replies.commentid = :commentid 
				ORDER BY replies.id DESC
				LIMIT :limit OFFSET :offset";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentid', $commentId, PDO::PARAM_INT);
		$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Model for searching replies for a certain comment, ordered by replies.id in descending order
	public static function searchReplies($commentId, $searchQuery) {
		$db = new Database();

		$sql = "SELECT replies.*, users.username, users.imgpath AS userimg
				FROM replies
				INNER JOIN users ON replies.userid = users.id
				WHERE replies.commentid = :commentid
				AND (users.username LIKE :searchQuery OR users.email LIKE :searchQuery)
				ORDER BY replies.id DESC";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentid', $commentId, PDO::PARAM_INT);
		$stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	// Get a single comment by ID
	public static function getCommentById($commentId) {
		$db = new Database();

		$sql = "SELECT comments.*, users.username, users.imgpath AS userimg
				FROM comments
				INNER JOIN users ON comments.userid = users.id
				WHERE comments.id = :commentid";

		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentid', $commentId, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	// Model method to create a new reply
	public static function createReply($commentId, $userId, $commentText)
	{
		$db = new Database();

		$uploadDir = 'uploads/replies/';
		if ($_FILES['Image1']['error'] === UPLOAD_ERR_OK) {
			$uploadPath1 = $uploadDir . basename($_FILES['Image1']['name']);
			move_uploaded_file($_FILES['Image1']['tmp_name'], $uploadPath1);
		}

		if ($_FILES['Image2']['error'] === UPLOAD_ERR_OK) {
			$uploadPath2 = $uploadDir . basename($_FILES['Image2']['name']);
			move_uploaded_file($_FILES['Image2']['tmp_name'], $uploadPath2);
		}

		if ($_FILES['Image3']['error'] === UPLOAD_ERR_OK) {
			$uploadPath3 = $uploadDir . basename($_FILES['Image3']['name']);
			move_uploaded_file($_FILES['Image3']['tmp_name'], $uploadPath3);
		}
		// Prepare the SQL query
		$sql = "INSERT INTO replies (text, userid, commentid, imgpath, imgpath2, imgpath3, created_at, updated_at) 
				VALUES (:commentText, :userid, :commentid, :imgpath, :imgpath2, :imgpath3, NOW(), NOW())";

		// Execute the query
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentText', $commentText, PDO::PARAM_STR);
		$stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
		$stmt->bindParam(':commentid', $commentId, PDO::PARAM_INT);
		$stmt->bindParam(':imgpath', $uploadPath1, PDO::PARAM_STR); // No change if image not uploaded
		$stmt->bindParam(':imgpath2', $uploadPath2, PDO::PARAM_STR); // No change if image not uploaded
		$stmt->bindParam(':imgpath3', $uploadPath3, PDO::PARAM_STR); // No change if image not uploaded	
	
		// Check if the query executed successfully
		if ($stmt->execute()) {
			return true; // Comment creation successful
		} else {
			return false; // Comment creation failed
		}
	}

	// Get the total number of replies for a specific comment
	public static function getTotalRepliesByCommentId($commentId) {
		$db = new Database();

		$sql = "SELECT COUNT(*) as count FROM `replies` WHERE `commentid` = :commentid";
		
		$stmt = $db->conn->prepare($sql);
		$stmt->bindParam(':commentid', $commentId, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!empty($result) && isset($result['count'])) {
			return $result['count'];
		}

		return 0;
	}

	//Get user info by userId 
    public static function getUserById($userId) {
        $db = new Database();

        // Prepare the SQL query
        $sql = "SELECT * FROM users WHERE id = :userId";

        // Bind parameters and execute the query
        $stmt = $db->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the user information
        return $user;
    }

	// Model method to edit user profile by ID
	public static function editUserById($userId) {
		$db = new Database();

		// Fetch user data
		$user = self::getUserById($userId);

		// Validate and update user data
		$username = !empty($_POST['username']) ? $_POST['username'] : $user['username'];
		$email = !empty($_POST['email']) ? $_POST['email'] : $user['email'];
		$password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];
		$description = !empty($_POST['description']) ? $_POST['description'] : '';
		$twitter = !empty($_POST['twitter']) ? $_POST['twitter'] : '';
		$instagram = !empty($_POST['instagram']) ? $_POST['instagram'] : '';
		$facebook = !empty($_POST['facebook']) ? $_POST['facebook'] : '';
		$discord = !empty($_POST['discord']) ? $_POST['discord'] : '';

		// Handle image upload
		if (isset($_FILES['userImage']) && $_FILES['userImage']['error'] === UPLOAD_ERR_OK) {
			$uploadDir = 'uploads/users/';
			$uploadPath = $uploadDir . basename($_FILES['userImage']['name']);
			move_uploaded_file($_FILES['userImage']['tmp_name'], $uploadPath);

			// Update the user's image path in the database
			$user['imgpath'] = $uploadPath;
		}

		// Check if confirm password matches current password
		$confirmPassword = !empty($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

		if (!password_verify($confirmPassword, $user['password'])) {
			// Password and confirm password do not match
			$_SESSION['userEditMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Viga: Kinnitussalas ei klapi praeguse salasõnaga' : 'Error: Confirm password does not match the current password');
			return false;
		}

		// Update the user in the database
		$sql = "UPDATE users SET username = :username, email = :email, password = :password, imgpath = :imgpath, description = :description, twitter = :twitter, instagram = :instagram, facebook = :facebook, discord = :discord WHERE id = :userId";
		$stmt = $db->conn->prepare($sql);

		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':imgpath', $user['imgpath'], PDO::PARAM_STR); // No change if image not uploaded
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':twitter', $twitter, PDO::PARAM_STR);
		$stmt->bindParam(':instagram', $instagram, PDO::PARAM_STR);
		$stmt->bindParam(':facebook', $facebook, PDO::PARAM_STR);
		$stmt->bindParam(':discord', $discord, PDO::PARAM_STR);
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

		// Execute the query
		$stmt->execute();

		// Return updated user data
		return $user;
	}


    public static function sendReport($reportedUserId, $reportText) {
        $userId = $_SESSION['userId'];
		$db = new Database();

        // Check if the user has already reported the same user
        $existingReport = self::getReportByUserAndReportedUser($userId, $reportedUserId);

        if ($existingReport) {
            // If there is an existing report, you can handle it accordingly
            // For example, display a message to the user
            $_SESSION['userReportMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Olete selle kasutaja juba raporteerinud' : 'You have already reported this user');
            return false;
        }

        // Insert the report into the database
        $sql = "INSERT INTO reports (userId, reportedUserId, text) VALUES (?, ?, ?)";
		$stmt = $db->conn->prepare($sql);
        $stmt->execute([$userId, $reportedUserId, $reportText]);

        // You can check if the insertion was successful and handle accordingly
        if ($stmt->rowCount() > 0) {
            $_SESSION['userReportMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Raport saadetud edukalt' : 'Report sent successfully');
            return true;
        } else {
            $_SESSION['userReportMessage'] = (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Ebaõnnestus raporti saatmine' : 'Failed to send report');
            return false;
        }
    }

    // Additional method to get a report by user and reported user
    public static function getReportByUserAndReportedUser($userId, $reportedUserId) {
		$db = new Database();
        $sql = "SELECT * FROM reports WHERE userId = ? AND reportedUserId = ?";
		$stmt = $db->conn->prepare($sql);
        $stmt->execute([$userId, $reportedUserId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>