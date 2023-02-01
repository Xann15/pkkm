<?php

$data = mysqli_query($conn, "SELECT * FROM users");

function register($data) {
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $email = strtolower(stripslashes($data['email']));

    // ?Check username yang di inputkan sudah terdaftar apa belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        ?>
        <div class="alert alert-danger" role="alert">username already exists!</div>
        <?php
    return false;
    }

    // ?Jika field username kosong
    if(empty(trim($username))) {
        ?>
        <div class="alert alert-danger" role="alert">please enter your username</div>
        <?php
    return false;
    }

    $password = password_hash($password, PASSWORD_BCRYPT);

    $role = 'user';
    $saldo = 50000;

    mysqli_query($conn, "INSERT INTO users(role, username, password, email, saldo) VALUES('$role', '$username', '$password', '$email', '$saldo')");
    $_SESSION['loged'] = true;
    $_SESSION['user'] = strtolower($username);
    return mysqli_affected_rows($conn);
}

function addRole($users) {
    global $conn;
    $username = $_POST['username'];
    $role = $_POST['role'];
    if(empty(trim($username))) {
        echo "<script>alert('select the person you want to change')</script>";
        return false;
    }     
    $conn->query("UPDATE users SET role = '$role' WHERE username = '$username'");
    
    return mysqli_affected_rows($conn);
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'sekarang';
}