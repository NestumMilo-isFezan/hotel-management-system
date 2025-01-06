<?php
include("../../directory.php");
include(CONFIG_DIR."/config.php"); // Include your database configuration file

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id']; // Get the ID from the AJAX request

    // Prepare a SQL query to fetch the data associated with the ID
    $sql = "SELECT * FROM hotelservice WHERE serviceID = $id";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row); // Return the data as a JSON object
    }
}
?>