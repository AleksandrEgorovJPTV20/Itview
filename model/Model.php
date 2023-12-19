<?php 
class Model {
    // Load tech data for the given year
    public static function getAlltechByYear($year) {
		$sql = "SELECT * FROM `tech` WHERE `year`='".$year."' LIMIT 3";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}

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

    public static function getTotalTopics() {
		$sql = "SELECT COUNT(*) as count FROM `topics`";
		$db = new database();
		$result = $db->getOne($sql);
	
		// Check if $result is not empty and contains the 'count' key
		if (!empty($result) && isset($result['count'])) {
			return $result['count'];
		}
	
		// Return 0 if there was an issue
		return 0;
	}

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
		return;
	}
}
?>