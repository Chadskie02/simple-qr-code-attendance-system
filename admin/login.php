<?php
session_start();
require 'dbcon.php';

if(isset($_SESSION['id'])){
    header("Location: index.php"); 
} else {
    if(isset($_POST['submit'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
    
        $queryin = "SELECT * FROM admin WHERE user_name='$username' AND password='".md5($password)."'";
        $result = mysqli_query($con, $queryin) or die("problem on query 1");
    
        if(mysqli_num_rows($result) > 0) {
            
            while($row = mysqli_fetch_array($result)) {
                $_SESSION["id"] = $row["id"];
                header("Location: index.php"); 
            }
    
        } else {
            echo "Invalid Email ID/Password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <title>Login</title>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 mx-auto">

                <div class="card card-body p-5 rounded border bg-white">
                <h1 class="mb-4 text-center">Login</h1>
                <form method="post" action="login.php"> 

                    <div class="input-group mb-3">
                        <span class="input-group-text">Username</span>
                        <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Password</span>
                        <input type="password" name="password" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                        <input type="submit" name="submit" value="Login" class="btn btn-primary"/>
                </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>