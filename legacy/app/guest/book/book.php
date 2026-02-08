<?php
session_start();
include("../../directory.php");
include(CONFIG_DIR."/config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $roomID = $_POST['roomID'];
        $guestID = $_SESSION['guestID'];
        $services = $_POST['services'];
        $checkin = $_POST["checkin"];
        $checkin = date('Y-m-d', strtotime($_POST['checkin']));
        $checkout = $_POST["checkout"];
        $checkout = date('Y-m-d', strtotime($_POST['checkout']));
        $totalprice = $_POST['totalprice'];

        $sql = "INSERT INTO booking(roomID, guestID, serviceID, check_in, check_out, total_price, status)
        VALUES($roomID, $guestID, $services, '$checkin', '$checkout', $totalprice, 'pending')";

        $result = mysqli_query($conn, $sql);
        if($result){
            echo "ok";
        }
        else{
            echo 'error';
        }

        mysqli_close($conn);
        exit();
    }
?>
