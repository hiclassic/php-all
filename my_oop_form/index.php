<?php
//step 2
require_once("data_collect.php");

if(isset($_POST["btnSubmit"])){
    
    $id=$_POST["txtId"];
    $name=$_POST["txtName"];
    $course=$_POST["txtCourse"];
    $phone=$_POST["txtPhone"];	
    
    if(preg_match("/^[0-9+]{11,14}$/",$phone)){		
    
        $student=new Student($id,$name,$course,$phone); 	
        $student->store();
        echo "Success!";
    
    }else{
       echo "Invalid Phone";	 
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
            Course:<br/>
            <input type="text" name="txtCourse" required />
        </div>
        
        <div>
            Phone:<br/>
            <input type="text" name="txtPhone" required />
        </div>
        
        <div>
            <input type="submit" name="btnSubmit" value="Submit" />
        </div>
    </form> 

     <?php
        // Display stored data
     if (file_exists("store.txt")) {
         $data = file_get_contents("store.txt");
         if ($data) {
             echo "<h2>Stored Data:</h2>";
             echo "<pre>" . htmlspecialchars($data) . "</pre>";
         } else {
             echo "<h2>No data stored yet.</h2>";
         }
     } else {
         echo "<h2>Data file does not exist.</h2>";
     }

     ?>
</body>
</html> 