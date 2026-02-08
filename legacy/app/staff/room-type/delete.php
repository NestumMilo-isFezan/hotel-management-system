<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    deletePreviousImage($conn, $id);
    $sql = "DELETE FROM roomtype WHERE typeID= $id";

    $result= mysqli_query($conn, $sql);
    if($result){
        echo'ok3';
    }
    else{
        echo'error';
    }

    mysqli_close($conn);
}

function deletePreviousImage($conn, $id) {
    $sql = "SELECT img_path FROM challenge WHERE ch_id = $id AND userID = ". $_SESSION["UID"];
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $previousImagePath = $row['img_path'];
        
        // Check if the previous image path exists and delete it
        if ($previousImagePath && file_exists(UPPATH_DIR."/roomtype/$previousImagePath")) {
            unlink(UPPATH_DIR."/roomtype/$previousImagePath");
        }
    }
}
?>