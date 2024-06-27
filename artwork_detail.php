<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM lukisan WHERE id = $id AND status = 'success'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "Lukisan tidak ditemukan."]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Parameter ID tidak ditemukan."]);
}
?>
