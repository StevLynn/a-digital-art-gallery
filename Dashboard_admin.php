<?php
    $servername = "Localhost";  
    $username = "root";
    $password = "";
    $dbname = "projek_web";
    $port = 3307; 

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM dashboard_admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Admin: " . $row["jumlah_admin"]. "<br>";
        echo "User: " . $row["jumlah_user"]. "<br>";
        echo "Art: " . $row["jumlah_art"]. "<br>";
        echo "Approval: " . $row["jumlah_approval"]. "<br>";
        echo "Deletion: " . $row["jumlah_deletion"]. "<br>";
    }
} else {
    echo "Tidak ada data";
}
$conn->close();
?>
