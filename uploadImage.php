<?php
$imageDir = 'images/';
//create the image file for storing later 
$newImageFile = $imageDir . basename($_FILES["fileToUpload"]["name"]);
//get the extension for checking later
$imageFileType = pathinfo($newImageFile,PATHINFO_EXTENSION);

// make sure the image is valid by getting the form data 
if(isset($_POST["submit"])) {
    $imgSizeCheck = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($imgSizeCheck === false) {
        echo "File is not an image.";
    }
}

if(file_exists($newImageFile)) {
    echo "File already exists.";
} else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //only include image filetypes
    echo "File type not allowed: only jpg, png, jpeg, and gif are allowed.";
} else if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newImageFile)) {
    //move the uploaded file to the /images dir (in the variable created earlier) and display the image if successful
    $file = basename( $_FILES["fileToUpload"]["name"]);
    echo "The file ". $file . " has been uploaded:\n";
    echo "<img src='http://localhost/~gschuurmans/assessment/images/".$file."'>";
} else {
    echo "Sorry, there was an error uploading your file.";
}
?>
