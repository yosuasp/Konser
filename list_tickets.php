<?php
session_start(); // Mulai sesi di awal file
include "koneksi.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

$user_id = $_SESSION['user_id']; // Dapatkan user_id dari sesi

$query = "SELECT pembelian.*, konser.nama_konser, konser.nama_artis, users.name AS user_name 
          FROM pembelian 
          JOIN konser ON pembelian.konser_id = konser.id 
          JOIN users ON pembelian.user_id = users.id
          WHERE pembelian.user_id = ?"; // Tambahkan kondisi WHERE untuk user_id
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Daftar Tiket Dibeli</title>
</head>
<body>
<div class="container">
    <header>
        <div class="nav">
            <a href="index.php" class="logo">LocalNight</a>
        </div>
    </header>

    <main class="main-container">
        <div class="tes-container">
            <h2>Daftar Tiket Dibeli</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pengguna</th>
                        <th>Nama Konser</th>
                        <th>Nama Artis</th>
                        <th>Tipe</th>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Nomor HP</th>
                        <th>Email</th>
                        <th>Tanggal Pembelian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['user_name']}</td>
                                    <td>{$row['nama_konser']}</td>
                                    <td>{$row['nama_artis']}</td>
                                    <td>{$row['type']}</td>
                                    <td>{$row['first_name']}</td>
                                    <td>{$row['last_name']}</td>
                                    <td>{$row['phone_number']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['purchase_date']}</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No tickets purchased yet.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<footer>
    <div class="footer-container">
        <a href="index.php" class="logo-footer"><h2>LocalNight</h2></a>
        <div class="icon-container">
            <img src="img/icon/bxl-facebook-circle.svg" alt="">
            <img src="img/icon/bxl-instagram.svg" alt="">
            <img src="img/icon/bxl-twitter.svg" alt="">
            <img src="img/icon/bxl-linkedin-square.svg" alt="">
        </div>
        <div class="footer-info">
            <ul>
                <li><h4>About Us</h4></li>
                <li><h4>Terms & Condition</h4></li>
                <li><h4>Privacy Policy</h4></li>
            </ul>
        </div>
        <div class="copy-right"><h3>&copy;2024 PT.Local Night. All Right Reserved </h3></div>
    </div>
</footer>

</body>
</html>
