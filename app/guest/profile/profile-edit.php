<?php
session_start();
include("../config/config.php");
?>

<!DOCTYPE html>
<html>
    <body>
    <?php
            if($_SESSION['guestID']){
                $guestID = $_SESSION['guestID'];
                $sql = "SELECT guest.*, useracc.* FROM guest
                JOIN useracc ON guest.accID = useracc.accID
                WHERE guest.guestID = '$guestID";

                $guestdata = fetchOne($sql);
                            
                if ($guestdata!= null) {
                    $guestID = $guestdata['guestID'];
                    $accountID = $guestdata['accID'];
                    $birthdate = $guestdata['birthdate'];
                    $address =  $guestdata['address'];
                    $postcode = $guestdata['postcode'];
                    $city = $guestdata['city'];
                    $state = $guestdata['state'];
                    $country = $guestdata['country'];
                }
            }
		?>
        <!--header edit profile-->
        <div>
			<h1>Edit Profile</h1>
		</div>
        <!--ni part form edit profile-->
        <form method="post" action="profile-edit-action.php">
            <!-- Add input fields for user to edit profile data -->
            <label for="username">Username</label>
            <input type="text" value="<?= $username ?>" required><br>

            <label for="Email">Email</label>
            <input type="email" value="<?= $email ?>" required><br>

            <label for="birthdate">Birthdate</label>
            <input type="date" value="<?= $birthdate ?>" required><br>

            <label for="address">Address</label>
            <input type="text" value="<?= $address ?>" required><br>

            <label for="postcode">Postcode</label>
            <input type="text" value="<?= $postcode ?>" required><br>

            <label for="city">City</label>
            <input type="text" value="<?= $city ?>" required><br>

            <label for="state">State</label>
            <input type="text" value="<?= $state ?>" required><br>

            <label for="country">Country</label>
            <input type="text" value="<?= $country ?>" required><br>

            <button type="submit">Update</button>
        </form>
    </body>

</html>
