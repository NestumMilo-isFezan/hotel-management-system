<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $bookid = $_POST['id'];
    $sql = "DELETE FROM booking WHERE bookID= $bookid";
    $result =mysqli_query($conn, $sql);

    if($result){
        echo 'ok';
    }
    else{
        echo 'error';
    }
    mysqli_close($conn);
    exit();
}

?>