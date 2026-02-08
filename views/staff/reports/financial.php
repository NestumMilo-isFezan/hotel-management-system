<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Financial Report - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #1a1a1a; }
        .card { border-radius: 15px; }
        .rounded-4 { border-radius: 1rem !important; }
    </style>
</head>
<body class="vh-100" data-bs-theme="dark">
    <button class="btn m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
        <i class='bx bx-menu fs-3'></i>
    </button>

    <?php include __DIR__ . '/../../partials/staff_sidebar.php'; ?>

    <div class="container-fluid px-4 pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0">Financial Analytics</h2>
                <p class="text-secondary">Revenue and transaction overview</p>
            </div>
            <button class="btn btn-outline-light" onclick="window.print()">
                <i class='bx bx-printer me-1'></i> Print Report
            </button>
        </div>

        <!-- Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card bg-success bg-opacity-10 border border-success border-opacity-25 p-4">
                    <small class="text-success text-uppercase fw-bold">Total Revenue</small>
                    <h2 class="display-6 fw-bold mb-0">RM <?= number_format($summary['total_revenue'], 2) ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary bg-opacity-10 border border-primary border-opacity-25 p-4">
                    <small class="text-primary text-uppercase fw-bold">Total Transactions</small>
                    <h2 class="display-6 fw-bold mb-0"><?= $summary['total_transactions'] ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info bg-opacity-10 border border-info border-opacity-25 p-4">
                    <small class="text-info text-uppercase fw-bold">Avg. Transaction</small>
                    <h2 class="display-6 fw-bold mb-0">RM <?= number_format($summary['avg_transaction'], 2) ?></h2>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <!-- Revenue Trend -->
            <div class="col-lg-8">
                <div class="card bg-dark border border-secondary border-opacity-25 p-4 h-100">
                    <h5 class="fw-bold mb-4">Revenue Trend (Last 30 Days)</h5>
                    <canvas id="revenueChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
            <!-- Payment Methods -->
            <div class="col-lg-4">
                <div class="card bg-dark border border-secondary border-opacity-25 p-4 h-100">
                    <h5 class="fw-bold mb-4">By Payment Method</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless align-middle mb-0">
                            <thead>
                                <tr class="text-secondary small text-uppercase">
                                    <th>Method</th>
                                    <th class="text-end">Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($byMethod as $m): ?>
                                    <tr>
                                        <td class="py-2">
                                            <i class='bx bxs-circle me-2' style="color: <?= $m['method'] === 'Cash' ? '#2ecc71' : ($m['method'] === 'Credit Card' ? '#3498db' : '#f1c40f') ?>;"></i>
                                            <?= \App\Core\Security::escape($m['method']) ?>
                                        </td>
                                        <td class="text-end fw-bold">RM <?= number_format((float)$m['total'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction List -->
        <h5 class="fw-bold mb-3">Recent Transactions</h5>
        <div class="card border border-secondary border-opacity-25 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Guest</th>
                            <th>Method</th>
                            <th class="text-end">Amount</th>
                            <th class="text-end pe-4">Balance After</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transactions)): ?>
                            <?php foreach ($transactions as $t): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold"><?= date('d M Y', strtotime($t['paymentdate'])) ?></div>
                                        <small class="text-secondary"><?= $t['paymenttime'] ?></small>
                                    </td>
                                    <td><?= \App\Core\Security::escape($t['firstName'] . ' ' . $t['lastName']) ?></td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary border"><?= $t['method'] ?></span>
                                    </td>
                                    <td class="text-end fw-bold">RM <?= number_format((float)$t['amountpay'], 2) ?></td>
                                    <td class="text-end pe-4 <?= (float)$t['balance'] <= 0 ? 'text-success' : 'text-warning' ?>">
                                        RM <?= number_format((float)$t['balance'], 2) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-4">No transactions found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const dailyData = <?= json_encode($daily) ?>;
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dailyData.map(d => d.paymentdate),
                datasets: [{
                    label: 'Daily Revenue (RM)',
                    data: dailyData.map(d => d.total),
                    borderColor: '#2ecc71',
                    backgroundColor: 'rgba(46, 204, 113, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#2ecc71'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                        ticks: { color: '#888' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#888' }
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
