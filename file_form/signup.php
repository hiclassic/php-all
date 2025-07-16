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
<body>
    <h2>Student Signup</h2>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <form method="POST">
        <input type="text" name="id" placeholder="ID" required><br>
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
