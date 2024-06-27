<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('location:Halaman_login.html');
}

include 'connection.php';

// Ambil data profil dari database
$username = $_SESSION['username'];
$sql = "SELECT * FROM `data_user` WHERE `username` = '$username'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama = $row['nama'];
    $description = $row['description'];
    $instagram = $row['instagram'];
    $twitter = $row['twitter'];
    $youtube = $row['youtube'];
    $profile_image = $row['profile_image'];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style_user.css">
</head>
<body>
<div class="top-section">
        <a href="Account_User.php"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Edit Profile</h1>
    </div>
    <div class="profile-info">
        <form class="profile-form" action="Edit_user.php" method="POST" enctype="multipart/form-data">
            <div class="profile-up" onclick="document.getElementById('profile_image_file').click();">
                <?php if (!empty($profile_image)) : ?>
                    <img id="profile-image" src="<?php echo $profile_image; ?>" alt="Profile Image">
                <?php else : ?>
                    <i class="fas fa-user-circle" id="profile-icon"></i>
                <?php endif; ?>
                <input type="file" class="form-control" id="profile_image_file" name="profile_image_file" style="display: none;" accept="image/*" onchange="loadProfileImage(event)">
            </div>
            <input type="hidden" name="old_username" value="<?php echo $_SESSION['username']; ?>"> <!-- Hidden field for old username -->

            <div class="mb-3">
                <h3>About User</h3>
                <label for="new_username" class="form-label">Username</label>
                <input type="text" class="form-control" id="new_username" name="new_username" value="<?php echo $username; ?>" >

                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>
                
                <!-- <label for="nama" class="form-label">Name</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>"> -->

                <label for="description" class="form-label">Self description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $description; ?>">
            </div>
            <div class="mb-3">
                <h3>Social Media</h3>
                <label for="instagram" class="form-label">Instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo $instagram; ?>" placeholder="https://www.instagram.com/">

                <label for="twitter" class="form-label">Twitter</label>
                <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo $twitter; ?>" placeholder="https://www.twitter.com/">

                <label for="youtube" class="form-label">Youtube</label>
                <input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo $youtube; ?>" placeholder="https://www.youtube.com/">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <footer>
        <div class="footer-content">
            <h3>A Digital Art Gallery</h3>
            <p>Visit us</p>
            <ul class="socials">
                <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                <li><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a></li>
                <li><a href="mailto:"><i class="far fa-envelope"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2024 A Digital Art Gallery. design by <span>kelompok 2dua</span></p>
        </div>
    </footer>

    <script>
        function loadProfileImage(event) {
            const profileImage = document.getElementById('profile-image');
            const profileIcon = document.getElementById('profile-icon');
            profileImage.src = URL.createObjectURL(event.target.files[0]);
            profileImage.style.display = 'block';
            profileIcon.style.display = 'none';
        }

        // Fungsi untuk memvalidasi URL
        function isValidURL(url) {
            // Pola regex untuk URL yang valid
            var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
            return !!pattern.test(url);
        }

        // Validasi saat form disubmit
        document.querySelector('form').addEventListener('submit', function(e) {
            var instagramInput = document.getElementById('instagram').value;
            var twitterInput = document.getElementById('twitter').value;
            var youtubeInput = document.getElementById('youtube').value;

            if (instagramInput !== '' && !isValidURL(instagramInput)) {
                alert('Masukkan URL Instagram yang valid');
                e.preventDefault();
            }

            if (twitterInput !== '' && !isValidURL(twitterInput)) {
                alert('Masukkan URL Twitter yang valid');
                e.preventDefault();
            }

            if (youtubeInput !== '' && !isValidURL(youtubeInput)) {
                alert('Masukkan URL YouTube yang valid');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>