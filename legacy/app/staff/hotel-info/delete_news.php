<?php
session_start();
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $sql = "DELETE FROM news WHERE newsID= $id";

    $result=mysqli_query($conn, $sql);
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

