<?php
    $servername = "localhost";  // Ganti localhost dengan 127.0.0.1
    $username = "root";
    $password = "";
    $dbname = "projek_web";
    $port = 3307;  // Tambahkan port di sini

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $profile_image = $_FILES['profile_image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($profile_image);

        // Cek apakah password lama benar
        $sql = "SELECT password FROM edit_profil_admin WHERE id = 1"; // Sesuaikan id admin yang sedang login
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($old_password, $row['password'])) {
                // Jika password baru diisi, hash password baru
                if (!empty($new_password) && $new_password === $confirm_password) {
                    $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);
                    $sql = "UPDATE edit_profil_admin SET username='$username', email='$email', phone='$phone', address='$address', password='$new_password_hashed' WHERE id=1";
                } else {
                    $sql = "UPDATE edit_profil_admin SET username='$username', email='$email', phone='$phone', address='$address' WHERE id=1";
                }

                // Cek apakah ada gambar profil baru diupload
                if (!empty($profile_image)) {
                    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
                        $sql = "UPDATE edit_profil_admin SET username='$username', email='$email', phone='$phone', address='$address', profile_image='$profile_image' WHERE id=1";
                    } else {
                        echo "Maaf, terjadi kesalahan saat mengupload gambar.";
                    }
                }

                if ($conn->query($sql) === TRUE) {
                    echo "Profil berhasil diperbarui";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Password lama tidak sesuai.";
            }
        }
    }

    $conn->close();
?>
