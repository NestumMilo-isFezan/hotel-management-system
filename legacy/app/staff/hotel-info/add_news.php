<?php
session_start();
include('../../directory.php');
include(CONFIG_DIR.'/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotelID = 1;
    $newstitle = $_POST["newstitle"];
    $description = trim($_POST["description"]);
    
    $sql = "INSERT INTO news (hotelID, newstitle, description)
    VALUES ($hotelID,  '$newstitle', '$description')";

    $result=mysqli_query($conn, $sql);
    if($result){
        echo 'ok';
    }
    else{
        echo 'error';
    }

    mysqli_close($conn);
    exit();
}
?>