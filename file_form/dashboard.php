<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

$student = $_SESSION['student'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['myfile'])) {
    $file = $_FILES['myfile'];
    if ($file['error'] === UPLOAD_ERR_OK) {
        $name = basename($file['name']);
        $tmp = $file['tmp_name'];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed = ['jpg','png','pdf','txt'];

        if (!in_array($ext, $allowed)) {
            $message = "❌ File type not allowed.";
        } else {
            $newName = uniqid('file_', true) . '.' . $ext;
            move_uploaded_file($tmp, 'uploads/' . $newName);
            file_put_contents('uploaded_files.txt', "{$student['email']},{$newName}\n", FILE_APPEND);
            $message = "✅ File uploaded!";

        }
    }
}

?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Welcome, <?= htmlspecialchars($student['name']) ?></h2>
    <p>ID: <?= htmlspecialchars($student['id']) ?></p>
    <p>Email: <?= htmlspecialchars($student['email']) ?></p>

    <h3>Upload File</h3>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="myfile" required>
        <button type="submit">Upload</button>
    </form>

    <h3>Your Uploaded Files</h3>
    <?php
    if (file_exists('uploaded_files.txt')) {
        $lines = file('uploaded_files.txt', FILE_IGNORE_NEW_LINES);
        echo "<ul>";
        foreach ($lines as $line) {
            list($email, $file) = explode(",", $line);
            if ($email == $student['email']) {
                echo "<li><a href='uploads/$file' target='_blank'>$file</a></li>";
                echo " <img src='uploads/$file' width='100px'>";
            }
        }
        echo "</ul>";
    }
    ?>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
