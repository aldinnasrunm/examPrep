<?php
require_once("../conn.php");


// make signup function
if(isset($_POST['signup'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['re-password'];
    if($password == $repassword){
        $query = mysqli_query($conn , "INSERT INTO users (user_name, password) VALUES ('" . $username . "', '" . $password . "');");
        header("Location: login.php");
    }else{
        echo "Password tidak sama";
    }
}








?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Sign Up</title>
</head>
<body>
<div class="container h-100 d-flex flex-row align-items-center justify-content-center">
        <div class="wrap w-25">
            <h3 class="mt-4">Register Page</h3>

        <form action="" method="post" class="d-flex flex-column justify-content-center">
            <div class="form-group mt-2">
                <label>Username</label>
                <input type="text" name="username" id="inpUsername" class="form-control" placeholder="Username here" >
            </div>
            <div class="form-group mt-2">
                <label>Password</label>
                <input type="password" name="password" id="inpPassword" class="form-control" placeholder="Input password" >
            </div>
            <div class="form-group mt-2">
                <label>Re-Enter Password</label>
                <input type="password" name="re-password" id="re-Password" class="form-control" placeholder="Re Input password" >
            </div>
            <button type="submit" name="signup" class="btn btn-primary mt-4">Sign Up</button>
            <button type="submit" name="login" class="btn btn-secondary mt-4">Login</button>

        </form>

        </div>
    </div>

    <script src="../js/bootstrap.min.js"></script>

</body>
</html>