<?php 
// Require Once
include('../../directory.php');

// Prepare To Fetch Data
session_start();
$hotelID = $_SESSION['hotelID'];
include (CONFIG_DIR."/config.php");

if(!isset($_SESSION['userID'])){
    header('lcoation');
}

// Fetch hotel and Room Data
$hoteldata = fetchOne("SELECT * FROM hotel WHERE hotelID=$hotelID");
$hotelicon = UPLOAD_DIR. '/home/home_icon.png';
if($hoteldata!=null){
    $hotelname = $hoteldata['hotelname'];
    $info = $hoteldata['info'];
    $about= $hoteldata['about'];
    $hotelimg = UPLOAD_DIR. "/home/".$hoteldata['img_path'];

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