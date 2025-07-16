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
        $message = "Student Login failed. Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
        }

        .login-container {
            max-width: 400px;
            background: #fff;
            margin: 80px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px #aaa;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background: #28a745;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #218838;
        }

        .message {
            text-align: center;
            padding: 10px;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Student Login</h2>

    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Email:</label>
        <input type="email" name="email" placeholder="Enter Email" required>

        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter Password" required>

        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
