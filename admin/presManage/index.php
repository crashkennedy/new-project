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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $sql = "SELECT file_name FROM uploads WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $file = $result->fetch_assoc();

    if ($file) {
        $file_path = 'uploads/' . $file['file_name'];
        if (file_exists($file_path)) {
            unlink($file_path);  // Delete the file from the server
        }

        $sql = "DELETE FROM uploads WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
    }
}

$sql = "SELECT id, file_name, file_type, file_size, upload_time FROM uploads";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Uploaded Files</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 90%;
    margin: 20px auto;
}

h2 {
    margin-bottom: 20px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 20px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

a {
    color: #4CAF50;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

button {
    background-color: #d9534f;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background-color: #c9302c;
}

form {
    display: inline;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Prescriptions</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>File Name</th>
                <th>File Type</th>
                <th>File Size (bytes)</th>
                <th>Upload Time</th>
                <th>Download</th>
                <th>Delete</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['file_name']}</td>
                            <td>{$row['file_type']}</td>
                            <td>{$row['file_size']}</td>
                            <td>{$row['upload_time']}</td>
                            <td><a href='download.php?file_name={$row['file_name']}'>Download</a></td>
                            <td>
                                <form method='POST' onsubmit='return confirm(\"Are you sure you want to delete this file?\");'>
                                    <input type='hidden' name='delete_id' value='{$row['id']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No records found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <script>
                document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    const confirmDelete = confirm('Are you sure you want to delete this file?');
                    if (!confirmDelete) {
                        e.preventDefault();
                    }
                });
            });
        });
        </script>
    </div>
</body>
</html>
