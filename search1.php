<?php
// Pastikan untuk menyesuaikan pengaturan database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projek_web";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Query untuk mencari berdasarkan title_lukisan dan username
$sql = "SELECT lukisan.title_lukisan AS title, lukisan.gambar AS cover_path, lukisan.username 
        FROM lukisan 
        WHERE lukisan.title_lukisan LIKE '%$search%' 
        OR lukisan.username LIKE '%$search%'";

$result = $conn->query($sql);

$response = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

echo json_encode($response);

$conn->close();
?>
