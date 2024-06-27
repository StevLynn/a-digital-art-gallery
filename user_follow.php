<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: Halaman_login.html');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $follower_id = $_SESSION['user_id']; // Ganti dengan session yang menyimpan ID pengguna yang sedang login
    $following_id = $_POST['following_id'];

    // Query untuk memeriksa apakah sudah mengikuti pengguna ini atau belum
    $sql_check = "SELECT * FROM follow WHERE follower_id = $follower_id AND following_id = $following_id";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows == 0) {
        // Jika belum mengikuti, tambahkan hubungan follow
        $sql_insert = "INSERT INTO follow (follower_id, following_id) VALUES ($follower_id, $following_id)";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "Berhasil mengikuti pengguna ini.";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        // Jika sudah mengikuti, hapus hubungan follow (Unfollow)
        $sql_delete = "DELETE FROM follow WHERE follower_id = $follower_id AND following_id = $following_id";
        
        if ($conn->query($sql_delete) === TRUE) {
            echo "Berhasil unfollow pengguna ini.";
        } else {
            echo "Error: " . $sql_delete . "<br>" . $conn->error;
        }
    }
} else {
    echo "Metode permintaan tidak valid.";
}

$conn->close();
?>
