<?php
require_once 'user.php';

class Student extends User {
    private $photo;

    public function __construct($id, $name, $email, $photo) {
        parent::__construct($id, $name, $email);
        $this->setPhoto($photo);
    }

    private function setPhoto($photo) {
        if ($photo['error'] === UPLOAD_ERR_OK) {
            $tmp = $photo['tmp_name'];
            $name = $photo['name'];
            $size = $photo['size'];

            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($ext, $allowed)) {
                throw new Exception("❌ Only JPG, PNG, GIF allowed.");
            }

            if ($size > 1024 * 1024) {
                throw new Exception("❌ Image too large (max 1MB).");
            }

            $newName = uniqid('img_', true) . '.' . $ext;
            $uploadPath = 'uploads/' . $newName;

            if (!move_uploaded_file($tmp, $uploadPath)) {
                throw new Exception("❌ Failed to upload photo.");
            }

            $this->photo = $newName;

        } else {
            throw new Exception("❌ Photo required.");
        }
    }

    public function save($filename) {
        $line = "{$this->id},{$this->name},{$this->email},{$this->photo}\n";
        file_put_contents($filename, $line, FILE_APPEND);
    }

    public static function display($filename) {
        if (!file_exists($filename)) {
            echo "<p>No students yet.</p>";
            return;
        }
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        echo "<h3>📋 Registered Students:</h3>";
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Photo</th></tr>";
        foreach ($lines as $line) {
            list($id, $name, $email, $photo) = explode(",", $line);
            echo "<tr>
                <td>" . htmlspecialchars($id) . "</td>
                <td>" . htmlspecialchars($name) . "</td>
                <td>" . htmlspecialchars($email) . "</td>
                <td><img src='uploads/" . htmlspecialchars($photo) . "' width='80'></td>
            </tr>";
        }
        echo "</table>";
    }
}
?>
