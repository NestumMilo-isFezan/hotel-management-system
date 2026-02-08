<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Bookings - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="/style/style.css" rel="stylesheet">
</head>
<body data-bs-theme="dark">
    <?php include __DIR__ . '/../../partials/navbar.php'; ?>

    <div class="container py-5">
        <h2 class="fw-bold mb-4">My Booking History</h2>

        <div class="row g-4">
            <?php if (!empty($bookings)): ?>
                <?php foreach ($bookings as $b): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="fw-bold mb-0">Room <?= \App\Core\Security::escape($b['roomNo']) ?></h5>
                                    <?php 
                                        $badgeClass = match($b['status']) {
                                            'pending' => 'bg-warning text-dark',
                                            'confirmed', 'checkin' => 'bg-success',
                                            'checkout' => 'bg-info',
                                            'cancelled' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= ucfirst($b['status']) ?></span>
                                </div>
                                <div class="mb-2">
                                    <small class="text-secondary d-block">Check-In</small>
                                    <span><?= date('d M Y', strtotime($b['check_in'])) ?></span>
                                </div>
                                <div class="mb-3">
                                    <small class="text-secondary d-block">Check-Out</small>
                                    <span><?= date('d M Y', strtotime($b['check_out'])) ?></span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <span class="fw-bold text-primary">RM <?= number_format((float)$b['total_price'], 2) ?></span>
                                    <?php if ($b['status'] === 'pending'): ?>
                                        <button class="btn btn-sm btn-outline-danger cancel-booking" data-id="<?= $b['bookID'] ?>">Cancel</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class='bx bx-calendar-x display-1 text-secondary mb-3'></i>
                    <p class="fs-5">You haven't made any bookings yet.</p>
                    <a href="/rooms" class="btn btn-primary mt-2">Browse Rooms</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include __DIR__ . '/../../partials/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.cancel-booking').click(function() {
                if (confirm('Are you sure you want to cancel this booking?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: '/my-bookings/cancel',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            if (response === 'ok') {
                                location.reload();
                            } else {
                                alert('Error cancelling booking');
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
