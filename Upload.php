<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: Halaman_login.html');
}

include 'connection.php';

$username = $_SESSION['username'];

// Mengambil jumlah data dengan status "pending"
$sqlPendingCount = "SELECT COUNT(*) AS pending_count FROM lukisan WHERE username = ? AND status = 'pending'";
$stmtPendingCount = $conn->prepare($sqlPendingCount);
$stmtPendingCount->bind_param("s", $username);
$stmtPendingCount->execute();
$resultPendingCount = $stmtPendingCount->get_result();
$rowPendingCount = $resultPendingCount->fetch_assoc();
$pendingCount = $rowPendingCount['pending_count'];

// Mengambil jumlah data dengan status "failed"
$sqlFailedCount = "SELECT COUNT(*) AS failed_count FROM lukisan WHERE username = ? AND status = 'failed'";
$stmtFailedCount = $conn->prepare($sqlFailedCount);
$stmtFailedCount->bind_param("s", $username);
$stmtFailedCount->execute();
$resultFailedCount = $stmtFailedCount->get_result();
$rowFailedCount = $resultFailedCount->fetch_assoc();
$failedCount = $rowFailedCount['failed_count'];

// Mengambil jumlah data dengan status "success"
$sqlSuccessCount = "SELECT COUNT(*) AS success_count FROM lukisan WHERE username = ? AND status = 'success'";
$stmtSuccessCount = $conn->prepare($sqlSuccessCount);
$stmtSuccessCount->bind_param("s", $username);
$stmtSuccessCount->execute();
$resultSuccessCount = $stmtSuccessCount->get_result();
$rowSuccessCount = $resultSuccessCount->fetch_assoc();
$successCount = $rowSuccessCount['success_count'];
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
    <link rel="stylesheet" href="style_user.css">
</head>

<body>
    <div class="navbar-top"></div>
    <div class="aside_navbar">
        <aside id="sidebar">
            <div class="sidebar_logo">
                <img src="img/Logo.png">
            </div>
            <div class="sidebar-menu">
                <ul class="sidebar-item">
                    <a href="Home.php">
                        <i class="fa-solid fa-house"></i>
                        <span>Home</span>
                    </a>
                </ul>
                <ul class="sidebar-item">
                    <a href="Search.php">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Search</span>
                    </a>
                </ul>
                <?php if (isset($_SESSION['username'])): ?>
                <ul class="sidebar-item">
                    <a href="Upload.php">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <span>Upload</span>
                    </a>
                </ul>
                <ul class="sidebar-item">
                    <a href="Follow.php">
                        <i class="fa-solid fa-users-line"></i>
                        <span>Follow</span>
                    </a>
                </ul>
                <ul class="sidebar-item">
                    <a href="Notifikasi.php">
                        <i class="fa-solid fa-bell"></i>
                        <span>Notification</span>
                    </a>
                </ul>
                <?php endif; ?>
                <?php if (!isset($_SESSION['username'])): ?>
                <ul class="sidebar-item">
                    <a href="Halaman_login.html">
                    <i class="fa-solid fa-right-to-bracket"></i>
                        <span>Login</span>
                    </a>
                </ul>
                <?php endif; ?>
            </div>
            <?php if (isset($_SESSION['username'])): ?>
            <ul class="user">
                <a href="Account_User.php">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
            </ul>
            <ul class="setting">
                <a href="Logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </ul>
            <?php endif; ?>
        </aside>
    </div>
        
    <div class="main" id="main">
        <div class="menu_home">
            <a href="#" id="uploadLink">Upload(<span id="upload_jumlah"><?php echo $pendingCount; ?></span> )</a>
            <a href="#" id="failedLink">Failed(<span id="failed_jumlah"><?php echo $failedCount; ?></span> )</a>
            <a href="#" id="successLink">Success(<span id="succes_jumlah"><?php echo $successCount; ?></span> )</a>
        </div>

        <!-- Tabel untuk Upload -->
        <div id="uploadContent"> 
            <div class="container mt-5">
                <table class="table table-bordered" style="color: #fff">
                    <tbody>
                        <?php
                        // Menampilkan data "pending"
                        $sqlPending = "SELECT title_lukisan FROM lukisan WHERE username = ? AND status = 'pending'";
                        $stmtPending = $conn->prepare($sqlPending);
                        $stmtPending->bind_param("s", $username);
                        $stmtPending->execute();
                        $resultPending = $stmtPending->get_result();
                        while ($row = $resultPending->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['title_lukisan']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel untuk Failed -->
        <div id="failedContent" style="display: none;"> 
            <div class="container mt-5">
                <table class="table table-bordered" style="color: #fff">
                    <tbody>
                        <?php
                        // Menampilkan data "failed"
                        $sqlFailed = "SELECT title_lukisan FROM lukisan WHERE username = ? AND status = 'failed'";
                        $stmtFailed = $conn->prepare($sqlFailed);
                        $stmtFailed->bind_param("s", $username);
                        $stmtFailed->execute();
                        $resultFailed = $stmtFailed->get_result();
                        while ($row = $resultFailed->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['title_lukisan']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel untuk Success -->
        <div id="successContent" style="display: none;"> 
            <div class="container mt-5">
                <table class="table table-bordered" style="color: #fff">
                    <tbody>
                        <?php
                        // Menampilkan data "success"
                        $sqlSuccess = "SELECT title_lukisan FROM lukisan WHERE username = ? AND status = 'success'";
                        $stmtSuccess = $conn->prepare($sqlSuccess);
                        $stmtSuccess->bind_param("s", $username);
                        $stmtSuccess->execute();
                        $resultSuccess = $stmtSuccess->get_result();
                        while ($row = $resultSuccess->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['title_lukisan']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="new_upload" id="new_upload">
            <a href="Tambah_Upload.php"><i class="fa-solid fa-circle-plus"></i></a>
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
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="script.js"></script>

    <script>
        document.getElementById('uploadLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('uploadContent').style.display = 'block';
            document.getElementById('failedContent').style.display = 'none';
            document.getElementById('successContent').style.display = 'none';
        });

        document.getElementById('failedLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('uploadContent').style.display = 'none';
            document.getElementById('failedContent').style.display = 'block';
            document.getElementById('successContent').style.display = 'none';
        });

        document.getElementById('successLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('uploadContent').style.display = 'none';
            document.getElementById('failedContent').style.display = 'none';
            document.getElementById('successContent').style.display = 'block';
        });
    </script>
</body>
</html>
