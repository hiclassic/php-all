<?php
// Initialize file name variable globally so later we can use it
$file_name = '';

if (isset($_FILES['myfile'])) {
    $file_name = $_FILES['myfile']['name'];
    $file_tmp = $_FILES['myfile']['tmp_name'];
    $file_type = $_FILES['myfile']['type'];
    $file_size = $_FILES['myfile']['size'];
    $img_folder = "image/";

    $kb = $file_size / 1024;

    if ($kb > 400) {
        echo "❌ File is too large!";
    } else {
        if (move_uploaded_file($file_tmp, $img_folder . $file_name)) {
            echo "✅ Successfully uploaded!";
        } else {
            echo "❌ File upload failed!";
        }
    }
}
?>

<body style="text-align: center; background-color: #f2f2f2; font-family: Arial, sans-serif;">
    <form action="" method="post" enctype="multipart/form-data" style="max-width: 500px; margin: 10px auto;">
        <fieldset>
            <div> Upload: <input type="file" name="myfile" required></div>
            <input type="submit" name="btnsubmit" value="Submit">
        </fieldset>
    </form>

    <?php
    // ✅ Proper check: Only show image if file uploaded and submit button pressed
    if (isset($_POST['btnsubmit']) && !empty($file_name)) {
        echo "<div style='margin:20px auto;'><img src='image/$file_name' style='max-width: 500px;'></div>";
    }
    ?>

    <div style="width: 500px; margin: 10px auto;">
        <h1>Upload Image Details</h1>
        <?php
        if (!empty($file_name)) {
            echo "Filename: " . htmlspecialchars($_FILES['myfile']['name']) . "<br>";
            echo "Type : " . htmlspecialchars($_FILES['myfile']['type']) . "<br>";
            echo "Size : " . $_FILES['myfile']['size'] . " bytes<br>";
            echo "Temp name: " . htmlspecialchars($_FILES['myfile']['tmp_name']) . "<br>";
            echo "Error : " . $_FILES['myfile']['error'] . "<br>";
        }
        ?>
    </div>
</body>
