<?php
include "includes/connection.php";

if (isset($_POST["btn_submit"])) {
    $name = $_POST["input_fullname"];
    $email = $_POST["input_email"];
    $address = $_POST["input_st_address"];
    $city = $_POST["input_city"];
    $zip = $_POST["input_zip"];

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO employees (user_name, user_email, user_st.address, user_city, user_zip) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $address, $city, $zip);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>





<h5 class="card-title">Employee Address Form</h5>

<form class="row g-3" method="POST" action="index_admin.php?page=employee_address_form">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingName" name="input_fullname" placeholder="Employee Name">
            <label for="floatingName">Employee Name:</label>
        </div>
    </div>

    <div class="col-md-10">
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingEmail" name="input_email" placeholder="Email">
            <label for="floatingEmail">Email:</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingAddress" name="input_st_address" placeholder="Street Address">
            <label for="floatingAddress">Street Address:</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingCity" name="input_city" placeholder="City">
            <label for="floatingCity">City:</label>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingZip" name="input_zip" placeholder="Zip Code">
            <label for="floatingZip">Zip Code:</label>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>
