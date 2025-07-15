<?php
class User {
    protected $id;
    protected $name;
    protected $email;

    public function __construct($id, $name, $email) {
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
    }

    protected function setId($id) {
        $id = trim($id);
        if (strlen($id) > 5) {
            throw new Exception("❌ ID must be max 5 characters.");
        }
        $this->id = $id;
    }

    protected function setName($name) {
        $this->name = htmlspecialchars(trim($name));
    }

    protected function setEmail($email) {
        $email = trim($email);
        if (!preg_match("/^[\w\-\.]+@[\w\-]+\.[a-z]{2,}$/i", $email)) {
            throw new Exception("❌ Invalid email format.");
        }
        $this->email = htmlspecialchars($email);
    }
}
?>
