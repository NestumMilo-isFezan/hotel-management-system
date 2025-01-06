<?php
session_start();
include("../../config/config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
</head>

<body onLoad="show_AddEntry()">
    <div>
        <h1>Room Edit</h1>
    </div>

    <?php
    $id = "";
    $roomstatus = "";
    $roomNo = "";

    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $room_id = ($_GET["id"]);
        $hotel_id = $_SESSION["hotelID"];

        $sql = "SELECT * FROM room WHERE roomID = '$room_id' AND hotelID = '$hotel_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row["roomID"];
            $roomstatus = $row["roomstatus"];
            $roomNo = $row["roomNo"];
        }
    }

    mysqli_close($conn);
    ?>

    <div>
        <h3>Edit Room</h3>
        <p>Required field with mark*</p>

        <form method="POST" action="room_edit_action.php" enctype="multipart/form-data">
            <!--hidden value: id to be submitted to action page-->
            <input type="hidden" id="rid"name="rid" value="<?= $id ?>">
            <table border="1">
                <tr>
                    <td>Year*</td>
                    <td>:</td>
                    <td>
                        <?php
                        if ($roomstatus != "") {
                            echo '<input type="text" name="roomstatus" value="' . $roomstatus . '" required>';
                        } else {
                        ?>
                            <input type="text" name="roomstatus" required>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>*</td>
                    <td>:</td>
                    <td>
                        <?php
                        if ($roomNo != "") {
                            echo '<input type="text" name="roomNo" size="5" value="' . $roomNo . '" required>';
                        } else {
                        ?>
                        <input type="text" name="roomNo" required>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <input type="submit" value="Submit" name="B1">
                        <input type="button" value="Reset" name="B2" onclick="resetForm()">
                        <input type="button" value="Clear" name="B3" onclick="clearForm()">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
