<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}

$student = $_SESSION['student'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; }
        .box { max-width: 500px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 6px; box-shadow: 0 0 8px #aaa; text-align: center; }
        a { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Welcome, <?php echo htmlspecialchars($student['name']); ?></h2>
        <p>Your Email: <?php echo htmlspecialchars($student['email']); ?></p>
        <p>Your ID: <?php echo htmlspecialchars($student['id']); ?></p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
