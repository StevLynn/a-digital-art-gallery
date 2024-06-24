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
    <title>Halaman Beranda Aplikasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style_user.css">
</head>

<body>
    <div class="top-section">
        <a href="Home.php"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Search</h1>
    </div>
    <div class="search-bar">
        <div class="search-container">
            <i class="fas fa-search"></i>
            <input id="searchInput" type="text" placeholder="Search here . . .">
            <i class="fas fa-times" id="clearInput"></i>
        </div>
    </div>
    <div class="content-section">
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


    <script>
        const inputElement = document.getElementById("searchInput");

        const clearIcon = document.getElementById("clearInput");

        clearIcon.addEventListener("click", function() {
            inputElement.value = "";
            clearIcon.style.display = "none";
        });

        inputElement.addEventListener("input", function() {
            if (inputElement.value.trim() !== "") {
                clearIcon.style.display = "block";
            } else {
                clearIcon.style.display = "none";
            }
        });
    </script>
</body>
</html>
