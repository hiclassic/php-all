<?php
require_once 'User.php';

class Student extends User {
    public function save($filename) {
        $line = "{$this->id},{$this->name},{$this->email},{$this->password}\n";
        file_put_contents($filename, $line, FILE_APPEND);
    }

    public static function checkLogin($filename, $email, $password) {
        if (!file_exists($filename)) return false;
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            list($id, $name, $db_email, $db_password) = explode(",", $line);
            if ($email == $db_email && password_verify($password, $db_password)) {
                return [
                    'id' => $id,
                    'name' => $name,
                    'email' => $db_email
                ];
            }
        }
        return false;
    }
}
?>
