<?php
session_start();

// OOP Student class load
require_once __DIR__ . '/oopstudent.php';



$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $student = new Student(
            $_POST['id'] ?? '',
            $_POST['name'] ?? '',
            $_POST['email'] ?? '',
            $_FILES['photo'] ?? []
        );
        $student->save('../data.txt');
        $message = "✅ Registered successfully!";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>📄 OOP Student Registration</title>
    <style>
        body { font-family: Arial; background: #f0f2f5; margin:0; padding:0; }
        .box { max-width: 500px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 6px; box-shadow: 0 0 8px #aaa; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
        .msg { background: #d4edda; padding: 10px; margin-bottom: 10px; border-radius: 4px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        .back-link { display: inline-block; margin-top: 10px; color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>
<div class="box">
    <h2>📝 OOP Student Registration</h2>
    <?php if ($message) echo "<div class='msg'>" . htmlspecialchars($message) . "</div>"; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="id" placeholder="Student ID (max 5 chars)" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="file" name="photo" required>
        <button type="submit">Register</button>
    </form>

    <?php Student::display('../data.txt'); ?>

 <!-- ✅ Back to Dashboard -->
    <a class="back-btn" href="dashboard.php">⬅️ Back to Dashboard</a>
</div>
</body>
</html>
