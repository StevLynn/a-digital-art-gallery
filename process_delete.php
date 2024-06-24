<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header('location: Halaman_login_admin.html');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $artwork_id = $_POST['artwork_id'];

    // Query untuk menghapus lukisan berdasarkan id
    $sql = "DELETE FROM lukisan WHERE id_lukisan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $artwork_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Jika berhasil dihapus, redirect kembali ke halaman persetujuan
        header('Location: Persetujuan_Postingan_Admin.php');
        exit();
    } else {
        // Handle error jika tidak berhasil dihapus
        echo "Gagal menghapus. Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
