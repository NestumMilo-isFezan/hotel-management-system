<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

function deleteBooking($conn, $bookingID) {
    $sql = "DELETE FROM booking WHERE bookID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookingID);
    return $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookid = $_POST['id'];

    if (deleteBooking($conn, $bookid)) {
        echo 'ok';
    } else {
        echo 'error';
    }
}
mysqli_close($conn);

?>