<?php
 include "includes/connection.php";

 if(isset($_POST["btn_submit"])){
    $name=$_POST["input_fullname"];
    $email=$_POST["input_email"];
    $address=$_POST["input_address"];

    $sql = "INSERT INTO user_registration (user_name, user_email, user_address)
VALUES (' $name', '$email', '$address')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 }

?>
             
             
             <h5 class="card-title">Subject Form</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="POST" action="index_admin.php?page=registration_form">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" name="input_fullname"placeholder="Your Name">
                    <label for="floatingName">Sucject Name</label>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="floatingEmail" name="input_email"placeholder="Your Email">
                    <label for="floatingEmail">Subject Code</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="floatingTextarea" name="input_address" style="height: 100px;"></textarea>
                    <label for="floatingTextarea">Subject Instructor</label>
                  </div>
                </div>
              </form><!-- End floating Labels Form -->

       