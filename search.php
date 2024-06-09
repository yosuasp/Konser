<?php
include 'koneksi.php';

$search = mysqli_real_escape_string($conn, $_GET['q']);
$query = "SELECT * FROM konser WHERE nama_konser LIKE '%$search%' OR lokasi LIKE '%$search%'";
$result = mysqli_query($conn, $query);
$tampung = [];
while ($row = mysqli_fetch_assoc($result)) {
    $tampung[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Logo/stock-photo-cartoon-emoji-hand-holding-microphone-and-showing-victory-gesture-isolated-over-purple-background-2175571409.jpg">
    <link rel="stylesheet" href="style.css">
    <title>Local Party Night - Search Results</title>
</head>
<body>
    <div class="container">
        <header>
            <div class="nav">
                <a href="index.php" class="logo">LocalNight</a>
                <div class="search">
                    <form action="search.php" method="get">
                        <input class="search-box" type="text" name="q" placeholder="Search..." required>
                        <button type="submit" class="icon-search"><img src="img/icon/bx-search.svg" alt=""></button>
                    </form>
                </div>
                <div class="filter">
                    <div class="dropdown">
                        <a href="#" class="event-link">Genre</a>
                        <div class="dropdown-content">
                            <a href="#">Rap</a>
                            <a href="#">RnB</a>
                            <a href="#">Pop</a>
                            <a href="#">Rock</a>
                            <a href="#">EDM</a>
                        </div>
                    </div>
                </div>
                <div class="nav-menu">
                    <a href="list_tickets.php" class="menu-bar cart"><img src="img/icon/bx-cart-alt-white.svg" alt=""></a>
                    <div class="dropdown">
                        <a href="#" class="menu-bar user"><img src="img/icon/bx-user.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <main>
            <div class="recomend">
                <div class="recomend-text">
                    <h2>Search Results</h2>
                </div>
                <div class="recomend-container">
                    <?php if (count($tampung) > 0) {
                        foreach ($tampung as $data) { ?>
                            <a class="recomend-card" href="detail.php?id=<?php echo $data['id'] ?>">
                                <img class="img imgs" src="<?php echo $data["gambar_konser"] ?>" alt="Concert Image">
                                <h3 class="title"><?php echo $data["nama_konser"] ?></h3>
                                <p class="lokasi"><?php echo $data["lokasi"] ?></p>
                                <p class="tanggal"><?php echo date('Y-m-d H:i', strtotime($data["waktu_konser"])) ?></p>
                            </a>
                    <?php } } else { ?>
                        <p>No results found.</p>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <a href="index.php" class="logo-footer">LocalNight</a>
            <div class="footer-icon">
                <a href="#"><img src="img/icon/bxl-facebook-circle.svg" alt=""></a>
                <a href="#"><img src="img/icon/bxl-instagram-alt.svg" alt=""></a>
                <a href="#"><img src="img/icon/bxl-twitter.svg" alt=""></a>
                <a href="#"><img src="img/icon/bxl-tiktok.svg" alt=""></a>
            </div>
            <p>&copy; 2024, PT Local Party Night</p>
        </div>
    </footer>
</body>
</html>
