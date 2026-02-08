<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking - <?= \App\Core\Security::escape($room['roomNo']) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="/style/style.css" rel="stylesheet">
</head>
<body data-bs-theme="dark">
    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <section class="py-5 bg-dark" style="min-height: 100vh;">
        <div class="container">
            <form id="bookform" class="card shadow-lg">
                <input type="hidden" id="roomID" value="<?= \App\Core\Security::escape((string)$room['roomID']) ?>">
                <input type="hidden" id="guestID" value="<?= \App\Core\Security::escape((string)$guestID) ?>">
                <input type="hidden" id="price" value="<?= \App\Core\Security::escape((string)$room['price']) ?>">
                <input type="hidden" id="totalprice" name="totalprice">

                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="<?= \App\Core\Security::escape($room['roomimg']) ?>" class="img-fluid rounded-start h-100 object-fit-cover" alt="Room Image" style="min-height: 300px;">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body p-4">
                            <h2 class="card-title fw-bold" style="font-family: 'Poppins';">Room No: <?= \App\Core\Security::escape($room['roomNo']) ?> - <?= \App\Core\Security::escape($room['name']) ?></h2>
                            <p class="card-text text-secondary"><?= \App\Core\Security::escape($room['description']) ?></p>
                            <span class="badge bg-warning text-dark mb-4">Capacity: <?= \App\Core\Security::escape((string)$room['capacity']) ?> people</span>
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="services" class="form-label">Additional Service</label>
                                    <select class="form-select" id="services" name="services" required>
                                        <option value="0" selected>None</option>
                                        <?php foreach ($services as $service): ?>
                                            <option value="<?= $service['serviceID'] ?>"><?= \App\Core\Security::escape($service['name']) ?> - RM <?= \App\Core\Security::escape((string)$service['price']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="checkin" class="form-label">Check-In Date</label>
                                    <input type="date" class="form-control" id="checkin" name="checkin" required min="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="checkout" class="form-label">Check-Out Date</label>
                                    <input type="date" class="form-control" id="checkout" name="checkout" required>
                                </div>
                            </div>

                            <div class="mt-5 d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-secondary mb-0">Estimated Price</p>
                                    <h3 class="fw-bold">RM <span id="estprice">0.00</span></h3>
                                </div>
                                <div>
                                    <a href="/rooms" class="btn btn-outline-danger me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-lg">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php include __DIR__ . '/../partials/footer.php'; ?>
    <?php include __DIR__ . '/../partials/auth_modals.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/booking.js"></script>
</body>
</html>
