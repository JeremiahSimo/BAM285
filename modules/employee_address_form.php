<?php
 include "connection1.php";

 if(isset($_POST["btn_submit"])){
    $name=$_POST["input_fullname"];
    $email=$_POST["input_email"];
    $address=$_POST["input_st.address"];
    $city=$_POST["input_city"];
    $zip=$_POST["input_zip"];

    $sql = "INSERT INTO employees (user_name, user_email, user_st.address, user_city, user_zip)
VALUES ('$name', '$email', '$address', '$city', '$zip')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 }

?>




<h5 class="card-title">Employee Address Form</h5>


    <form class="row g-3" method="POST" action="index_admin.php?page=employee_address_form">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" name="input_fullname"placeholder="Employee Name">
                    <label for="floatingName">Employee Name:</label>
                  </div>
                </div>


    <div class="col-md-10">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="floatingEmail" name="input_email"placeholder="Email">
                    <label for="floatingEmail">Email:</label>
                  </div>
                </div>


    

    <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingAddress" name="input_st.address"placeholder="Street Address">
                    <label for="floatingAddress">Street Address:</label>
                  </div>
                </div>



    <div class="col-md-6">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingCity" name="input_city"placeholder="City">
                      <label for="floatingCity">City</label>
                    </div>
                  </div>
                </div>




    <div class="col-md-2">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingZip" name="input_zip"placeholder="Zip Code">
                    <label for="floatingZip">Zip Code</label>
                  </div>
                </div>


                <div class="text-center">
                  <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>

