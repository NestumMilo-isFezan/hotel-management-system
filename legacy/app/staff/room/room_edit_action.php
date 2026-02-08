<?PHP
session_start();
include('../../config/config.php');

//variables
$action="";
$id="";
$roomstatus = "";
$roomNo = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $id = $_POST["rid"];
    $roomstatus = $_POST["rroomstatus"];
    $roomNo = $_POST["roomNo"];
    
        $sql = "UPDATE room SET roomstatus= '$roomstatus', roomNo ='$roomNo' WHERE roomID =" . $id . " AND hotelID = ". $_SESSION["hotelID"];

        $status = update_DBTable($conn, $sql);

        if ($status) {          
            //Tell successfull record
            echo "Form data updated successfully!<br>";
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
function update_DBTable($conn, $sql){
if (mysqli_query($conn, $sql)) {
    return true;
} else {
    echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
    return false;
}
}
?>