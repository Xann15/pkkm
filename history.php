<?php
session_start();

if(!isset($_SESSION['loged'])) {
    header("location: index.php");
}

require_once "init.php";

$username = $_SESSION['user'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$info = mysqli_fetch_assoc($result);
$user_id = $info['user_id'];
$history = $conn->query("SELECT * FROM history WHERE history_id = $user_id ORDER BY id DESC");
$check = mysqli_num_rows($history);

if(isset($_POST['ctaDelete'])) {
    $id = $_POST['getId'];

    $conn->query("DELETE FROM history WHERE id = '$id'");
    header("refresh:0; url=");
}

if(isset($_GET['info'])) {
    $op = $_GET['info'];
} else {
    $op = "";
}

if($op == 'details') {
    $show = $_GET['show'];
    $getInfo = $conn->query("SELECT * FROM history WHERE id = $show");
    $fetchInfo = mysqli_fetch_assoc($getInfo);

    if($info['user_id'] == $fetchInfo['history_id']) {
        
    } else {
        header("location: page-notfound/");
        exit;
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
    <title>Detail Payment | PKKM</title>
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
            <a href="javascript:history.back()" class="my-auto mx-2 text-success"><i class="bi bi-arrow-left" style="font-size: 30px"></i></a>
            <img src="assets/img/history.png" alt="Topup" class="shadow-sm rounded-circle">
            <p class="my-auto mx-3" style="font-size: 30px; font-family: fjalla one;">Details</p>
        </div>

        <div class=" mt-5 prev d-flex row justify-content-center text-center mx-auto bg-light col-lg-8 col-md-10 col-12 p-4 m-2" style="border-radius: 10px">
            <p class="display-5 fs-4">Detail Pembayaran</p>
            <?php if($fetchInfo['iuran'] == "trash") { ?>
                <img src="assets/img/trash.jpg" alt="trash payment" class="d-block mx-auto rounded-circle" style="width: 90px">
            <?php } else if($fetchInfo['iuran'] == "security") { ?>
                <img src="assets/img/security.png" alt="security payment" class="d-block mx-auto rounded-circle" style="width: 90px">
            <?php } ?>

            <table class="table">
                <tbody>
                    <tr>
                        <th>Iuran</th>
                        <td><span class="text-warning"><?= ucwords($fetchInfo['iuran']) ?></span></td>
                    </tr>
                    <tr>
                        <th>No Pelanggan</th>
                        <td><?= $fetchInfo['no_pelanggan'] ?></td>
                    </tr>
                    <tr>
                        <th>Periode</th>
                        <td><?= $fetchInfo['periode'] ?></td>
                    </tr>
                    <tr>
                        <th>Saldo</th>
                        <td>Rp. <?= $fetchInfo['saldo'] ?></td>
                    </tr>
                    <tr>
                        <th>Total Pembayaran</th>
                        <td class="text-danger">- Rp. <?= $fetchInfo['total_pembayaran'] ?></td>
                    </tr>
                    <tr>
                        <th>Saldo Tersisa</th>
                        <td class="text-success">Rp. <?= $fetchInfo['saldo'] - $fetchInfo['total_pembayaran'] ?></td>
                    </tr>
                    <tr>
                        <th>Waktu Pembayaran</th>
                        <td><?= time_elapsed_string($fetchInfo['tgl']) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
    <?php exit;
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
    <title>History | PKKM</title>
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
            <img src="assets/img/history.png" alt="history">
            <p class="my-auto mx-3" style="font-size: 30px; font-family: fjalla one;">History</p>
        </div>
        
        <div class="metode col-lg-8 col-md-10 col-12 m-2 mx-auto mt-5 py-5">
            <?php if($check == 0) { ?>
                <p class="text-center display-6 text-light fs-4">Kamu belum melakukan transaksi apapun</p>
            <?php } ?>

            <?php while($h = mysqli_fetch_assoc($history)): 
                $id = $h['id'];
                ?>
                <a href="?info=details&show=<?= $id; ?>" class="btn btn-light d-flex mb-2">
                    <?php if($h['iuran'] == 'trash') { ?>
                        <img src="assets/img/trash.jpg" alt="trash payment" style="width: 75px" class="shadow-sm rounded-circle">
                        <div class="w-100">
                            <p class="display-6 fs-4 mb-1 text-warning">Trash</p>
                            <p class="mb-0"><span class="text-success"><span class="text-danger">- Rp. <?= $h['total_pembayaran'] ?></span></p>
                            <p class="mb-0 text-muted"><?= time_elapsed_string($h['tgl']) ?></p>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="getId" value="<?= $h['id'] ?>">
                            <button type="submit" name="ctaDelete" id="ctaDelete" class="btn btn-danger rounded-pill py-0"><i class="bi bi-trash"></i></button>
                        </form>
                    <?php } ?>
                    <?php if($h['iuran'] == 'security') { ?>
                        <img src="assets/img/security.png" alt="security payment" style="width: 75px" class="shadow-sm rounded-circle">
                        <div class="w-100">
                            <p class="display-6 fs-4 mb-1 text-warning">Security</p>
                            <p class="mb-0"><span class="text-success">- <span class="text-danger">Rp. <?= $h['total_pembayaran'] ?></span></p>
                            <p class="mb-0 text-muted"><?= time_elapsed_string($h['tgl']) ?></p>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="getId" value="<?= $h['id'] ?>">
                            <button type="submit" name="ctaDelete" id="ctaDelete" class="btn btn-danger rounded-pill py-0"><i class="bi bi-trash"></i></button>
                        </form>
                    <?php } ?>
                    
                </a>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>