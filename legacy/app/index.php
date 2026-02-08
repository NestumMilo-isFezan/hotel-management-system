<?php 
require_once "directory.php";
require_once (TEMP_DIR."/homepart.php");

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

  <body data-bs-theme="dark">
    <!-- Navbar -->
    <?php 
      require TEMP_DIR."/navlogic.php";
    ?>
    <!-- End Navbar -->

    <!-- Hero Section -->
    <section id="home" class="text-center vh-100" style="background-image: url('<?= $hotelimg?>'); background-size:cover; background-repeat: no-repeat;">
      <div class="px-2 pt-2 w-100 y-100 h-100 d-flex" style="background: rgb(32,32,39); background: linear-gradient(90deg, rgba(32,32,39,0.3) 0%, rgba(53,53,78, 0.3) 28%, rgba(94,94,108, 0.3) 70%, rgba(111,106,106, 0.3) 100%); backdrop-filter: blur(5px);">
        <div class="px-2 pt-2 pt-sm-3 m-auto" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);">
          <div>
            <h1 class="display-4 mx-3" style="font-family: 'Staatliches';">Welcome to the<br><span class="display-1" style="color:#22092C;"><?= $hotelname?></span></h1>
            <p class="fs-5 mt-2 mx-auto w-75" style="font-family: 'Poppins';"><?= $info?></p>
          </div>
        </div>
      </div>
    </section>

    <!-- Hotel News -->
    <section id="news" class="h-100" style="min-height: 80vh;">
      <div class="album py-2 pb-3 h-100 bg-dark"">
      
        <div class="mt-2 mb-4 pt-1 px-3 text-center">
          <h1 class="display-2 fw-bold " style="font-family: 'Staatliches'; color:#4CB9E7">News</h1>
        </div>

        <div class="container mt-3 h-100">
            <div class="row row-cols-1 row-cols-md-3 g-3">
            <?php
            // Fetch news data ordered by the latest date
            $sql = "SELECT newstitle, description, registerdate, registertime 
                    FROM news ORDER BY registerdate DESC, registertime DESC LIMIT 3";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title" style = "font-weight: bold"><?= $row["newstitle"] ?></h5>
                        <p class="card-text" style = "text-align: justify"><?= $row["description"] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-body-secondary"><?= $row["date"] ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            } 
            else {
                echo '<p>No news available. 🤷‍♂️📰</p>';
            }
            mysqli_close($conn);
            ?>
    </section>
    

    <!-- Footer -->
    <?php 
      include "./template/footer.php"
    ?>

    <!-- Modal -->
    <div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form autocomplete="off" class="modal-content" method="post" id="loginform">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Log-In</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-100">
                        <div class="mb-1">
                            <label for="email" class="col-form-label">Email :</label>
                            <div class="input-group">
                                <span class="input-group-text" style="width:40px;"><i class='bx bxs-envelope' ></i></span>
                                <input type="email" class="form-control" id="loginemail" name="email" placeholder="Your Email" require>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="passw" class="col-form-label">Password :</label>
                            <div class="input-group">
                                <span class="input-group-text" style="width:40px;"><i class='bx bxs-key' ></i></span>
                                <input type="password" class="form-control" id="loginpass" name="password" placeholder="Your Password" require>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit" id="loginnow" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form autocomplete="off" class="modal-content" method="post" id="registerform">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Register</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-100">
                      <div class="mb-1">
                            <label for="name" class="col-form-label">Username :</label>
                            <div class="input-group">
                                <span class="input-group-text" style="width:40px;"><i class='bx bxs-user-circle' ></i></span>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Your Username">
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="email" class="col-form-label">Email :</label>
                            <div class="input-group">
                                <span class="input-group-text" style="width:40px;"><i class='bx bxs-envelope' ></i></span>
                                <input type="email" class="form-control" id="registeremail" name="registeremail" placeholder="Your Email">
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="password" class="col-form-label">Password :</label>
                            <div class="input-group">
                                <span class="input-group-text" style="width:40px;"><i class='bx bxs-key' ></i></span>
                                <input type="password" class="form-control" id="regpassword" name="password" placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="confirmpass" class="col-form-label">Confirm Password :</label>
                            <div class="input-group">
                                <span class="input-group-text" style="width:40px;"><i class='bx bxs-key' ></i></span>
                                <input type="password" class="form-control" id="confirmpass" name="confirmpass" placeholder="Re-Enter Password">
                            </div>
                        </div>
                        <hr>
                        <div class="mb-1">
                            <label for="fname" class="col-form-label">First Name :</label>
                            <div class="input-group">
                                <span class="input-group-text" style="width:40px;"><i class='bx bx-rename' ></i></span>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Your First Name">
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="lname" class="col-form-label">Last Name :</label>
                            <div class="input-group">
                                <span class="input-group-text" style="width:40px;"><i class='bx bxs-rename' ></i></span>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Your Last Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit" id="registernow" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="guestToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
        <strong class="me-auto">System</strong>
        <small>A changes made...</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        Hi Guest-san, Let's explore the page in 5 seconds...
        </div>
    </div>

    <div id="staffToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
        <strong class="me-auto">System</strong>
        <small>A changes made...</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        Hello Staff-san, You will be redirected to staff page. <br>Maybe in 5 seconds...
        </div>
    </div>

    <div id="addToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
        <strong class="me-auto">System</strong>
        <small>A changes made...</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        Successfully Register.<br>Please Login.
        </div>
    </div>

</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="./auth/authentication.js"></script>
  </body>
</html>