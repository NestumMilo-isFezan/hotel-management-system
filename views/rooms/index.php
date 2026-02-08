<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Room Catalogue - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="/style/style.css" rel="stylesheet">
</head>
<body data-bs-theme="dark">
    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Header -->
    <section class="text-center" style="background-image: url('<?= \App\Core\Security::escape($hotel['hotelimg'] ?? '') ?>'); background-size:cover; background-repeat: no-repeat; height: 300px;">
        <div class="w-100 h-100 d-flex" style="background: rgba(32,32,39,0.3); backdrop-filter: blur(5px);">
            <div class="m-auto" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);">
                <h1 class="display-5" style="font-family: 'Staatliches';"><?= \App\Core\Security::escape($hotel['hotelname'] ?? '') ?><br><span class="display-2" style="color:#22092C;">Room Catalogue</span></h1>
            </div>
        </div>
    </section>

    <!-- Room List -->
    <section class="py-5 bg-dark" style="min-height: 80vh;">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php if (!empty($rooms)): ?>
                    <?php foreach ($rooms as $room): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?= \App\Core\Security::escape($room['roomimg']) ?>" class="card-img-top object-fit-cover" style="height: 200px;" alt="Room Image">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Room No: <?= \App\Core\Security::escape($room['roomNo']) ?></h5>
                                    <p class="card-text text-secondary"><?= \App\Core\Security::escape($room['description']) ?></p>
                                </div>
                                <div class="card-footer bg-transparent border-0 mb-3 d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0">RM <?= \App\Core\Security::escape($room['price']) ?></h3>
                                    <?php if (\App\Core\Session::get('guestID')): ?>
                                        <a href="/book?room=<?= $room['roomID'] ?>" class="btn btn-primary">Book Now</a>
                                    <?php else: ?>
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#loginmodal">Login to Book</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p>No available rooms found. 🤷‍♂️</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../partials/footer.php'; ?>

    <?php include __DIR__ . '/../partials/auth_modals.php'; ?>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/authentication.js"></script>
</body>
</html>
