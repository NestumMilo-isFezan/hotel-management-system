<?php
session_start();
include('../../directory.php');
include(CONFIG_DIR . '/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotelID = 1;
    $roomNo = $_POST["roomNo"];
    $roomtype = $_POST["roomtype"];
    $roomstatus = $_POST["roomstatus"];
    
    $sql = "INSERT INTO room (hotelID, typeID, roomstatus, roomNo)
    VALUES ($hotelID, '$roomtype', '$roomstatus', '$roomNo')";
    
    mysqli_query($conn, $sql);

    mysqli_close($conn);
}