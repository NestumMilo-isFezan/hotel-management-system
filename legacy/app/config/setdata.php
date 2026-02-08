<?php
include('../../directory.php');
require_once(CONFIG_DIR  . '/config.php');

// Insert Data
function setQuery($sql, $title, $message){
    global $conn;

    // Icon
    $successicon = ICON_DIR .'/success.png';
    $failedicon = ICON_DIR .'/db-error.png';

    // Algo
    $result = mysqli_query($conn, $sql);
    if($result) { ?>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <!-- Start -->
                    <div class = "container-fluid">
                        <div class="row-cols-1">
                            <div class = "col">
                                <h2>Successful <?= $title?></h2>
                            </div>
            
                            <div class = "col m-auto" style="width:150px; height:150px;">
                                <img src = "<?= $successicon?>">
                            </div>

                            <div class = "col my-3">
                                <p><?= $message?></p>
                            </div>
                        </div>
                    </div>
                <!-- End -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
        
      <script>
        setTimeout(function() {
          window.location.href = "index.php";
        }, 4000)
      </script>
    <?php
      }
    else
    {
    ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <!-- Start -->
                    <div class = "container-fluid">
                        <div class="row-cols-1">
                            <div class = "col">
                                <h2>Successful</h2>
                            </div>
            
                            <div class = "col m-auto" style="width:150px; height:150px;">
                                <img src = "<?= $failedicon?>">
                            </div>

                            <div class = "col my-3">
                                <p>It seems failed, huh?</p>
                            </div>
                        </div>
                    </div>
                <!-- End -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
        
      <script>
        setTimeout(function() {
          window.location.href = "index.php";
        }, 4000)
      </script>
        setTimeout(function() {
          window.location.href = "index.php";
        }, 4000)
      </script>
  
  <?php
    }
  }
  ?>