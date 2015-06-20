<?php
/**
 * Created by PhpStorm.
 * User: Dustin
 * Date: 12/13/2014
 * Time: 1:20 PM
 */
session_start();
include('../lib/config.php');
include('../lib/db.class.php');
include('../include_classes.php');
include('../functions.php');
require_once('../php_classes/FileValidation.php');
require_once('../php_classes/FileValidationError.php');

ini_set('display_errors',0);
error_reporting(E_ALL);

$db = new Db($dbConfig);

if (isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"])) {
    $target_dir = "uploads/"; //The folder that the file is going to end up in
    $file_name = basename($_FILES["fileToUpload"]["name"]); //The name of the file

    try {
        $validator = new FileValidation($_FILES["fileToUpload"]["tmp_name"]);
        $tmp_file_type = $validator->validateFileType();
        echo $tmp_file_type;

        $query = "SELECT id FROM files ORDER BY id DESC LIMIT 1;"; //This retrieves the latest file id so that it can be modified for the sake of naming the new file
        $result = $db->runQuery($query); //The new name for the file
        $db_file_name = strval(intval($result[0]['id']) + 1); //The db file name is the latest pulled id plus one, i.e. the id it's gonna get when it's put into the database

        $file_tmp_name = $_FILES["fileToUpload"]["tmp_name"]; //This is the temporary file that's stored in files
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION); //Get the file name
        $file_path = $target_dir . $db_file_name . "." . $file_type; //The path to the file in the db


        echo $file_path . "<br />";

        $uploadOk = 1;

        //region Checking things
        // Check if image file is a actual image or fake image
        /*if (isset($_POST["submit"])) {
            $check = getimagesize($file_tmp_name);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }*/

        // Check if file already exists
        /*if (file_exists($file_path)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }*/
        // Check file size
        /*if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }*/
        // Allow certain file formats
        /*if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
            && $file_type != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }*/
        //endregion

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        }
        else {
            if (move_uploaded_file($file_tmp_name, $file_path)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

                //Insert the info into the files table in the database.
                $query = "INSERT INTO files(name, link, type) VALUES('$file_name', '$file_path', '$file_type');";
                mysql_query($query);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } catch (FileValidationError $e) {
        echo $e->getMessage();
    }


}

?>

<!DOCTYPE html>
<html>
<head>

</head>

<body>

<form action="file_upload_test.php" method="post" enctype="multipart/form-data">
    <label>Select image to upload:</label>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>