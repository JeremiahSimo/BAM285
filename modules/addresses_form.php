<?php
include 'connection1.php';

$query = "SELECT * FROM `employees`";



$result = $conn->query($query) or die($conn->error);


?>


<table class="table datatable">
                <thead>
                  <tr>
                  <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    
                    <th>St. Address</th>
                    <th>City</th>
                    <th>Zip Code</th>
                    <th colspan=2>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()):	?>
                  <tr>
                  <td><?php echo $row['user_id']; ?></td>
                  <td><?php echo $row['user_name']; ?></td>
                  <td><?php echo $row['user_email']; ?></td>
                  <td><?php echo $row['user_st.address']; ?></td>
                  <td><?php echo $row['user_city']; ?></td>
                  <td><?php echo $row['user_zip']; ?></td>
                 <td>
                    <button type="button" class="btn btn-warning">EDIT</button>
                    <button type="button" class="btn btn-danger">DELETE</button>
                 </td>
                    
                  </tr>
              <?php endwhile; ?>
                </tbody>
              </table>