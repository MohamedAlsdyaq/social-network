<?php
session_start();

include "include.php";

$code = $_SESSION['file'];
upload_image($code);

echo "<br> logged in as: ". $_SESSION['name'];
