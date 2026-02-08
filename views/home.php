<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= \App\Core\Security::escape($title) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="/style/style.css" rel="stylesheet">
</head>
<body data-bs-theme="dark">
    <?php include __DIR__ . '/partials/navbar.php'; ?>

    <!-- Hero Section -->
    <section id="home" class="text-center vh-100" style="background-image: url('<?= \App\Core\Security::escape($hotel['hotelimg'] ?? '') ?>'); background-size:cover; background-repeat: no-repeat;">
        <div class="px-2 pt-2 w-100 y-100 h-100 d-flex" style="background: rgba(32,32,39,0.3); backdrop-filter: blur(5px);">
            <div class="px-2 pt-2 pt-sm-3 m-auto" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);">
                <div>
                    <h1 class="display-4 mx-3" style="font-family: 'Staatliches';">Welcome to the<br><span class="display-1" style="color:#22092C;"><?= \App\Core\Security::escape($hotel['hotelname'] ?? '') ?></span></h1>
                    <p class="fs-5 mt-2 mx-auto w-75" style="font-family: 'Poppins';"><?= \App\Core\Security::escape($hotel['info'] ?? '') ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="news" class="h-100 bg-dark" style="min-height: 80vh;">
        <div class="album py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h1 class="display-2 fw-bold" style="font-family: 'Staatliches'; color:#4CB9E7">News</h1>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-3">
                    <?php if (!empty($news)): ?>
                        <?php foreach ($news as $item): ?>
                            <div class="col">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><?= \App\Core\Security::escape($item['newstitle']) ?></h5>
                                        <p class="card-text"><?= \App\Core\Security::escape($item['description']) ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-body-secondary"><?= \App\Core\Security::escape($item['registerdate']) ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">No news available. 🤷‍♂️📰</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/partials/footer.php'; ?>

    <?php include __DIR__ . '/partials/auth_modals.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/authentication.js"></script>
</body>
</html>