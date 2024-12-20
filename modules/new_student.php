<?php
include 'includes/connection.php';

$query = "SELECT * FROM `students`";



$result = $conn->query($query) or die($conn->error);


?>


<table class="table datatable">
                <thead>
                  <tr>
                  <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    
                    <th>Program </th>
                    <th>Level</th>
                    <th>Specialization</th>
                    <th>Created Date</th>
                    <th colspan=2>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()):	?>
                  <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['number']; ?></td>
                  <td><?php echo $row['program']; ?></td>
                  <td><?php echo $row['level']; ?></td>
                  <td><?php echo $row['specialization']; ?></td>
                  <td><?php echo $row['created_at']; ?></td>
                 <td>
                    <button type="button" class="btn btn-warning">EDIT</button>
                    <button type="button" class="btn btn-danger">DELETE</button>
                 </td>
                    
                  </tr>
              <?php endwhile; ?>
                </tbody>
              </table>