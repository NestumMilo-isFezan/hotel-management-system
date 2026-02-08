<footer class="bg-dark text-white pt-5 pb-4" id="contact">
    <div class="container text-center text-md-left">
        <div class="row text-center text-md-left">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-info"><?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></h5>
                <p><?= \App\Core\Security::escape($hotel['info'] ?? '') ?></p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-info">Contact</h5>
                <p><i class="bx bxs-home mr-3"></i> <?= \App\Core\Security::escape($hotel['full_address'] ?? '') ?></p>
                <p><i class="bx bxs-envelope mr-3"></i> <?= \App\Core\Security::escape($hotel['email'] ?? '') ?></p>
                <p><i class="bx bxs-phone mr-3"></i> <?= \App\Core\Security::escape($hotel['contact'] ?? '') ?></p>
            </div>
        </div>

        <hr class="mb-4">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p>Copyright © 2024 All rights reserved by:
                    <a href="#" style="text-decoration: none;">
                        <strong class="text-info"><?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></strong>
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>
