<?php
session_start();
include('../../directory.php');
include(CONFIG_DIR.'/config.php');

$id="";
$name = "";
$desription = " ";
$price =" ";
$capacity = "";

$target_dir = "../../upload/roomtype";
$target_file = "";
$uploadOk = 0;
$imageFileType = "";
$uploadfileName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = trim($_POST["price"]);
    $capacity = ($_POST["capacity"]);
    $filetmp = $_FILES["fileToUpload"];
    $uploadfileName = $filetmp["name"];

    if(isset($_FILES["fileToUpload"]) &&  $_FILES["fileToUpload"]["name"] == ""){
        $sql = "INSERT INTO roomtype (hotelID, name, description, price, capacity, room_imgpath)
        VALUES (" . $_SESSION["hotelID"] . ", '" . $name . "', '" . $description . "', '" . $price . "','" . $capacity . "', '" . $uploadfileName . "')";
    }
     else if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        $uploadOk = 1;        
        $filetmp = $_FILES["fileToUpload"];
        $uploadfileName = $filetmp["name"];
                 
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            echo "ERROR: Sorry, image file $uploadfileName already exists.<br>";
            $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "ERROR: Sorry, your file is too large. Try resizing your image.<br>";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        } 
    
        if($uploadOk){
            $sql = "INSERT INTO roomtype (hotelID, name, description, price, capacity, room_imgpath)
            VALUES (" . $_SESSION["hotelID"] . ", '". $name . "', '". $description . "', '" . $price . "','" . $capacity . "', '" . $uploadfileName . "')";
    } 
    }
    mysqli_query($conn, $sql);

    mysqli_close($conn);
}