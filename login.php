<?php
session_start();
include "config/koneksi.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if($cek > 0){
        $_SESSION['username']=$username;
        header("location:starter.php");
    }else{
        echo "<script>alert('Username atau Password salah');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta churset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="Style.css">
        <style>
         body {
            background-image: url('Background-01.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
</style>
    </head>
    <body>
        <div class="container">
            <div class="login">
                <form method="POST">
                    <h1>Login</h1>
                    <hr>
                    <p>Work From Office</p>
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan Username">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" name="login">Login</button>
                    <p>
                        <a href="#">Forgot Password</a>
                    </p>
                    <div class="social-icons">
                        <a href="#" class="icon google" title="Login with Google">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg" alt="Google" style="width:24px;height:24px;">
                        </a>
                        <a href="#" class="icon facebook" title="Login with Facebook">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/facebook/facebook-original.svg" alt="Facebook" style="width:24px;height:24px;">
                        </a>
                        <a href="#" class="icon twitter" title="Login with Twitter">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/twitter/twitter-original.svg" alt="Twitter" style="width:24px;height:24px;">
                        </a>
                    </div>
                </form>
            </div>
            <div class="right">
                <img src="char.png" alt="">
            </div>
        </div>
    </body></html>