<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $bookid = $_POST['book'];
    $sql = "UPDATE booking SET status = 'confirmed' WHERE bookID = $bookid";

    if(mysqli_query($conn, $sql)){
        $roomID = $_POST['room'];
        $sql = "UPDATE room SET roomstatus = 'unavailable' WHERE roomID = $roomID";

        if(mysqli_query($conn, $sql)){
            echo 'ok';
        }
    }
    else{
        echo 'error';
    }
}

mysqli_close($conn);
exit();
?>