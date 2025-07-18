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

    private function setId($id) {
        $this->id = trim($id);
    }

    private function setName($name) {
        $this->name = htmlspecialchars(trim($name));
    }

    private function setBatch($batch) {
        $this->batch = trim($batch);
    }

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

    public static function handleFileUpload($file) {
    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("File upload error.");
    }

    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Invalid file type. Only JPG, PNG, PDF allowed.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File too large. Max 2MB allowed.");
    }

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $filename = basename($file['name']);
    $targetPath = $uploadDir . time() . '_' . $filename;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $info = "{$targetPath}|{$file['type']}|{$file['size']}\n";
        file_put_contents('uploads/files.txt', $info, FILE_APPEND);
        return true;
    } else {
        throw new Exception("Failed to move uploaded file.");
    }
}

   public static function displayUploadedFiles() {
    $filePath = 'uploads/files.txt';

    if (!file_exists($filePath)) {
        echo "<p>No uploaded files found.</p>";
        return;
    }

    $rows = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    echo '<div style="max-width:600px; margin:20px auto;">';
    echo '<h3>Uploaded Files</h3>';

    foreach ($rows as $row) {
        list($path, $type, $size) = explode('|', $row);
        $sizeKB = round($size / 1024, 2);

        echo '<div style="border:1px solid #ccc; padding:10px; margin:10px 0; border-radius:5px;">';

        if (strpos($type, 'image/') === 0) {
            echo '<img src="'.$path.'" width="100"><br>';
        }

        echo "<strong>File:</strong> ".basename($path)."<br>";
        echo "<strong>Type:</strong> {$type}<br>";
        echo "<strong>Size:</strong> {$sizeKB} KB";

        echo '</div>';
    }

    echo '</div>';
}

}
