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


    // Searching topics topics method
    public static function searchTopics($searchTerm, $page = 1, $itemsPerPage = 2) {
        $offset = ($page - 1) * $itemsPerPage;

        $sql = "SELECT topics.*, users.username
                FROM topics
                JOIN users ON topics.userid = users.id
                WHERE topics.name LIKE :searchTerm
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

			// Set success message
			$_SESSION['createMessage'] = 'Topic created successfully';
			return true; // Success
		} catch (Exception $e) {
			// Rollback the transaction on error
			$db->conn->rollBack();

			// Set error message
			$_SESSION['createMessage'] = 'Failed to create topic';
			return false; // Error
		}
	}

	// Get all comments of a topic by id + pages
	public static function getAllCommentsById($id, $page = 1, $itemsPerPage = 2) {
        $db = new Database();

        $offset = ($page - 1) * $itemsPerPage;

        $sql = "SELECT comments.*, users.username
                FROM comments 
                INNER JOIN users ON comments.userid = users.id
                WHERE comments.topicid = :id 
                LIMIT :limit OFFSET :offset";

        $stmt = $db->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

		// Calculating all comments, for pages generation buttons method
    public static function getTotalCommentsById($id) {
		$sql = "SELECT COUNT(*) as count FROM `comments`";
		$db = new database();
		$result = $db->getOne($sql);
	
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