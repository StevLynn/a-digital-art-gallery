<?php

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artwork_id = $_POST['artwork_id']; // Pastikan ini sesuai dengan input yang dikirimkan dari form
    
    if (isset($_POST['approve'])) {
        // Update status menjadi 'success'
        $sql = "UPDATE lukisan SET status = 'success' WHERE id_lukisan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $artwork_id); // Gunakan "i" untuk integer
        if ($stmt->execute()) {
            echo "Status berhasil diupdate menjadi 'success'.";
        } else {
            echo "Gagal mengupdate status: " . $conn->error;
        }
        $stmt->close();
    } elseif (isset($_POST['reject'])) {
        // Update status menjadi 'failed'
        $sql = "UPDATE lukisan SET status = 'failed' WHERE id_lukisan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $artwork_id); // Gunakan "i" untuk integer
        if ($stmt->execute()) {
            echo "Status berhasil diupdate menjadi 'failed'.";
        } else {
            echo "Gagal mengupdate status: " . $conn->error;
        }
        $stmt->close();
    }

    // Redirect kembali ke halaman persetujuan
    header('Location: Persetujuan_Postingan_Admin.php');
    exit();
}


$conn->close();
?>
