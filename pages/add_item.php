<?php
require_once('../conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you already established the database connection somewhere else
    // $conn = mysqli_connect($servername, $username, $password, $dbname);

    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $query = mysqli_prepare($conn, "INSERT INTO items (item_name, price, quantity) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($query, "sss", $item_name, $price, $quantity);
    mysqli_stmt_execute($query);

    // Redirect back to the main page or any other desired page
    header("Location: ../index.php");
    exit();
}
?>
