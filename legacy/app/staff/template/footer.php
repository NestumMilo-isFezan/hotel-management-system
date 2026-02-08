<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between px-3 py-3 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
        <a href="" class="me-4 text-reset">
        <i class='bx bxl-facebook-square' ></i>
        </a>
        <a href="" class="me-4 text-reset">
        <i class='bx bxl-twitter' ></i>
        </a>
        <a href="" class="me-4 text-reset">
        <i class='bx bxl-instagram-alt' ></i>
        </a>
        <a href="" class="me-4 text-reset">
        <i class='bx bxl-linkedin-square' ></i>
        </a>
        <a href="" class="me-4 text-reset">
        <i class='bx bxl-github' ></i>
        </a>
    </div>
    <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
    <div class="container text-center text-md-start mt-3 mb-2">
        <!-- Grid row -->
        <div class="row justify-content-between">
        <!-- Grid column -->
        <div class="col-md-4 col-lg-4 col-xl-3 mx-2 mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-2 pb-3 border-bottom">
            <i class='bx bxs-buildings' ></i> | <?= $hotelname?>
            </h6>
            <p>
            <?= $about?>
            </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-5 col-xl-4 mx-2 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-2 pb-3 border-bottom">Our Contact</h6>
            <div class="d-flex px-1">
            <i class='bx bxs-map-pin p-2 me-1' ></i>
            <p class="ms-1"><?= $address?>, <?= $city?>, <?= $postcode?>, <?= $statename?>, <?= $countryname?></p> 
            </div>
            <div class="d-flex px-1">
            <i class='bx bxs-envelope p-2 me-1' ></i>
            <p class="ms-1"><?= $email?></p> 
            </div>
            <div class="d-flex px-1">
            <i class='bx bxs-phone p-2 me-1' ></i>
            <p class="ms-1"><?= $contact?></p> 
            </div>
        </div>
        <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center px-1 py-2" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2023 Copyright: Hak Milik Group MangsaCoding
    </div>
    <!-- Copyright -->
</footer>