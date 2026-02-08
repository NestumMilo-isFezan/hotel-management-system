<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $hotelID = 1;
    $id = $_POST['id'];
    $newstitle = $_POST['newstitle'];
    $description = $_POST['description'];

    $sql = "UPDATE news SET newstitle = '$newstitle', description = '$description'
            WHERE newsID = '$id'";

    
    mysqli_query($conn, $sql);

    mysqli_close($conn);
}
?>