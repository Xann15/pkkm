<?php

session_start();

require_once "init.php";

if(!isset($_SESSION['loged'])) {
    header("location: index.php");
}

$username = $_SESSION['user'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

$info = mysqli_fetch_assoc($result);

// gets the user IP Address
$user_ip=$_SERVER['REMOTE_ADDR'];

$getView = $conn->query("SELECT * FROM totalview");

$view = mysqli_fetch_assoc($getView);
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
    <title>Home | PKKM</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/index.css">
    <script src="assets/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dm Sans">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    <div class="container mt-3">
        <div class="header p-2 justify-content-between d-flex">
            <a href="setting.php" class="profile d-flex" style="text-decoration: none">
                <div class="picture d-flex">
                    <img src="assets/img/user.png" alt="profile picture" width="32px" height="32px" class="my-auto rounded-circle">
                </div>
                <div class="info mx-2">
                    <p class="text-light mb-0 my-auto"><?= ucwords($username) ?></p>
                    <?php if($info['seluler'] == NULL) { ?>
                        <p class="num text-light mb-0 my-auto">seluler belum ditambahkan</p>
                    <?php } else { ?>
                        <p class="num text-light my-auto"><?= $info['seluler'] ?></p>
                    <?php } ?>
                </div>
            </a>

            <div class="saldo d-flex">
                <p class="text-light my-auto">Rp. <?= $info['saldo'] ?><i class="bi bi-wallet2 mx-2"></i></p>
            </div>
        </div>

        <div class="content">
            <!-- Pengumuman -->
            <div id="carouselExampleInterval" class="carousel col-lg-6 col-md-8 mx-auto slide mt-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3500">
                        <img src="assets/img/banner-1.png" class="d-block w-100" alt="pengumuman">
                    </div>
                    <div class="carousel-item" data-bs-interval="3500">
                        <img src="assets/img/banner-2.png" class="d-block w-100" alt="pengumuman">
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="features text-light mt-3">
                <p class="display-3">Features</p>

                <div class="card-group justify-content-between row text-dark p-3 g-3 m-3 ">
                    <a href="history.php" class="col-lg-3 col-md-6 col-6 text-dark">
                        <div class="card shadow">
                            <img src="assets/img/history.png" class="mt-4 mx-auto card-img-top" alt="">
                            <div class="card-body text-center">
                                <h5 class="card-title">History</h5>
                            </div>
                        </div>
                    </a>
                    <a href="topup.php" class="col-lg-3 col-md-6 col-6 text-dark">
                        <div class="card shadow">
                            <img src="assets/img/topup.png" class="mt-4 mx-auto card-img-top" alt="">
                            <div class="card-body text-center">
                                <h5 class="card-title">Topup</h5>
                            </div>
                        </div>
                    </a>
                    <a href="trash.php" class="col-lg-3 col-md-6 col-6 text-dark">
                        <div class="card shadow">
                            <img src="assets/img/trash.jpg" class="mt-4 mx-auto card-img-top" alt="">
                            <div class="card-body text-center">
                                <h5 class="card-title">Trash</h5>
                            </div>
                        </div>
                    </a>
                    <a href="security.php" class="col-lg-3 col-md-6 col-6 text-dark">
                        <div class="card shadow">
                            <img src="assets/img/security.png" class="mt-4 mx-auto card-img-top" alt="">
                            <div class="card-body text-center">
                                <h5 class="card-title">Security</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="d-flex mt-4 justify-content-between">
            <p class="text-light"><i class="bi bi-eye"></i> <span class="text-warning"><?= $view['totalvisit'] ?></span> orang mengunjungi halaman ini</p>
            <?php if($info['role'] == 'admin') { ?>
                <a href="admin.php" class="gap-1 btn d-flex btn-outline-light"><i class="bi bi-person my-auto"></i><p class="my-auto">Admin</p></a>
            <?php } ?>
        </div>
    </div>
    <?php
    // cek ip
    $cek = $conn->query("SELECT userip FROM pageview WHERE page = 'home' AND userip = '$user_ip'");
    $cc = mysqli_num_rows($cek);
    if($cc > 0) {
        exit;
    } else {
        $conn->query("UPDATE totalview SET totalvisit = totalvisit + 1 WHERE page = 'home'");
        $conn->query("INSERT INTO pageview VALUE('', 'home', '$user_ip')");
    }
    ?>
    
</body>
</html>