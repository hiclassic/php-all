<?php
class Student {
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($id, $name, $email, $password) {
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    private function setId($id) {
        $this->id = trim($id);
    }

    private function setName($name) {
        $this->name = htmlspecialchars(trim($name));
    }

    private function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        $this->email = $email;
    }

    private function setPassword($password) {
        if (strlen($password) < 6) {
            throw new Exception("Password must be at least 6 characters.");
        }
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function saveToFile($filename) {
        $data = "{$this->id},{$this->name},{$this->email},{$this->password}\n";
        file_put_contents($filename, $data, FILE_APPEND);
    }

    public static function displayStudents($filename) {
        if (file_exists($filename)) {
            $data = file_get_contents($filename);
            echo "<h3>📋 Stored Students:</h3>";
            echo "<pre>" . htmlspecialchars($data) . "</pre>";
        } else {
            echo "<p>No student data found.</p>";
        }
    }
     

}
?>
