<?php
include "includes/connection.php";

// Handle Delete Operation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM student_registration WHERE student_id = $delete_id";
    if ($conn->query($delete_query) === TRUE) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Record deleted successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location='index_admin.php?page=student_registration_display';
                });
              </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle Edit Operation
if (isset($_POST['edit_submit'])) {
    $edit_id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_email = $_POST['edit_email'];
    $edit_course = $_POST['edit_course'];

    $update_query = "UPDATE student_registration SET 
                        student_name = '$edit_name', 
                        student_email = '$edit_email', 
                        student_course = '$edit_course' 
                     WHERE student_id = $edit_id";

    if ($conn->query($update_query) === TRUE) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Record updated successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location='index_admin.php?page=student_registration_display';
                });
              </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch all students from the database
$query = "SELECT * FROM student_registration";
$result = $conn->query($query) or die($conn->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Display</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Update with your Bootstrap path -->
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Registered Students</h2>
        <table class="table table-striped table-bordered mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['student_id']; ?></td>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><?php echo $row['student_email']; ?></td>
                    <td><?php echo $row['student_course']; ?></td>
                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal<?php echo $row['student_id']; ?>"
                                onclick="showEditAlert(<?php echo $row['student_id']; ?>)">
                            EDIT
                        </button>

                        <!-- Delete Button with SweetAlert2 -->
                        <a href="index_admin.php?page=student_registration_display&delete_id=<?php echo $row['student_id']; ?>" 
                            class="btn btn-danger btn-sm" 
                            onclick="event.preventDefault(); 
                                     Swal.fire({
                                         title: 'Are you sure?',
                                         text: 'This will delete the student record!',
                                         icon: 'warning',
                                         showCancelButton: true,
                                         confirmButtonText: 'Yes, delete it!',
                                         cancelButtonText: 'No, keep it'
                                     }).then((result) => {
                                         if (result.isConfirmed) {
                                             window.location.href = 'index_admin.php?page=student_registration_display&delete_id=<?php echo $row['student_id']; ?>';
                                         }
                                     });">
                            DELETE
                        </a>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $row['student_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="row g-3" method="POST" action="index_admin.php?page=student_registration_display">
                                <div class="modal-body">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['student_id']; ?>">
                                    <div class="mb-3">
                                        <label for="editName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="editName" name="edit_name" value="<?php echo $row['student_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="editEmail" name="edit_email" value="<?php echo $row['student_email']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editCourse" class="form-label">Course</label>
                                        <input type="text" class="form-control" id="editCourse" name="edit_course" value="<?php echo $row['student_course']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="edit_submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="path/to/bootstrap.bundle.js"></script> <!-- Update with your Bootstrap JS path -->

    <!-- SweetAlert2 Custom Edit Alert -->
    <script>
        function showEditAlert(studentId) {
            Swal.fire({
                title: 'Edit Student',
                text: 'You are about to edit the details of student ID ' + studentId,
                icon: 'info',
                showConfirmButton: true,
            });
        }
    </script>
</body>
</html>
