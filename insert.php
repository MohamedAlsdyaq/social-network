<?php

session_start();
require "include.php";

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $pass1 = mysqli_real_escape_string($db, $_POST['1']);
    $pass2 = mysqli_real_escape_string($db, $_POST['2']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $code = md5($name + microtime());
  
$_SESSION['name'] = $name;
$_SESSION['pass'] = $pass1;
$_SESSION['email'] = $email;
$_SESSION['code'] = $code;
$_SESSION['valid'] = "no";



if ($pass1 != $pass2){
    echo "passwords do not matches";
    exit();
}




if (check_name($name) === false )
    die("user with this name already exisits");

if (check_email($email) === false )
    die("user with this email already exisit");





$query = "insert into user (name, pass, email, activation) values(?, ?, ?, ?)";
		

$stmt = $db->prepare($query);

$stmt->bind_param("ssss", $_SESSION['name'], $_SESSION['pass'], $_SESSION['email'], $_SESSION['code']);

$stmt->execute();
		
if (!$stmt)
    echo "sorry we/'re facing downtime< please try again!";
    else{
echo "your account was added successfuly ";


    }


$body = email($email, $code);



$headers = "From: Nanashi Web Server \r\n";
$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    

$file = $email.$code;
$_SESSION['file'] = $file;

if(mail($email, "active account", $body, $headers)){
  
}


   