<?php
session_start();
include('../../directory.php');
include(CONFIG_DIR.'/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookid = $_POST['book'];
    $sql = "UPDATE booking SET status = 'checkout' WHERE bookID = $bookid";

    if(mysqli_query($conn, $sql)){
        echo 'ok';
    }
    else{
        echo 'error';
    }
}

mysqli_close($conn);
exit();
?>