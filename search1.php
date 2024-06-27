<?php
include 'connection.php';

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
