<?php
include "koneksi.php";

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
            <!-- Search Bar -->
            <div class="search">
                <a class="icon-search" href=""><img src="img/icon/bx-search.svg" alt=""></a>
                <input class="search-box" type="text" placeholder="Search...">
                <a class="cone-filter" href="">
                    <div class="container-cone">
                        <img src="img/icon/bx-filter.svg" alt="">
                        <div class="cone-content">
                            <p>Filter By :</p>
                            <a href="#">Name</a>
                            <a href="#">Location</a>
                            <a href="#">Date</a>
                        </div>
                    </div>
                </a>
            </div>
            <div class="filter">
                <div class="dropdown">
                    <a href="#" class="event-link">Genre</a>
                    <div class="dropdown-content">
                        <a href=""><h3>Rap</h3></a>
                        <a href=""><h3>RnB</h3></a>
                        <a href=""><h3>Pop</h3></a>
                        <a href=""><h3>Rock</h3></a>
                        <a href=""><h3>EDM</h3></a>
                    </div>
                </div>
            </div>

            <!-- Account and Balance -->
            <div class="nav-menu">
                <a href="#" class="menu-bar cart"><img src="img/icon/bx-cart-alt.svg" alt=""></a>
                <a href="#" class="menu-bar user"><img src="img/icon/bx-user.svg" alt=""></a>
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
                                    <div class="wrapper-ticket">
                                        <label for="reguler-ticket">Reguler</label>
                                        <div class="input-stock">
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
                                    <!-- <a href="pemesanan.html" class="order-link">Pesan Sekarang</a> -->
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
