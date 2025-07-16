<?php
class User {
    protected $id;
    protected $name;
    protected $email;
    protected $password;

    public function __construct($id, $name, $email, $password) {
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    protected function setId($id) {
        if (strlen($id) > 5) {
            throw new Exception("ID must be max 5 chars.");
        }
        $this->id = trim($id);
    }

    protected function setName($name) {
        $this->name = htmlspecialchars(trim($name));
    }

    protected function setEmail($email) {
        if (!preg_match("/^[\w\-\.]+@[\w\-]+\.[a-z]{2,}$/i", $email)) {
            throw new Exception("Invalid email format.");
        }
        $this->email = trim($email);
    }

    protected function setPassword($password) {
        if (strlen($password) < 4) {
            throw new Exception("Password must be at least 4 chars.");
        }
        $this->password = password_hash(trim($password), PASSWORD_DEFAULT);
    }
}
?>
