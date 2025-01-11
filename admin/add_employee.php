<?php
include 'connection.php'; // Include database connection

function addEmployee($name, $department, $email, $password, $con) {
    $password = md5($password); // Encrypt the password
    $query = "INSERT INTO users (name, department, email, password) VALUES ('$name', '$department', '$email', '$password')";
    return mysqli_query($con, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (addEmployee($name, $department, $email, $password, $con)) {
        echo "<script>alert('Employee added successfully!'); window.location.href = 'index_admin.php?page=add_employee';</script>";
    } else {
        echo "<script>alert('Failed to add employee.');</script>";
    }
}
?>


    <title>Add Employee</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title text-center">Add Employee</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select name="department" id="department" class="form-select" required>
                                <option value="Project Management">Project Manager</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Development">Developer</option>
                                <option value="Design">Front End Developer</option>
                                <option value="Business Analysis">Business Analyst</option>
                                <option value="Technical Support">Technical Support</option>
                                <option value="Development">Back End Developer</option>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Add Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

