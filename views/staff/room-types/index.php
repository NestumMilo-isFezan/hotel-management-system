<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Room Types - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold" style="font-family: 'Poppins';">Manage Room Types</h2>
                <p class="text-secondary">Define categories for rooms in <?= \App\Core\Security::escape($hotel['hotelname'] ?? '') ?></p>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#typeModal">
                <i class='bx bx-plus me-1'></i> Add Room Type
            </button>
        </div>

        <div class="card border border-secondary border-opacity-25 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Type Name</th>
                            <th>Description</th>
                            <th>Price (RM)</th>
                            <th>Capacity</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($roomTypes)): ?>
                            <?php foreach ($roomTypes as $index => $t): ?>
                                <tr>
                                    <td class="ps-4"><?= $index + 1 ?></td>
                                    <td class="fw-bold"><?= \App\Core\Security::escape($t['name']) ?></td>
                                    <td><?= \App\Core\Security::escape($t['description']) ?></td>
                                    <td><?= number_format((float)$t['price'], 2) ?></td>
                                    <td><?= (int)$t['capacity'] ?> people</td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-outline-danger delete-type" data-id="<?= $t['typeID'] ?>"><i class='bx bx-trash'></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center py-4">No room types defined yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Room Type Modal -->
    <div class="modal fade" id="typeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="addTypeForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add Room Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Type Name</label>
                        <input type="text" class="form-control" name="roomtype" placeholder="e.g. Deluxe Suite" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price (RM)</label>
                            <input type="number" step="0.01" class="form-control" name="price" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Capacity (People)</label>
                            <input type="number" class="form-control" name="capacity" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Type</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addTypeForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/staff/room-types/add',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === 'ok') {
                            location.reload();
                        } else {
                            alert('Error adding room type');
                        }
                    }
                });
            });

            $('.delete-type').click(function() {
                if (confirm('Delete this room type? This may affect existing rooms.')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: '/staff/room-types/delete',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            if (response === 'ok') {
                                location.reload();
                            } else {
                                alert('Error deleting room type');
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
