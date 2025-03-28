<?php
$servername = "localhost";
$username = "root";
$password = "root@123";
$dbname = "mentee_db";

// Create connection
$conn = new mysqli_connect($localhost, $root, $root123, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS mentees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    rollno VARCHAR(50),
    address TEXT,
    emailid VARCHAR(100),
    phone_no VARCHAR(15)
)";
$conn->query($sql);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $rollno = $_POST['rollno'];
        $address = $_POST['address'];
        $emailid = $_POST['emailid'];
        $phone_no = $_POST['phone_no'];
        
        $sql = "INSERT INTO mentees (name, rollno, address, emailid, phone_no) VALUES ('$name', '$rollno', '$address', '$emailid', '$phone_no')";
        $conn->query($sql);
    }
    elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $rollno = $_POST['rollno'];
        $address = $_POST['address'];
        $emailid = $_POST['emailid'];
        $phone_no = $_POST['phone_no'];
        
        $sql = "UPDATE mentees SET name='$name', rollno='$rollno', address='$address', emailid='$emailid', phone_no='$phone_no' WHERE id=$id";
        $conn->query($sql);
    }
    elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM mentees WHERE id=$id";
        $conn->query($sql);
    }
}

// Fetch mentees
$mentees = $conn->query("SELECT * FROM mentees");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mentee Management</title>
</head>
<body>
    <h2>Mentee Form</h2>
    <table border="1">
        <form method="post">
            <input type="hidden" name="id" id="id">
            <tr><td><label>Name:</label></td><td><input type="text" name="name" id="name" required></td></tr>
            <tr><td><label>Roll No:</label></td><td><input type="text" name="rollno" id="rollno" required></td></tr>
            <tr><td><label>Address:</label></td><td><input type="text" name="address" id="address" required></td></tr>
            <tr><td><label>Email ID:</label></td><td><input type="email" name="emailid" id="emailid" required></td></tr>
            <tr><td><label>Phone No:</label></td><td><input type="text" name="phone_no" id="phone_no" required></td></tr>
            <tr><td colspan="2">
                <button type="submit" name="add">Add Mentee</button>
                <button type="submit" name="update">Update Mentee</button>
            </td></tr>
        </form>
    </table>

    <h2>Mentee List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Address</th>
            <th>Email ID</th>
            <th>Phone No</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $mentees->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['rollno']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['emailid']; ?></td>
            <td><?php echo $row['phone_no']; ?></td>
            <td>
                <button onclick="editMentee(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['rollno']; ?>', '<?php echo $row['address']; ?>', '<?php echo $row['emailid']; ?>', '<?php echo $row['phone_no']; ?>')">Edit</button>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

    <script>
        function editMentee(id, name, rollno, address, emailid, phone_no) {
            document.getElementById('id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('rollno').value = rollno;
            document.getElementById('address').value = address;
            document.getElementById('emailid').value = emailid;
            document.getElementById('phone_no').value = phone_no;
        }
    </script>
</body>
</html>
<?php
$conn->close();
?>
