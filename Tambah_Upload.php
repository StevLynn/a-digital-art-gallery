<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('location:Halaman_login.html');
}?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Postingan Baru</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style_user.css">
</head>

<body>
    <div class="top-section">
        <a href="Home.html"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>New Post</h1>
    </div>
        <form action="posting.php" method="POST" enctype="multipart/form-data">
            <div class="form-gambar" id="file-input-container">
                <input type="file" id="gambar" name="gambar" accept="image/*" required onchange="previewImage(event)">
            </div>
            <div class="form-gambar">
                <img id="preview" alt="Preview">
                <canvas id="canvas" width="450" height="250"></canvas>
            </div>
            <div class="form-group">
                <label for="title_lukisan">Painting name</label>
                <input type="text" id="title_lukisan" name="title_lukisan" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Description</label>
                <textarea id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="media">Media</label>
                <input type="text" id="media" name="media" required>
            </div>
            <div class="form-group">
                <label for="tahun_pembuatan">Production year</label>
                <input type="date" id="tahun_pembuatan" name="tahun_pembuatan" required>
            </div>
            <div class="form-group">
                <label for="ukuran">Size</label>
                <input type="text" id="ukuran" name="ukuran" required>
            </div>
            <div class="form-group">
                <button type="submit" class="submit-btn">SUBMIT</button>
            </div>
        </form>
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
        function previewImage(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function(){
                const preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>
</body>
</html>
