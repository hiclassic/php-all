<?php
session_start();
require_once 'student_class.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (Student::authenticate('data.txt', $email, $password)) {
        $_SESSION['student_email'] = $email;
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Login failed. Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; }
        .container { max-width: 400px; margin: 80px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #aaa; }
        h2 { text-align: center; }
        input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; margin: 10px 0;
        }
        input[type="submit"] {
            background: #28a745; color: #fff; border: none; padding: 12px; width: 100%; border-radius: 4px; cursor: pointer;
        }
        input[type="submit"]:hover { background: #218838; }
        .message { padding: 10px; background: #f8d7da; border: 1px solid #f5c6cb; margin-bottom: 20px; border-radius: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Login</h2>
    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
</div>

</body>
</html>
