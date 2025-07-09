<?php session_start();

if(isset($_POST["btnLogin"])){
    
    $username=$_POST["txtUsername"];
    $password=$_POST["txtPassword"];
    
    $filePath="login.txt";
    
    $file=file($filePath);
    
    foreach($file as $line){
        
        list($_username,$_password)=explode(",",$line);
        
        if(trim($_username)==$username && trim($_password)==$password){
            
            $_SESSION["sname"]=$username;
            
            header("location:index.php");
            
        }else{
            
            $msg="Username or Password is incorrect!";
        }
        
    }
    
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php echo isset($msg)?$msg:""; ?>
    
    <form action="" method="post">
        
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="txtUsername" /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="txtPassword" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="btnLogin" value="Login" /></td>
            </tr>
        </table>
        
    </form>
    
</body>
</html>
        
   