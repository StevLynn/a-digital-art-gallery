<?php
    session_start();
    include 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT username, password FROM data_user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($db_username, $hashed_password);

        if ($stmt->fetch() && password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $db_username;
            header("Location: Home.html");
            exit();
        } else {
            echo "Username atau password salah.";
        }

        $stmt->close();
        $conn->close();
    }
?>
