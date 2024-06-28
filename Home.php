<?php
session_start();

include 'connection.php';

// Query untuk mengambil data gambar dengan status 'success'
$sql = "SELECT * FROM lukisan WHERE status = 'success'";
$result = $conn->query($sql);

// Query untuk mengambil data pengguna
$sql_users = "SELECT * FROM data_user";
$result_users = $conn->query($sql_users);

// Inisialisasi array untuk menyimpan data pengguna
$users = [];
if ($result_users->num_rows > 0) {
    while ($row_user = $result_users->fetch_assoc()) {
        // Simpan data pengguna ke dalam array
        $users[$row_user['username']] = $row_user; // Gunakan username sebagai kunci
    }
}

// Inisialisasi array untuk menyimpan hasil query
$images = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Simpan seluruh baris (row) ke dalam array
        $images[] = $row; // Menyimpan semua data baris dari hasil query
    }
}
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_user.css">
    <!-- <link rel="stylesheet" href="responsif.css"> -->
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
        
    <main>
        <div class="card-main">
            <div class="menu_home">
                <a href="#" id="forYouLink">For you</a>
                <a href="#" id="internasionalLink">Internasional</a>
                <a href="#" id="nasionalLink">Nasional</a>
            </div>
            
            <div id="forYouContent">
                <div class="container mt-5">
                    <h2>Popular Artists</h2>
                    <div class="row">
                        <!-- Bagian dalam loop foreach untuk "Popular Artists" -->
                        <?php foreach ($users as $user_data): ?>
                            <div class="col-md-2">
                                <div class="text-center">
                                    <?php
                                    // Ambil data pengguna berdasarkan username dari array $user_data
                                    $username = $user_data['username'];
                                    $profile_image = $user_data['profile_image'];
                                    ?>
                                    <!-- Menampilkan gambar profil pengguna -->
                                    <div class="rounded-circle bg-light p-3">
                                        <a href="Account_User_Lain.php?username=<?php echo urlencode($user_data['username']); ?>">
                                            <?php if (!empty($profile_image)) : ?>
                                                <img src="<?php echo $profile_image; ?>" alt="Profile Image">
                                            <?php else : ?>
                                                <i class="fas fa-user fa-lg text-secondary"></i>
                                            <?php endif; ?>
                                        </a>
                                    </div>

                                    <p class="mt-2"><?php echo $username; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="container mt-5">
                    <h2>Popular Arts</h2>
                    <div class="row">
                        <?php foreach ($images as $image): ?>
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <a href="artwork_detail1.php?id_lukisan=<?php echo $image['id_lukisan']; ?>">
                                    <img class="card-img-top" src="<?php echo $image['gambar']; ?>" alt="Artwork Image">
                                </a>
                                <div class="icon-container">
                                    <button type="button"><i class="fas fa-heart fa-lg"></i></button>
                                    <!-- <button type="button"><i class="fas fa-comment fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-share fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-download fa-lg"></i></button> -->
                                </div>
                                <div class="name-container">
                                    <span><?php echo $image['title_lukisan']; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="container mt-5">
                    <h2>Late Post</h2>
                    <div class="row">
                        <?php foreach ($images as $image): ?>
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <a href="artwork_detail1.php?id_lukisan=<?php echo $image['id_lukisan']; ?>">
                                    <img class="card-img-top" src="<?php echo $image['gambar']; ?>" alt="Artwork Image">
                                </a>
                                <div class="icon-container">
                                    <button type="button"><i class="fas fa-heart fa-lg"></i></button>
                                    <!-- <button type="button"><i class="fas fa-comment fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-share fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-download fa-lg"></i></button> -->
                                </div>
                                <div class="name-container">
                                    <span><?php echo $image['title_lukisan']; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <div id="internasionalContent" style="display: none;">
                <div class="container mt-5">
                    <div class="row">
                        <?php foreach ($images as $image): ?>
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <a href="artwork_detail1.php?id_lukisan=<?php echo $image['id_lukisan']; ?>">
                                    <img class="card-img-top" src="<?php echo $image['gambar']; ?>" alt="Artwork Image">
                                </a>
                                <div class="icon-container">
                                    <button type="button"><i class="fas fa-heart fa-lg"></i></button>
                                    <!-- <button type="button"><i class="fas fa-comment fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-share fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-download fa-lg"></i></button> -->
                                </div>
                                <div class="name-container">
                                    <span><?php echo $image['title_lukisan']; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <div id="nasionalContent" style="display: none;">
                <div class="container mt-5">
                    <div class="row">
                        <?php foreach ($images as $image): ?>
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <a href="artwork_detail1.php?id_lukisan=<?php echo $image['id_lukisan']; ?>">
                                    <img class="card-img-top" src="<?php echo $image['gambar']; ?>" alt="Artwork Image">
                                </a>
                                <div class="icon-container">
                                    <button type="button"><i class="fas fa-heart fa-lg"></i></button>
                                    <!-- <button type="button"><i class="fas fa-comment fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-share fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-download fa-lg"></i></button> -->
                                </div>
                                <div class="name-container">
                                    <span><?php echo $image['title_lukisan']; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
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
    </main>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
    <script>
        document.getElementById('forYouLink').addEventListener('click', function () {
            document.getElementById('forYouContent').style.display = 'block';
            document.getElementById('internasionalContent').style.display = 'none';
            document.getElementById('nasionalContent').style.display = 'none';
        });

        document.getElementById('internasionalLink').addEventListener('click', function () {
            document.getElementById('forYouContent').style.display = 'none';
            document.getElementById('internasionalContent').style.display = 'block';
            document.getElementById('nasionalContent').style.display = 'none';
        });

        document.getElementById('nasionalLink').addEventListener('click', function () {
            document.getElementById('forYouContent').style.display = 'none';
            document.getElementById('internasionalContent').style.display = 'none';
            document.getElementById('nasionalContent').style.display = 'block';
        });
    </script>
</body>
</html>
