<?php
require_once('conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you already established the database connection somewhere else
    // $conn = mysqli_connect($servername, $username, $password, $dbname);

    $item_id = $_POST['item_id'];

    $query = mysqli_prepare($conn, "DELETE FROM items WHERE item_id = ?");
    mysqli_stmt_bind_param($query, "i", $item_id);
    mysqli_stmt_execute($query);

    // Redirect back to the main page or any other desired page
    header("Location: index.php");
    exit();
}
?>