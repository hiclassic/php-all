
<?php 
$n="123";
echo md5($n);
echo "<br>";
// See the password_hash() example to see where this came from.

$plaintext_password = "Password@123";


$verify = password_verify($plaintext_password, $hash);


if ($verify) {
	echo 'Password Verified!';
} else {
	echo 'Incorrect Password!';
}
echo "<br>";


// $password = '202cb962ac59075b964b07152d234b70';
// $hashedPassword = Hash::check($password);
// echo $hashedPassword;

?>