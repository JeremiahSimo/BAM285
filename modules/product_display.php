<?php
include "includes/connection.php";

// Handle Edit Operation
if (isset($_POST['edit_submit'])) {
    $edit_id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_price = $_POST['edit_price'];
    $edit_quantity = $_POST['edit_quantity'];

    $update_query = "UPDATE product_inventory SET 
                        product_name = '$edit_name', 
                        product_price = '$edit_price', 
                        product_quantity = '$edit_quantity' 
                     WHERE product_id = $edit_id";

    if ($conn->query($update_query) === TRUE) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Product Updated',
                    text: 'The product details have been updated successfully.',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location='index_admin.php?page=product_inventory_display';
                });
              </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle Delete Operation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $delete_query = "DELETE FROM product_inventory WHERE product_id = $delete_id";
    if ($conn->query($delete_query) === TRUE) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Product Deleted',
                    text: 'The product has been deleted successfully.',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location='index_admin.php?page=product_inventory_display';
                });
              </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch products
$query = "SELECT * FROM product_inventory";
$result = $conn->query($query) or die($conn->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inventory Display</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Product Inventory</h2>
        <table class="table table-striped table-bordered mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['product_price']; ?></td>
                    <td><?php echo $row['product_quantity']; ?></td>
                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal<?php echo $row['product_id']; ?>">
                            EDIT
                        </button>

                        <!-- Delete Button with SweetAlert2 -->
                        <a href="#" 
                            class="btn btn-danger btn-sm" 
                            onclick="event.preventDefault(); 
                                     Swal.fire({
                                         title: 'Are you sure?',
                                         text: 'You won\'t be able to revert this!',
                                         icon: 'warning',
                                         showCancelButton: true,
                                         confirmButtonText: 'Yes, delete it!',
                                         cancelButtonText: 'No, cancel'
                                     }).then((result) => {
                                         if (result.isConfirmed) {
                                             window.location.href = 'index_admin.php?page=product_inventory_display&delete_id=<?php echo $row['product_id']; ?>';
                                         }
                                     });">
                            DELETE
                        </a>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $row['product_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="index_admin.php?page=product_inventory_display">
                                <div class="modal-body">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['product_id']; ?>">
                                    <div class="mb-3">
                                        <label for="editName" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="editName" name="edit_name" value="<?php echo $row['product_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPrice" class="form-label">Price</label>
                                        <input type="number" class="form-control" id="editPrice" name="edit_price" value="<?php echo $row['product_price']; ?>" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editQuantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="editQuantity" name="edit_quantity" value="<?php echo $row['product_quantity']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="edit_submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="path/to/bootstrap.bundle.js"></script>
</body>
</html>
