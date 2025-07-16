<?php
class Student {
    private $id;
    private $name;
    private $batch;

    public function __construct($id, $name, $batch) {
        $this->setId($id);
        $this->setName($name);
        $this->setBatch($batch);
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
        $data = "{$this->id},{$this->name},{$this->batch}\n";
        file_put_contents($filename, $data, FILE_APPEND);
    }

    public static function displayStudents($filename) {
        if (!file_exists($filename)) {
            echo "<p>No student data found.</p>";
            return;
        }

        $rows = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        echo <<<TABLE
        <style>
            table {
                border-collapse: collapse;
                width: 60%;
                margin: 20px auto;
                font-family: Arial, sans-serif;
            }
            th, td {
                border: 1px solid #999;
                padding: 8px 12px;
                text-align: center;
            }
            th {
                background-color: #f4f4f4;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
        </style>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Batch</th>
                </tr>
            </thead>
            <tbody>
        TABLE;

        foreach ($rows as $student) {
            list($id, $name, $batch) = explode(",", trim($student));
            echo "<tr><td>{$id}</td><td>{$name}</td><td>{$batch}</td></tr>";
        }

        echo "</tbody></table>";
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
            $info = "{$filename}|{$file['type']}|{$file['size']}\n";
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
            list($name, $type, $size) = explode('|', $row);
            $sizeKB = round($size / 1024, 2);
            echo <<<BOX
                <div style="border:1px solid #ccc; padding:10px; margin:10px 0; border-radius:5px;">
                    <strong>File:</strong> {$name}<br>
                    <strong>Type:</strong> {$type}<br>
                    <strong>Size:</strong> {$sizeKB} KB
                </div>
            BOX;
        }

        echo '</div>';
    }
}
?>
