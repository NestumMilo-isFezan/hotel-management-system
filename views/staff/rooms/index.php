<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Rooms - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
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
                <h2 class="fw-bold" style="font-family: 'Poppins';">Manage Hotel Rooms</h2>
                <p class="text-secondary">View and manage all rooms in <?= \App\Core\Security::escape($hotel['hotelname'] ?? '') ?></p>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roomModal">
                <i class='bx bx-plus me-1'></i> Add Hotel Room
            </button>
        </div>

        <div class="card border border-secondary border-opacity-25 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Room No.</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rooms)): ?>
                            <?php foreach ($rooms as $index => $room): ?>
                                <tr>
                                    <td class="ps-4"><?= $index + 1 ?></td>
                                    <td class="fw-bold"><?= \App\Core\Security::escape($room['roomNo']) ?></td>
                                    <td><?= \App\Core\Security::escape($room['typeName']) ?></td>
                                    <td>
                                        <?php if ($room['roomstatus'] === 'available'): ?>
                                            <span class="badge bg-success-subtle text-success">Available</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-subtle text-danger">Unavailable</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-outline-primary me-1"><i class='bx bx-edit-alt'></i></button>
                                        <button class="btn btn-sm btn-outline-danger delete-room" data-id="<?= $room['roomID'] ?>"><i class='bx bx-trash'></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">No rooms found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Room Modal -->
    <div class="modal fade" id="roomModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="addRoomForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add Hotel Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="roomNo" class="form-label">Room Number</label>
                        <input type="text" class="form-control" id="roomNo" name="roomNo" required>
                    </div>
                    <div class="mb-3">
                        <label for="roomtype" class="form-label">Room Type</label>
                        <select class="form-select" id="roomtype" name="roomtype" required>
                            <option value="" selected disabled>Select room type</option>
                            <?php foreach ($roomTypes as $type): ?>
                                <option value="<?= $type['typeID'] ?>"><?= \App\Core\Security::escape($type['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="roomstatus" class="form-label">Status</label>
                        <select class="form-select" id="roomstatus" name="roomstatus" required>
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Room</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addRoomForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/staff/rooms/add',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === 'ok') {
                            location.reload();
                        } else {
                            alert('Error adding room');
                        }
                    }
                });
            });

            $('.delete-room').click(function() {
                if (confirm('Are you sure you want to delete this room?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: '/staff/rooms/delete',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            if (response === 'ok') {
                                location.reload();
                            } else {
                                alert('Error deleting room');
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
