<?php
session_start();
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
            </div>
            <ul class="user">
                <a href="Account_User.php">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
            </ul>
            <?php if (isset($_SESSION['username'])): ?>
            <ul class="setting">
                <a href="Settings.html">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a>
            </ul>
            <?php endif; ?>
        </aside>
    </div>
        
    <div class="main" id="main">
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
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="rounded-circle bg-light p-3">
                                    <i class="fas fa-user fa-lg text-secondary"></i>
                                </div>
                                <p class="mt-2">Artist 1</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="rounded-circle bg-light p-3">
                                    <i class="fas fa-user fa-lg text-secondary"></i>
                                </div>
                                <p class="mt-2">Artist 2</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="rounded-circle bg-light p-3">
                                    <i class="fas fa-user fa-lg text-secondary"></i>
                                </div>
                                <p class="mt-2">Artist 3</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="rounded-circle bg-light p-3">
                                    <i class="fas fa-user fa-lg text-secondary"></i>
                                </div>
                                <p class="mt-2">Artist 4</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="rounded-circle bg-light p-3">
                                    <i class="fas fa-user fa-lg text-secondary"></i>
                                </div>
                                <p class="mt-2">Artist 5</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mt-5">
                    <h2>Popular Arts</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top">
                                <div class="icon-container">
                                    <button type="button"><i class="fas fa-heart fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-comment fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-share fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-download fa-lg"></i></button>
                                </div>
                            </div>
                            <div class="name-container">
                                <span>Nama Art</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="internasionalContent" style="display: none;">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top">
                                <div class="icon-container">
                                    <button type="button"><i class="fas fa-heart fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-comment fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-share fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-download fa-lg"></i></button>
                                </div>
                            </div>
                            <div class="name-container">
                                <span>Nama art</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="nasionalContent" style="display: none;">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top">
                                <div class="icon-container">
                                    <button type="button"><i class="fas fa-heart fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-comment fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-share fa-lg"></i></button>
                                    <button type="button"><i class="fas fa-download fa-lg"></i></button>
                                </div>
                            </div>
                            <div class="name-container">
                                <span>Nama Art </span>
                            </div>
                        </div>
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
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="script.js"></script>
    
    <script>
        document.getElementById('forYouLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('forYouContent').style.display = 'block';
            document.getElementById('internasionalContent').style.display = 'none';
            document.getElementById('nasionalContent').style.display = 'none';
        });

        document.getElementById('internasionalLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('forYouContent').style.display = 'none';
            document.getElementById('internasionalContent').style.display = 'block';
            document.getElementById('nasionalContent').style.display = 'none';
        });

        document.getElementById('nasionalLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('forYouContent').style.display = 'none';
            document.getElementById('internasionalContent').style.display = 'none';
            document.getElementById('nasionalContent').style.display = 'block';
        });
    </script>
</body>
</html>
