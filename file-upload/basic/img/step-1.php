<?php
//image file upload
if(isset($_POST["btn"])){
    $fileName=$_FILES["img"]["name"];
    $tmpName=$_FILES["img"]["tmp_name"];
    copy("$tmpName","img/.$fileName");
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file"id="" name="img"> <br>
        <input type="submit" value="submit" name="btn" >
    </form>

    <?php
if(isset($_POST["btn"])){
    echo "<img src='img/$fileName' width='300px'>";
}
?>
</body>
</html>

