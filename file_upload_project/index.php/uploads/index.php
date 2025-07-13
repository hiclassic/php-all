<?php
// ✅ 1. initialize variables
$message = "";
$uploadedFileName = "";

// ✅ 2. If form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ✅ 3. file selected? name it 'myfile'
    if (isset($_FILES['myfile']) && $_FILES['myfile']['error'] === UPLOAD_ERR_OK) {

        $file_tmp = $_FILES['myfile']['tmp_name'];
        $file_name = $_FILES['myfile']['name'];
        $file_size = $_FILES['myfile']['size'];
        $file_type = $_FILES['myfile']['type'];

        // ✅ 4. extension check
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($file_ext, $allowed_ext)) {
            $message = "❌ Only JPG, PNG, GIF, WEBP allowed!";
        }
        elseif ($file_size > 1024 * 1024) { // 1 MB
            $message = "❌ File too large! Max 1 MB.";
        } else {
            // ✅ 5. unique file name
            $new_name = uniqid('img_', true) . '.' . $file_ext;
            $upload_path = "uploads/" . $new_name;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                $message = "✅ File uploaded successfully!";
                $uploadedFileName = $new_name;
            } else {
                $message = "❌ Upload failed.";
            }
        }

    } else {
        $message = "❌ Please select a file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP File Upload</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; text-align: center; }
        .box { max-width: 500px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 8px #aaa; }
        input { margin: 10px 0; }
        .msg { margin: 10px 0; padding: 10px; background: #e9ffe9; border: 1px solid #b2f5b2; }
    </style>
</head>
<body>
    <div class="box">
        <h2>🗂️ Upload an Image</h2>
        <?php if ($message) echo "<div class='msg'>" . htmlspecialchars($message) . "</div>"; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="myfile" required><br>
            <button type="submit">Upload</button>
        </form>

        <?php if ($uploadedFileName): ?>
            <h3>Preview:</h3>
            <img src="uploads/<?php echo htmlspecialchars($uploadedFileName); ?>" style="max-width: 100%;">
        <?php endif; ?>
    </div>
</body>
</html>
