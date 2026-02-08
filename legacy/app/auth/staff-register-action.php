<?php
session_start();
include("../config/config.php");

//STEP 1: Form data handling using mysqli_real_escape_string function to escape special characters for use in an SQL query,
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPwd = mysqli_real_escape_string($conn, $_POST['confirmPwd']);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contact = $_POST['contact'];
    $hotelID = 1;

    // Validate password and confirmPwd
    if ($password !== $confirmPwd) {
        echo "Password does not match";
        exit();
    }

    //STEP 2: Check if userEmail already exists
    $sql = "SELECT * FROM useracc WHERE email='$email' LIMIT 1";	
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Email already exists";
        exit();
    } else {
        // User does not exist, insert new user record, hash the password		
        $pwdHash = password_hash($staffPassword, PASSWORD_DEFAULT); 
        $sql = "INSERT INTO useracc (username, email, password ) VALUES ('$username','$email', '$pwdHash')";
    }

    if (mysqli_query($conn, $sql)) {
        $lastInsertedId = mysqli_insert_id($conn);

        // Insert staff information
        $sql = "INSERT INTO staff (accID, hotelID, firstName, lastName, contact) 
                VALUES ('$lastInsertedId', '$hotelID', '$firstName','$lastName','$contact')";

        if (mysqli_query($conn, $sql)) {
            // Use JavaScript to show a confirmation prompt
            echo "<script>
                    var Confirmation = confirm('Registration successful. Do you want to continue?');
                    if (Confirmation) {
                        // Redirect to another page if confirmed
                        window.location.href = '../staff/index.php';
                    } else {
                        alert('Alright!');
                        window.location.href = 'staff-register.php';
                    }
                </script>";
        } else {
            // Use Toastr to show an error notification
            echo "<script>
                    alert('Error Occur');
                </script>";
        }
    }
}
mysqli_close($conn);
?>

