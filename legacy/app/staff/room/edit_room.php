<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $hotelID = 1;
    $id = $_POST['id'];
    $roomtype = $_POST['roomtype'];
    $roomstatus = $_POST['roomstatus'];
    $roomNo = $_POST['roomNo'];
   
    $sql = "UPDATE room SET typeID = '$roomtype', roomstatus = '$roomstatus', roomNo = '$roomNo' WHERE roomID = '$id'";

    mysqli_query($conn, $sql);

    mysqli_close($conn);
}
?>