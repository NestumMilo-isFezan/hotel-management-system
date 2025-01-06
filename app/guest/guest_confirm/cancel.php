<?php
session_start();
include('../../directory.php');
include(CONFIG_DIR.'/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookid = $_POST['book'];
    $sql = "UPDATE booking SET status = 'cancelled' WHERE bookID = $bookid";
    $result = mysqli_query($conn, $sql);

    if($result){
        $sql = "UPDATE room SET roomstatus = 'available' WHERE roomID = $roomID";
        echo 'ok';
    }
    else{
        echo 'error';
    }
}

mysqli_close($conn);
exit();
?>