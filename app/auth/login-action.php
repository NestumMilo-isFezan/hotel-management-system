<?php
session_start();
include("../directory.php");
include(CONFIG_DIR."/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //login values from login form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password= mysqli_real_escape_string($conn, $_POST['password']);
    
    $sql = "SELECT * FROM useracc WHERE email ='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "error";
        exit();
    }
    else {
        //check if user exists
        if (mysqli_num_rows($result) == 1) {    
            //check password hash
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                if ($row['userRoles']==2){
                    $guestdata = fetchOne("SELECT * FROM guest WHERE accID=". $row['accID']);
                    $_SESSION['user'] = 1;
                    $_SESSION['guestID'] = $guestdata['guestID'];
                    echo "guest";
                }
                else {
                    $staffdata = fetchOne("SELECT * FROM staff WHERE accID=". $row['accID']);
                    $_SESSION['user'] = 1;
                    $_SESSION['staffID'] = $staffdata['staffID'];
                    echo "staff";
                }
    
                //set logged in time
                $_SESSION['loggedin_time'] = time();   
            }
            else{
                echo "password error";
                exit();
            }
        }
        else{
            echo "error";
            exit();
        }
    }
    mysqli_close($conn);
    exit();
}






?>