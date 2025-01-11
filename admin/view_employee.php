<?php
include 'connection.php'; // Include the database connection

// Function to fetch all employees
function getAllEmployees($con) {
    $query = "SELECT * FROM users";
    $result = mysqli_query($con, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
// Function to add a new employee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_employee'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hash the password using MD5

    $query = "INSERT INTO users (name, department, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $department, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('New employee added successfully!'); window.location.href='index_admin.php?page=view_employee';</script>";
    } else {
        echo "<script>alert('Error adding employee: " . mysqli_error($con) . "');</script>";
    }
}
?>

<title>View Employees</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Employees List</h4>
                    <!-- Add Employee Button -->
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        <i class="fas fa-plus"></i> Add Employee
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $employees = getAllEmployees($con); // Fetch all employees
                            $cnt = 1;
                            foreach ($employees as $employee) {
                                echo "<tr>
                                <td>{$cnt}</td>
                                <td>{$employee['name']}</td>
                                <td>{$employee['department']}</td>
                                <td>{$employee['email']}</td>
                                <td class='text-center'>
                                    <div class='d-flex justify-content-center gap-2'>
                                        <a href='index_admin.php?page=view_employee_details&employee_id=" . $employee['id'] . "' 
                                        class='btn btn-info btn-sm'>
                                            <i class='fas fa-eye'></i> View
                                        </a>

                                        <a href='#' 
                                           data-bs-toggle='modal' 
                                           data-bs-target='#editModal" . $employee['id'] . "' 
                                           class='btn btn-warning btn-sm'>
                                            <i class='fas fa-edit'></i> Edit
                                        </a>
                                        <a href='delete.php?delete_id=" . $employee['id'] . "' 
                                           onclick=\"return confirm('Are you sure you want to delete this employee?')\" 
                                           class='btn btn-danger btn-sm'>
                                            <i class='fas fa-trash'></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>";

                                // Edit Modal
                                echo "<div class='modal fade' id='editModal{$employee['id']}' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='editModalLabel'>Edit Employee</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <form method='POST' action='edit_employee.php'>
                                            <div class='modal-body'>
                                                <input type='hidden' name='id' value='{$employee['id']}'>
                                                <div class='mb-3'>
                                                    <label for='name{$employee['id']}' class='form-label'>Name</label>
                                                    <input type='text' class='form-control' id='name{$employee['id']}' name='name' value='{$employee['name']}' required>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='department{$employee['id']}' class='form-label'>Department</label>
                                                    <select class='form-control' id='department{$employee['id']}' name='department' required>
                                                        <option value=''>-- Select Department --</option>
                                                        <option value='Project Management' " . ($employee['department'] === 'Project Management' ? 'selected' : '') . ">Project Management</option>
                                                        <option value='Marketing' " . ($employee['department'] === 'Marketing' ? 'selected' : '') . ">Marketing</option>
                                                        <option value='Development' " . ($employee['department'] === 'Development' ? 'selected' : '') . ">Development</option>
                                                        <option value='Design' " . ($employee['department'] === 'Design' ? 'selected' : '') . ">Design</option>
                                                        <option value='Business Analysis' " . ($employee['department'] === 'Business Analysis' ? 'selected' : '') . ">Business Analysis</option>
                                                        <option value='Technical Support' " . ($employee['department'] === 'Technical Support' ? 'selected' : '') . ">Technical Support</option>
                                                    </select>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='email{$employee['id']}' class='form-label'>Email</label>
                                                    <input type='email' class='form-control' id='email{$employee['id']}' name='email' value='{$employee['email']}' required>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                <button type='submit' class='btn btn-primary'>Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>";
                                $cnt++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-control" id="department" name="department" required>
                            <option value="">-- Select Department --</option>
                            <option value="Project Management">Project Management</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Development">Development</option>
                            <option value="Design">Design</option>
                            <option value="Business Analysis">Business Analysis</option>
                            <option value="Technical Support">Technical Support</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add_employee" class="btn btn-success">Add Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<?php
// Close the database connection after all operations are completed
mysqli_close($con);
?>
