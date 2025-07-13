<?php
//cheek file size in associative array
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

if (isset($_FILES['img'])) {
    $file_name = $_FILES['img']['name'];
    $file_tmp = $_FILES['img']['tmp_name'];
    $file_type = $_FILES['img']['type'];
    $file_size = $_FILES['img']['size'];
    $img = "image/";
    $kb=$file_size/1024;
    
    if($kb>400){ 
    echo "File is too large";
    } else { 
        move_uploaded_file($file_tmp,$img.$file_name);
        echo "sucessfully";
    }
    
}

?>
<body style="text-align: center; background-color: #f2f2f2; font-family: Arial, sans-serif; ">
    <form action="" method="post" enctype="multipart/form-data" style="max-width: 300px;  margin: 10px auto;"> 
        <div> Upload: <input type="file" name="img"></div> 
        <input type="submit" value="submit">
    </form>
</body>