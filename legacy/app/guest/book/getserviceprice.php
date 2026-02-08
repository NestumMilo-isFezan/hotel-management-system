<?php 
// Prepare To Fetch Data
session_start();
$hotelID = $_SESSION['hotelID'];
$uploadpath = "../../upload/";
include "../../config/config.php";

if(!isset($_SESSION['userID'])){
    
}

if(!isset($_GET['service'])){
    // Default Option
    $defaultoption = "Basic Plan";
    
    // Room  Data
    $servicedata = fetchOne("SELECT price FROM hotelservice WHERE hotelID=$hotelID AND name='$defaultoption'");
    $price = $servicedata['price'];
    
}
else{
    $serviceID = $_GET['service'];
    // Room  Data
    $servicedata = fetchOne("SELECT price FROM hotelservice WHERE hotelID=$hotelID AND serviceID=$serviceID");
    $price = $servicedata['price'];

}
// Output the data in JSON format
header('Content-Type: application/json');
echo json_encode(array('price' => $price));
?>