<?php
session_start();
include "koneksi.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT pembelian.*, konser.nama_konser, konser.nama_artis, konser.waktu_konser, konser.jam_konser 
          FROM pembelian 
          JOIN konser ON pembelian.konser_id = konser.id 
          WHERE pembelian.user_id = ?";
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
        <div class="nav-menu">
            <a href="list_tickets.php" class="menu-bar cart"><img src="img/icon/bx-cart-alt-white.svg" alt=""></a>
            <div class="dropdown">
                <a href="#" class="menu-bar user">
                    <?php
                    if (!isset($_SESSION['user_id'])) {
                        echo "<div class='sign-in-btn'><a class='sign-in' href='login.html'>Sign In</a></div>";
                    } else {
                        echo "<img src='img/icon/bx-user.svg' alt=''>";
                    }
                    ?>
                </a>
                <?php
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $query_user = "SELECT name FROM users WHERE id = $user_id";
                    $result_user = mysqli_query($conn, $query_user);

                    if ($result_user) {
                        $user = mysqli_fetch_assoc($result_user);
                        echo "<div class='dropdown-content'>
                                <p class='sign-in-btn'>Hello, " . htmlspecialchars($user['name']) . "</p>
                                <a href='logout.php'>Logout</a>
                              </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</header>

<main class="main-container">
    <div class="tes-container">
        <h2>Daftar Tiket Dibeli</h2>
        <div class="container-ticket-order">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <form action='' class='ticket-form'>
                        <div class='card-ticket'>
                            <h4>ID Ticket : ". htmlspecialchars($row['id'])."</h4>                        
                            <h3>Nama Konser: " . htmlspecialchars($row['nama_konser']) . "</h3>
                            <h4>Nama Artis: " . htmlspecialchars($row['nama_artis']) . "</h4>
                            <h4>Waktu Konser: " . htmlspecialchars($row['waktu_konser']) . " " . htmlspecialchars($row['jam_konser']) . "</h4>
                            <h4>Tipe Tiket: " . htmlspecialchars($row['type']) . "</h4>
                            <p>Nama Pelanggan: " . htmlspecialchars($row['first_name'])." ". htmlspecialchars($row['last_name']). "</p>
                            <p>Nomor Hp Pelanggan: " . htmlspecialchars($row['phone_number']) . "</p>
                            <p>Email Pelanggan: " . htmlspecialchars($row['email']) . "</p>
                            <br>
                            <div class='tombol'>
                                <a href='edit_form.php?id=". htmlspecialchars($row['id']) ."' class='edit-button'>Ubah</a>
                                <a href='delete_form.php?id=". htmlspecialchars($row['id']) ."' class='delete-button' onclick='return confirm(\"Apakah Anda yakin ingin menghapus tiket ini?\")'>Hapus</a>
                            </div>
                        </div>
                    </form>";
                }
            } else {
                echo "<p>No tickets purchased yet.</p>";
            }
            ?>
        </div>
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
