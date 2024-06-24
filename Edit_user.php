<?php
// Assuming you have a database connection file
include 'connection.php';
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_username = $_SESSION['username']; // The old username from session
    $new_username = $_POST['new_username']; // The new username
    $description = $_POST['description'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];
    $youtube = $_POST['youtube'];
    $profile_image = $_POST['profile_image'];

    // Handle file upload
    if (!empty($_FILES['profile_image_file']['name'])) {
        $target_dir = "uploads/"; // Directory where the file will be saved
        
        // Check if the directory exists, if not, create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $target_file = $target_dir . basename($_FILES["profile_image_file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["profile_image_file"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES["profile_image_file"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["profile_image_file"]["tmp_name"], $target_file)) {
                $profile_image = $target_file; // Use the file path as the profile image URL
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update query - modify according to your table structure
    $sql = "UPDATE data_user SET username=?, description=?, instagram=?, twitter=?, youtube=?, profile_image=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("sssssss", $new_username, $description, $instagram, $twitter, $youtube, $profile_image, $old_username);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
        // Update session username if the username was changed
        $_SESSION['username'] = $new_username;
        // Redirect back to the previous page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>