<?php
class Utils  
{
    public static function uploadImage()
    {
        $target_dir="uploads/";
        $target_file = $target_dir.round(microtime(true)).basename($_FILES["img"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_GET["submit"])) {
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1; //File is an image
            } else {
                $uploadOk = 0; //File is not an image
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;//File exists
        }
        // Check file size
        if ($_FILES["img"]["size"] > 500000) {
            $uploadOk = 0;//File too large
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0; //Incorrect format
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "Error file 1";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                return $target_file;
            } else {
                return "Error file 2";
            }
        }
    }
}
?>