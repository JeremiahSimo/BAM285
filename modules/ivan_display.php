<?php
// Start the session to handle any session data (if required)


// Include database connection
include "includes/connection.php";  // Database connection file (adjust path as needed)

// Query to fetch all employees
$sql_select = "SELECT * FROM ivan_form";
$result_select = $conn->query($sql_select);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Records</title>
    <style>
        /* Your existing styles (unchanged) */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        footer {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 30px;
            padding: 20px 0;
            width: 100%;
            background-color: #f1f1f1;
        }

        footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
                width: 90%;
            }
            table th, table td {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Employee Records</h2>

        <!-- Display the employee records if any are found -->
        <?php if ($result_select->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Date of Joining</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result_select->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                            <td><?php echo htmlspecialchars($row['position']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_of_joining']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No employee records found.</p>
        <?php endif; ?>
    </div>

    <!-- Footer with copyright and design credits -->
    <footer>
        <p>&copy; 2024 Copyright NiceAdmin. All Rights Reserved. | Designed by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a></p>
    </footer>

</body>
</html>
