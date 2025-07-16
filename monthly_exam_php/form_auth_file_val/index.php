<?php
require_once 'student_class.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $student = new Student(
            $_POST['id'],
            $_POST['name'],
            $_POST['batch'],
            $_POST['email'],
            $_POST['password']
        );
        $student->saveToFile("data.txt");
        $message = "Registration successful. Please login now.";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; }
        .container { max-width: 500px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #aaa; }
        h2 { text-align: center; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; margin-top: 5px;
        }
        input[type="submit"] {
            background: #007BFF; color: #fff; padding: 12px; border: none; margin-top: 15px; width: 100%;
            border-radius: 4px; cursor: pointer;
        }
        input[type="submit"]:hover { background: #0056b3; }
        .message { padding: 10px; background: #d1e7dd; border: 1px solid #badbcc; margin: 15px 0; border-radius: 5px; }
        .link { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Registration</h2>
    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>ID:</label>
        <input type="text" name="id" required>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Batch:</label>
        <input type="text" name="batch" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Register">
    </form>

    <div class="link">
        Already have an account? <a href="login.php">Login here</a>
    </div>
</div>

</body>
</html>
