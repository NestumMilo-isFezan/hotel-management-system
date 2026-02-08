<?
  include('../../directory.php');
  require (TEMP_DIR.'/roompart.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Rooms</title>
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

    <!-- Header -->
    <section class="text-center mh-50" style="background-image: url('<?= $hotelimg?>'); background-size:cover; background-repeat: no-repeat;">
      <div class="px-2 pt-2 w-100 y-100 h-100 d-flex" style="background: rgb(32,32,39); background: linear-gradient(90deg, rgba(32,32,39,0.3) 0%, rgba(53,53,78, 0.3) 28%, rgba(94,94,108, 0.3) 70%, rgba(111,106,106, 0.3) 100%); backdrop-filter: blur(5px);">
        <div class="px-2 pt-2 pt-sm-3 m-auto" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);">
          <div>
            <h1 class="display-5" style="font-family: 'Staatliches';"><?= $hotelname?><br><span class="display-2" style="color:#22092C;">Room Catalogue</span></h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Room List -->
    <?php
      // Configuration Pagination //
      $data_inpage = 6;
      $totaldata = count(fetchAll("SELECT * FROM room"));
      $totalpage = ceil($totaldata/$data_inpage);
      $activepage = (isset($_GET["page"])) ? $_GET["page"] : 1;
      $initialdata = ($data_inpage * $activepage) - $data_inpage;

      $roomdata = fetchAll("SELECT room.*, roomtype.*
                            FROM room
                            JOIN roomtype ON room.typeID = roomtype.typeID
                            WHERE room.hotelID = $hotelID AND room.roomstatus = 'available'
                            LIMIT $initialdata, $data_inpage;");
    ?>
    <section class="h-100" style="min-height: 80vh;">
      <div class="container py-2 py-sm-5">
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">

        <?php
        if($roomdata){
          foreach ($roomdata as $card){
            $roomimg = UPPATH_DIR . "/roomtype/" . $card['room_imgpath'];

            if(!file_exists($roomimg) || $card['room_imgpath']=="") { 
              $roomimg = UPLOAD_DIR . "/roomtype/default.jpg";
            }
            else{
              $roomimg = UPLOAD_DIR . "/roomtype/" . $card['room_imgpath'];
            }
        ?>
            <div class="col">
                <div class="card h-100" style="min-height: 400px;">
                    <img src="<?= $roomimg?>" class="card-img-top object-fit-cover" style="height: 200px;" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Room No :&nbsp;<?= $card['roomNo']?></h5>
                        <p class="card-text"><?= $card['description']?></p>

                    </div>
                    <div class="mb-5 d-flex justify-content-between mx-3">
                        <h3>RM&nbsp;<?= $card['price']?></h3>
                        <button class="btn btn-primary" onclick="javascript:location.href='../book/index.php?room=<?= $card['roomID']?>'">Book Now</button>
                    </div>
                </div>
            </div>

          <?php   
            }
          }
        ?>

        </div>
    </div>

    <!-- Pagination -->
        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
          <ul class="pagination">
            <?php if($activepage>1) : ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?= $activepage-1?>">Previous</a>
            </li>
            <?php else : ?>
            <li class="page-item disabled">
              <a class="page-link" href="#">Previous</a>
            </li>
            <?php endif; ?>

          <?php for($i=1; $i <= $totalpage; $i++) : ?>
            <?php if($i == $activepage) : ?>
              <li class="page-item active" aria-current="page">
                <span class="page-link"><?= $i?></span>
              </li>

            <?php else : ?>
              <li class="page-item"><a class="page-link" href="?page=<?= $i?>"><?= $i?></a></li>

            <?php endif; ?>
          <?php endfor; ?>

          <?php if($activepage==$totalpage) : ?>
            <li class="page-item disabled">
              <a class="page-link" href="#">Next</a>
            </li>

          <?php else : ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?= $activepage+1?>">Next</a>
            </li>
          <?php endif; ?>
          </ul>
        </nav>
    </section>


    <!-- Footer -->
    <?php
      include (TEMP_DIR."/footer.php")
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>