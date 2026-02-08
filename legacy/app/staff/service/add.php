<?php
session_start();
include('../../directory.php');
include(CONFIG_DIR.'/config.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $hotelID = 1;
    $name = $_POST['servicename'];
    $description = $_POST['description'];
    $price = number_format((float)$_POST['price'], 2, '.', '');
    $status = $_POST['status'];

    $sql = "INSERT INTO hotelservice (hotelID, name, description, price, servicestatus)
    VALUES ($hotelID, '$name', '$description', '$price', '$status')";

    mysqli_query($conn, $sql);

    mysqli_close($conn);
}