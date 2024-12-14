<h5 class="card-title">Enrollment Form</h5>
<form class="row g-3">
  <div class="col-md-12">
    <label for="inputName" class="form-label">Full Name</label>
    <input type="text" class="form-control" id="inputName" placeholder="Enter your full name" required>
  </div>
  <div class="col-md-6">
    <label for="inputEmail" class="form-label">Email Address</label>
    <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email" required>
  </div>
  <div class="col-md-6">
    <label for="inputPhone" class="form-label">Phone Number</label>
    <input type="tel" class="form-control" id="inputPhone" placeholder="Enter your phone number" required>
  </div>
  <div class="col-md-6">
    <label for="inputDOB" class="form-label">Date of Birth</label>
    <input type="date" class="form-control" id="inputDOB" required>
  </div>
  <div class="col-md-6">
    <label for="inputCourse" class="form-label">Course of Enrollment</label>
    <select id="inputCourse" class="form-select" required>
      <option selected>Choose a course...</option>
      <option>BSIT</option>
      <option>BSCRIM</option>
      <option>BSED</option>
      <option>BSN</option>
      <option>BSHM</option>
      <option>BSTM</option>
    </select>
  </div>
  <div class="col-md-6">
    <label for="inputCountry" class="form-label">Country</label>
    <input type="text" class="form-control" id="inputCountry" placeholder="Enter your country" required>
  </div>
  <div class="col-md-6">
    <label for="inputState" class="form-label">State/Province</label>
    <input type="text" class="form-control" id="inputState" placeholder="Enter your state or province" required>
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">City</label>
    <input type="text" class="form-control" id="inputCity" placeholder="Enter your city" required>
  </div>
  <div class="col-md-6">
    <label for="inputZip" class="form-label">Zip Code</label>
    <input type="text" class="form-control" id="inputZip" placeholder="Enter your zip code" required>
  </div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="termsCheck" required>
      <label class="form-check-label" for="termsCheck">
        I agree to the terms and conditions
      </label>
    </div>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-primary">Enroll</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
  </div>
</form>
