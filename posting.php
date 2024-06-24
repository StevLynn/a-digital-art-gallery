<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    die("You need to log in first.");
}

// Debugging koneksi database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form dan melakukan sanitasi
    $nama = $conn->real_escape_string($_POST['title_lukisan']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $media = $conn->real_escape_string($_POST['media']);
    $tahun = $conn->real_escape_string($_POST['tahun_pembuatan']); // Pastikan formatnya YYYY-MM-DD
    $ukuran = $conn->real_escape_string($_POST['ukuran']);
    $username = $conn->real_escape_string($_SESSION['username']); // Mengambil username dari session
    $status = "pending"; // Mengatur status ke "pending"
    
    // Debugging data input
    echo "Data yang diterima: <br>";
    echo "Nama: $nama <br>";
    echo "Deskripsi: $deskripsi <br>";
    echo "Media: $media <br>";
    echo "Tahun: $tahun <br>";
    echo "Ukuran: $ukuran <br>";
    echo "Username: $username <br>";
    echo "Status: $status <br>";

    // Mengambil file gambar dan menyimpannya di server
    $target_dir = "lukisan/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    
    // Debugging file upload
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        echo "File berhasil diunggah: $target_file <br>";

        // Menyimpan data ke database
        $sql = "INSERT INTO lukisan (title_lukisan, deskripsi, media, tahun_pembuatan, ukuran, gambar, username, status) 
                VALUES ('$nama', '$deskripsi', '$media', '$tahun', '$ukuran', '$target_file', '$username', '$status')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // Menghentikan output sebelum redirect
            ob_start();
            header('Location: Upload.php');
            ob_end_flush();
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    
    $conn->close();
}
?>
