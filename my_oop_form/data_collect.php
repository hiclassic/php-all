<?php

class Student {
    private $id;
    private $name;
    private $pass;
    private $email;
    private $course;
    private $phone;

    private static $file_path = "store.txt";

    public function __construct($id, $name, $pass, $email, $course, $phone) {
        $this->id = $id;
        $this->name = $name;
        $this->pass = $pass;
        $this->email = $email;
        $this->course = $course;
        $this->phone = $phone;
    }

    public function save() {
        $data = $this->id . "," . $this->name . "," . $this->pass . "," . $this->email . "," . $this->course . "," . $this->phone . PHP_EOL;
        file_put_contents(self::$file_path, $data, FILE_APPEND);
    }

    public static function displayStudents() {
        if (file_exists(self::$file_path)) {
            $data = file_get_contents(self::$file_path);
            echo "<h3>📋 Stored Students:</h3>";
            echo "<pre>" . htmlspecialchars($data) . "</pre>";
        } else {
            echo "<p>No student data found.</p>";
        }
    }
}

?>