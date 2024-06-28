<?php
session_start();
include 'connection.php';

// Validate and sanitize the ID parameter
$id = isset($_POST['id_lukisan']) ? intval($_POST['id_lukisan']) : 0;
$comment_text = isset($_POST['comment_text']) ? trim($_POST['comment_text']) : '';

if ($id <= 0) {
    die(json_encode(['success' => false, 'error' => 'Invalid artwork ID.']));
}

if (empty($comment_text)) {
    die(json_encode(['success' => false, 'error' => 'Comment cannot be empty.']));
}

// Assuming 'id_user' is your user identifier, adjust as per your session/user management
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;

// Prepare and execute the SQL statement to insert the comment
$stmt = $conn->prepare("INSERT INTO comments (id_lukisan, id_user, comment_text) VALUES (?, ?, ?)");
$stmt->bind_param('iis', $id, $id_user, $comment_text);

if ($stmt->execute()) {
    // On successful insertion, return success response
    echo json_encode(['success' => true]);
} else {
    // On failure, return error response
    echo json_encode(['success' => false, 'error' => 'Failed to save comment.']);
}

$stmt->close();
$conn->close();
?>
