<?php 
// Prepare To Fetch Data
session_start();
$hotelID = $_SESSION['hotelID'];
$uploadpath = "../../upload/";
include "../config/config.php";


$_SESSION['userID']=1;
$_SESSION['userRoles']=1;

if(isset($_SESSION['userID'], $_SESSION['userRoles'])){
    if($_SESSION['userRoles'] == 1){
        // Fetch Staff Data
        $userID = $_SESSION['userID'];
        $staffdata = fetchOne("SELECT * FROM staff WHERE accID=$userID");
        
        $staffID = $staffdata['staffID'];
        $hotelID = $staffdata['hotelID'];
        $firstName = $staffdata['firstName'];
        $lastName = $staffdata['lastName'];
        $contact = $staffdata['contact'];

        // Fetch Hotel Data
        $hoteldata = fetchOne("SELECT * FROM hotel WHERE hotelID=$hotelID");
        $hotelicon = $uploadpath."home/home_icon.png";

        $hotelname = $hoteldata['hotelname'];
        $info = $hoteldata['info'];
        $about= $hoteldata['about'];
        $hotelimg = "../../upload/home/".$hoteldata['img_path'];
    
        $contact = $hoteldata['contact'];
        $email = $hoteldata['email'];
    
        $address = $hoteldata['address'];
        $city = $hoteldata['city'];
        $postcode = $hoteldata['postcode'];
        $statename = $hoteldata['state'];
        $countryname = $hoteldata['country'];
        $fulladdress = "$address, "."$city, "."$postcode, "."$statename, "."$countryname ";
    
    }
    else{
        header('Location: ../index.php');
    }

}
?>