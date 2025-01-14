<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

function updateBookingStatus($conn, $bookingID, $status) {
    $sql = "UPDATE booking SET status = ? WHERE bookID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $bookingID);
    return $stmt->execute();
}

function updateRoomStatus($conn, $roomID, $status) {
    $sql = "UPDATE room SET roomstatus = ? WHERE roomID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $roomID);
    return $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookid = $_POST['book'];
    $roomID = $_POST['room'];

    if (updateBookingStatus($conn, $bookid, 'confirmed') &&
        updateRoomStatus($conn, $roomID, 'unavailable')) {
        echo 'ok';
    } else {
        echo 'error';
    }
}
mysqli_close($conn);

exit();
?>