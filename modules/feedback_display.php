<?php
include 'includes/connection.php';

// Handle the delete action
if (isset($_POST['btn_delete'])) {
    $delete_id = $_POST['delete_record_id']; // Make sure this matches the name in the form

    // Soft delete by updating a "delete_status" field
    $delete_query = "UPDATE feedback SET `delete_status` = 1 WHERE `id` = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='index_admin.php?page=feedback_display';</script>";
    } else {
        echo "<script>alert('Error deleting record!');</script>";
    }
    $stmt->close();
}

// Handle the update action
if (isset($_POST['submit_feedback'])) {
    $id = $_POST['id']; // Get the ID of the record being edited
    $good_at = $_POST['good_at'];
    $overall_feedback = $_POST['overall_feedback'];
    $date_submitted = $_POST['date_submitted']; // Get the new date

    // Prepare SQL query to update feedback, excluding the student_id
    $update_query = "UPDATE feedback SET good_at = ?, overall_feedback = ?, date_submitted = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);

    // Bind the parameters (excluding student_id)
    $stmt->bind_param("sssi", $good_at, $overall_feedback, $date_submitted, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Feedback updated successfully!'); window.location.href='index_admin.php?page=feedback_display';</script>";
    } else {
        echo "<script>alert('Error updating record!');</script>";
    }

    $stmt->close();
}


// Fetch non-deleted records
$query = "SELECT a.full_name, b.* FROM children AS a INNER JOIN feedback AS b ON b.student_id = a.id WHERE b.delete_status = 0";
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
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['good_at']; ?></td>
            <td><?php echo $row['overall_feedback']; ?></td>
            <td><?php echo $row['date_submitted']; ?></td>
            <td>
                <!-- Edit button triggers modal -->
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editModal" 
                   data-id="<?php echo $row['id']; ?>"
                   data-fullname="<?php echo $row['full_name']; ?>"
                   data-goodat="<?php echo $row['good_at']; ?>"
                   data-feedback="<?php echo $row['overall_feedback']; ?>"
                   data-datesubmitted="<?php echo $row['date_submitted']; ?>">EDIT</a>
            </td>
            <td>
                <!-- Delete Form -->
                <form method="POST" action="" onsubmit="return confirmDelete(this);" style="display:inline;">
                    <input type="hidden" name="delete_record_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="btn_delete" class="btn btn-danger">DELETE</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
          <div class="form-group">
            <label for="studentName">Full Name</label>
            <input type="text" class="form-control" id="studentName" disabled>
          </div>
          <div class="form-group">
            <label for="goodAt">Good At</label>
            <input type="text" class="form-control" id="goodAt" name="good_at">
          </div>
          <div class="form-group">
            <label for="feedback">Overall Feedback</label>
            <textarea class="form-control" id="feedback" name="overall_feedback"></textarea>
          </div>
          <div class="form-group">
            <label for="dateSubmitted">Date Submitted</label>
            <input type="date" class="form-control" id="dateSubmitted" name="date_submitted">
          </div>
          <input type="hidden" id="studentId" name="student_id">
          <input type="hidden" id="recordId" name="id">
          <div class="form-group">
            <button type="submit" name="submit_feedback" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS (make sure this is after jQuery) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    // Populate modal with data when Edit button is clicked
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // The button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var fullname = button.data('fullname');
        var goodat = button.data('goodat');
        var feedback = button.data('feedback');
        var datesubmitted = button.data('datesubmitted');

        // Convert date_submitted to YYYY-MM-DD format
        var formattedDate = new Date(datesubmitted).toISOString().split('T')[0];

        // Populate the modal with data
        var modal = $(this);
        modal.find('#studentName').val(fullname);
        modal.find('#goodAt').val(goodat);
        modal.find('#feedback').val(feedback);
        modal.find('#dateSubmitted').val(formattedDate); // Set formatted date
        modal.find('#studentId').val(button.data('studentid')); // Set the student ID
        modal.find('#recordId').val(id); // Set the record ID
    });

    // Function to confirm delete
    function confirmDelete(form) {
        if (confirm("Are you sure you want to delete this record?")) {
            form.submit(); // Submit the form if the user confirms
        } else {
            console.log("Delete action canceled.");
        }
    }
</script>
