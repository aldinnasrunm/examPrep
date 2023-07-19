<?php
require_once('../conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you already established the database connection somewhere else
    // $conn = mysqli_connect($servername, $username, $password, $dbname);

    $item_id = $_POST['item_id'];
    $new_item_name = $_POST['new_item_name'];
    $new_price = $_POST['new_price'];
    $new_quantity = $_POST['new_quantity'];

    $query = mysqli_prepare($conn, "UPDATE items SET item_name = ?, price = ?, quantity = ? WHERE item_id = ?");
    mysqli_stmt_bind_param($query, "sssi", $new_item_name, $new_price, $new_quantity, $item_id);
    mysqli_stmt_execute($query);

    // Redirect back to the main page or any other desired page
    header("Location: ../index.php");
    exit();
}
?>
