<?php
include 'connection.php';

// menghitung jumlah 'admin'
$sqlCount_admin = "SELECT COUNT(*) AS total_rows FROM admin";
$result_admin = $conn->query($sqlCount_admin);

if ($result_admin) {
    $row = $result_admin->fetch_assoc();
    $totalCount_admin = $row['total_rows'];
} else {
    $totalCount_admin = 0; // Jika query tidak berhasil, atur total menjadi 0 atau sesuaikan dengan kebutuhan
}

// menghitung jumlah 'lukisan'
$sqlCount_user = "SELECT COUNT(*) AS total_rows FROM data_user";
$result_user = $conn->query($sqlCount_user);

if ($result_user) {
    $row = $result_user->fetch_assoc();
    $totalCount_user = $row['total_rows'];
} else {
    $totalCount_user = 0; // Jika query tidak berhasil, atur total menjadi 0 atau sesuaikan dengan kebutuhan
}

// menghitung jumlah 'lukisan'
$sqlCount_lukisan = "SELECT COUNT(*) AS total_rows FROM lukisan";
$result_lukisan = $conn->query($sqlCount_lukisan);

if ($result_lukisan) {
    $row = $result_lukisan->fetch_assoc();
    $totalCount_lukisan = $row['total_rows'];
} else {
    $totalCount_lukisan = 0; // Jika query tidak berhasil, atur total menjadi 0 atau sesuaikan dengan kebutuhan
}

// Ambil jumlah lukisan dengan status 'success'
$sqlSuccess = "SELECT COUNT(*) as count FROM lukisan WHERE status = 'success'";
$resultSuccess = $conn->query($sqlSuccess);
$rowSuccess = $resultSuccess->fetch_assoc();
$successCount = $rowSuccess['count'];

// Ambil jumlah lukisan dengan status 'failed'
$sqlFailed = "SELECT COUNT(*) as count FROM lukisan WHERE status = 'failed'";
$resultFailed = $conn->query($sqlFailed);
$rowFailed = $resultFailed->fetch_assoc();
$failedCount = $rowFailed['count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Digital Art Gallery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style_admin.css">
</head>

<body>
    <div class="navbar-top"></div>
    <div class="aside_navbar">
        <aside id="sidebar">
            <div class="sidebar_logo">
                <img src="img/Logo.png" alt="Logo">
            </div>
            <div class="sidebar-menu">
                <ul class="sidebar-item">
                    <a href="Dashboard_admin.html">
                        <i class="fa-solid fa-house"></i>
                        <span>Home</span>
                    </a>
                </ul>
                <ul class="sidebar-item">
                    <a href="Daftar_Pengguna_Admin.html">
                        <i class="fa-solid fa-users"></i>
                        <span>User Management</span>
                    </a>
                </ul>

                <ul class="sidebar-item">
                    <a href="Persetujuan_Postingan_Admin.php">
                        <i class="fa-solid fa-paint-brush"></i>
                        <span>Post Management</span>
                    </a>
                </ul>

                <ul class="sidebar-item">
                    <a href="report._admin.html">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Report</span>
                    </a>
                </ul>

            </div>
            <ul class="user">
                <a href="profil_admin.html">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
            </ul>
        </aside>
    </div>
    <div class="container">
        <div class="card-container">
            <div class="card-row">
                <div class="card" id="admin">
                    <div class="count"><span id="admin_jumlah"><?php echo $totalCount_admin; ?></span></div>
                    <div class="label">Admin</div>
                </div>
                <div class="card" id="user">
                    <div class="count"><span id="user_jumlah"><?php echo $totalCount_user; ?></span></div>
                    <div class="label">User</div>
                </div>
                <div class="card" id="art">
                    <div class="count"><span id="art_jumlah"><?php echo $totalCount_lukisan; ?></span></div>
                    <div class="label">Art</div>
                </div>
            </div>
            <div class="card-row">
                <div class="card" id="approval">
                    <div class="count"><span id="approval_jumlah"><?php echo $successCount; ?></span></div>
                    <div class="label">Approval</div>
                </div>
                <div class="card" id="deletion">
                    <div class="count"><span id="reject_jumlah"><?php echo $failedCount; ?></span></div>
                    <div class="label">Reject</div>
                </div>
            </div>
            
            <div class="chart">
                <div class="chart-label"></div>
                <canvas id="growthChart" width="50" height="15"></canvas>
            </div>
        </div>
    </div>
            
    <footer>
        <div class="footer-content">
            <h3>A Digital Art Gallery</h3>
            <p>Visit us</p>
            <ul class="socials">
                <li><a href="https://www.instagram.com/adheputryb_01"><i class="fab fa-instagram"></i></a></li>
                <li><a href="https://www.facebook.com/Alif Saputra"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://www.twitter.com/ibnudzaky"><i class="fab fa-twitter"></i></a></li>
                <li><a href="mailto:stevelinfriska29@gmail.com"><i class="far fa-envelope"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2024 A Digital Art Gallery. design by<span>kelompok 2dua</span></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script>
    // Contoh data pertumbuhan pengguna dan postingan (sesuaikan dengan data Anda)
    const growthData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        pengguna: [10, 20, 30, 40, 50, 60],
        postingan: [5, 10, 15, 20, 25, 30]
    };

    // Inisialisasi grafik
    const ctx = document.getElementById('growthChart').getContext('2d');
    const growthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: growthData.labels,
            datasets: [{
                label: 'Pengguna',
                data: growthData.pengguna,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            },
            {
                label: 'Postingan',
                data: growthData.postingan,
                borderColor: 'rgb(255, 99, 132)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top' // Mengatur posisi label di atas grafik
                }
            }
        }
    });
</script>

</body>
</html>
