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
    <div class="top-section">
        <a href="Home.html"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Edit Profile</h1>
    </div>
    <div class="profile-info">
    <div class="profile-up">
        <i class="fas fa-user-circle"></i>
    </div>
    <form class="profile-form" action="Edit_user.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="old_username" value="<?php echo $_SESSION['username']; ?>"> <!-- Hidden field for old username -->
        
        <div class="mb-3">
            <h3>About User</h3>
            <label for="new_username" class="form-label">Username</label>
            <input type="text" class="form-control" id="new_username" name="new_username" value="<?php echo $_SESSION['username']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Self description</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <div class="mb-3">
            <h3>Sosial Media</h3>
            <label for="instagram" class="form-label">Instagram</label>
            <input type="text" class="form-control" id="instagram" name="instagram">
        </div>
        <div class="mb-3">
            <label for="twitter" class="form-label">Twitter</label>
            <input type="text" class="form-control" id="twitter" name="twitter">
        </div>
        <div class="mb-3">
            <label for="youtube" class="form-label">Youtube</label>
            <input type="text" class="form-control" id="youtube" name="youtube">
        </div>
        <div class="mb-3">
            <label for="profile_image" class="form-label">Profile Image URL</label>
            <input type="text" class="form-control" id="profile_image" name="profile_image">
        </div>
        <div class="mb-3">
            <label for="profile_image_file" class="form-label">Upload Profile Image</label>
            <input type="file" class="form-control" id="profile_image_file" name="profile_image_file">
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
</body>
</html>
