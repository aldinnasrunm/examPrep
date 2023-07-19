<?php
require_once('conn.php');
// Starting the session
session_start();

$userid = $_SESSION['userid'];
$phd = "";

//check if user already login
if ($userid == null) {
    //if user not loged in, trow into login page
    header("Location: pages/login.php");
} else {
    // Assuming you already established the database connection somewhere else
    // $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Fixing SQL Injection vulnerability with prepared statement
    $query = mysqli_prepare($conn, "SELECT * FROM items");
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    // Fetching all rows from the result set into an associative array
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($rows as $index => $row) {
        // Incrementing the index correctly within parentheses
        $txt = '<tr class="">
                    <td scope="row">' . ($index + 1) . '</td>
                    <td>' . $row['item_id'] . '</td>
                    <td>' . $row['item_name'] . '</td>
                    <td>' . $row['price'] . '</td>
                    <td>' . $row['quantity'] . '</td>
                    <td><button type="button" class="btn btn-primary" name="edit">Edit</button><button type="button" class="btn btn-danger" name="delete">Delete</button></td>
                    
                </tr>';
        // inserting data into it
        $phd .= $txt;
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: pages/login.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title></title>
</head>

<body>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <form action="pages/logout.php" method="post">
            <button type="submit" class="btn btn-danger" name="logout">Logout</button>
        </form>
    </nav>

    <div class="contaner d-flex flex-column justify-content-center">
        <div class="container header">
            <h3 class="text-center">Gudang</h3>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, eos. Nihil ducimus, nostrum adipisci rem maiores praesentium error corrupti molestias voluptates beatae debitis quod. Ex ullam deleniti aspernatur eum maxime.</p>
        </div>
        <div class="container add-product">
            <h4 class="mb-3">Add New Item</h4>
            <form action="pages/add_item.php" method="post">
                <div class="mb-3">
                    <label for="item_name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" name="item_name" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" required>
                </div>
                <button type="submit" class="btn btn-success">Add</button>
            </form>
        </div>
        <div class="container list">
            <div class="table-responsive">
                <form action="" method="post">
                    <table class="table table-secondary">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">ID Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $phd; ?>
                        </tbody>
                    </table>
                </form>
            </div>

        </div>

    </div>


    <script src="js/bootstrap.min.js"></script>
    <script>
        // Add event listeners to the Edit buttons
        var editButtons = document.getElementsByName("edit");
        editButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                var row = event.target.closest("tr");
                var item_id = row.children[1].innerText;
                var item_name = row.children[2].innerText;
                var price = row.children[3].innerText;
                var quantity = row.children[4].innerText;

                // Prompt the user to enter new values for editing
                var new_item_name = prompt("Enter new item name:", item_name);
                var new_price = prompt("Enter new price:", price);
                var new_quantity = prompt("Enter new quantity:", quantity);

                // Create a hidden form and submit it to the edit_item.php script
                var form = document.createElement("form");
                form.method = "post";
                form.action = "pages/edit_item.php";
                form.style.display = "none";

                var itemIdInput = document.createElement("input");
                itemIdInput.type = "hidden";
                itemIdInput.name = "item_id";
                itemIdInput.value = item_id;
                form.appendChild(itemIdInput);

                var newItemNameInput = document.createElement("input");
                newItemNameInput.type = "hidden";
                newItemNameInput.name = "new_item_name";
                newItemNameInput.value = new_item_name;
                form.appendChild(newItemNameInput);

                var newPriceInput = document.createElement("input");
                newPriceInput.type = "hidden";
                newPriceInput.name = "new_price";
                newPriceInput.value = new_price;
                form.appendChild(newPriceInput);

                var newQuantityInput = document.createElement("input");
                newQuantityInput.type = "hidden";
                newQuantityInput.name = "new_quantity";
                newQuantityInput.value = new_quantity;
                form.appendChild(newQuantityInput);

                document.body.appendChild(form);
                form.submit();
            });
        });

        // Add event listeners to the Delete buttons
        var deleteButtons = document.getElementsByName("delete");
        deleteButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                var row = event.target.closest("tr");
                var item_id = row.children[1].innerText;

                // Create a hidden form and submit it to the delete_item.php script
                var form = document.createElement("form");
                form.method = "post";
                form.action = "pages/delete_item.php";
                form.style.display = "none";

                var itemIdInput = document.createElement("input");
                itemIdInput.type = "hidden";
                itemIdInput.name = "item_id";
                itemIdInput.value = item_id;
                form.appendChild(itemIdInput);

                document.body.appendChild(form);
                form.submit();
            });
        });
    </script>
</body>

</html>