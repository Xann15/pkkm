<?php

session_start();

require_once "init.php";

if(isset($_SESSION['loged'])) {
    header("location: home.php");
    exit;
}

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if(mysqli_num_rows($result) === 1 ) {
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];

        if($role == 'admin') {
            $_SESSION['adminpkkm'] = true;
        }

        if(password_verify($password, $row['password'])){
            $_SESSION['info'] = $result;
            $_SESSION['loged'] = true;
            $_SESSION['user'] = strtolower($username);

            header("location: home.php");
            exit;
        } else {
            ?>
            <div class="alert alert-danger" role="alert">Username or passwword incorret</div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-danger" role="alert">Undefinded users</div>
        <?php
    }

    if(empty(trim($username))) {
        ?>
        <div class="alert alert-danger" role="alert">Please enter your username</div>
        <?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pelayanan Kebersihan Keamanan Mobile">
    <meta name="keywords" content="PKKM, PKKMWEB, pkkm, pkkmweb, pelayanan kebersihan, pelayanan keamanan">
    <meta name="author" content="Pandjie Aldino">
    <title>Login | PKKM</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/index.css">
    <script src="assets/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair DIsplay">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <style>
        .preloader img {
            width: 100px;
            animation: preloader 1s;
        }

        @keyframes preloader {
            0% {
                transform: rotate(-360deg);
            }
            100% {
                transform: rotate(0deg);
            }
        }
    </style>
</head>
<body>

    <div class="preloader d-flex align-items-center" style="height: 100vh; background-color: #3AA629">
        <img src="assets/img/logo.png" alt="logo" class="d-block mx-auto">
    </div>

    <div class="container text-white mt-5" id="app">
        <div class="title-login">
            <p class="display-4">Log in</p>
        </div>

        <div class="form form-login mt-5 col-lg-8 mx-auto">
            <form action="" method="POST">
                <div class="input p-lg-4 p-3 bg-white">
                    <div class="mb-3 mt-3">
                        <label for="username" class="form-label">Name  *</label>
                        <input type="username" class="form-control" name="username" id="username" aria-describedby="username" placeholder="Username">
                    </div>
                    <div class="mb-5">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" name="password" id="password" class="form-control" id="password" placeholder="Enter your password">
                    </div>
                </div>

                <div class="cta-login text-center mt-5">
                    <button type="submit" name="login" id="login" class="btn btn-login bg-white mx-auto">Login</button>
                </div>
            </form>
        </div>

        <div class="bottom-title text-center mt-5">
            <p>You don't have account ? <a href="register.php" class="btn text-light">Cick Here</a></p>
        </div>
    </div>

    <script>
            window.onload = function () {
                window.setTimeout(fadeOut, 1000)
                document.querySelector('#app').style.opacity = '0';
                document.querySelector('#app').style.display = 'none';
            }

            function fadeOut() {
                document.querySelector('.preloader').style.opacity = '0';
                document.querySelector('.preloader').style.height = '0';
                document.querySelector('.preloader').style.display = 'none';
                document.querySelector('#app').style.opacity = '1';
                document.querySelector('#app').style.display = '';
            }
    </script>
</body>
</html>