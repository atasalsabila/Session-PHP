<?php
session_start();
if (isset($_POST['nama'])) {
    $_SESSION['nama'] = $_POST['nama'];
} elseif (!isset($_SESSION['nama'])) {
    exit("Anda belum login, silahkan login terlebih dahulu melalui <a href='login.html'>link ini</a>");
}
$nama = $_SESSION['nama'];
$time = date('H');
$timestamp = date('d-m-Y H:i:s');
if ($time < "11") {
    $sapa = 'pagi';
} elseif ($time < "15") {
    $sapa = 'siang';
} elseif ($time < "18") {
    $sapa = 'sore';
} elseif ($time >= '18' || $time < '3') {
    $sapa = 'malam';
}
if ($_SESSION['counter'] == null) {
    $_SESSION['counter'] = 1;
    $_SESSION['timestamps'] = array();
}
$counter = $_SESSION['counter'];
$_SESSION['timestamps'][$counter]['time'] = $timestamp;
$_SESSION['timestamps'][$counter]['user'] = $nama;
$_SESSION['counter'] += 1;

function echoHistoryTable()
{
    $number = 1;
    echo "<table>";
    echo "<tr><th>No.<th>Waktu</th><th>Nama Pengguna</th></th></tr>";
    foreach ($_SESSION['timestamps'] as $print) {
        echo "<tr><td>" . $number . "</td><td>" . $print['time'] . "</td><td>" . $print['user'] . "</td></tr>";
        $number++;
    }
    echo "</table>";
}
?>
<!DOCTYPE html>
<head>
    <title>Beranda</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <div class="form-box">
        <h3><?php echo "Selamat $sapa, $nama" ?></h3>
        Halaman ini telah dikunjungi <?php echo $counter?> kali <br><br>
        Riwayat
        <?php echoHistoryTable()?>
    </div>
</body>
</html>
