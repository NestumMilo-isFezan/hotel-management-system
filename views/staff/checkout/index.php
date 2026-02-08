<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Check-Out - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
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
        <h2 class="fw-bold mb-4" style="font-family: 'Poppins';">Manage Check-Out</h2>

        <nav class="mb-4">
            <div class="nav nav-tabs" id="checkoutTab" role="tablist">
                <button class="nav-link active" id="to-checkout-tab" data-bs-toggle="tab" data-bs-target="#to-checkout" type="button">To Check Out</button>
                <button class="nav-link" id="checked-out-tab" data-bs-toggle="tab" data-bs-target="#checked-out" type="button">Checked Out</button>
            </div>
        </nav>

        <div class="tab-content" id="checkoutTabContent">
            <!-- To Check Out -->
            <div class="tab-pane fade show active" id="to-checkout" role="tabpanel">
                <div class="card border border-secondary border-opacity-25 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Guest Name</th>
                                    <th>Room No.</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($toCheckOut)): ?>
                                    <?php foreach ($toCheckOut as $index => $b): ?>
                                        <tr>
                                            <td class="ps-4"><?= $index + 1 ?></td>
                                            <td class="fw-bold"><?= \App\Core\Security::escape($b['firstName'] . ' ' . $b['lastName']) ?></td>
                                            <td><?= \App\Core\Security::escape($b['roomNo']) ?></td>
                                            <td><?= date('d M Y', strtotime($b['check_in'])) ?></td>
                                            <td><?= date('d M Y', strtotime($b['check_out'])) ?></td>
                                            <td class="text-end pe-4">
                                                <button class="btn btn-sm btn-warning checkout-btn" data-id="<?= $b['bookID'] ?>">Check-Out</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="6" class="text-center py-4">No guests ready for check-out.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Checked Out -->
            <div class="tab-pane fade" id="checked-out" role="tabpanel">
                <div class="card border border-secondary border-opacity-25 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Guest Name</th>
                                    <th>Room No.</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                    <th class="text-end pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($checkedOut)): ?>
                                    <?php foreach ($checkedOut as $index => $b): ?>
                                        <tr>
                                            <td class="ps-4"><?= $index + 1 ?></td>
                                            <td><?= \App\Core\Security::escape($b['firstName'] . ' ' . $b['lastName']) ?></td>
                                            <td><?= \App\Core\Security::escape($b['roomNo']) ?></td>
                                            <td><?= date('d M Y', strtotime($b['check_in'])) ?></td>
                                            <td><?= date('d M Y', strtotime($b['check_out'])) ?></td>
                                            <td class="text-end pe-4"><span class="badge bg-danger">Checked Out</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="6" class="text-center py-4">No check-out history found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.checkout-btn').click(function() {
                const id = $(this).data('id');
                $.ajax({
                    url: '/staff/checkout/process',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if (response === 'ok') {
                            window.location.href = '/staff/payment?bookID=' + id;
                        } else {
                            alert('Error processing check-out');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
