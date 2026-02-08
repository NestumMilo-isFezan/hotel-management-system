<?php 
// Prepare To Fetch Data
session_start();
$_SESSION['hotelID'] = 1;
$hotelID = $_SESSION['hotelID'];
include "config/config.php";

// Fetch Data
$hoteldata = fetchOne("SELECT * FROM hotel WHERE hotelID=$hotelID");
$hotelicon = "upload/home/home_icon.png";
if($hoteldata!=null){
    $hotelname = $hoteldata['hotelname'];
    $info = $hoteldata['info'];
    $about= $hoteldata['about'];
    $hotelimg = "./upload/home/".$hoteldata['img_path'];

    $contact = $hoteldata['contact'];
    $email = $hoteldata['email'];

    $address = $hoteldata['address'];
    $city = $hoteldata['city'];
    $postcode = $hoteldata['postcode'];
    $statename = $hoteldata['state'];
    $countryname = $hoteldata['country'];
    $fulladdress = "$address, "."$city, "."$postcode, "."$statename, "."$countryname ";
}
?>