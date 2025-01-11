<?php
include 'connection.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect POST data
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $department = trim($_POST['department']);
    $email = trim($_POST['email']);

    // Validate inputs
    if (empty($id) || empty($name) || empty($department) || empty($email)) {
        echo '<div class="alert alert-danger" role="alert">
                All fields are required. Redirecting...
              </div>';
        header("refresh:1;url=index_admin.php?page=view_employee");
        exit;
    }

    // Start transaction
    mysqli_begin_transaction($con);

    try {
        // Update query for `users` table
        $queryUsers = "UPDATE users SET name = ?, department = ?, email = ? WHERE id = ?";
        $stmtUsers = mysqli_prepare($con, $queryUsers);

        if ($stmtUsers) {
            mysqli_stmt_bind_param($stmtUsers, "sssi", $name, $department, $email, $id);
            mysqli_stmt_execute($stmtUsers);
            mysqli_stmt_close($stmtUsers);
        } else {
            throw new Exception("Failed to prepare statement for updating users.");
        }

        // Update query for `leaves` table
        $queryLeaves = "UPDATE leaves SET name = ?, department = ?, email = ? WHERE email = (
                            SELECT email FROM users WHERE id = ?
                        )";
        $stmtLeaves = mysqli_prepare($con, $queryLeaves);

        if ($stmtLeaves) {
            mysqli_stmt_bind_param($stmtLeaves, "sssi", $name, $department, $email, $id);
            mysqli_stmt_execute($stmtLeaves);
            mysqli_stmt_close($stmtLeaves);
        } else {
            throw new Exception("Failed to prepare statement for updating leaves.");
        }

        // Commit transaction
        mysqli_commit($con);

        // Success message and redirect
        echo '<div class="alert alert-success" role="alert">
                Employee and leave records updated successfully! Redirecting...
              </div>';
        header("refresh:1;url=index_admin.php?page=view_employee");
        exit;
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($con);

        // Error message and redirect
        echo '<div class="alert alert-danger" role="alert">
                Error updating records: ' . $e->getMessage() . '. Redirecting...
              </div>';
        header("refresh:1;url=index_admin.php?page=view_employee");
        exit;
    }
}

// Close the database connection
mysqli_close($con);
?>
