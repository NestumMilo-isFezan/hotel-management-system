<?php 
// Require Once
include('../../directory.php');

// Prepare To Fetch Data
session_start();
$hotelID = $_SESSION['hotelID'];
include (CONFIG_DIR."/config.php");

if(!isset($_SESSION['guestID'])){
    header('loation');
}
else{
    $guestID = $_SESSION['guestID'];
}

if(!isset($_GET['room'])){
    header("refresh:0; url=../../index.php");
}
else{
    $roomID = $_GET['room'];
}
// Fetch hotel and Room Data
$hoteldata = fetchOne("SELECT * FROM hotel WHERE hotelID=$hotelID");
$hotelicon = UPLOAD_DIR. "/home/home_icon.png";
if($hoteldata!=null){
    $hotelname = $hoteldata['hotelname'];
    $info = $hoteldata['info'];
    $about= $hoteldata['about'];
    $hotelimg = UPLOAD_DIR."/home/".$hoteldata['img_path'];

    $contact = $hoteldata['contact'];
    $email = $hoteldata['email'];

    $address = $hoteldata['address'];
    $city = $hoteldata['city'];
    $postcode = $hoteldata['postcode'];
    $statename = $hoteldata['state'];
    $countryname = $hoteldata['country'];
    $fulladdress = "$address, "."$city, "."$postcode, "."$statename, "."$countryname ";

    // Room  Data
    $roomdata = fetchOne("SELECT room.*, roomtype.*
                            FROM room JOIN roomtype
                            ON room.typeID=roomtype.typeID
                            WHERE room.hotelID=$hotelID AND room.roomID= $roomID");

    $roomNo = $roomdata['roomNo'];
    $roomname = $roomdata['name'];
    $roomdesc = $roomdata['description'];
    $roomprice = $roomdata['price'];
    $capacity = $roomdata['capacity'];

    $roomimg = UPPATH_DIR . "/roomtype/" . $roomdata['room_imgpath'];

    if(!file_exists($roomimg) || $roomdata['room_imgpath']=="") { 
        $roomimg = UPLOAD_DIR . "/roomtype/default.jpg";
    }
    else{
        $roomimg = UPLOAD_DIR ."/roomtype/" . $roomdata['room_imgpath'];
    }

}


?>