<?php
include 'includes/connection.php';

$query = "SELECT * FROM `user_registration`";



$result = $conn->query($query) or die($conn->error);


?>


<table class="table datatable">
                <thead>
                  <tr>
                  <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    
                    <th>address</th>
                    <th colspan=2>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()):	?>
                  <tr>
                  <td><?php echo $row['user_id']; ?></td>
                  <td><?php echo $row['user_name']; ?></td>
                  <td><?php echo $row['user_email']; ?></td>
                  <td><?php echo $row['user_address']; ?></td>
                 <td>
                    <button type="button" class="btn btn-warning">EDIT</button>
                    <button type="button" class="btn btn-danger">DELETE</button>
                 </td>
                    
                  </tr>
              <?php endwhile; ?>
                </tbody>
              </table>