<?php 
session_start();
require "../../directory.php";
require (TEMP_DIR."/roompart.php");

if(isset($_SESSION['staffID'])){
  header("Refresh:0; url=staff/index.php");
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome to the <?= $hotelname?></title>
        <link href="" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Staatliches" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

  <body data-bs-theme="dark" class="vw-100 vh-100">
    <!-- Navbar -->
    <?php 
      require TEMP_DIR."/navguest.php";
    ?>
    <!-- End Navbar -->

    <?php
        if($_SESSION['guestID']){
            $guestID = $_SESSION['guestID'];
            $sql = "SELECT guest.*, useracc.* FROM guest
                    JOIN useracc ON guest.accID = useracc.accID
                    WHERE guest.guestID = $guestID";

            $guestdata = fetchOne($sql);
                                
            if ($guestdata!= null) {
                $guestID = $guestdata['guestID'];
                $accountID = $guestdata['accID'];
                $birthdate = $guestdata['birthdate'];
                $uaddress =  $guestdata['address'];
                $upostcode = $guestdata['postcode'];
                $ucity = $guestdata['city'];
                $ustate = $guestdata['state'];
                $ucountry = $guestdata['country'];
                $imgprofile = $guestdata['img_path'];
                $username = $guestdata['username'];
                $phone = $guestdata['contact'];

                $firstName = $guestdata['firstName'];
                $lastname = $guestdata['lastName'];
                $gemail = $guestdata['email'];
            }

            if($imgprofile ==""){
               $imgprofile = ICON_DIR."/user_icon.png";
            }
            else{
                $imgtemp = $imgprofile;
                $imgprofile = UPLOAD_DIR."/user/$imgtemp";
            }
                    
        }
    ?>

    <div class="container">
        <div class="w-100 ms-md-5">
        <div class="row w-100 p-2 pb-5">
                        <div class="col-lg-9 col-md-8 col-12">
                            <!-- Card -->
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header">
                                    <h3 class="mb-0">Profile Details</h3>
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="d-lg-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center mb-4 mb-lg-0">
                                            <img src="<?= $imgprofile?>" id="img-uploaded" style="width:100px; height:100px;" alt="avatar">
                                            <div class="ms-3">
                                                <h4 class="mb-0"><?= $username?></h4>
                                            </div>
                                        </div>
                                        <div>
                                            <button id="editbtn" class="btn btn-outline-secondary btn-sm">Edit Profile</button>
                                        </div>
                                    </div>
                                    <hr class="my-5">
                                    <div>
                                        <h4 class="mb-0">Personal Details</h4>
                                        <p class="mb-4">Edit guest personal information and address.</p>
                                        <!-- Form -->
                                        <form id="infoform" class="row gx-3" method="post">
                                            <!-- First name -->
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="fname">First Name</label>
                                                <input type="text" id="fname" class="form-control ded" placeholder="First Name" required="" value="<?= $firstName?>">
                                                <div class="invalid-feedback">Please enter first name.</div>
                                            </div>
                                            <!-- Last name -->
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="lname">Last Name</label>
                                                <input type="text" id="lname" class="form-control ded" placeholder="Last Name" required="" value="<?= $lastname?>">
                                                <div class="invalid-feedback">Please enter last name.</div>
                                            </div>
                                            <!-- Phone -->
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="text" id="email" class="form-control" placeholder="" required="" disabled value="<?= $gemail?>">
                                                <div class="invalid-feedback">Please enter email.</div>
                                            </div>
                                            <!-- Address -->
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="address">Address</label>
                                                <input type="text" id="address" class="form-control ded" placeholder="Address" required="" value="<?= $uaddress?>">
                                            </div>
                                            <!-- Postcode -->
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="birth">Postcode</label>
                                                <input type="text" id="postcode" class="form-control ded" placeholder="Address" required="" value="<?= $upostcode?>">
                                            </div>
                                            <!-- City -->
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="city">City</label>
                                                <input type="text" id="city" class="form-control ded" placeholder="City" required="" value="<?= $ucity?>">
                                            </div>
                                            <!-- State -->
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="state">State</label>
                                                <input type="text" id="state" class="form-control ded" placeholder="State" required="" value="<?= $ustate?>">
                                                
                                            </div>
                                            <!-- Country -->
                                            <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label" for="country">Country</label>
                                                <input type="text" id="country" class="form-control ded" placeholder="Country" required="" value="<?= $ucountry?>">
                                                
                                            </div>
                                            
                                            <div class="col-12">
                                                <!-- Button -->
                                                <button class="btn btn-primary" id="finishbtn" type="submit">Update Profile</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>


    <div class="toast-container position-fixed bottom-0 end-0 p-3">

<div id="imgToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
    <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
    <strong class="me-auto">System</strong>
    <small>A changes made...</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    Successfully Replace Image Hotel
    </div>
</div>

<div id="editToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
    <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
    <strong class="me-auto">System</strong>
    <small>A changes made...</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    Successfully Edit Guest Profile
    </div>
</div>
<div id="editNewsToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
    <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
    <strong class="me-auto">System</strong>
    <small>A changes made...</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    Successfully Edit News
    </div>
</div>

<div id="deleteNewsToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
    <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
    <strong class="me-auto">System</strong>
    <small>A changes made...</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    Successfully Delete News
    </div>
</div>

<div id="addNewsToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
    <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
    <strong class="me-auto">System</strong>
    <small>A changes made...</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    Successfully Add News
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="action.js"></script>
</body>
</html>