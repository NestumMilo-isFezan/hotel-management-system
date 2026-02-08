<?php
session_start();
include("../config/config.php");

    //STEP 1: Form data handling using mysqli_real_escape_string function to escape special characters for use in an SQL query,
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirmPwd = mysqli_real_escape_string($conn, $_POST['confirmPwd']);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];

          //Validate pwd and confrimPwd
        if ($password !== $confirmPwd) {
            echo "password not match";
            exit();
        }
    //STEP 2: Check if userEmail already exist
        $sql = "SELECT * FROM useracc WHERE email='$email' LIMIT 1";	
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            echo "email exist";
            exit();
        }
        else {
            // User does not exist, insert new user record, hash the password		
            $pwdHash = trim(password_hash($_POST['password'], PASSWORD_DEFAULT)); 
            //echo $pwdHash;
            $sql = "INSERT INTO useracc (username, email, password ) VALUES ('$username','$email', '$pwdHash')";
            $insertOK=0;
        }

        if (mysqli_query($conn, $sql)) {
            $insertOK=1;
   
        } else {
            echo "sql error";
            exit();
        }

        if($insertOK==1){
            $lastInsertedId = mysqli_insert_id($conn);
            $sql = "INSERT INTO guest (accID, address, postcode, city, state, country, firstName, lastName ) 
            VALUES ('$lastInsertedId', '', '','','','','$fname','$lname')";
            if(mysqli_query($conn, $sql)){
                echo "passed";
            }
            else{
                echo "sql error";
                exit();
            }
   
        }
        
        
     
    }
        mysqli_close($conn);
        exit();

?>