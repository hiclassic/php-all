<?php
session_start();
require_once 'student_class.php';

if (!isset($_SESSION['student_email'])) {
    header("Location: login.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_file'])) {
    try {
        Student::handleFileUpload($_FILES['upload_file']);
        $message = "File uploaded successfully!";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; }
        .container { max-width: 600px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #aaa; }
        h2 { text-align: center; }
        form { margin: 20px 0; }
        input[type="file"] { display: block; margin-bottom: 15px; }
        input[type="submit"] { padding: 10px 20px; background: #007BFF; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        input[type="submit"]:hover { background: #0056b3; }
        .message { padding: 10px; background: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; border-radius: 4px; margin-bottom: 20px; }
        a { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
    </style>
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['student_email']); ?></h2>
    <p><a href="logout.php">Logout</a></p>

    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <h3>Upload File</h3>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="upload_file" required>
        <input type="submit" value="Upload">
    </form>

    <?php Student::displayUploadedFiles(); ?>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
