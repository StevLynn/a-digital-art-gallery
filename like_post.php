<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id_lukisan']) ? intval($_POST['id_lukisan']) : 0;

    if ($id > 0) {
        $sql = "UPDATE lukisan SET likes = likes + 1 WHERE id_lukisan = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to update likes']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to prepare query']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid artwork ID']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
?>
