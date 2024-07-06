<?php
session_start();
include 'connection.php';


$id = isset($_GET['id_lukisan']) ? intval($_GET['id_lukisan']) : 0;

if ($id <= 0) {
    die("Invalid artwork ID.");
}

$sql = "SELECT * FROM lukisan WHERE id_lukisan = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $lukisan = $result->fetch_assoc();
        $judul_lukisan = $lukisan['title_lukisan'];
        $deskripsi_lukisan = $lukisan['deskripsi'];
        $gambar_lukisan = $lukisan['gambar'];
    } else {
        die("Artwork not found.");
    }

    $stmt->close();
} else {
    die("Failed to prepare query: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artwork Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #181818;
            color: white;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #282828;
            padding: 20px;
            border-radius: 10px;
            position: relative;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }
        .image-placeholder img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .icons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .icon {
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
        }
        .icon .comment-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            font-size: 12px;
        }
        .icon .like-count {
            margin-left: 5px;
        }
        .details, .description, .comment-section {
            margin-bottom: 20px;
        }
        .comment-section {
            display: none;
        }
        .comment-list {
            margin-top: 10px;
        }
        .comment {
            background-color: #404040;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            position: relative;
        }
        .comment .user {
            font-weight: bold;
        }
        .comment .timestamp {
            font-size: 0.8em;
            color: #b0b0b0;
        }
        .comment .text {
            margin-top: 5px;
        }
        .comment .actions {
            display: flex;
            gap: 10px;
        }
        .comment .actions button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }
        .comment .likes {
            display: flex;
            align-items: center;
            position: absolute;
            left: 10px; /* Posisi tombol like di sebelah kiri */
            bottom: 10px;
        }
        .comment .likes span {
            margin-left: 5px;
        }
        .reply {
            margin-left: 20px;
            border-left: 2px solid #505050;
            padding-left: 10px;
        }
        .reply-form {
            margin-left: 20px;
            margin-top: 10px;
            display: none;
        }
        .comment-form, .reply-form {
            display: flex;
            flex-direction: column;
        }
        .comment-form textarea, .reply-form textarea {
            border: none;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .comment-form button, .reply-form button {
            align-self: flex-end;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: red;
            color: white;
            cursor: pointer;
        }
        .edit-mode {
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <span class="close-button" id="close-button">&times;</span>
    <h1><?php echo htmlspecialchars($lukisan['title_lukisan']); ?></h1>
    <h2>Karya <a href="Account_User_Lain.php?username=<?php echo urlencode($lukisan['username']); ?>"><span><?php echo htmlspecialchars($lukisan['username']); ?></span></a></h2>
    <div class="image-placeholder">
        <img src="<?php echo htmlspecialchars($lukisan['gambar']); ?>" alt="Artwork Image">
    </div>
    <div class="icons">
        <span class="icon" id="post-like-icon">&#9825;<span class="like-count" id="post-like-count">0</span></span>
        <span class="icon" id="comment-icon">&#128172;<span class="comment-count" id="comment-count">0</span></span>
        <span class="icon">&#9654;</span>
        <span class="icon">&#128257;</span>
    </div>
    <div class="details">
        <p><strong>Production year:</strong> <?php echo htmlspecialchars($lukisan['tahun_pembuatan']); ?></p>
        <p><strong>Size:</strong> <?php echo htmlspecialchars($lukisan['ukuran']); ?></p>
        <p><strong>Media:</strong> <?php echo htmlspecialchars($lukisan['media']); ?></p>
    </div>
    <div class="description">
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($lukisan['deskripsi'])); ?></p>
    </div>
    <div class="comment-section" id="comment-section">
        <h3>Komentar</h3>
        <form id="comment-form" class="comment-form">
            <textarea id="comment-input" rows="3" placeholder="Tambahkan komentar Anda di sini..."></textarea>
            <button type="submit">Kirim</button>
        </form>
        <div class="comment-list" id="comment-list"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const commentIcon = document.getElementById('comment-icon');
    const postLikeIcon = document.getElementById('post-like-icon');
    const commentForm = document.getElementById('comment-form');
    const commentList = document.getElementById('comment-list');

    commentIcon.addEventListener('click', toggleCommentSection);
    postLikeIcon.addEventListener('click', likePost);
    commentForm.addEventListener('submit', handleCommentFormSubmit);

    loadCommentsFromLocalStorage();
    updateCommentCount();
});

function toggleCommentSection() {
    const commentSection = document.getElementById('comment-section');
    commentSection.style.display = commentSection.style.display === 'block' ? 'none' : 'block';
}

function likePost() {
    const postLikeCountSpan = document.getElementById('post-like-count');
    const currentLikeCount = parseInt(postLikeCountSpan.textContent);
    const idLukisan = <?php echo json_encode($id); ?>;

    fetch('like_post.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id_lukisan=${idLukisan}`,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            postLikeCountSpan.textContent = currentLikeCount + 1;
        } else {
            throw new Error(data.error || 'Failed to like the post.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message);
    });
}

function handleCommentFormSubmit(event) {
    event.preventDefault();
    const commentInput = document.getElementById('comment-input');
    const commentText = commentInput.value.trim();
    const idLukisan = <?php echo json_encode($id); ?>;

    if (commentText) {
        fetch('Comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id_lukisan: idLukisan,
                comment_text: commentText,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                addComment(commentText, 'User', new Date().toLocaleString(), [], null);
                commentInput.value = '';
                updateCommentCount();
                saveCommentsToLocalStorage();
            } else {
                throw new Error(data.error || 'Gagal menyimpan komentar.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message);
        });
    }
}

function addComment(commentText, user, timestamp, replies, parentElement) {
    const commentListElement = parentElement ? parentElement.querySelector('.comment-list') : document.getElementById('comment-list');
    const newComment = document.createElement('div');
    newComment.classList.add('comment');
    newComment.innerHTML = `
        <div class="user">${user}</div>
        <div class="timestamp">${timestamp}</div>
        <div class="text">${commentText}</div>
        <div class="actions">
            <button class="reply-button">Balas</button>
            <button class="edit-button">Edit</button>
            <button class="delete-button">Hapus</button>
        </div>
        <div class="comment-list"></div>
        <form class="reply-form">
            <textarea rows="2" placeholder="Tambahkan balasan Anda di sini..."></textarea>
            <button type="submit">Balas</button>
        </form>
    `;
    commentListElement.appendChild(newComment);

    const replyButton = newComment.querySelector('.reply-button');
    const editButton = newComment.querySelector('.edit-button');
    const deleteButton = newComment.querySelector('.delete-button');
    const replyForm = newComment.querySelector('.reply-form');

    replyButton.addEventListener('click', () => toggleReplyForm(replyForm));
    replyForm.addEventListener('submit', (event) => handleReplyFormSubmit(event, newComment));
    editButton.addEventListener('click', () => editComment(newComment));
    deleteButton.addEventListener('click', () => deleteComment(newComment));
}

function toggleReplyForm(replyForm) {
    replyForm.style.display = replyForm.style.display === 'block' ? 'none' : 'block';
}

function handleReplyFormSubmit(event, parentComment) {
    event.preventDefault();
    const replyInput = event.target.querySelector('textarea');
    const replyText = replyInput.value.trim();

    if (replyText) {
        addComment(replyText, 'User', new Date().toLocaleString(), [], parentComment);
        replyInput.value = '';
        saveCommentsToLocalStorage();
    }
}

function editComment(commentElement) {
    const textElement = commentElement.querySelector('.text');
    const originalText = textElement.textContent;

    textElement.innerHTML = `
        <textarea rows="3">${originalText}</textarea>
        <button class="save-edit-button">Simpan</button>
        <button class="cancel-edit-button">Batal</button>
    `;

    const saveEditButton = textElement.querySelector('.save-edit-button');
    const cancelEditButton = textElement.querySelector('.cancel-edit-button');
    const editTextarea = textElement.querySelector('textarea');

    saveEditButton.addEventListener('click', () => saveEditComment(commentElement, editTextarea.value));
    cancelEditButton.addEventListener('click', () => cancelEditComment(commentElement, originalText));
}

function saveEditComment(commentElement, newText) {
    const textElement = commentElement.querySelector('.text');
    textElement.textContent = newText;
    saveCommentsToLocalStorage();
}

function cancelEditComment(commentElement, originalText) {
    const textElement = commentElement.querySelector('.text');
    textElement.textContent = originalText;
}

function deleteComment(commentElement) {
    commentElement.remove();
    updateCommentCount();
    saveCommentsToLocalStorage();
}

function updateCommentCount() {
    const commentCountSpan = document.getElementById('comment-count');
    const commentList = document.getElementById('comment-list');
    const commentCount = commentList.getElementsByClassName('comment').length;
    commentCountSpan.textContent = commentCount;
}

function saveCommentsToLocalStorage() {
    const commentList = document.getElementById('comment-list');
    const commentsData = serializeComments(commentList);
    localStorage.setItem('comments', JSON.stringify(commentsData));
}

function loadCommentsFromLocalStorage() {
    const commentsData = JSON.parse(localStorage.getItem('comments')) || [];
    const commentList = document.getElementById('comment-list');
    commentList.innerHTML = '';
    deserializeComments(commentsData, commentList);
}

function serializeComments(commentList) {
    const comments = [];
    const commentElements = commentList.querySelectorAll('.comment');

    commentElements.forEach(commentElement => {
        const user = commentElement.querySelector('.user').textContent;
        const timestamp = commentElement.querySelector('.timestamp').textContent;
        const text = commentElement.querySelector('.text').textContent;
        const replies = serializeComments(commentElement.querySelector('.comment-list'));
        comments.push({ user, timestamp, text, replies });
    });

    return comments;
}

function deserializeComments(commentsData, commentList) {
    commentsData.forEach(commentData => {
        addComment(commentData.text, commentData.user, commentData.timestamp, commentData.replies, commentList);
    });
}
</script>
</body>
</html>
