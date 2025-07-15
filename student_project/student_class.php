<?php
class Student {
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($id, $name, $email, $password) {
        $this->id = trim($id);
        $this->name = htmlspecialchars(trim($name));
        $this->email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        $this->password = password_hash(trim($password), PASSWORD_DEFAULT);
    }

    public function save($filename) {
        $data = "{$this->id},{$this->name},{$this->email},{$this->password}\n";
        file_put_contents($filename, $data, FILE_APPEND);
    }

    public static function authenticate($filename, $email, $password) {
        if (!file_exists($filename)) return false;

        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($id, $name, $storedEmail, $storedHash) = explode(",", trim($line), 4);
            if ($storedEmail === $email && password_verify($password, $storedHash)) {
                return ['id' => $id, 'name' => $name, 'email' => $storedEmail];
            }
        }
        return false;
    }
}
?>
