<?php

function upload_image($code) {
    
    $code = $_SESSION['file'];
$target_dir = "user/$code/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    
 
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        
        //show user previousily uploadeed pictures
       
    // open this directory 
    $myDirectory = opendir("user/$code");
    // get each entry
    while($entryName = readdir($myDirectory)) {$dirArray[] = $entryName;} closedir($myDirectory);
    $indexCount = count($dirArray);
        echo "$indexCount files<br/>";
    sort($dirArray);

    echo "<TABLE border=1 cellpadding=5 cellspacing=0 class=whitelinks><TR><TH>Filename</TH><th>Filetype</th><th>Filesize</th></TR>\n";

        for($index=0; $index < $indexCount; $index++) 
        {
            if (substr("$dirArray[$index]", 0, 1) != ".")
            {
            echo "<TR>
            <td><a href=\"$dirArray[$index]\">$dirArray[$index]</a></td>
            <td>".filetype($dirArray[$index])."</td>
            <td>".filesize($dirArray[$index])."</td>
                </TR>";
            }
        }
    echo "</TABLE>";
  
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

}