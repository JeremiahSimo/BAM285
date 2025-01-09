<?php
include 'includes/connection.php';

// Handle the delete action
if (isset($_POST['btn_delete'])) {
    $delete_id = $_POST['delete_record_id'];

    // Soft delete by updating a "delete_status" field
    $delete_query = "UPDATE `feedback` SET `delete_status` = 1 WHERE `id` = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='index.php?page=attendance';</script>";
    } else {
        echo "<script>alert('Error deleting record!');</script>";
    }
    $stmt->close();
}

// Fetch non-deleted records
$query = "SELECT * FROM `feedback` WHERE `delete_status` = 0";
$result = $conn->query($query) or die($conn->error);

?>

<table class="table datatable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Child ID</th>
            <th>Good At</th>
            <th>Overall Feedback</th>
            <th>Date Submitted</th>
            <th colspan=2>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['student_name']; ?></td>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['good_at']; ?></td>
            <td><?php echo $row['overall_feedback']; ?></td>
            <td><?php echo $row['date_submitted']; ?></td>
            <td>
                <!-- Edit button redirects to an edit form -->
                <a href="edit_attendance.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">EDIT</a>
            </td>
            <td>
                <!-- Delete button triggers a confirmation -->
                <form method="POST" action="index.php?page=attendance" onsubmit="return confirmDelete();">
                    <input type="hidden" name="delete_record_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="btn_delete" class="btn btn-danger">DELETE</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
}
</script>
