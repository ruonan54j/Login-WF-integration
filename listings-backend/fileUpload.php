<?php
    $images = [];
    $fileLength=$_POST['file_length'];
    echo $fileLength;
    for ($i = 0; $i <= $fileLength; $i++){
    echo $i;
    $currentDir = 'C:/xampp/htdocs/CASTLE LAB/listings-backend/';
    $uploadDirectory = "/uploaded_images/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions
   
    $fileName = $_FILES['myfile'.$i]['name'];

    $images[] = "uploaded_images/".$fileName;
    
    $fileSize = $_FILES['myfile'.$i]['size'];
    $fileTmpName  = $_FILES['myfile'.$i]['tmp_name'];
    $fileType = $_FILES['myfile'.$i]['type'];
   // $tempExt =end(explode('.',$_FILES['myfile'.$i]['name']));
    //$fileExtension = strtolower($tempExt);

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

       // if (! in_array($fileExtension,$fileExtensions)) {
         //   $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        //}
        

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }
        
        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                echo "The file " . basename($fileName) . " has been uploaded";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }

    }
?>