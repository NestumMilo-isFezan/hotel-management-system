<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Profile - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="/style/style.css" rel="stylesheet">
</head>
<body data-bs-theme="dark">
    <?php include __DIR__ . '/../../partials/navbar.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="card-header bg-primary py-3">
                        <h4 class="mb-0 text-white"><i class='bx bx-user-circle me-2'></i>Personal Profile</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="position-relative">
                                <img src="/img/user_icon.png" class="rounded-circle border border-3 border-primary p-1" style="width: 80px; height: 80px;" alt="User">
                            </div>
                            <div class="ms-3">
                                <h3 class="mb-0 fw-bold"><?= \App\Core\Security::escape($guest['username']) ?></h3>
                                <p class="text-secondary mb-0"><?= \App\Core\Security::escape($guest['email']) ?></p>
                            </div>
                        </div>

                        <hr class="my-4 opacity-25">

                        <form id="profileForm" class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-uppercase fw-bold text-secondary">First Name</label>
                                <input type="text" class="form-control" name="fname" value="<?= \App\Core\Security::escape($guest['firstName']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-uppercase fw-bold text-secondary">Last Name</label>
                                <input type="text" class="form-control" name="lname" value="<?= \App\Core\Security::escape($guest['lastName']) ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-uppercase fw-bold text-secondary">Address</label>
                                <input type="text" class="form-control" name="address" value="<?= \App\Core\Security::escape($guest['address']) ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-uppercase fw-bold text-secondary">Postcode</label>
                                <input type="text" class="form-control" name="postcode" value="<?= \App\Core\Security::escape($guest['postcode']) ?>" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label small text-uppercase fw-bold text-secondary">City</label>
                                <input type="text" class="form-control" name="city" value="<?= \App\Core\Security::escape($guest['city']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-uppercase fw-bold text-secondary">State</label>
                                <input type="text" class="form-control" name="state" value="<?= \App\Core\Security::escape($guest['state']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-uppercase fw-bold text-secondary">Country</label>
                                <input type="text" class="form-control" name="country" value="<?= \App\Core\Security::escape($guest['country']) ?>" required>
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-primary px-5 py-2">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../../partials/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#profileForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/profile/update',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === 'ok') {
                            alert('Profile updated successfully!');
                        } else {
                            alert('Error updating profile');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
