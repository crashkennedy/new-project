<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "omos_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadDirectory = 'uploads/';
    $filePath = $uploadDirectory . basename($file['name']);
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $fileName = basename($file['name']);
    $fileSize = $file['size'];

    // Check if file type is allowed
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'txt'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC, DOCX, & TXT files are allowed.";
        exit;
    }

    // Move the file to the uploads directory
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Insert file info into database
        $sql = "INSERT INTO uploads (file_name, file_type, file_size) VALUES ('$fileName', '$fileType', $fileSize)";

        if ($conn->query($sql) === TRUE) {
            echo "Prescription file has been sent, We will get back to you shortly!.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
