<?php
require_once 'student.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    try {
        $student = new Student($id, $name, $email);
        $student->save('data.txt');
        $message = "✅ Registration successful!";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; }
        .container { max-width: 500px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 6px; box-shadow: 0 0 8px #aaa; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px; background: #007bff; color: #fff; border: none; width: 100%; }
        .msg { padding: 10px; background: #d4edda; margin-bottom: 10px; }
        table { margin-top: 20px; width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
    </style>
</head>
<body>
<div class="container">
    <h2>📄 Student Registration</h2>

    <?php if ($message) echo "<div class='msg'>" . htmlspecialchars($message) . "</div>"; ?>

    <form method="POST">
        <input type="text" name="id" placeholder="Student ID (max 5 chars)" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Register</button>
    </form>

    <?php Student::display('data.txt'); ?>
</div>
</body>
</html>
