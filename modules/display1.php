<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forms_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch data from the reservation_form table
$sql = "SELECT * FROM reservation_form";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #5cb85c;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Reservation Records</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['rsv_id']; ?></td>
                        <td><?php echo $row['rsv_name']; ?></td>
                        <td><?php echo $row['rsv_email']; ?></td>
                        <td><?php echo $row['rsv_phone']; ?></td>
                        <td><?php echo $row['rsv_date']; ?></td>
                        <td><?php echo $row['rsv_time']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No reservations found.</p>
    <?php endif; ?>

    <?php
    // Close the database connection
    mysqli_close($conn);
    ?>

</body>
</html>
