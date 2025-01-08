<?php
include 'includes/connection.php';


if(isset($_POST["btn_delete"])){
  $delete_id=$_POST['delete_user_id'];

  $delete_query = "UPDATE `user_registration` SET `delete_status`=1 WHERE  user_id=$delete_id";



$result = $conn->query($delete_query) or die($conn->error);
}

$query = "SELECT * FROM `user_registration` WHERE delete_status=0";



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
                    <form method="POST" action="index_admin.php?page=display_members" onsubmit="return confirmDelete();">
                    <input type="hidden" name="delete_user_id" id="delete_user_id" value="<?php echo $row['user_id']; ?>">
                    <button type="submit" name="btn_delete" class="btn btn-danger">DELETE</button>
                   </form>
                 </td>
                    
                  </tr>
              <?php endwhile; ?>
                </tbody>
              </table>

              <script>
  function confirmDelete() {
    return confirm("Are you sure you want to delete this user?");
  }
</script>