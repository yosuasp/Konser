<?php
session_start();
include "koneksi.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

// Dapatkan ID tiket dari parameter URL
if (isset($_GET['id'])) {
    $ticket_id = $_GET['id'];

    // Ambil data tiket yang akan diedit
    $query = "SELECT pembelian.*, konser.nama_konser, konser.nama_artis, konser.waktu_konser, konser.jam_konser 
              FROM pembelian 
              JOIN konser ON pembelian.konser_id = konser.id 
              WHERE pembelian.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $ticket = $result->fetch_assoc();
    } else {
        echo "Ticket not found.";
        exit();
    }
} else {
    echo "No ticket ID provided.";
    exit();
}

// Update data tiket setelah form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_numbers'];
    $emails = $_POST['email'];

    $update_query = "UPDATE pembelian SET first_name = ?, last_name = ?, phone_number = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssi", $first_name, $last_name, $phone_number, $emails, $ticket_id);

    if ($stmt->execute()) {
        header("Location: list_tickets.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Tiket</title>
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
        <h2>Edit Data Tiket</h2>
        <div class="container-edit">
            <form action="" method="POST" class="edit-form">
                <div class="edit-ticket">
                    <h4>ID Ticket : <?php echo $ticket['id']?></h4>
                    <h3>Nama Konser: <?= htmlspecialchars($ticket['nama_konser']) ?></h3>
                    <h4>Nama Artis: <?= htmlspecialchars($ticket['nama_artis']) ?></h4>
                    <h4>Waktu Konser: <?= htmlspecialchars($ticket['waktu_konser']) . " " . htmlspecialchars($ticket['jam_konser']) ?></h4>
                    <h4>Tipe Tiket: <?= htmlspecialchars($ticket['type']) ?></h4>
                    <table>
                        <tr>
                            <td>Nama Depan: </td>
                            <td><input type="text" name="first_name" value="<?= htmlspecialchars($ticket['first_name']) ?>"></td>
                        </tr>
                        <tr>
                            <td>Nama Belakang: </td>
                            <td><input type="text" name="last_name" value="<?= htmlspecialchars($ticket['last_name']) ?>"></td>
                        </tr>
                        <tr>
                            <td>Nomor HP: </td>
                            <td><input type="text" name="phone_numbers" value="<?= htmlspecialchars($ticket['phone_number']) ?>"></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><input type="text" name="email" value="<?= htmlspecialchars($ticket['email']) ?>"></td>
                        </tr>
                        <tr>
                            <div class="button-view">
                                <td><input type="submit" value="Simpan Perubahan" class="simpan"></td>
                                <td><a href="list_tickets.php" class="batal">Batalkan Perubahan</a></td>
                            </div>
                        </tr>
                    </table>
                </div>
            </form>
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
