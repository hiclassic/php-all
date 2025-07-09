<?php

//some important encryption code policy in php
//md5,sha1,sha256,sha512,bcrypt,ripemd160   
//password_hash()   

//https://www.codeigniter.com/userguide3/libraries/passwords.html
//example wilth code:

$m = password_hash("password", PASSWORD_DEFAULT);
echo $m;
echo "<br>";
echo password_verify("password", $m);

//md5

$m = md5("password");
echo $m;
echo "<br>";
echo md5("password", $m);


?>