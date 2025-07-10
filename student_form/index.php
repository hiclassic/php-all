<?php session_start();
 ?>
<?php
require_once 'student_class.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $student = new Student(
            $_POST['id'],
            $_POST['name'],
            $_POST['batch'],
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
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            background: #fff;
            margin: 50px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px #aaa;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background: #007BFF;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        .message {
            text-align: center;
            padding: 10px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .table-wrapper {
            max-width: 800px;
            margin: 30px auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Registration Form</h2>

    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>ID:</label>
        <input type="text" name="id" placeholder="Enter ID" required>

        <label>Name:</label>
        <input type="text" name="name" placeholder="Enter Name" required>

        <label>Batch:</label>
        <input type="text" name="batch" placeholder="Enter Batch" required>

        <input type="submit" value="Submit">
    </form>
</div>

<div class="table-wrapper">
    <?php Student::displayStudents("data.txt"); ?>
</div>

</body>
</html>