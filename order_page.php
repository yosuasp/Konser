<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
}

$user_id = $_SESSION['user_id'];

$pesan_reguler = $_POST['reguler-ticket'];
$pesan_vip  = $_POST['vip-ticket'];
$pesan_super_vip = $_POST['super-vip-ticket'];
$harga_reguler = $_POST['harga-reguler-ticket']*$pesan_reguler;
$harga_vip = (int)$_POST['harga-vip_ticket']*(int)$pesan_vip;
$harga_super_vip = (int)$_POST['harga-supervip-ticket']*(int)$pesan_super_vip;
$total = $harga_reguler+$harga_super_vip+$harga_vip;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Logo/stock-photo-cartoon-emoji-hand-holding-microphone-and-showing-victory-gesture-isolated-over-purple-background-2175571409.jpg">
    <link rel="stylesheet" href="style.css">
    <title>Local Party Night - Order Now</title>
</head>
<body>
<div class="container">
<header>
            <div class="nav">
                <a href="index.php" class="logo">LocalNight</a>
                <!-- Account and Balance -->
                <div class="nav-menu">
                    <a href="#" class="menu-bar cart"><img src="img/icon/bx-cart-alt-white.svg" alt=""></a>
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

    <main class="main-container">
        <div class="tes-container">
            <form class="tes-wrap" action="process_purchase.php" method="POST">
                
                <input type="hidden" value= '<?php echo $pesan_reguler?>' name="reguler">
                <input type="hidden" value= '<?php echo $pesan_vip?>' name="vip">
                <input type="hidden" value= '<?php echo $pesan_super_vip?>' name="super_vip">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $konser_id = $_POST['konser_id'];
                    
                    $reguler_ticket = isset($_POST['reguler-ticket']) ? $_POST['reguler-ticket'] : 0;
                    $vip_ticket = isset($_POST['vip-ticket']) ? $_POST['vip-ticket'] : 0;
                    $super_vip_ticket = isset($_POST['super-vip-ticket']) ? $_POST['super-vip-ticket'] : 0;

                    $query_detail = "SELECT * FROM konser WHERE id = $konser_id";
                    $result_detail = mysqli_query($conn, $query_detail);

                    if ($result_detail) {
                        $detail_konser = mysqli_fetch_assoc($result_detail);
                    } else {
                        echo "Failed to fetch concert details.";
                        exit();
                    }

                    function generateForm($type, $count, $detail_konser) {
                        for ($i = 1; $i <= $count; $i++) {
                            echo "
                            <div class='wrapper-order'>
                                <div class='form-order order-1'>
                                <div class='container-order'>
                                    <h3>Pemesanan Tiket $type $i</h3>
                                    <div class='order-ticket'>
                                        <input type='hidden' name='type[]' value='$type'>
                                        <input type='hidden' name='konser_id[]' value='{$detail_konser['id']}'>
                                        <label for='fname'>Nama Depan</label>
                                        <input type='text' name='fname[]' required placeholder='First Name'>
                                        <label for='lname'>Nama Belakang</label>
                                        <input type='text' name='lname[]' required placeholder='Last Name'>
                                        <label for='phone-number'>Nomor HP</label>
                                        <input type='tel' name='phone_number[]' required placeholder='08123...'>
                                        <label for='email'>Alamat Email</label>
                                        <input type='email' name='email[]' required placeholder='example@gmail.com'>
                                    </div>
                                </div>
                            </div>";
                                echo "
                                <div class='detail-info'>
                                    <div class='img-event'>
                                        <img src='{$detail_konser['gambar_konser']}' alt=''>
                                    </div>
                                    <div class='details-order'>
                                        <h1>{$detail_konser['nama_konser']}</h1>  
                                        <ul class='ul-detail'>
                                            <li class='li-detail'>Nama Artis : <span>{$detail_konser['nama_artis']}</span></li>
                                            <li class='li-detail'>Tanggal : <span>{$detail_konser['waktu_konser']}</span></li>
                                            <li class='li-detail'>Jam Mulai : <span>{$detail_konser['jam_konser']}</span></li>
                                            <li class='li-detail'>Lokasi : <span>{$detail_konser['lokasi']}</span></li>
                                        </ul>    
                                    </div>
                                </div>
                            </div>";
                        }
                    }

                    if ($reguler_ticket > 0) {
                        generateForm('Reguler', $reguler_ticket, $detail_konser);
                    }

                    if ($vip_ticket > 0) {
                        generateForm('VIP', $vip_ticket, $detail_konser);
                    }

                    if ($super_vip_ticket > 0) {
                        generateForm('Super VIP', $super_vip_ticket, $detail_konser);
                    }
                } else {
                    echo "No ticket selected.";
                }
                ?>
                <button type="submit">Submit</button>
            </form>
            <p>Total Harga : <?php echo $total?></p>
            <div class="details-back">
                <a href="detail.php?id=<?php echo $konser_id; ?>"><h1>&#60; Back To Details</h1></a>
            </div>
            <div class="wrapper-payment">
                <h3>Pilih Metode Pembayaran</h3>
                <div class="container-payment">
                    <div class="bank bri"><img src="img/asset/bri2.jpg" alt="" class="pay"></div>
                    <div class="bank bca"><img src="img/asset/bca3.jpg" alt="" class="pay"></div>
                    <div class="bank mandiri"><img src="img/asset/mandiri.jpg" alt="" class="pay"></div>
                    <div class="bank dana"><img src="img/asset/dana.jpg" alt="" class="pay"></div>
                    <div class="bank paypal"><img src="img/asset/paypal.jpg" alt="" class="pay"></div>
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
        <div class="copy-right"><h3>&copy;2024 PT.Local Night. All Right Reserved </h3></div>
    </div>
</footer>

</body>
</html>
