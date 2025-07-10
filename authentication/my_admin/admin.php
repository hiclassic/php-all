<?php 
 session_start();

 if(!isset($_SESSION["sname"])){
	 header("location:admin_log.php");
  }
//step 2:
require_once("admin_class.php");

if(isset($_POST["btnSubmit"])){
	$id=$_POST["txtId"];
	$name=$_POST["txtName"];
	$email=$_POST["email"];
    $pass=$_POST["pass"];
	$phone=$_POST["txtPhone"];
	
	if(!preg_match("/^[0-9+]{11,14}$/",$phone)){
		
		echo "Phone is not valid";
		
	}elseif(!preg_match("/^[a-zA-Z0-9]{4,}[@][a-zA-Z]{4,6}[.][a-zA-Z]{2,3}$/",$email)){
		
		echo "Email is not valid";
        
    }elseif(!preg_match("/^[a-zA-Z0-9]{4,}$/",$pass)){
        
        echo "Password is not valid";
		
	}else{
		$student=new Student($id,$name,$email,$phone,$pass);
		$student->save();
		echo "Sucess !";
		
	}
	
}

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Panel</title>
</head>

<body>
<a href="logout.php">Logout</a>
<form action="#" method="post">
<div>Id<br/>
<input type="text" name="txtId" />
</div>

<div>Name<br/>
<input type="text" name="txtName" />
</div>

<div>email<br/>
<input type="text" name="email" />
</div>

<div>Phone<br/>
<input type="text" name="txtPhone" />
</div>

<div>Password<br/>
<input type="password" name="pass" />
</div>
<div>
<input type="submit" name="btnSubmit" value="Submit"/>
</div>

</form>
<?php 
	Admin::display_admin();
?>

</body>
</html>