<?php
session_start();
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $guestID = $_SESSION['guestID'];

    $fname =$_POST['firstname'];
    $lname =$_POST['lastname'];
    $addr =$_POST['address'];
    $post =$_POST['postcode'];
    $city =$_POST['city'];
    $state =$_POST['state'];
    $country =$_POST['country'];
   
    $sql = "UPDATE guest SET firstName='$fname', lastName='$lname', 
            address = '$addr', postcode='$post', city='$state', state='$state', country='$country' WHERE guestID = $guestID";

    
    $result = mysqli_query($conn, $sql);
    if($result){
        echo 'ok';
    }
    else{
        echo'error' . mysqli_error($conn);
    }

    mysqli_close($conn);
    exit();
}
?>