<?php
require "directory.php";
$uplaodpath = UPLOAD_DIR.'/user/';
$img_path = "";
// Check if userID is set in the session
if($_SESSION['user'] == 1){
    // If userID is set, the user is logged in

    // Check if userRoles is set and if the user is a guest (assuming 2 represents a guest role)
    if(isset($_SESSION['guestID'])){
        // Fetch Guest Data
        $userID = $_SESSION['userID'];
        $guestdata = fetchOne("SELECT * FROM guest WHERE accID=$userID");

        // Assign Guest Data
        $guestID = $guestdata['guestID'];
        $firstName = $guestdata['firstName'];
        $img = $guestdata['img_path'];
        if($img == null){
            $img_path = ICON_DIR."/user_icon.png";
        }
        else{
            $img_path = $uploadpath . $img;
        }
        
        // Include the guest navbar
        include (TEMP_DIR."/loggedbar.php"); 
    } 

}
else {
    // Include a default navbar for users who are not logged in
    include TEMP_DIR. "/navbar.php";
}
?>