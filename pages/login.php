<?php

require_once("../conn.php");
session_start();


if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn , "SELECT * FROM users WHERE user_name = '" . $username . "';");
    $row = mysqli_fetch_assoc($query);

    if($row['user_name'] == $username && $row['password'] == $password){
        $_SESSION['userid'] = $row['user_id'];
        header("Location: ../index.php");
    }else{
        echo "Username atau password salah";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    <!-- Container -->
    <div class="container h-100 d-flex flex-row align-items-center justify-content-center">
        <div class="wrap w-25">
            <h3 class="mt-4">Login Page</h3>

        <form action="" method="post" class="d-flex flex-column justify-content-center">
            <div class="form-group mt-2">
                <label>Username</label>
                <input type="text" name="username" id="inpUsername" class="form-control" placeholder="Username here" >
            </div>
            <div class="form-group mt-2">
                <label>Password</label>
                <input type="password" name="password" id="inpPassword" class="form-control" placeholder="Input password" >
            </div>
            <button type="submit" name="login" class="btn btn-primary mt-4">Login</button>
        </form>

        </div>
    </div>

    <script src="../js/bootstrap.min.js"></script>
</body>

</html>