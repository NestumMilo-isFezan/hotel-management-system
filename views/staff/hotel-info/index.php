<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Hotel Info - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
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
        <h2 class="fw-bold mb-4" style="font-family: 'Poppins';">Manage Hotel Information & News</h2>

        <nav class="mb-4">
            <div class="nav nav-tabs" id="hotelTab" role="tablist">
                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button">Hotel Info</button>
                <button class="nav-link" id="news-tab" data-bs-toggle="tab" data-bs-target="#news" type="button">News Management</button>
            </div>
        </nav>

        <div class="tab-content" id="hotelTabContent">
            <!-- Hotel Info -->
            <div class="tab-pane fade show active" id="info" role="tabpanel">
                <div class="card border-0 shadow-sm p-4">
                    <form id="infoForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Hotel Name</label>
                                <input type="text" class="form-control" name="hotelname" value="<?= \App\Core\Security::escape($hotel['hotelname']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= \App\Core\Security::escape($hotel['email']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="text" class="form-control" name="contact" value="<?= \App\Core\Security::escape($hotel['contact']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="<?= \App\Core\Security::escape($hotel['address']) ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Postcode</label>
                                <input type="text" class="form-control" name="postcode" value="<?= \App\Core\Security::escape($hotel['postcode']) ?>" required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" name="city" value="<?= \App\Core\Security::escape($hotel['city']) ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" name="state" value="<?= \App\Core\Security::escape($hotel['state']) ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Hero Info Text</label>
                                <textarea class="form-control" name="info" rows="2" required><?= \App\Core\Security::escape($hotel['info']) ?></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">About Description</label>
                                <textarea class="form-control" name="about" rows="4" required><?= \App\Core\Security::escape($hotel['about']) ?></textarea>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- News -->
            <div class="tab-pane fade" id="news" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Latest News</h4>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newsModal">Add News</button>
                </div>
                <div class="card border border-secondary border-opacity-25 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($news)): ?>
                                    <?php foreach ($news as $index => $n): ?>
                                        <tr>
                                            <td class="ps-4"><?= $index + 1 ?></td>
                                            <td class="fw-bold"><?= \App\Core\Security::escape($n['newstitle']) ?></td>
                                            <td><?= \App\Core\Security::escape(substr($n['description'], 0, 100)) ?>...</td>
                                            <td><?= date('d M Y', strtotime($n['registerdate'])) ?></td>
                                            <td class="text-end pe-4">
                                                <button class="btn btn-sm btn-outline-danger delete-news" data-id="<?= $n['newsID'] ?>"><i class='bx bx-trash'></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-4">No news articles found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add News Modal -->
    <div class="modal fade" id="newsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="addNewsForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add Hotel News</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">News Title</label>
                        <input type="text" class="form-control" name="newstitle" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Publish News</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#infoForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/staff/hotel-info/update',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === 'ok') {
                            alert('Hotel info updated successfully!');
                            location.reload();
                        } else {
                            alert('Error updating hotel info');
                        }
                    }
                });
            });

            $('#addNewsForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/staff/news/add',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === 'ok') {
                            location.reload();
                        } else {
                            alert('Error publishing news');
                        }
                    }
                });
            });

            $('.delete-news').click(function() {
                if (confirm('Are you sure you want to delete this news article?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: '/staff/news/delete',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            if (response === 'ok') {
                                location.reload();
                            } else {
                                alert('Error deleting news');
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
