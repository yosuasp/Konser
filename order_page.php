<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pemesanan Tiket</title>
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
            <div class="wrapper-order">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $konser_id = $_POST['konser_id'];
                    $reguler_ticket = isset($_POST['reguler-ticket']) ? $_POST['reguler-ticket'] : 0;
                    $vip_ticket = isset($_POST['vip-ticket']) ? $_POST['vip-ticket'] : 0;
                    $super_vip_ticket = isset($_POST['super-vip-ticket']) ? $_POST['super-vip-ticket'] : 0;

                    function generateForm($type, $count) {
                        for ($i = 1; $i <= $count; $i++) {
                            echo "
                            <div class='form-order order-1'>
                                <div class='container-order'>
                                    <h3>Pemesanan Tiket $type $i</h3>
                                    <form action='save_order.php' method='post' class='order-ticket'>
                                        <input type='hidden' name='type' value='$type'>
                                        <label for='fname'>Nama Depan</label>
                                        <input type='text' name='fname[]' required placeholder='First Name'>
                                        <label for='lname'>Nama Belakang</label>
                                        <input type='text' name='lname[]' required placeholder='Last Name'>
                                        <label for='phone-number'>Nomor HP</label>
                                        <input type='tel' name='phone_number[]' required placeholder='08123...'>
                                        <label for='email'>Alamat Email</label>
                                        <input type='email' name='email[]' required placeholder='example@gmail.com'>
                                    </form>
                                </div>
                            </div>";?>
                            <?php
                            echo "
                            <div class='detail-info'>
                                <div class='img-event'>
                                    <img src='img/asset/bruno.jpg' alt=''>
                                </div>
                                <div class='details-order'>
                                    <h1>Bruno Mars Concert In Jakarta</h1>  
                                    <ul class='ul-detail'>
                                        <li class='li-detail'>Artis Name : <span>Bruno Mars</span></li>
                                        <li class='li-detail'>Date : <span>15 March 2025</span></li>
                                        <li class='li-detail'>Start Time : <span>8:00PM</span></li>
                                        <li class='li-detail'>Location : <span>Jakarta International Stadium</span></li>
                                        <li class='li-detail'>Ticket Availability : <span>Available</span></li>
                                    </ul>    
                                </div>
                            </div> <br><br>";
                        }
                    }

                    if ($reguler_ticket > 0) {
                        generateForm('Reguler', $reguler_ticket);
                    }

                    if ($vip_ticket > 0) {
                        generateForm('VIP', $vip_ticket);
                    }

                    if ($super_vip_ticket > 0) {
                        generateForm('Super VIP', $super_vip_ticket);
                    }
                } else {
                    echo "No ticket selected.";
                }
                ?>
                <!-- <div class="details-back">
                    <a href="detail.php?id=<?php echo $konser_id; ?>"><h1>&#60; Back To Details</h1></a>
                </div> -->
                <!-- <div class="wrapper-payment">
                    <h3>Pilih Metode Pembayaran</h3>
                    <div class="container-payment">
                        <div class="bank bri"><img src="img/asset/bri2.jpg" alt="" class="pay"></div>
                        <div class="bank bca"><img src="img/asset/bca3.jpg" alt="" class="pay"></div>
                        <div class="bank mandiri"><img src="img/asset/mandiri.jpg" alt="" class="pay"></div>
                        <div class="bank dana"><img src="img/asset/dana.jpg" alt="" class="pay"></div>
                        <div class="bank paypal"><img src="img/asset/paypal.jpg" alt="" class="pay"></div>
                    </div>
                </div> -->
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
