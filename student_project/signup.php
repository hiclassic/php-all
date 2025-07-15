<?php
session_start();
require_once 'student_class.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] '?? ';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($id && $name && $email && $password) {
        $student = new Student($id, $name, $email, $password);
        $student->save('data.txt');
        $message = "✅ Registration successful! <a href='login.php'>Login here</a>";
    } else {
        $message = "❌ Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Signup</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; }
        .box { max-width: 400px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 6px; box-shadow: 0 0 8px #aaa; }
        input { width: 90%; margin: 10px 0; padding: 10px; }
        button { width: 90%; padding: 10px; background: #007bff; color: #fff; border: none; }
        .msg { padding: 10px; background: #d4edda; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Student Signup</h2>
        <?php if ($message) echo "<div class='msg'>$message</div>"; ?>
        <form method="POST">
            <input type="text" name="id" placeholder="Student ID" required>
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
