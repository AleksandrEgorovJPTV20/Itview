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

	// Calculating all topics, for pages generatiion buttons method
    public static function getTotalTopics() {
		$sql = "SELECT COUNT(*) as count FROM `topics`";
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