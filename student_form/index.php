<?php
require_once 'student_class.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $student = new Student(
            $_POST['id'],
            $_POST['name'],
            $_POST['email'],
            $_POST['password']
        );
        $student->saveToFile("data.txt");
        $message = "Student data saved successfully.";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Form</title>
</head>
<body>
    <h2>Student Registration Form</h2>

    <?php if ($message): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>ID:</label><br>
        <input type="text" name="id" required><br>

        <label>Name:</label><br>
        <input type="text" name="name" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Submit">
    </form>
    <?php Student::displayStudents("data.txt"); ?>
</body>
</html>
