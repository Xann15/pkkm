<?php
session_start();

if(!isset($_SESSION['loged'])) {
    header("location: index.php");
}

require_once "init.php";

$username = $_SESSION['user'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

$info = mysqli_fetch_assoc($result);
$gagal = "";
$sukses = "";


if(isset($_POST['bayarSecurity'])) {

    $saldo = $info['saldo'];
    $user_id = $info['user_id'];
    $noPelanggan = $_POST['noPelanggan'];
    $periode = $_POST['periode'];
    $nominal = $_POST['nominal'];
    $iuran = 'security';
    

    $datetime = date('Y-m-d H:i:s');

    if(empty(trim($noPelanggan && $periode && $nominal ))) {
        echo "<script>alert('silahkan lengkapkan data anda')</script>";
        header("refresh:0; url=security.php");exit;
    }

    if($nominal >= 1 && $nominal < 20000) {
        echo "<script>alert('Harga bayar per periode adalah Rp. 20.000')</script>";
        header("refresh:0; url=security.php");exit;
    }

    $total = $saldo - $nominal;

    if($saldo < 20000) {
        echo "<script>alert('Saldo anda tidak mencukupi')</script>";
        header("refresh:0; url=security.php");exit;
    }

    $conn->query("INSERT INTO history(history_id, iuran, username, saldo, periode, total_pembayaran, tgl, no_pelanggan) VALUE('$user_id', '$iuran', '$username', '$saldo', '$periode', '$nominal', '$datetime', '$noPelanggan')");
    $conn->query("UPDATE users SET saldo = '$total' WHERE user_id = '$user_id'");
    
    echo "<script>alert('Pembayaran Berhasil')</script>";
    header("location: security.php");

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
    <title>Security | PKKM</title>
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
        <?php
        if($gagal){
            ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $gagal ?>
        </div>
        <?php
            header("refresh:3;url=index.php");// 3 = 3detik refresh page
            }
        ?>
        <?php
            if($sukses){
        ?>
        <div class="alert alert-success" role="alert">
            <?php echo $sukses ?>
        </div>
        <?php
            header("refresh:3;url=index.php");// 3 = 3detik refresh page
            }
        ?>
        <div class="header-history bg-light d-flex p-2" style="border-radius:30px; height: 80px">
            <a href="home.php" class="my-auto mx-2 text-success"><i class="bi bi-arrow-left" style="font-size: 30px"></i></a>
            <img src="assets/img/security.png" alt="Trash">
            <p class="my-auto mx-3" style="font-size: 30px; font-family: fjalla one;">Security Payment</p>
        </div>

        <div class="account mt-4 d-flex justify-content-between">
            <a href="setting.php" class="profile d-flex" style="text-decoration: none">
                <div class="picture d-flex">
                    <img src="assets/img/user.png" alt="profile picture" width="32px" height="32px" class="my-auto rounded-circle">
                </div>
                <div class="info mx-2">
                    <p class="text-light mb-0"><?= ucwords($username) ?></p>
                <?php if($info['seluler'] == NULL) { ?>
                    <p class="num text-light mb-0 my-auto">seluler belum ditambahkan</p>
                <?php } else { ?>
                    <p class="num text-light my-auto"><?= $info['seluler'] ?></p>
                <?php } ?>
                </div>
            </a>

            <div class="saldo d-flex">
                <p class="text-light my-auto">Rp. <?= $info['saldo'] ?> <i class="bi bi-wallet2"></i></p>
            </div>
        </div>

        <div class="form mt-5 col-lg-8 mx-auto">
            <form action="" method="POST">
                <div class="rounded p-lg-4 p-3 bg-white">
                    <div class="mb-3 mt-3">
                        <label for="noPelanggan" class="form-label text-success fs-4" style="font-weight: 800;font-family: roboto">No Pelanggan :</label>
                        <input type="number" class="form-control" name="noPelanggan" id="noPelanggan" aria-describedby="noPelanggan" style="height:40px; border-radius: 0">
                    </div>
                    <div class="mb-3">
                        <label for="periode" class="form-label text-success fs-4" style="font-weight: 800;font-family: roboto">Periode :</label>
                        <input type="number" name="periode" id="periode" class="form-control" id="periode" style="height:40px; border-radius: 0">
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label text-success fs-4" style="font-weight: 800;font-family: roboto">Nominal :</label>
                        <input type="number" name="nominal" id="nominal" class="form-control" id="nominal" style="height:40px; border-radius: 0">
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="button" name="bayarSecurity" id="bayarSecurity" class="btn btn-danger mx-auto col-lg-6 col-md-8 col-10" data-bs-toggle="modal" data-bs-target="#modal">Bayar Sekarang</button>
                </div>

                <!-- modal -->
                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content align-items-center p-5">
                            <input type="submit" name="bayarSecurity" class="btn btn-danger mx-auto" value="Konfirmasi Pembayaran">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>