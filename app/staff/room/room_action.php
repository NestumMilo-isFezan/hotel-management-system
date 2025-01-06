<?PHP
session_start();
include('../../config/config.php');

//variables
$action="";
$id="";
$roomNo = "";
$roomstatus = "";
$roomtype = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $roomNo = $_POST["roomNo"];
    $roomtype = $_POST["roomtype"];
    $roomstatus = $_POST["roomstatus"];
    
        $sql = "INSERT INTO room (hotelID, typeID, roomstatus, roomNo)
        VALUES (" . $_SESSION["hotelID"] . ",'" . $roomtype . "', '" . $roomstatus . "', '". $roomNo . "')";
        
        $status = insertTo_DBTable($conn, $sql);

        if ($status) { 
            //Tell successfull record
            echo "Form data saved successfully!<br>";
            echo '<a href="index.php">Back</a>'; 
        } 
        else{
            //There is an error while uploading image 
            echo "Sorry, there was an error uploading your file.<br>";  
            echo '<a href="javascript:history.back()">Back</a>';              
        }
}

//close db connection
mysqli_close($conn);

//Function to insert data to database table
function insertTo_DBTable($conn, $sql){
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>
    
   