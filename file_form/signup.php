<?php
session_start();
require_once 'classes/student.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $student = new Student(
            $_POST['id'] ?? '',
            $_POST['name'] ?? '',
            $_POST['email'] ?? '',
            $_POST['password'] ?? ''
        );
        $student->save('students.txt');
        $message = "✅ Registration successful! <a href='login.php'>Login here</a>";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Signup</title></head>
<style>
        body { font-family: Arial; background: #f9f9f9; }
        .box { max-width: 500px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 6px; box-shadow: 0 0 8px #aaa; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
        .msg { background: #d4edda; padding: 10px; margin-bottom: 10px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    </style>
<body>
    <div class="box">
    <h2>Student Signup</h2>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <form method="POST">
        <input type="text" name="id" placeholder="ID" required><br>
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    </div>
</body>
</html>
