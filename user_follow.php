<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: Halaman_login.html');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil id dari username yang disimpan dalam session
    $username = $_SESSION['username'];
    
    // Query untuk mendapatkan id berdasarkan username dari session
    $sql_get_id = "SELECT id FROM data_user WHERE username = ?";
    $stmt_get_id = $conn->prepare($sql_get_id);
    $stmt_get_id->bind_param('s', $username);
    $stmt_get_id->execute();
    $result_get_id = $stmt_get_id->get_result();

    if ($result_get_id->num_rows > 0) {
        $row = $result_get_id->fetch_assoc();
        $follower_id = $row['id']; // Ambil id dari hasil query
        $following_id = $_POST['following_id'];

        // Prepared statement untuk memeriksa apakah sudah mengikuti pengguna ini atau belum
        $sql_check = "SELECT * FROM follow WHERE follower_id = ? AND following_id = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param('ii', $follower_id, $following_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows == 0) {
            // Jika belum mengikuti, tambahkan hubungan follow
            $sql_insert = "INSERT INTO follow (follower_id, following_id) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param('ii', $follower_id, $following_id);
            
            if ($stmt_insert->execute()) {
                echo "Berhasil mengikuti pengguna ini.";
            } else {
                echo "Error: " . $stmt_insert->error;
            }
        } else {
            // Jika sudah mengikuti, hapus hubungan follow (Unfollow)
            $sql_delete = "DELETE FROM follow WHERE follower_id = ? AND following_id = ?";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param('ii', $follower_id, $following_id);
            
            if ($stmt_delete->execute()) {
                echo "Berhasil unfollow pengguna ini.";
            } else {
                echo "Error: " . $stmt_delete->error;
            }
        }

        // Mengarahkan kembali ke halaman sebelumnya (atau halaman profil pengguna)
        header("Location: Account_User_Lain.php?username=$username");
    } else {
        echo "Metode permintaan tidak valid.";
    }

    $stmt_check->close();
    if (isset($stmt_insert)) {
        $stmt_insert->close();
    }
    if (isset($stmt_delete)) {
        $stmt_delete->close();
    }
} else {
    echo "Metode permintaan tidak valid.";
}

$conn->close();
?>
