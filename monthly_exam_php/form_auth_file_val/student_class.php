<?php
class Student {
    private $id;
    private $name;
    private $batch;
    private $email;
    private $password;

    public function __construct($id, $name, $batch, $email = '', $password = '') {
        $this->setId($id);
        $this->setName($name);
        $this->setBatch($batch);
        $this->email = trim($email);
        $this->password = trim($password);
    }

    // ... setId(), setName(), setBatch() as before

    public function saveToFile($filename) {
        $data = "{$this->id},{$this->name},{$this->batch},{$this->email},{$this->password}\n";
        file_put_contents($filename, $data, FILE_APPEND);
    }

    public static function authenticate($filename, $email, $password) {
        if (!file_exists($filename)) return false;

        $rows = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($rows as $row) {
            $parts = explode(",", $row);
            if (count($parts) >= 5) {
                list($id, $name, $batch, $savedEmail, $savedPassword) = $parts;
                if (trim($savedEmail) === $email && trim($savedPassword) === $password) {
                    return true;
                }
            }
        }
        return false;
    }

    // + handleFileUpload() & displayUploadedFiles() as before...
}

?>
