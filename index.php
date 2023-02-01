<?php

session_start();

if(isset($_SESSION['loged'])) {
    header("location: home.php");
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
    <title>PKKM</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/index.css">
    <script src="assets/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .preloader img {
            width: 100px;
            animation: preloader 3s;
        }

        @keyframes preloader {
            0% {
                transform: rotate(-360deg);
            }
            75% {
                transform: rotate(0deg);
            }
            100% {
                transform: scale(1.5);
            }
        }

    </style>
</head>
<body>

    <div class="preloader d-flex align-items-center" style="height: 100vh; background-color: #3AA629">
        <img src="assets/img/logo.png" alt="logo" class="d-block mx-auto">
    </div>

    <div class="container text-white mt-5 py-2" id="app">
        <div class="title-welcome col-lg-6 col-md-8 col-10">
            <span class="h1 text-light animate__animated animate__fadeIn" style="animation-delay: 0.8s">Welcome</span>
            <span class="h1 text-light animate__animated animate__fadeIn" style="animation-delay: 1.3s">to</span>
            <p class="h1 text-light animate__animated animate__fadeIn" style="animation-delay: 2.3s">
                <span class="text-success">P</span>elayanan
                <span class="text-success">K</span>ebersihan
                <span class="text-success">K</span>eamanan
                <span class="text-success">M</span>obile
            </p>
        </div>
        <div class="cta">
            <a href="login.php" class="p-0 text-light m-0 text-light animate__animated animate__fadeIn" style="animation-delay: 2.8s">
                <i class="bi bi-arrow-right"></i>
                <p>Next</p>
            </a>
        </div>
    </div>

    <script>
            window.onload = function () {
                window.setTimeout(fadeOut, 3000)
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