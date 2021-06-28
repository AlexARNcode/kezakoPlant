<?php

/**
 * DEPENDENCIES
 */
require_once(__DIR__ . '/plantResults.php');
require_once(__DIR__ . '/plantNetApi.php');

/**
 * UPLOAD
 */
$uploadIsOk = true;

// Directory where files will be uploaded
$targertDir = "uploads/";

// Change the original filename to a random name, example : 60d978b1edbeb-paquerette-fleur.jpg
$newFileName = uniqid() . '-' . basename($_FILES["fileToUpload"]["name"]);

// Define the complete name with path/filename.extension, example : uploads/60d978b1edbeb-paquerette-fleur.jpg
$targetFile = $targertDir . $newFileName;


$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadIsOk = true;
    } else {
        echo "File is not an image.";
        $uploadIsOk = false;
    }
}

// Check if file already exists
if (file_exists($targetFile)) {
    echo "Sorry, file already exists.";
    $uploadIsOk = false;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadIsOk = false;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadIsOk = false;
}

// Check if $uploadIsOk is set to 0 by an error
if ($uploadIsOk === false) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        // echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded in " . $targetFile;

        /* PlantNet API Call */
        $plantResultObject = getPlantInfoFromImage($targetFile);

        /* Display the results */
        displayPlantResults($plantResultObject, $targetFile);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
