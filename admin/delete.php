<?php
// Include the database connection
include 'connection.php';

// Check if the delete ID is provided
if (isset($_GET['delete_id'])) {
    // Sanitize the delete_id to prevent SQL injection
    $delete_id = intval($_GET['delete_id']);
    
    // Prepare the DELETE SQL query
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $con->prepare($query);

    if ($stmt) {
        // Bind the delete_id to the query
        $stmt->bind_param("i", $delete_id);

        // Execute the query
        if ($stmt->execute()) {
            // Success message
            echo "<script>
                    alert('User deleted successfully!');
                    window.location.href = 'index_admin.php?page=view_employee';
                  </script>";
        } else {
            // Failure message
            echo "<script>
                    alert('Failed to delete user. Please try again.');
                    window.location.href = 'index_admin.php?page=view_employee';
                  </script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error in preparing the statement
        echo "<script>
                alert('Error preparing the delete operation. Please try again.');
                window.location.href = 'index_admin.php?page=view_employee';
              </script>";
    }
} else {
    // Redirect if no delete_id is provided
    echo "<script>
            alert('No user selected for deletion.');
            window.location.href = 'index_admin.php?page=view_employee';
          </script>";
}

// Close the database connection
$con->close();
?>
