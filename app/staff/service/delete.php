<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $sql = "DELETE FROM hotelservice WHERE serviceID= $id";

    mysqli_query($conn, $sql);
    mysqli_close($conn);
}

?>