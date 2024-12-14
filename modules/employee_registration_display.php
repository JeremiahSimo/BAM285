<?php
include "includes/connection.php";

$query = "SELECT * FROM employee_registration";
$result = $conn->query($query) or die($conn->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration Display</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Update with your Bootstrap path -->
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Registered Employees</h2>
        <table class="table table-striped table-bordered mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['employee_id']; ?></td>
                    <td><?php echo $row['employee_name']; ?></td>
                    <td><?php echo $row['employee_email']; ?></td>
                    <td><?php echo $row['employee_position']; ?></td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm">EDIT</button>
                        <button type="button" class="btn btn-danger btn-sm">DELETE</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
