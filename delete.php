<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_no = $_POST['roll_no'];

    $conn = new mysqli("localhost", "root", "root@123", "wt");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM students WHERE roll_no = ?");
    $stmt->bind_param("s", $roll_no);

    if ($stmt->execute()) {
        echo "Mentee deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
