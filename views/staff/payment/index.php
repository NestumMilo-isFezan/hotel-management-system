<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Process Payment - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="/style/style.css" rel="stylesheet">
</head>
<body class="vh-100" data-bs-theme="dark">
    <button class="btn m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
        <i class='bx bx-menu fs-3'></i>
    </button>

    <?php include __DIR__ . '/../../partials/staff_sidebar.php'; ?>

    <div class="container-fluid px-4">
        <h2 class="fw-bold mb-4" style="font-family: 'Poppins';">Process Booking Payment</h2>

        <div class="row g-4">
            <!-- Payment Summary -->
            <div class="col-md-5">
                <div class="card border-0 shadow-sm bg-dark p-4 h-100">
                    <h4 class="mb-4">Payment Summary</h4>
                    <div class="mb-3">
                        <small class="text-secondary d-block">Booking ID</small>
                        <span class="fs-5">#<?= $booking['bookID'] ?></span>
                    </div>
                    <hr class="text-secondary">
                    <div class="mb-3">
                        <small class="text-secondary d-block">Total Booking Amount</small>
                        <span class="fs-4">RM <?= number_format((float)$booking['total_price'], 2) ?></span>
                    </div>
                    <div class="mb-4">
                        <small class="text-secondary d-block">Current Balance Due</small>
                        <h2 class="fw-bold text-warning">RM <?= number_format($lastPayment ? (float)$lastPayment['balance'] : (float)$booking['total_price'], 2) ?></h2>
                    </div>
                    <?php if ($lastPayment && (float)$lastPayment['balance'] <= 0): ?>
                        <div class="alert alert-success">
                            <i class='bx bx-check-circle me-2'></i> This booking is fully paid.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="col-md-7">
                <div class="card border-0 shadow-sm p-4">
                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success mb-4">
                            <i class='bx bx-check-circle me-2'></i> 
                            <?php if ($lastPayment && (float)$lastPayment['balance'] <= 0): ?>
                                Payment completed! The booking has been finalized.
                            <?php else: ?>
                                Partial payment processed successfully!
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($lastPayment && (float)$lastPayment['balance'] <= 0): ?>
                        <div class="text-center py-5">
                            <i class='bx bxs-badge-check text-success' style="font-size: 5rem;"></i>
                            <h3 class="mt-3">Fully Paid</h3>
                            <p class="text-secondary">This transaction is complete and the room has been released.</p>
                            <div class="d-grid gap-2 mt-4">
                                <a href="/staff/checkout" class="btn btn-primary btn-lg">Return to Check-Out</a>
                                <a href="/staff/bookings" class="btn btn-outline-secondary">View All Bookings</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <h4 class="mb-4">Receive Payment</h4>
                        <form action="/staff/payment/process" method="POST">
                            <input type="hidden" name="payid" value="<?= $booking['bookID'] ?>">
                            <div class="mb-3">
                                <label class="form-label">Amount to Pay (RM)</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text">RM</span>
                                    <input type="number" step="0.01" class="form-control" name="amountpay" required autofocus>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Payment Method</label>
                                <select class="form-select form-select-lg" name="paymethod" required>
                                    <option value="" disabled selected>Select method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="E-Wallet">E-Wallet</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Complete Transaction</button>
                                <a href="/staff/checkout" class="btn btn-outline-info">Back to Check-Out</a>
                                <a href="/staff/checkin" class="btn btn-outline-info">Back to Check-In</a>
                                <a href="/staff/bookings" class="btn btn-outline-secondary">Back to Bookings</a>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
