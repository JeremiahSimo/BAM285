<?php
include 'connection.php'; // Include the database connection

// Fetch employees' names and emails
$queryUsers = "SELECT name, email FROM users";
$resultUsers = mysqli_query($con, $queryUsers);

// Handle leave application submission
if (isset($_POST['apply'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $leavedate = $_POST['leavedate'];
    $reason = $_POST['leavereason'];
    $status = 0; // Default status is pending

    $sql = "INSERT INTO leaves (name, email, department, leavedate, leavereason, status) 
            VALUES ('$name', '$email', '$department', '$leavedate', '$reason', '$status')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Leave Applied Successfully'); window.location.href='index_admin.php?page=apply_leave';</script>";
    } else {
        echo "<script>alert('Error Applying Leave');</script>";
    }
}
?>


<title>Apply Leave</title>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Apply Leave</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <select name="name" class="form-control" required>
                                <option value="">-- Select Name --</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($resultUsers)) {
                                    echo "<option value='{$row['name']}'>{$row['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <select name="email" class="form-control" required>
                                <option value="">-- Select Email --</option>
                                <?php
                                mysqli_data_seek($resultUsers, 0); // Reset pointer for the second use
                                while ($row = mysqli_fetch_assoc($resultUsers)) {
                                    echo "<option value='{$row['email']}'>{$row['email']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <select name="department" class="form-control" required>
                                <option value="Project Management">Project Manager</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Development">Developer</option>
                                <option value="Design">Front End Developer</option>
                                <option value="Business Analysis">Business Analyst</option>
                                <option value="Technical Support">Technical Support</option>
                                <option value="Development">Back End Developer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Leave Date</label>
                            <input type="date" name="leavedate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Reason For Leave</label>
                            <select name="leavereason" class="form-control" required>
                                <option value="">-- Select Reason --</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Vacation">Vacation</option>
                                <option value="Personal Reasons">Personal Reasons</option>
                                <option value="Family Emergency">Family Emergency</option>
                                <option value="Bereavement">Bereavement</option>
                                <option value="Maternity/Paternity Leave">Maternity/Paternity Leave</option>
                                <option value="Medical Appointment">Medical Appointment</option>
                                <option value="Training or Education">Training or Education</option>
                                <option value="Relocation">Relocation</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <button type="submit" name="apply" class="btn btn-success btn-block">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
