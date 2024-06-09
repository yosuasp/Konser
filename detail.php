<?php
session_start(); // Mulai sesi di awal file

include 'koneksi.php';

if (isset($_GET['id'])) {
    $konser_id = $_GET['id'];

    // Query untuk mengambil detail konser berdasarkan ID
    $query_detail = "SELECT * FROM konser WHERE id = $konser_id";
    $result_detail = mysqli_query($conn, $query_detail);

    if ($result_detail) {
        // Tampilkan detail konser
        $detail_konser = mysqli_fetch_assoc($result_detail);
    } else {
        echo "Gagal mengambil detail konser.";
        exit();
    }
} else {
    echo "ID konser tidak ditemukan.";
    exit();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Mempersiapkan dan menjalankan statement SQL
    $sql = "SELECT name FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
} else {
    $user = null;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/Logo/stock-photo-cartoon-emoji-hand-holding-microphone-and-showing-victory-gesture-isolated-over-purple-background-2175571409.jpg">
    <title>Concert Details</title>
</head>
<body>

<div class="container">
    <header>
            <div class="nav">
                <a href="index.php" class="logo">LocalNight</a>
                <!-- Account and Balance -->
                <div class="nav-menu">
                    <a href="list_tickets.php" class="menu-bar cart"><img src="img/icon/bx-cart-alt-white.svg" alt=""></a>
                    <div class="dropdown">
                        <a href="#" class="menu-bar user">
                            <?php
                            if (!isset($_SESSION['user_id'])) {
                                echo "<div class='sign-in-btn'><a class ='sign-in' href='login.html'>Sign In</a></div>";
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

    <main>
        <div class="main container">
            <div class="main-img konser-img">
                <img src="<?php echo $detail_konser['gambar_konser']; ?>" alt="">
            </div>
            <div class="main-topic title-concert">
                <h1><?php echo $detail_konser['nama_konser']; ?></h1>
                <div class="detail-container">
                    <div class="details">
                        <h3>Concert Information</h3>
                        <ul class="ul-detail">
                            <li class="li-detail">Artis Name : <span><?php echo $detail_konser['nama_artis']; ?></span></li>
                            <li class="li-detail">Date : <span><?php echo $detail_konser['waktu_konser']; ?></span></li>
                            <li class="li-detail">Start Time : <span><?php echo $detail_konser['jam_konser']; ?></span></li>
                            <li class="li-detail">Location : <span><?php echo $detail_konser['lokasi']; ?></span></li>
                            <li class="li-detail">Ticket Availability : <span>Available</span></li>
                        </ul>
                    </div>
                    <div class="details">
                        <h3>Price Information</h3>
                        <ul class="ul-detail">
                            <li class="li-detail">Reguler : <span>Rp. <?php echo number_format($detail_konser['harga_reguler']); ?></span></li>
                            <li class="li-detail">VIP : <span>Rp. <?php echo number_format($detail_konser['harga_vip']); ?></span></li>
                            <li class="li-detail">Super VIP : <span>Rp. <?php echo number_format($detail_konser['harga_supervip']); ?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="description">
                    <h2>Description:</h2>
                    <p><?php echo nl2br($detail_konser['deskripsi_konser']); ?></p>
                </div>
                <div class="vanue-purches">
                    <div class="container-ticket">
                        <div class="ticket-box">
                            <h2>Buy Now !</h2>
                            <div class="dropdown-ticket">
                                <form action="order_page.php" method="post" class="content-ticket">
                                    <input type="hidden" name="konser_id" value="<?php echo $detail_konser['id']?>">
                                    <input type="hidden" name="konser_name" value="<?php echo $detail_konser['nama_konser']; ?>">
                                    <input type="hidden" name="konser_date" value="<?php echo $detail_konser['waktu_konser']; ?>">
                                    <input type="hidden" name="konser_location" value="<?php echo $detail_konser['lokasi']; ?>">
                                    <div class="wrapper-ticket">
                                        <label for="reguler-ticket">Reguler</label>
                                        <div class="input-stock">
                                            <input type="hidden" value="<?php echo  $detail_konser['harga_reguler']; ?>" name="harga-reguler-ticket">
                                            <input type="hidden" value="<?php echo $detail_konser['harga_vip'];?>" name="harga-vip_ticket">
                                            <input type="hidden" value="<?php echo $detail_konser['harga_supervip'];?>" name="harga-supervip-ticket">
                                            <input type="number" name="reguler-ticket" placeholder="Masukan jumlah tiket" min="1" max="<?php echo $detail_konser['stock_reguler'];?>">
                                            <h4>Stock : <?php echo $detail_konser['stock_reguler']; ?></h4>
                                        </div>
                                    </div>
                                    <div class="wrapper-ticket">
                                        <label for="VIP-ticket">VIP</label>
                                        <div class="input-stock">
                                            <input type="number" name="vip-ticket" placeholder="Masukan jumlah tiket" min="1" max="<?php echo $detail_konser['stock_vip'];?>">
                                            <h4>Stock : <?php echo $detail_konser['stock_vip']; ?></h4>
                                        </div>
                                    </div>
                                    <div class="wrapper-ticket">
                                        <label for="super-vip-ticket">Super - VIP</label>
                                        <div class="input-stock">
                                            <input type="number" name="super-vip-ticket" placeholder="Masukan jumlah tiket" min="1" max="<?php echo $detail_konser['stock_supervip'];?>">
                                            <h4>Stock : <?php echo $detail_konser['stock_supervip']; ?></h4>
                                        </div>
                                    </div>
                                    <input type="submit" value="Pesan" class="order-link">
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <img src="img/asset/loket_seating_map_raisa_gbk.png" alt="">
                </div>
            </div>
        </div>
    </main>
</div>

<footer>
    <div class="footer-container">
        <a href="index.html" class="logo-footer"><h2>LocalNight</h2></a>
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
        <div class="copy-right"><h3>&copy;2024 PT.Local Night. All Right Reserved</h3></div>
    </div>
</footer>

</body>
</html>
