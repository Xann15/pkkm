<?php
session_start();

if(!isset($_SESSION['loged'])) {
    header("location: index.php");
}

require_once "init.php";

$username = $_SESSION['user'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

$info = mysqli_fetch_assoc($result);


// PROCESSED
if(isset($_GET['metode'])) {
    $metode = $_GET['metode'];
} else {
    $metode = "";
}

if($metode == 'bri') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Topup BRI | PKKM</title>
        <link rel="stylesheet" href="assets/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="assets/index.css">
        <script src="assets/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fjalla One">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    </head>
    <body>
        <div class="container mt-lg-5 mt-4 py-lg-2">
            <div class="header-history bg-light d-flex p-2" style="border-radius:30px; height: 80px">
                <a href="javascript:history.back()" class="my-auto mx-2 text-success"><i class="bi bi-arrow-left" style="font-size: 30px"></i></a>
                <img src="assets/img/bri.jpg" alt="Topup" class="rounded shadow">
                <p class="my-auto mx-3" style="font-size: 30px; font-family: fjalla one;">Topup</p>
            </div>

            <div class=" mt-5 prev d-flex row justify-content-center text-center mx-auto bg-light col-lg-8 col-md-10 col-12 p-4 m-2">
                <p style="font-family: roboto">BRI Virtual Account Number</p>
                <p class="text-warning fs-3">8881 0 0812 9999 6877</p>
                <button class="btn btn-outline-primary" style="width: fit-content">Copy Code</button>
                <p class="mt-3 mb-0">Account name : <?= ucwords($username) ?></p>
            </div>
        </div>
    </body>
    </html>
<?php
exit;
}

if($metode == 'dana') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Topup DANA | PKKM</title>
        <link rel="stylesheet" href="assets/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="assets/index.css">
        <script src="assets/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fjalla One">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    </head>
    <body>
        <div class="container mt-lg-5 mt-4 py-lg-2">
            <div class="header-history bg-light d-flex p-2" style="border-radius:30px; height: 80px">
                <a href="javascript:history.back()" class="my-auto mx-2 text-success"><i class="bi bi-arrow-left" style="font-size: 30px"></i></a>
                <img src="assets/img/dana.png" alt="Topup" class="rounded shadow">
                <p class="my-auto mx-3" style="font-size: 30px; font-family: fjalla one;">Topup</p>
            </div>

            <div class=" mt-5 prev d-flex row justify-content-center text-center mx-auto bg-light col-lg-8 col-md-10 col-12 p-4 m-2">
                <p style="font-family: roboto">DANA Account Number</p>
                <p class="text-warning fs-3">3321 0 0812 9999 6877</p>
                <button class="btn btn-outline-primary" style="width: fit-content">Copy Code</button>
                <p class="mt-3 mb-0">Account name : <?= ucwords($username) ?></p>
            </div>
        </div>
    </body>
    </html>
<?php
exit;
}

if($metode == 'shopeepay') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Topup Shopeepay | PKKM</title>
        <link rel="stylesheet" href="assets/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="assets/index.css">
        <script src="assets/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fjalla One">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    </head>
    <body>
        <div class="container mt-lg-5 mt-4 py-lg-2">
            <div class="header-history bg-light d-flex p-2" style="border-radius:30px; height: 80px">
                <a href="javascript:history.back()" class="my-auto mx-2 text-success"><i class="bi bi-arrow-left" style="font-size: 30px"></i></a>
                <img src="assets/img/shopee.jpg" alt="Topup" class="rounded shadow">
                <p class="my-auto mx-3" style="font-size: 30px; font-family: fjalla one;">Topup</p>
            </div>

            <div class=" mt-5 prev d-flex row justify-content-center text-center mx-auto bg-light col-lg-8 col-md-10 col-12 p-4 m-2">
                <p style="font-family: roboto">Shopeepay Account Number</p>
                <p class="text-warning fs-3">7791 0 0812 9999 6877</p>
                <button class="btn btn-outline-primary" style="width: fit-content">Copy Code</button>
                <p class="mt-3 mb-0">Account name : <?= ucwords($username) ?></p>
            </div>
        </div>
    </body>
    </html>
<?php
exit;
}

if($metode == 'topup') {
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
        <title>Topup Topup | PKKM</title>
        <link rel="stylesheet" href="assets/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="assets/index.css">
        <script src="assets/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fjalla One">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    </head>
    <body>
        <div class="container mt-lg-5 mt-4 py-lg-2">
            <div class="header-history bg-light d-flex p-2" style="border-radius:30px; height: 80px">
                <a href="javascript:history.back()" class="my-auto mx-2 text-success"><i class="bi bi-arrow-left" style="font-size: 30px"></i></a>
                <img src="assets/img/topup2.png" alt="Topup" class="rounded shadow">
                <p class="my-auto mx-3" style="font-size: 30px; font-family: fjalla one;">Topup</p>
            </div>

            <div class=" mt-5 prev d-flex row justify-content-center text-center mx-auto bg-light col-lg-8 col-md-10 col-12 p-4 m-2">
                <p style="font-family: roboto">Topup Virtual Account Number</p>
                <p class="text-warning fs-3">4551 0 0812 9999 6877</p>
                <button class="btn btn-outline-primary" style="width: fit-content">Copy Code</button>
                <p class="mt-3 mb-0">Account name : <?= ucwords($username) ?></p>
            </div>
        </div>
    </body>
    </html>
<?php
exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topup | PKKM</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/index.css">
    <script src="assets/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fjalla One">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    <div class="container mt-lg-5 mt-4 py-lg-2">
        <div class="header-history bg-light d-flex p-2" style="border-radius:30px; height: 80px">
            <a href="home.php" class="my-auto mx-2 text-success"><i class="bi bi-arrow-left" style="font-size: 30px"></i></a>
            <img src="assets/img/topup.png" alt="Topup">
            <p class="my-auto mx-3" style="font-size: 30px; font-family: fjalla one;">Topup</p>
        </div>

        <div class="pesan mt-5 text-light">
            <p class="display-6 fs-3">Saldo Anda Rp. <span class="text-warning"><?= $info['saldo'] ?></span></p>
            <p>Mau isi Saldo Kamu dengan cara apa?</p>
            <p class="mt-5">Pilih cara Topup:</p>
        </div>

        <div class="metode col-lg-8 col-md-10 col-12 m-2 mx-auto">
            <a href="?metode=bri" class="btn btn-light d-flex justify-content-between mb-2">
                <img src="assets/img/bri.jpg" alt="bri" style="width: 75px" class="float-start shadow rounded">
                <i class="bi bi-arrow-right text-success my-auto" style="font-size: 30px"></i>
            </a>
            <a href="?metode=dana" class="btn btn-light d-flex justify-content-between mb-2">
                <img src="assets/img/dana.png" alt="bri" style="width: 75px" class="float-start shadow rounded">
                <i class="bi bi-arrow-right text-success my-auto" style="font-size: 30px"></i>
            </a>
            <a href="?metode=shopeepay" class="btn btn-light d-flex justify-content-between mb-2">
                <img src="assets/img/shopee.jpg" alt="bri" style="width: 75px" class="float-start shadow rounded">
                <i class="bi bi-arrow-right text-success my-auto" style="font-size: 30px"></i>
            </a>
            <a href="?metode=topup" class="btn btn-light d-flex justify-content-between">
                <img src="assets/img/topup2.png" alt="bri" style="width: 75px" class="float-start shadow rounded">
                <i class="bi bi-arrow-right text-success my-auto" style="font-size: 30px"></i>
            </a>
        </div>
    </div>
</body>
</html>