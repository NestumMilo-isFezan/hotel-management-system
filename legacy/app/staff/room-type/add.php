<?php
ini_set('upload_max_filesize', '10M');
session_start();
include('../../directory.php');
include(CONFIG_DIR.'/config.php');

$target_dir = UPPATH_DIR."/roomtype/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $hotelID = $_POST['hotelID'];
    $type = $_POST["roomtype"];
    $description = $_POST["description"];
    $price = number_format((float)$_POST['price'], 2, '.', '');
    $capacity = $_POST["capacity"];
    
    // No Image
    if(isset($_FILES["uploadphoto"]) &&  $_FILES["uploadphoto"]["name"] == ""){
        $sql = "INSERT INTO roomtype (hotelID, name, description, price, capacity, room_imgpath)
        VALUES ($hotelID, '$type', '$description', '$price', '$capacity', '')";

        $result = mysqli_query($conn, $sql);
        if($result){
            echo 'ok';
        }
        else {
            echo 'sql error 1:'. mysqli_error($conn);
        }
    }

    else if (isset($_FILES["uploadphoto"]) && $_FILES["uploadphoto"]["error"] == UPLOAD_ERR_OK) {
        $uploadOk = 1;        
        $filetmp = $_FILES["uploadphoto"];
        $uploadfile = $filetmp["name"];
                 
        $target_file = $target_dir . basename($_FILES["uploadphoto"]["name"]);        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            echo "existed";
            $uploadOk = 0;
        }
        if ($_FILES["uploadphoto"]["size"] > 10000000) {
            echo "too large";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "wrong format";
            $uploadOk = 0;
        } 
    
        if($uploadOk){
            $sql = "INSERT INTO roomtype (hotelID, name, description, price, capacity, room_imgpath)
            VALUES ($hotelID, '$type', '$description', '$price', $capacity, '$uploadfile')";
            
            $result = mysqli_query($conn, $sql);
            if($result){
                if(move_uploaded_file($_FILES['uploadphoto']['tmp_name'], $target_file)){
                    echo 'nice';
                }
                else{
                    echo 'unfortunately';
                }
            }
            else {
                echo 'sql error 2:'. mysqli_error($conn);
            }
        }
    }

    mysqli_close($conn);
    exit();
}