
 <?php
 // Include the database connection file
 include "includes/connection.php";
 
 // Initialize form data variables
 $fullname = $email = $age = $address = $city = $state = $zip = $course = "";
 
 // Check if the form is submitted
 if (isset($_POST["btn_submit"])) {
     // Sanitize and retrieve form data
     $fullname = mysqli_real_escape_string($conn, $_POST["input_fullname"]);
     $email = mysqli_real_escape_string($conn, $_POST["input_email"]);
     $age = mysqli_real_escape_string($conn, $_POST["input_age"]);
     $address = mysqli_real_escape_string($conn, $_POST["input_address"]);
     $city = mysqli_real_escape_string($conn, $_POST["input_city"]);
     $state = mysqli_real_escape_string($conn, $_POST["input_state"]);
     $zip = mysqli_real_escape_string($conn, $_POST["input_zip"]);
     $course = mysqli_real_escape_string($conn, $_POST["input_course"]);
 
     // SQL query to insert data into the student_registration table
     $sql = "INSERT INTO student_registration (fullname, age, email, address, city, state, zip, course)
             VALUES ('$fullname', '$age', '$email', '$address', '$city', '$state', '$zip', '$course')";
 
     // Execute the query and check if the data was inserted successfully
     if ($conn->query($sql) === TRUE) {
         echo "Student registered successfully!";
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }
 
     // Close the database connection
     $conn->close();
 }
 ?>
             
             
             <h5 class="card-title">Registration Form</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="POST" action="index_admin.php?page=registration_form">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" name="input_fullname"placeholder="Your Name">
                    <label for="floatingName">Your Name</label>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="floatingEmail" name="input_email"placeholder="Your Email">
                    <label for="floatingEmail">Your Email</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="floatingTextarea" name="input_address" style="height: 100px;"></textarea>
                    <label for="floatingTextarea">Address</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingCity" placeholder="City">
                      <label for="floatingCity">City</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="State">
                      <option selected>New York</option>
                      <option value="1">Oregon</option>
                      <option value="2">DC</option>
                    </select>
                    <label for="floatingSelect">State</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingZip" placeholder="Zip">
                    <label for="floatingZip">Zip</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

       