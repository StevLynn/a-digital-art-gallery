<?php
session_start();
include 'connection.php';

if (!isset($_GET['username'])) {
    header('Location: Home.php');
    exit();
}

$username = $_GET['username'];

// Prepared statement untuk mengambil informasi pengguna berdasarkan username
$sql = "SELECT * FROM data_user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Tampilkan informasi pengguna sesuai kebutuhan Anda
    $username = $row['username'];
    $profile_image = $row['profile_image'];
    $description = $row['description'];
    $instagram = $row['instagram'];
    $twitter = $row['twitter'];
    $youtube = $row['youtube'];

    // Query for stats
    $user_id = $row['id']; // Ambil ID pengguna untuk digunakan dalam query stats

    // $sql_stats = "SELECT COUNT(*) AS total_likes FROM likes WHERE user_id = ?";
    // $stmt_stats = $conn->prepare($sql_stats);
    // $stmt_stats->bind_param('i', $user_id);
    // $stmt_stats->execute();
    // $result_stats = $stmt_stats->get_result();
    // $total_likes = ($result_stats->num_rows > 0) ? $result_stats->fetch_assoc()['total_likes'] : 0;

    // $sql_followers = "SELECT COUNT(*) AS total_followers FROM follow WHERE following_id = ?";
    // $stmt_followers = $conn->prepare($sql_followers);
    // $stmt_followers->bind_param('i', $user_id);
    // $stmt_followers->execute();
    // $result_followers = $stmt_followers->get_result();
    // $total_followers = ($result_followers->num_rows > 0) ? $result_followers->fetch_assoc()['total_followers'] : 0;

    // $sql_following = "SELECT COUNT(*) AS total_following FROM follow WHERE follower_id = ?";
    // $stmt_following = $conn->prepare($sql_following);
    // $stmt_following->bind_param('i', $user_id);
    // $stmt_following->execute();
    // $result_following = $stmt_following->get_result();
    // $total_following = ($result_following->num_rows > 0) ? $result_following->fetch_assoc()['total_following'] : 0;

} else {
    echo "Pengguna tidak ditemukan.";
    $nama = 'Nama';
    $description = 'Deskripsi singkat . . . . . . ()';
    $instagram = '#';
    $twitter = '#';
    $youtube = '#';
    $profile_image = 'default.jpg'; 
    exit();
}

$sql_images = "SELECT * FROM lukisan WHERE status = 'success' AND username = ?";
$stmt_images = $conn->prepare($sql_images);
if ($stmt_images === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt_images->bind_param("s", $username);
$stmt_images->execute();
$result_images = $stmt_images->get_result();

// Inisialisasi array untuk menyimpan hasil query gambar
$images = [];

if ($result_images->num_rows > 0) {
    while ($row_image = $result_images->fetch_assoc()) {
        $images[] = $row_image; // Menyimpan semua data baris dari hasil query
    }
}

// Cek apakah pengguna ini diikuti atau belum
$sql_check_follow = "SELECT * FROM follow WHERE follower_id = ? AND following_id = ?";
$stmt_check_follow = $conn->prepare($sql_check_follow);
$stmt_check_follow->bind_param('ii', $_SESSION['username'], $user_id);
$stmt_check_follow->execute();
$result_check_follow = $stmt_check_follow->get_result();
$is_following = $result_check_follow->num_rows > 0;


$stmt_images->close();
$stmt_check_follow->close();
$conn->close();
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
        <section class="profile-card">
            <!-- Bagian Header Profil -->
            <div class="profile-header">
                <div class="profile-icon">
                    <?php if (!empty($profile_image)) : ?>
                        <img id="profile-image" src="<?php echo $profile_image; ?>" alt="Profile Image">
                    <?php else : ?>
                        <i class="fas fa-user-circle" id="profile-icon"></i>
                    <?php endif; ?>
                </div>
                <h2><?php echo $username; ?></h2>
                <div class="profile-stats">
                    <!-- <div><?php echo $total_likes; ?><br>Suka</div>
                    <div><?php echo $total_followers; ?><br>Pengikut</div>
                    <div><?php echo $total_following; ?><br>Mengikuti</div> -->
                    <div>0<br>Suka</div>
                    <div>0<br>Pengikut</div>
                    <div>0<br>Mengikuti</div>
                </div>
            </div>

            <!-- Deskripsi Profil -->
            <div class="profile-description">
                <p><?php echo $description; ?></p>
                <p>
                    <?php if ($instagram != '#' && !empty($instagram)): ?><a href="<?php echo $instagram; ?>"><i class="fab fa-instagram"></i></a><?php endif; ?>
                    <?php if ($twitter != '#' && !empty($twitter)): ?><a href="<?php echo $twitter; ?>"><i class="fab fa-twitter"></i></a><?php endif; ?>
                    <?php if ($youtube != '#' && !empty($youtube)): ?><a href="<?php echo $youtube; ?>"><i class="fab fa-youtube"></i></a><?php endif; ?>
                </p>
            </div>

            <!-- Tombol Follow -->
            <div class="profile-actions">
                <form action="user_follow.php" method="post">
                    <input type="hidden" name="following_id" value="<?php echo $user_id; ?>">
                    <?php
                        if ($is_following) {
                            echo '<button type="submit" name="unfollow">Unfollow</button>';
                        } else {
                            echo '<button type="submit" name="follow">Follow</button>';
                        }
                    ?>
                </form>
            </div>

            <div class="additional-icons">
                <a href="#" id="gallerypenggunaLink"><i class="fas fa-th-large"></i></a>
                <a href="#" id="favoritepenggunaLink"><i class="fas fa-heart"></i></a>
            </div>

            <div id="gallerypenggunaContent">
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
            <div id="favoritepenggunaContent" style="display: none;">
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
        </section>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="script.js"></script>
    
    <script>
        document.getElementById('gallerypenggunaLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('gallerypenggunaContent').style.display = 'block';
            document.getElementById('favoritepenggunaContent').style.display = 'none';
        });

        document.getElementById('favoritepenggunaLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('gallerypenggunaContent').style.display = 'none';
            document.getElementById('favoritepenggunaContent').style.display = 'block';
        });
    </script>
</body>
</html>
