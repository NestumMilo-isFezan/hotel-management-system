<?php
session_start();
include("../../config/config.php");


$hotelID = $_SESSION['hotelID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $newHotelName = mysqli_real_escape_string($conn, $_POST['hotelname']);
    $newContact = mysqli_real_escape_string($conn, $_POST['contact']);
    $newEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $newAddress = mysqli_real_escape_string($conn, $_POST['address']);
    $newPostcode = mysqli_real_escape_string($conn, $_POST['postcode']);
    $newCity = mysqli_real_escape_string($conn, $_POST['City']);
    $newState = mysqli_real_escape_string($conn, $_POST['State']);
    $newCountry = mysqli_real_escape_string($conn, $_POST['Country']);
    $newInfo = mysqli_real_escape_string($conn, $_POST['info']);
    $newAbout = mysqli_real_escape_string($conn, $_POST['about']);

    $updateQuery = "UPDATE hotel SET 
                    hotelname = '$newHotelName',
                    contact = '$newContact',
                    email = '$newEmail',
                    address = '$newAddress',
                    postcode = '$newPostcode',
                    City = '$newCity',
                    State = '$newState',
                    Country = '$newCountry',
                    info = '$newInfo',
                    about = '$newAbout'
                    WHERE hotelID = $hotelID";

    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        header("Location: updated_hotel.php");
        exit();
    } else {
        echo "Error updating hotel information: " . mysqli_error($conn);
    }
}


$query = "SELECT * FROM hotel WHERE hotelID = $hotelID";
$result = mysqli_query($conn, $query);
$hotelInfo = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Hotel Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
        }

        h2 {
            color: #28a745;
            font-family: 'Staatliches';
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 800px;
            margin: 20px auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #6c757d;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #495057;
            background-color: #343a40;
            color: #fff;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h2>Edit Hotel Information</h2>
    
    <form method="POST">
        <div class="form-group">
            <label for="hotelname">Hotel Name</label>
            <input type="text" id="hotelname" name="hotelname" value="<?php echo $hotelInfo['hotelname']; ?>" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact" value="<?php echo $hotelInfo['contact']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $hotelInfo['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $hotelInfo['address']; ?>">
        </div>
        <div class="form-group">
            <label for="postcode">Postcode</label>
            <input type="text" id="postcode" name="postcode" value="<?php echo $hotelInfo['postcode']; ?>">
        </div>
        <div class="form-group">
            <label for="City">City</label>
            <input type="text" id="City" name="City" value="<?php echo $hotelInfo['City']; ?>">
        </div>
        <div class="form-group">
            <label for="State">State</label>
            <input type="text" id="State" name="State" value="<?php echo $hotelInfo['State']; ?>">
        </div>
        <div class="form-group">
            <label for="Country">Country</label>
            <input type="text" id="Country" name="Country" value="<?php echo $hotelInfo['Country']; ?>">
        </div>
        <div class="form-group">
            <label for="info">Info</label>
            <textarea id="info" name="info"><?php echo $hotelInfo['info']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <textarea id="about" name="about"><?php echo $hotelInfo['about']; ?></textarea>
        </div>

    </form>
    <p><a class="btn btn-warning" href="updated_hotel.php">View Updated Information</a></p>
</body>
</html>