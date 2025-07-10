<?php session_start();
  
  if(isset($_POST["btnLogin"])){
	  
	  $adminmail=$_POST["email"];
	  $adminpass=$_POST["pass"];
	  
	  $file=file("admin_list.txt");
	  
	  foreach($file as $line){
		  
		  list($_username,$_password)=explode(",",$line);
		  
		  if(trim($_username)==$username && trim($_password)==$password){
			  
			
			 $_SESSION["sname"]=$username;
			
			 header("location:demo.php");
			  
		  }else{
			  
			  $msg="Username or Password is incorrect!";
		  }
		  
	  }
	  
  }

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
 <?php
   echo isset($msg)?$msg:"";
 ?>
 <form action="#" method="post">
   <div>
    Username<br/>
    <input type="text" name="txtUsername" />
   </div>
   <div>
    Password<br/>
    <input type="password" name="txtPassword" />
   </div>
   <div>
    <input type="submit" value="Log In" name="btnLogin" />
   </div>
 </form>
</body>
</html>