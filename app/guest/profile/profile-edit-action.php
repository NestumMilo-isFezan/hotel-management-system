<?php
session_start();
include('config/config.php');


//check if logged-in
if(!isset($_SESSION["guestID"])){
    header("location:index.php"); 
}

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guestID = $_POST['guestID'];
    $accountID = $_POST['accID'];
    $birthdate = $_POST['birthdate'];
    $address =  $_POST['address'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    $sql = 'UPDATE guest
    SET username="' .$username. '", email="' .$email. '", birthdate="' . $birthdate . '", address="' . $address . '", postcode="' . $postcode . '", city="' . $city . '", state="' . $state . '", country="' . $country .
    '" WHERE guest.guestID=' . ';';
                
    $status = updateTo_DBTable($conn, $sql);

    if($status){
        echo'
            <main>
                <div>
                    <img src="img/success.png"/>
                    <h2> Data was added, Please Wait.<br></h2>
                </div>
            </main>';
        header("refresh:3;URL=profile-view.php");
    }
    else{
        echo'
            <main>
                <div>
                    <img src="img/db-error.png"/>
                    <h2>The Data is invalid.<br></h2>  
                </div>
            </main>';
        header("refresh:3;URL=profile-edit.php");
    }

    mysqli_close($conn);
}

            //Function to insert data to database table
            function updateTo_DBTable($conn, $sql){
                if (mysqli_query($conn, $sql)) {
                    return true;
                } else {
                    echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
                    return false;
                }
            }
?>