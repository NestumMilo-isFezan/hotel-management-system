<?PHP
session_start();
include('../../config/config.php');

//this action called when Delete link is clicked
if(isset($_GET["id"]) && $_GET["id"] != ""){
    $id = $_GET["id"];
    $sql = "DELETE FROM room WHERE roomID=" . $id . " AND hotelID=" . $_SESSION["hotelID"];
    //echo $sql . "<br>";
    
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully<br>";
        echo '<a href="index.php">Back</a>';
     } else {
        echo "Error deleting record: " . mysqli_error($conn) . "<br>";
        echo '<a href="index.php">Back</a>';
    }
}
mysqli_close($conn);
?>