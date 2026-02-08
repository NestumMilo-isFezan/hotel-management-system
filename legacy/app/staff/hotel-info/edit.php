<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hotelID = $_POST['hotelID'];
    $name = $_POST['hotelname'];
    $contact = $_POST['contact'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $info = $_POST['info'];
    $about = $_POST['about'];

    $sql = "UPDATE hotel SET 
                    hotelname = '$name',
                    contact = '$contact',
                    email = '$email',
                    address = '$address',
                    postcode = '$postcode',
                    city = '$city',
                    state = '$state',
                    country = '$country',
                    info = '$info',
                    about = '$about'
                    WHERE hotelID = $hotelID";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "ok";
    } else {
        echo "error";
    }

    mysqli_close($conn);
    exit();
}

?>