<?php
session_start();
include("../../config/config.php");


$hotelID = $_SESSION['hotelID']; 

$query = "SELECT * FROM hotel WHERE hotelID = $hotelID";
$result = mysqli_query($conn, $query);
$hotelInfo = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Updated Hotel Information</title>
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

        p {
            text-align: center;
            color: #6c757d;
        }

        table {
            width: 50%;
            margin: 20px auto;
            background-color: #212529;
            color: #fff;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #495057;
        }

        th {
            background-color: #28a745;
            color: #fff;
        }

        tr:hover {
            background-color: #343a40;
        }
    </style>
</head>
<body>
    <h2>Updated Hotel Information</h2>
    <p>Welcome, <?php echo $_SESSION['user']; ?>!</p>
    <table class="table">
        <tr>
            <th>Field</th>
            <th>Information</th>
        </tr>
        <tr>
            <td>Hotel Name</td>
            <td><?php echo $hotelInfo['hotelname']; ?></td>
        </tr>
        <tr>
            <td>Contact</td>
            <td><?php echo $hotelInfo['contact']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $hotelInfo['email']; ?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><?php echo $hotelInfo['address']; ?></td>
        </tr>
        <tr>
            <td>Postcode</td>
            <td><?php echo $hotelInfo['postcode']; ?></td>
        </tr>
        <tr>
            <td>City</td>
            <td><?php echo $hotelInfo['City']; ?></td>
        </tr>
        <tr>
            <td>State</td>
            <td><?php echo $hotelInfo['State']; ?></td>
        </tr>
        <tr>
            <td>Country</td>
            <td><?php echo $hotelInfo['Country']; ?></td>
        </tr>
        <tr>
            <td>Info</td>
            <td><?php echo $hotelInfo['info']; ?></td>
        </tr>
        <tr>
            <td>About</td>
            <td><?php echo $hotelInfo['about']; ?></td>
        </tr>
    </table>
</body>
</html>
