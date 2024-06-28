<?php
session_start();
include 'connection.php';

// Pastikan parameter id_lukisan tersedia dan merupakan angka
$id = isset($_GET['id_lukisan']) ? intval($_GET['id_lukisan']) : null;

if ($id === null || $id <= 0) {
    echo "ID lukisan tidak valid.";
    exit;
}

// Query untuk mengambil data detail lukisan berdasarkan ID
$sql = "SELECT * FROM lukisan WHERE id_lukisan = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah ada hasil
    if ($result->num_rows > 0) {
        $lukisan = $result->fetch_assoc();
    } else {
        echo "Lukisan tidak ditemukan.";
        exit;
    }

    $stmt->close();
} else {
    echo "Query gagal disiapkan: " . $conn->error;
    exit;
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
    <h1><?php echo $lukisan['title_lukisan']; ?></h1>
    <h2>Karya <?php echo $lukisan['nama_akun']; ?></h2>
    <div class="image-placeholder">
        <img src="<?php echo $lukisan['gambar']; ?>" alt="Artwork Image">
    </div>
    <div class="icons">
        <span class="icon" id="post-like-icon">&#9825;<span class="like-count" id="post-like-count">0</span></span>
        <span class="icon" id="comment-icon">&#128172;<span class="comment-count" id="comment-count">0</span></span>
        <span class="icon">&#9654;</span>
        <span class="icon">&#128257;</span>
    </div>
    <div class="details">
        <p><strong>Tahun:</strong> <?php echo $lukisan['tahun_pembuatan']; ?></p>
        <p><strong>Ukuran:</strong> <?php echo $lukisan['ukuran']; ?></p>
        <p><strong>Media:</strong> <?php echo $lukisan['media']; ?></p>
    </div>
    <div class="description">
        <?php echo nl2br($lukisan['deskripsi']); ?>
    </div>
    <div class="comment-section" id="comment-section">
        <h3>Komentar</h3>
        <form id="comment-form" class="comment-form">
            <textarea id="comment-input" placeholder="Tulis komentar Anda..."></textarea>
            <button type="button">Kirim</button>
        </form>
        <div class="comment-list" id="comment-list">
            <!-- Komentar akan ditambahkan di sini -->
        </div>
    </div>
</div>

<script>
    document.getElementById('close-button').addEventListener('click', function() {
        window.history.back();
    });

    // Dummy data untuk komentar
    const comments = [
        {
            user: "User1",
            timestamp: "2023-03-15 10:30",
            text: "Keren banget!",
            likes: 5
        },
        {
            user: "User2",
            timestamp: "2023-03-15 11:00",
            text: "Bagus sekali.",
            likes: 2
        }
    ];

    function displayComments() {
        const commentList = document.getElementById('comment-list');
        commentList.innerHTML = '';
        comments.forEach(comment => {
            const commentElement = document.createElement('div');
            commentElement.classList.add('comment');
            commentElement.innerHTML = `
                <div class="user">${comment.user}</div>
                <div class="timestamp">${comment.timestamp}</div>
                <div class="text">${comment.text}</div>
                <div class="actions">
                    <button type="button">Balas</button>
                    <button type="button">Edit</button>
                    <button type="button">Hapus</button>
                </div>
                <div class="likes">
                    <span>&#9825;</span><span>${comment.likes}</span>
                `;
            commentList.appendChild(commentElement);
        });
    }

    displayComments();
</script>
</body>
</html>
