<?
  include('../../directory.php');
  require (TEMP_DIR.'/bookpart.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking</title>
    <link href="" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  </head>

  <body data-bs-theme="dark">
    <!-- Navbar -->
    <?php 
      require (TEMP_DIR."/navguest.php");
    ?>
    <!-- End Navbar -->

    <!-- Room List -->
    <section class="h-100" style="min-height: 100vh;">
      <div class="container py-3 py-sm-2">
        <form class="row row-cols-1 g-4 pb-4" id="bookform" method="post">
          <input type="hidden" id="roomID" value=<?= $roomID?>>
          <input type="hidden" id="guestID" value=<?= $guestID?>>

          <div class="col">
              <div class="card h-100" style="min-height: 80vh;">
                  <img src="<?= $roomimg?>" class="card-img-top object-fit-cover" style="height: 35vh;" alt="...">
                  <div class="card-body">
                      <h2 class="card-title fw-bold" style="font-family: 'Poppins';">No : <?= $roomNo?> - <?= $roomname?></h5>
                      <p class="card-text"><?= $roomdesc?></p>
                      <p class="badge bg-warning text-dark">For <?= $capacity?> people</p>
                      
                      <div class="row g-3">
                        <div class="col-12 input-group mb-3">
                          <label for="services" class="input-group-text" style="width:100px;">Service</label>
                          <select class="form-select" aria-label="Default select example" name="services" id="services" required>
                            <option selected>Select the service you want to enjoy</option>
                            <?php
                              $servicedata = fetchAll("SELECT * FROM hotelservice WHERE hotelID=$hotelID AND servicestatus='available'");
                              if($servicedata){
                                foreach ($servicedata as $selections){
                                  $serviceID = $selections['serviceID'];
                                  $serviceName = $selections['name'];
                                  $serviceprice = $selections['price'];
                                  ?>
                                  <option value=<?= $serviceID?>><?= $serviceName?> - RM <?= $serviceprice?></option>
                            <?php
                                }
                              }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                          <label for="checkin" class="input-group-text" style="width:100px;">Check In</label>
                          <input type="date" class="form-control" name="checkin" id="checkin" placeholder="Select check-in date" required>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                          <label for="checkout" class="input-group-text" style="width:100px;">Check Out</label>
                          <input type="date" class="form-control" name="checkout" id="checkout" placeholder="Select check-out date" required>
                        </div>
                            </div>
                  </div>
                  <div class="mb-5 d-flex justify-content-between mx-3">
                    <input type="hidden" id="price" value="<?= $roomprice?>">
                    <input type="hidden" name="totalprice" id="totalprice">
                    <div class="ps-2">
                      <h3>RM&nbsp;<span  id="estprice">0.00</span></h3>
                    </div>
                    <div class="p-1 my-1">
                      <button class="btn btn-danger btn-lg" name="cancel">Cancel</button>
                      <button class="btn btn-primary btn-lg" name="submit" id="submitit">Book Now</button>
                    </div>
                  </div>
              </div>
          </div>
        </form>
    
      </div>
    </section>

    
    <!-- Footer -->
    <?php
      include (TEMP_DIR."/footer.php");
    ?>

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

    <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
        <strong class="me-auto">System</strong>
        <small>A changes made...</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        It seems there is a problem. <br>Maybe server failed...
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
        Successfully Book The Room.<br>Redirect to login page in maybe 5 seconds.
        </div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="action.js"></script>
    <!-- <script src="submit.js"></script> -->
  </body>
</html>