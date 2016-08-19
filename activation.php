<?php 
session_start();
include "include.php";

if (!$_SESSION['name'] || !$_SESSION['email'] || !$_SESSION['pass']) {
    echo "hacking attempt";
    exit();
}

$e = $_GET['e'];
$code = $_GET['code'];
$sql = "select * from user where email='$e' and activation='$code' and active='1'
limit 1";

$query = mysqli_query($db, $sql);
$numrows = mysqli_num_rows($query);

if ($numrows == 1){
    echo "you are already activated";
    exit();
}

$sql = "SELECT * FROM user WHERE email='$e' AND activation='$code' 
LIMIT 1";

    $query = mysqli_query($db, $sql);
	$numrows = mysqli_num_rows($query);
	
	if($numrows == 0){
		
		echo "no match";
    	exit();
	}

	$sql = "UPDATE user SET active='1' WHERE email='$e' ";
    $query = mysqli_query($db, $sql);
if ($query){
    $_SESSION['valid'] = "yes";
    echo "congates! <br> you are activated now";
   $file =  $_SESSION['file'];
    
  if (!file_exists("user/$file")) {
			mkdir("user/$file", 0755);
		}}
	
