<?php
require_once "data_collect.php";

if (isset($_POST["btnSubmit"])) {
    $id = $_POST["txtId"];
    $name = $_POST["txtName"];
    $pass = $_POST["txtPass"];
    $email = $_POST["email"];
    $course = $_POST["txtCourse"];
    $phone = $_POST["txtPhone"];

    if (
        preg_match("/^[0-9+]{11,14}$/", $phone) &&
        filter_var($email, FILTER_VALIDATE_EMAIL) &&
        preg_match("/^[a-zA-Z0-9]{4,}$/", $pass)
    ) {
        $student = new Student($id, $name, $pass, $email, $course, $phone);
        $student->save();
        echo "<p style='color:green;'>✅ Success!</p>";
    } else {
        echo "<p style='color:red;'>❌ Invalid Data</p>";
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Form</title>
</head>
<body>
    <h2>Student Registration</h2>
    <form method="post" action="#">
        <div>
            ID:<br/>
            <input type="text" name="txtId" required />
        </div>
        <div>
            Name:<br/>
            <input type="text" name="txtName" required />
        </div>
        <div>
            Password:<br/>
            <input type="password" name="txtPass" required />
        </div>
        <div>
            Email:<br/>
            <input type="email" name="email" required />
        </div>
        <div>
            Course:<br/>
            <input type="text" name="txtCourse" required />
        </div>
        <div>
            Phone:<br/>
            <input type="text" name="txtPhone" required />
        </div>
        <div style="margin-top:10px;">
            <input type="submit" name="btnSubmit" value="Submit" />
        </div>
    </form>

    <hr/>

    <?php
        Student::displayStudents();
    ?>
</body>
</html>
