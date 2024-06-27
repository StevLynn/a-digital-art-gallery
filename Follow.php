<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('location:Halaman_login.html');
}?>

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
    <div class="navbar-top">

    </div>
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
        <div class="user-icons">
            <div class="icon">
                <i class="fas fa-user-circle"></i>
                <p>nama</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-circle"></i>
                <p>nama</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-circle"></i>
                <p>nama</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-circle"></i>
                <p>nama</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-circle"></i>
                <p>nama</p>
            </div>
        </div>
        <div class="gallery">
            <div class="item">
                <div class="name">nama</div>
                <div class="heart"><i class="far fa-heart"></i></div>
            </div>
            <div class="item">
                <div class="name">nama</div>
                <div class="heart"><i class="far fa-heart"></i></div>
            </div>
            <div class="item">
                <div class="name">nama</div>
                <div class="heart"><i class="far fa-heart"></i></div>
            </div>
            <div class="item">
                <div class="name">nama</div>
                <div class="heart"><i class="far fa-heart"></i></div>
            </div>
            <div class="item">
                <div class="name">nama</div>
                <div class="heart"><i class="far fa-heart"></i></div>
            </div>
            <div class="item">
                <div class="name">nama</div>
                <div class="heart"><i class="far fa-heart"></i></div>
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
    </div>
</body>
</html>
