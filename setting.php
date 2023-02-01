<?php
session_start();
require_once "init.php";


if(!isset($_SESSION['loged'])) {
    header("location: index.php");
}

$username = $_SESSION['user'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

$info = mysqli_fetch_assoc($result);
$seluler = "";
$email = "";
$alamat = "";


if(isset($_POST['ubahNama'])) {
    $name = htmlspecialchars($_POST['username']);

    $id = $_POST['uid'];

    if($name == '') {
        echo "<script>alert('Field username tidak boleh kosong!')</script>";
        header("refresh: 0; url=");
        exit;
    }

    if($name == $username) {
        echo "<script>alert('Tidak ada perubahan!')</script>";
        header("refresh: 0; url=");
        exit;
    }

    $conn->query("UPDATE users SET username = '$name' WHERE user_id = '$id'");
    $username = $name;
}

if(isset($_POST['ubahSeluler'])) {
    $seluler = $info['seluler'];
    $telp = $_POST['seluler'];

    $id = $_POST['uid'];

    if($telp == '') {
        echo "<script>alert('Field seluler tidak boleh kosong!')</script>";
        header("refresh: 0; url=");
        exit;
    }

    if($telp == $seluler) {
        echo "<script>alert('Tidak ada perubahan!')</script>";
        header("refresh: 0; url=");
        exit;
    }

    $conn->query("UPDATE users SET seluler = '$telp' WHERE user_id = '$id'");
    header("refresh:0; url=");
}

if(isset($_POST['ubahEmail'])) {
    $email = $info['email'];
    $mail = $_POST['email'];

    $id = $_POST['uid'];

    if($mail == '') {
        echo "<script>alert('Field email tidak boleh kosong!')</script>";
        header("refresh: 0; url=");
        exit;
    }

    if($mail == $email) {
        echo "<script>alert('Tidak ada perubahan!')</script>";
        header("refresh: 0; url=");
        exit;
    }

    $conn->query("UPDATE users SET email = '$mail' WHERE user_id = '$id'");
    header("refresh:0; url=");
}

if(isset($_POST['ubahAlamat'])) {
    $alamat = $info['alamat'];
    $alamatBaru = $_POST['alamat'];

    $id = $_POST['uid'];

    if($alamatBaru == '') {
        echo "<script>alert('Field alamat tidak boleh kosong!')</script>";
        header("refresh: 0; url=");
        exit;
    }

    if($alamatBaru == $alamat) {
        echo "<script>alert('Tidak ada perubahan!')</script>";
        header("refresh: 0; url=");
        exit;
    }

    $conn->query("UPDATE users SET alamat = '$alamatBaru' WHERE user_id = '$id'");
    header("refresh:0; url=");
}

if(isset($_POST['ubahSandi'])) {
    $password = $_POST['sandi'];

    $id = $_POST['uid'];

    $password = password_hash($password, PASSWORD_BCRYPT);

    $conn->query("UPDATE users SET password = '$password' WHERE user_id = '$id'");
    header("refresh:0; url=");
}

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: index.php");
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
    <title>Setting | PKKM</title>
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
    <div class="container mt-5 py-2">    
        <div class="header-setting d-flex">
            <div class="cta-setting my-auto">
                <a href="home.php" class="text-light" style="font-size: 35px"><i class="bi bi-arrow-left"></i></a>
            </div>

            <div class="pictures mx-auto">
                <img src="assets/img/user.png" alt="user" class="rounded-circle" style="transform: translate(-25%, 0%)">
            </div>
        </div>

        <div class="alert alert-success p-2 col-lg-6 col-md-8 col-12 mx-auto mt-5" role="alert">
            <p class="text-center m-0">Tekan untuk merubah</p>
        </div>

        <div class="prev-account mt-5 col-lg-8 col-md-10 col-12 mx-auto py-2">
            <button class="btn btn-light w-100 mx-auto d-flex justify-content-between mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalNama">
                <p class="my-auto">Nama</p>
                <p class="my-auto text-muted"><?= ucwords($username) ?></p>
            </button>
            <button class="btn btn-light w-100 mx-auto d-flex justify-content-between mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalSeluler">
                <p class="my-auto">No Seluler</p>
                <?php if($info['seluler'] == NULL) { ?>
                    <p class="my-auto text-muted">Belum ditambahkan</p>
                <?php } else { ?>
                    <p class="my-auto text-muted"><?= $info['seluler'] ?></p>
                <?php }?>
            </button>
            <button class="btn btn-light w-100 mx-auto d-flex justify-content-between mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalEmail">
                <p class="my-auto">Email</p>
                <p class="my-auto text-muted"><?= $info['email'] ?></p>
            </button>
            <button class="btn btn-light w-100 mx-auto d-flex justify-content-between mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalAlamat">
                <p class="my-auto">Alamat</p>
                <?php if($info['alamat'] == NULL) { ?>
                    <p class="my-auto text-muted">Belum ditambahkan</p>
                <?php } else { ?>
                    <p class="my-auto text-muted"><?= $info['alamat'] ?></p>
                <?php }?>
            </button>
            <button class="btn btn-light w-100 mx-auto d-flex justify-content-between mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalKataSandi">
                <p class="my-auto">Ubah Kata Sandi</p>
                <p class="my-auto text-muted"><?= ucwords($username) ?></p>
            </button>
            <button class="btn btn-success mx-auto d-flex float-start" data-bs-toggle="modal" data-bs-target="#exampleModalLogout">
                <p class="my-auto"><i class="bi bi-box-arrow-right"></i> Logout</p>
            </button>
        </div>

        <!-- modal -->
        <div class="modal fade" id="exampleModalNama" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Ubah Nama</label>
                                <input type="hidden" name="uid" value="<?= $info['user_id'] ?>">
                                <input type="text"
                                    name="username"
                                    id="username"
                                    class="form-control"
                                    id="message-text"
                                    value="<?= $username ?>"
                                    maxlength="25"
                                    placeholder="panjang maksimal 25 karakter"
                                    style="background-color: #fff"></input>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="ubahNama" class="btn btn-success" style="border-radius: 10px">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalSeluler" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Ubah Seluler</label>
                                <input type="hidden" name="uid" value="<?= $info['user_id'] ?>">
                                <input type="tel"
                                    name="seluler"
                                    id="seluler"
                                    class="form-control"
                                    id="message-text"
                                    value="<?php if($info['seluler'] != NULL) { echo $info['seluler']; } ?>"
                                    placeholder="<?php if($info['seluler'] == NULL) { echo "Masukan Seluler Anda"; } ?>"
                                    style="background-color: #fff"></input>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="ubahSeluler" class="btn btn-success" style="border-radius: 10px">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Ubah Email</label>
                                <input type="hidden" name="uid" value="<?= $info['user_id'] ?>">
                                <input type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    id="message-text"
                                    value="<?= $info['email']; ?>"
                                    placeholder="Masukan Email Anda"
                                    style="background-color: #fff"></input>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="ubahEmail" class="btn btn-success" style="border-radius: 10px">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalAlamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Ubah Alamat</label>
                                <input type="hidden" name="uid" value="<?= $info['user_id'] ?>">
                                <input type="text"
                                name="alamat"
                                id="alamat"
                                class="form-control"
                                id="message-text"
                                value="<?php if($info['alamat'] !== NULL) { echo $info['alamat']; } ?>"
                                placeholder="<?php if($info['alamat'] == NULL) { echo "Masukan alamat anda"; } ?>"
                                style="background-color: #fff"></input>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="ubahAlamat" class="btn btn-success" style="border-radius: 10px">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalKataSandi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Ubah Kata Sandi</label>
                                <input type="hidden" name="uid" value="<?= $info['user_id'] ?>">
                                <input type="text"
                                name="sandi"
                                id="sandi"
                                class="form-control"
                                id="message-text"
                                placeholder="Gunakan Kombinasi Simbol"
                                style="background-color: #fff"></input>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="ubahSandi" class="btn btn-success" style="border-radius: 10px">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Anda yakin ingin Logout?</h1>
                            <p class="text-muted mb-0">Jika logout anda harus login kembali.</p>
                        </div>
                        <div>
                            <button type="button" class="btn-close my-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-2" style="border: none">
                                <form action="" method="post">
                                    <input type="submit" name="logout" id="logout" class="btn btn-danger mx-auto" value="Ya, saya yakin">
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>