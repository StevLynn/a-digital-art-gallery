<?php
include 'connection.php';

// Query untuk mengambil lukisan dengan status pending
$sql = "SELECT id_lukisan, username, title_lukisan, gambar, deskripsi FROM lukisan WHERE status = 'pending'";
$result = $conn->query($sql);

// Query untuk mengambil lukisan dengan status 'failed' atau 'success'
$sql_penghapusan = "SELECT username, title_lukisan, gambar, deskripsi FROM lukisan WHERE status IN ('failed', 'success')";
$result_penghapusan = $conn->query($sql_penghapusan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Art Gallery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style_admin.css">
</head>
<body>
    <nav>
        <div class="nav_top">
            <a href="Dashboard_admin.html"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
    </nav>
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
                    <a href="Persetujuan_Postingan_Admin.html">
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
        <div class="posting-management">
            <div class="tab">
                <button class="tablinks active" onclick="openTab(event, 'Persetujuan')">Persetujuan postingan</button>
                <button class="tablinks" onclick="openTab(event, 'Penghapusan')">Penghapusan postingan</button>
            </div>

            <div id="Persetujuan" class="tabcontent" style="display: flex;">
                <div class="container mt-5">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Describtion</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['title_lukisan']); ?></td>
                                    <td><img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="Artwork" style="max-width: 150px;"></td>
                                    <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                                    <td>
                                        <form action="process_approval.php" method="post">
                                            <input type="hidden" name="artwork_id" value="<?php echo htmlspecialchars($row['id_lukisan']); ?>">
                                            <button type="submit" name="approve" class="btn btn-success">Approve</button>
                                            <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="Penghapusan" class="tabcontent">
                <div class="container mt-5">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Describtion</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row_penghapusan = $result_penghapusan->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row_penghapusan['username']); ?></td>
                                <td><?php echo htmlspecialchars($row_penghapusan['title_lukisan']); ?></td>
                                <td><img src="<?php echo htmlspecialchars($row_penghapusan['gambar']); ?>" alt="Artwork" style="max-width: 150px;"></td>
                                <td><?php echo htmlspecialchars($row_penghapusan['deskripsi']); ?></td>
                                <td>
                                    <form action="process_delete.php" method="post">
                                        <input type="hidden" name="artwork_id" value="<?php echo htmlspecialchars($row_penghapusan['id_lukisan']); ?>">
                                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-content">
            <h3>Digital Art Gallery</h3>
            <p>Visit us</p>
            <ul class="socials">
                <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                <li><a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a></li>
                <li><a href="mailto:someone@example.com"><i class="far fa-envelope"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2024 Digital Art Gallery. design by <span>kelompok 2dua</span></p>
        </div>
    </footer>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</body>
</html>
