<?php
session_start();
require_once 'student_class.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $student = Student::authenticate('data.txt', $email, $password);
    if ($student) {
        $_SESSION['student'] = $student;
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "❌ Login failed. Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; }
        .box { max-width: 400px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 6px; box-shadow: 0 0 8px #aaa; }
        input { width: 90%; margin: 10px 0; padding: 10px; }
        button { width: 90%; padding: 10px; background: #28a745; color: #fff; border: none; }
        .msg { padding: 10px; background: #f8d7da; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Student Login</h2>
        <?php if ($message) echo "<div class='msg'>$message</div>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
</body>
</html>
