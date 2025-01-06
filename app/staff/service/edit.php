<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $hotelID = 1;
    $id = $_POST['id'];
    $name = $_POST['servicename'];
    $description = $_POST['description'];
    $price = number_format((float)$_POST['price'], 2, '.', '');
    $status = $_POST['status'];
   
    $sql = "UPDATE hotelservice SET name= '$name', description ='$description', price = '$price', 
            servicestatus = '$status' WHERE serviceID = $id";

    
    mysqli_query($conn, $sql);

    mysqli_close($conn);
}
?>