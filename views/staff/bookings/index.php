<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Bookings - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
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
        <h2 class="fw-bold mb-4" style="font-family: 'Poppins';">Manage Guest Bookings</h2>

        <nav class="mb-4">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-pending-tab" data-bs-toggle="tab" data-bs-target="#nav-pending" type="button" role="tab">Requested</button>
                <button class="nav-link" id="nav-confirmed-tab" data-bs-toggle="tab" data-bs-target="#nav-confirmed" type="button" role="tab">Confirmed</button>
                <button class="nav-link" id="nav-cancelled-tab" data-bs-toggle="tab" data-bs-target="#nav-cancelled" type="button" role="tab">Cancelled</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <!-- Pending -->
            <div class="tab-pane fade show active" id="nav-pending" role="tabpanel">
                <div class="card border border-secondary border-opacity-25 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Guest</th>
                                    <th>Room</th>
                                    <th>Service</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($pending)): ?>
                                    <?php foreach ($pending as $index => $b): ?>
                                        <tr>
                                            <td class="ps-4"><?= $index + 1 ?></td>
                                            <td><?= \App\Core\Security::escape($b['firstName'] . ' ' . $b['lastName']) ?></td>
                                            <td><?= \App\Core\Security::escape($b['roomNo']) ?></td>
                                            <td><?= \App\Core\Security::escape($b['serviceName'] ?? 'None') ?></td>
                                            <td><?= date('d M Y', strtotime($b['check_in'])) ?></td>
                                            <td><?= date('d M Y', strtotime($b['check_out'])) ?></td>
                                            <td class="text-end pe-4">
                                                <button class="btn btn-sm btn-success confirm-booking" data-id="<?= $b['bookID'] ?>">Confirm</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-center py-4">No pending requests.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Confirmed -->
            <div class="tab-pane fade" id="nav-confirmed" role="tabpanel">
                <div class="card border border-secondary border-opacity-25 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Guest</th>
                                    <th>Room</th>
                                    <th>Service</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                    <th class="text-end pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($confirmed)): ?>
                                    <?php foreach ($confirmed as $index => $b): ?>
                                        <tr>
                                            <td class="ps-4"><?= $index + 1 ?></td>
                                            <td><?= \App\Core\Security::escape($b['firstName'] . ' ' . $b['lastName']) ?></td>
                                            <td><?= \App\Core\Security::escape($b['roomNo']) ?></td>
                                            <td><?= \App\Core\Security::escape($b['serviceName'] ?? 'None') ?></td>
                                            <td><?= date('d M Y', strtotime($b['check_in'])) ?></td>
                                            <td><?= date('d M Y', strtotime($b['check_out'])) ?></td>
                                            <td class="text-end pe-4"><span class="badge bg-success">Confirmed</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-center py-4">No confirmed bookings.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Cancelled -->
            <div class="tab-pane fade" id="nav-cancelled" role="tabpanel">
                <div class="card border border-secondary border-opacity-25 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Guest</th>
                                    <th>Room</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($cancelled)): ?>
                                    <?php foreach ($cancelled as $index => $b): ?>
                                        <tr>
                                            <td class="ps-4"><?= $index + 1 ?></td>
                                            <td><?= \App\Core\Security::escape($b['firstName'] . ' ' . $b['lastName']) ?></td>
                                            <td><?= \App\Core\Security::escape($b['roomNo']) ?></td>
                                            <td><span class="badge bg-danger">Cancelled</span></td>
                                            <td class="text-end pe-4">
                                                <button class="btn btn-sm btn-outline-danger delete-booking" data-id="<?= $b['bookID'] ?>"><i class='bx bx-trash'></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-4">No cancelled bookings.</td></tr>
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
            $('.confirm-booking').click(function() {
                const id = $(this).data('id');
                $.ajax({
                    url: '/staff/bookings/confirm',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if (response === 'ok') {
                            location.reload();
                        } else {
                            alert('Error confirming booking');
                        }
                    }
                });
            });

            $('.delete-booking').click(function() {
                if (confirm('Delete this record?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: '/staff/bookings/delete',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            if (response === 'ok') {
                                location.reload();
                            } else {
                                alert('Error deleting booking');
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
