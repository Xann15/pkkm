<?php

session_start();

if(!isset($_SESSION['loged'])) {
    header("location: index.php");
    exit;
}

if(!isset($_SESSION['adminpkkm'])) {
    header("location: home.php");
    exit;
}

require_once "init.php";

$username = $_SESSION['user'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

$info = mysqli_fetch_assoc($result);

$data = mysqli_query($conn, "SELECT * FROM users");

$usn = "";
$role = "";
$i = 1;

if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $getUser = $conn->query("SELECT * FROM users WHERE user_id = '$id'");
    $s = mysqli_fetch_assoc($getUser);
    $usn = $s['username'];
    $role = $s['role'];
}

if(isset($_POST['delete'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM users WHERE user_id = '$id'");
    header("refresh: 0;url=admin.php");
}

if(isset($_POST['addRole'])) {
    if(addrole($_POST) > 0) {
        echo "<script>alert('Berhasil mengubah role')</script>";
        header("refresh:0; url=admin.php");
    } else {
        echo "<script>alert('Terjadi Kesalahan :P')</script>";
        header("refresh:0;url=admin.php");
    }
}

if(isset($_POST['ubahSaldo'])) {
    $username = $_POST['username'];
    $saldo = $_POST['jumlahSaldo'];

    $conn->query("UPDATE users SET saldo = '$saldo' where username = '$username'");
    echo "<script>alert('Berhasil mengubah saldo')</script>";
    header("refresh:0;url=admin.php");
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
    <title>Admin | PKKM</title>
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
    <div class="container mt-lg-5 mt-4 py-lg-2">
        <div class="header-history bg-light d-flex p-2" style="border-radius:30px; height: 80px">
            <a href="home.php" class="my-auto mx-2 text-success"><i class="bi bi-arrow-left" style="font-size: 30px"></i></a>
            <img src="assets/img/logo.png" alt="admin" style="shadow">
            <p class="my-auto mx-3" style="font-size: 30px; font-family: fjalla one;">Admin</p>
        </div>

        <div class="title-admin text-light mt-5">
            <p class="display-5 mb-0">Halo <span class="fw-bold text-warning"><?= ucwords($username) ?></span></p>
            <p style="opacity: 85%">Kamu adalah Admin PKKM</p>
        </div>

        <div class="tableUser">
                <p class="display-6">Users</p>
                <table class="col-lg-8 col-md-10 col-12 table table-bordered table-striped mt-3">
                <thead>
                    <tr class="text-center align-middle fw-bold">
                        <td>#</td>
                        <td>Role</td>
                        <td>Username</td>
                        <td>Seluler</td>
                        <td>Email</td>
                        <td>Alamat</td>
                        <td>Saldo</td>
                        <td style="width:15%">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while($r = mysqli_fetch_assoc($data)): ?>
                    <tr class="text-center align-middle">
                        <td><?= $i++ ?></td>
                        <td><?= $r['role'] ?></td>
                        <td><?= $r['username'] ?></td>
                        <td><?= $r['seluler'] ?></td>
                        <td><?= $r['email'] ?></td>
                        <td><?= $r['alamat'] ?></td>
                        <td><?= $r['saldo'] ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $r['user_id'] ?>">
                                <button type="submit" name="edit" value="Edit" class="text-info btn btn-dark rounded-pill p-1 px-3"><i class="bi bi-pencil-square"></i></button>
                                <button type="submit" name="delete" value="Delete" class="text-warning btn btn-dark rounded-pill p-1 px-3"><i class="bi bi-trash "></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            </div>

            <div class="container mt-5 py-5">
                <p class="display-6">Set Role Users</p>

                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="username" class="col-sm-2 col-form-label my-auto">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" id="username" autocomplete="off" class="form-control" value="<?= $usn ?>">
                        </div>
                    </div>
                    <div class="mb-3 row"> 
                        <label for="role" class="col-sm-2 col-form-label my-auto">Set Role to</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="role" id="role" value="<?= $role ?>">
                                <option value="user">- Choose Role -</option>
                                <option value="user" <?php if($role === "user") echo "selected"?>>user
                                </option>
                                <option value="admin" <?php if($role === "admin") echo "selected"?>>admin
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="addRole" class="btn btn-dark rounded-pill p-1 px-3">Set Role</button>
                    </div>
                </form>
            </div>

            <div class="container mt-5 py-5">
                <p class="display-6">Saldo</p>

                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="username" class="col-sm-2 col-form-label my-auto">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" id="username" autocomplete="off" class="form-control" value="<?= $usn ?>">
                        </div>
                    </div>
                    <div class="mb-3 row"> 
                        <label for="saldo" class="col-sm-2 col-form-label my-auto">Jumlah Saldo</label>
                        <div class="col-sm-10">
                            <input name="jumlahSaldo" id="jumlahSaldo" class="form-control" type="number">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="ubahSaldo" class="btn btn-dark rounded-pill p-1 px-3">Ubah Saldo</button>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>