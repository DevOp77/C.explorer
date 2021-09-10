<?php
    // Handling a couple of uploads here 

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
// Get the type of document/ image being uploaded 

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image

if(isset($_POST["submit"])) {
    // Checking the mimetype to find out if its an accurate document  
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        // If mimetype is an allowed document   
        echo "File is an editable document - " . $check["mime"] . ". ";
        $uploadOk = 1;
    }
    // If mimetype is not an allowed one 
    else {
        echo "File is not an editable document. ";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists. ";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large. ";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt") {
    echo "Sorry, only DOC, DOCX, TXT files are allowed. ";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded. ";
    $_SESSION['fileUpload']=0;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. ";
        $_SESSION['fileUpload']=1;
        $_SESSION['uploadedFile'] = basename( $_FILES["fileToUpload"]["name"]);
    } 
    // Run is file could not be uploaded 
    else {
        echo "Sorry, there was an error uploading your file. ";
        $_SESSION['fileUpload']=0;
    }
}
?>