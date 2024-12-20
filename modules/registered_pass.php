<?php
include 'includes/connection.php';

$query = "SELECT * FROM `applications`";



$result = $conn->query($query) or die($conn->error);


?>


<table class="table datatable">
                <thead>
                  <tr>
                  <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    
                    <th>Birth Date</th>
                    <th>Passport Type</th>
                    <th>Created Date</th>
                    <th colspan=2>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()):	?>
                  <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['first_name']; ?></td>
                  <td><?php echo $row['last_name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['birth_date']; ?></td>
                  <td><?php echo $row['passport_type']; ?></td>
                  <!-- <td><?php echo $row['created_at']; ?></td> -->
                 <td>
                    <button type="button" class="btn btn-warning">EDIT</button>
                    <button type="button" class="btn btn-danger">DELETE</button>
                 </td>
                    
                  </tr>
              <?php endwhile; ?>
                </tbody>
              </table>