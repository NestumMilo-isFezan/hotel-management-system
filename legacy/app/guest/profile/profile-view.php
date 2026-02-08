<?php
session_start();
include("../config/config.php");/*nanti dh last baru masuk yang betul*/
/*$activePage = 'Profile';ini kalau nak buat rezponsive navbar*/
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
		
		<!--ini header untuk profile punya -->
		<div>
			<h1>My Profile</h1>
		</div>

        <!--php function for navbar kalau kau buat-->

        <!--sini bermulanya part untuk add profile data/kiranya baru nak isi laa gituu------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
        <!--ini pulak untuk image button link dgn profile-editimg-->
        <div>
            <img src="../../img/user_icon.png">
			<div>
				<?php
				if(isset($_SESSION['img_path'])){
					echo"<img src='../../uploads/" .$_SESSION['img_path']."'>";
				}
				else{
					echo'
					<img src="../../img/user_icon.png">
					';
				}
				?>
                <!--butang edit image-->
				<div>
					<button onclick="window.location.href='profile-editimg.php';">Edit Image</button>
				</div>
			</div>
        </div>
        <!--table profile view-->
        <div>
            <table border="2" width="100%" style="border-collapse: collapse;">
                <tr>
                    <td width="164">Name</td>
                    <td><?=$username?></td>
                </tr>
                <tr>
                    <td width="164">Email</td>
                    <td><?=$email?></td>
                </tr>  
                <tr>
                    <td width="164">Birthdate</td>
                    <td><?=$birthdate?></td>
                </tr>
                <tr>
                    <td width="164">Address</td>
                    <td><?="$address,$postcode,$city,$state,$country"?></td>
                </tr>
            </table>
        <div>
            <button onclick="window.location.href='profile-edit.php';">Update Profile</button>
        </div>
	</body>
</html>