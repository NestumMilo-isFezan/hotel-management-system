<?php
require("../../directory.php");
require(TEMP_DIR . "/adminpart.php");

if (isset($_POST["submit"])) {
    $payid = $_POST["payid"];
    $amountpay = $_POST["amountpay"];
    $paymethod = $_POST["paymethod"];

    // Check if there is an existing payment with a negative balance
    $checkExistingPaymentSQL = "SELECT * FROM payment WHERE bookID = '$payid' AND balance < 0 ORDER BY paymentdate DESC, paymenttime DESC LIMIT 1";
    $existingPaymentResult = mysqli_query($conn, $checkExistingPaymentSQL);

    if ($existingPaymentResult && mysqli_num_rows($existingPaymentResult) > 0) {
        // If there is an existing payment with a negative balance, update the existing payment
        $existingPaymentRow = mysqli_fetch_assoc($existingPaymentResult);
        $existingPaymentID = $existingPaymentRow["paymentID"];
        $newBalance = $existingPaymentRow["balance"] + $amountpay;

        $updatePaymentSQL = "UPDATE payment SET amountpay = '$amountpay', balance = '$newBalance', method = '$paymethod' WHERE paymentID = '$existingPaymentID'";
        $updatePaymentResult = mysqli_query($conn, $updatePaymentSQL);

        if ($updatePaymentResult) {
            // Update booking status based on user balance
            $updateBookingSQL = ($newBalance < 0) ?
                "UPDATE booking SET status = 'checkin' WHERE bookID = '$payid'" :
                "UPDATE booking SET status = 'checkout' WHERE bookID = '$payid'";

            $updateBookingResult = mysqli_query($conn, $updateBookingSQL);

            if ($updateBookingResult) {
                header("Location: ../checkout/index.php");
                exit(); // Important to stop script execution after redirect
            } else {
                echo "Error updating booking status: " . mysqli_error($conn);
            }
        } else {
            echo "Error updating existing payment: " . mysqli_error($conn);
        }
    } else {
        // If there is no existing payment with a negative balance, insert a new payment
        $balance = $_POST['amountpay'] - $_POST['total_price'];

        $insertPaymentSQL = "INSERT INTO payment (bookID, amountpay, balance, method) VALUES ('$payid', '$amountpay', '$balance', '$paymethod')";
        $insertPaymentResult = mysqli_query($conn, $insertPaymentSQL);

        if ($insertPaymentResult) {
            // Retrieve user balance
            $getUserBalanceSQL = "SELECT balance FROM payment WHERE bookID = '$payid' ORDER BY paymentdate DESC, paymenttime DESC LIMIT 1";
            $userBalanceResult = mysqli_query($conn, $getUserBalanceSQL);

            if ($userBalanceResult) {
                $userBalanceRow = mysqli_fetch_assoc($userBalanceResult);
                $userBalance = $userBalanceRow["balance"];

                // Update booking status based on user balance
                $updateBookingSQL = ($userBalance < 0) ?
                    "UPDATE booking SET status = 'checkin' WHERE bookID = '$payid'" :
                    "UPDATE booking SET status = 'checkout' WHERE bookID = '$payid'";

                $updateBookingResult = mysqli_query($conn, $updateBookingSQL);

                if ($updateBookingResult) {
                    header("Location: ../checkout/index.php");
                } else {
                    echo "Error updating booking status: " . mysqli_error($conn);
                }
            } else {
                echo "Error fetching user balance: " . mysqli_error($conn);
            }
        } else {
            echo "Error inserting new payment: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>