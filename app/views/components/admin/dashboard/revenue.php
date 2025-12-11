<style>
    /* --- CẤU HÌNH CHUNG --- */
    :root {
        --bg-dark: #1e1e2d;
        --text-light: #fff;
        --text-gray: #aaa;
        --border-color: #3a3a50;
    }

    /* Container chính */
    .dashboard-container {
        padding: 20px;
        max-width: 100%;
    }

    /* --- BỘ LỌC (FILTER BOX) --- */
    .filter-box {
        background: var(--bg-dark);
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    .filter-form {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        /* Quan trọng: Cho phép rớt dòng trên mobile */
    }

    .filter-label {
        color: var(--text-light);
        margin: 0;
    }

    .filter-select {
        background-color: #151521;
        color: var(--text-light);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 8px 35px 8px 15px;
        outline: none;
        cursor: pointer;
        min-width: 150px;
    }

    .btn-view {
        background: #3699ff;
        color: #fff;
        border: none;
        padding: 8px 25px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        white-space: nowrap;
        /* Không cho chữ bị ngắt dòng */
    }

    /* --- CÁC THẺ THỐNG KÊ (CARDS) --- */
    .stats-cards {
        display: grid;
        /* KỸ THUẬT RESPONSIVE TỰ ĐỘNG:
           Tự động chia cột. Nếu màn hình nhỏ hơn 280px thì rớt xuống dòng dưới.
           Desktop: 3 cột | Tablet: 2 cột | Mobile: 1 cột 
        */
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--bg-dark);
        padding: 25px;
        border-radius: 12px;
        /* Hiệu ứng hover nhẹ */
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-title {
        color: var(--text-gray);
        font-size: 14px;
        margin: 0 0 10px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-light);
    }

    /* Màu viền trái cho từng card */
    .card-revenue {
        border-left: 5px solid #2ecc71;
    }

    .card-sold {
        border-left: 5px solid #3699ff;
    }

    .card-best {
        border-left: 5px solid #f1c40f;
    }

    /* --- BIỂU ĐỒ (CHART) --- */
    .chart-wrapper {
        background: var(--bg-dark);
        padding: 20px;
        border-radius: 12px;
        width: 100%;
        position: relative;
        /* Chiều cao mặc định trên PC */
        height: 500px;
    }

    /* --- MEDIA QUERY CHO MOBILE --- */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 10px;
            /* Giảm padding trên mobile */
        }

        .filter-form {
            flex-direction: column;
            /* Xếp dọc bộ lọc */
            align-items: stretch;
            /* Kéo giãn full chiều ngang */
        }

        .filter-select,
        .btn-view {
            width: 100%;
            /* Nút và select to ra cho dễ bấm */
        }

        .chart-wrapper {
            height: 350px;
            /* Giảm chiều cao biểu đồ trên mobile cho đỡ chiếm chỗ */
            padding: 10px;
        }

        .stat-value {
            font-size: 20px;
            /* Giảm size chữ chút */
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="content-header">
    <h1 style="color: #fff; padding: 20px 20px 0;">Thống kê doanh thu năm <?php echo $year; ?></h1>
</div>

<div class="dashboard-container">

    <div class="filter-box">
        <form action="" method="GET" class="filter-form">
            <label class="filter-label">Chọn năm:</label>
            <select name="year" class="filter-select">
                <?php
                $currentYear = date('Y');
                for ($i = $currentYear; $i >= $currentYear - 4; $i--) {
                    $selected = ($i == $year) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
            </select>
            <button type="submit" class="btn-view">Xem báo cáo</button>
        </form>
    </div>

    <div class="stats-cards">

        <div class="stat-card card-revenue">
            <h4 class="stat-title">Tổng doanh thu</h4>
            <div class="stat-value">
                <?php echo number_format($totalRevenue, 0, ',', '.'); ?>₫
            </div>
        </div>

        <div class="stat-card card-sold">
            <h4 class="stat-title">Số lượng đã bán</h4>
            <div class="stat-value">
                <?php echo number_format($totalProducts); ?>
                <span style="font-size: 14px; font-weight: 400; color: #888;">sản phẩm</span>
            </div>
        </div>

        <div class="stat-card card-best">
            <h4 class="stat-title">Bán chạy nhất</h4>
            <div class="stat-value" style="font-size: 18px;"> <?php
                                                                if ($bestSeller) {
                                                                    echo htmlspecialchars($bestSeller['name']);
                                                                    echo "<div style='font-size: 13px; color: #888; margin-top: 5px; font-weight: 400;'>Đã bán: " . $bestSeller['total_sold'] . " cái</div>";
                                                                } else {
                                                                    echo "Chưa có dữ liệu";
                                                                }
                                                                ?>
            </div>
        </div>
    </div>

    <div class="chart-wrapper">
        <canvas id="revenueChart"></canvas>
    </div>

</div>

<script>
    const revenueData = <?php echo $chartData; ?>;
    const ctx = document.getElementById('revenueChart').getContext('2d');

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'], // Viết tắt tháng cho gọn trên mobile
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: revenueData,
                backgroundColor: 'rgba(54, 153, 255, 0.6)',
                borderColor: 'rgba(54, 153, 255, 1)',
                borderWidth: 1,
                borderRadius: 4,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // QUAN TRỌNG: Để chart co giãn theo height của div cha
            plugins: {
                legend: {
                    labels: {
                        color: '#fff'
                    }
                },
                title: {
                    display: true,
                    text: 'BIỂU ĐỒ DOANH THU',
                    color: '#fff',
                    font: {
                        size: 16
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#444'
                    },
                    ticks: {
                        color: '#bbb'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#bbb'
                    }
                }
            }
        }
    });
</script>