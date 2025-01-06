<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST["id"];
    $sql = "DELETE FROM room WHERE roomID= '$id'";

    if(mysqli_query($conn, $sql)){
        echo "ok";
    } 
    else {
        echo "error";
    }
    mysqli_close($conn);
}
?>
