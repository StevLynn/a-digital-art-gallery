<?php
session_start();
include 'connection.php';

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);
$id_lukisan = isset($data['id_lukisan']) ? intval($data['id_lukisan']) : 0;
$comment_text = isset($data['comment_text']) ? trim($data['comment_text']) : '';

if ($id_lukisan > 0 && !empty($comment_text)) {
    $username = $_SESSION['username']; 
    $timestamp = date('Y-m-d H:i:s');

    
    $sql = "INSERT INTO comments (id_lukisan, username, comment_text, timestamp) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("isss", $id_lukisan, $username, $comment_text, $timestamp);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to save comment.']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to prepare query.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input.']);
}

$conn->close();
?>
