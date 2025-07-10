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
            $id = htmlspecialchars($id);
            $name = htmlspecialchars($name);
            $batch = htmlspecialchars($batch);
            echo "<tr><td>{$id}</td><td>{$name}</td><td>{$batch}</td></tr>";
        }

        echo "</tbody></table>";
    }
}
?>
