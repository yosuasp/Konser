<?php
session_start(); // Start the session at the beginning of the file

include 'koneksi.php';

// Check if user_id exists in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Prepare and execute SQL statement
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

// Initialize variables
$filter_by = '';
$search_query = '';

// Check if search query and filter are set
if (isset($_GET['search_query']) && isset($_GET['filter_by'])) {
    $search_query = $_GET['search_query'];
    $filter_by = $_GET['filter_by'];
}

// Default query to fetch concerts
$query = "SELECT *, (stock_supervip + stock_vip + stock_reguler) as total_stock FROM konser ORDER BY total_stock DESC LIMIT 3";

// Modify query based on filter
if ($search_query !== '' && $filter_by !== '') {
    switch ($filter_by) {
        case 'name':
            $query = "SELECT * FROM konser WHERE nama_konser LIKE ?";
            break;
        case 'location':
            $query = "SELECT * FROM konser WHERE lokasi LIKE ?";
            break;
        case 'date':
            $query = "SELECT * FROM konser WHERE waktu_konser = ?";
            break;
    }
}

// Preparing the statement for the search query
$stmt = $conn->prepare($query);

if ($search_query !== '' && $filter_by !== '') {
    if ($filter_by === 'date') {
        $stmt->bind_param("s", $search_query);
    } else {
        $search_query = "%" . $search_query . "%";
        $stmt->bind_param("s", $search_query);
    }
}

$stmt->execute();
$result = $stmt->get_result();
$tampung = [];
while ($row = $result->fetch_assoc()) {
    $tampung[] = $row;
}
$stmt->close();

$kueri = "SELECT * FROM konser";
$result2 = mysqli_query($conn, $kueri);
$temp = [];
while ($row2 = mysqli_fetch_assoc($result2)) {
    $temp[] = $row2;
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
    <title>Local Party Night - Order Now</title>
</head>
<body>
    <div class="container">
        <!-- header -->
        <header>
            <div class="nav">
                <a href="index.html" class="logo">LocalNight</a>
                <!-- Search Bar -->
                <div class="search">
                    <form method="GET" action="index.php">
                        <input class="search-box" type="text" name="search_query" placeholder="Search...">
                        <select name="filter_by">
                            <option value="name">Name</option>
                            <option value="location">Location</option>
                            <option value="date">Date</option>
                        </select>
                        <button type="submit" class="icon-search">
                            <img src="img/icon/bx-search.svg" alt="">
                        </button>
                    </form>
                </div>
                <div class="filter">
                    <div class="dropdown">
                        <a href="#" class="event-link">Genre</a>
                        <div class="dropdown-content">
                            <a href="#"><h3>Rap</h3></a>
                            <a href="#"><h3>RnB</h3></a>
                            <a href="#"><h3>Pop</h3></a>
                            <a href="#"><h3>Rock</h3></a>
                            <a href="#"><h3>EDM</h3></a>
                        </div>
                    </div>
                </div>
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
                            echo "<div class='dropdown-content'>
                                    <p class='sign-in-btn'>Hello, " . htmlspecialchars($user['name']) . "</p>
                                    <a href='logout.php'>Logout</a>
                                  </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <main>
            <div class="main container">
                <div class="main-img">
                    <img src="img/asset/konser.jpg" alt="">
                </div>
                <div class="main-topic">
                    <h1>Enjoy Your Life With <span>Local Night</span></h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam ut porro, nemo ab doloribus voluptatum voluptatem non deleniti temporibus esse repellat totam. Aperiam accusantium eum repudiandae quaerat voluptatibus a vero!</p>
                </div>
            </div>

            <div class="recomend">
                <div class="recomend-text">
                    <h2>Recommendation To You</h2>
                </div>
                <div class="recomend-container">
                    <?php foreach ($tampung as $data) { ?>
                        <a class="recomend-card" href="detail.php?id=<?php echo $data['id']?>">
                            <img class="img imgs" src="<?php echo $data["gambar_konser"] ?>" alt="">
                            <div class="detail-card">
                                <div class="location">
                                    <p><img src="img/icon/bxs-map.svg" alt=""> <?php echo $data["lokasi"] ?></p>
                                    <p><img src="img/icon/bx-calendar.svg" alt=""><?php echo $data["waktu_konser"] ?> | <?php echo $data["jam_konser"] ?></p>
                                </div>
                                <h3><?php echo $data["nama_konser"] ?></h3>
                                    <div class="price-status">
                                        <p>Start From : <span>Rp. <?php echo $data["harga_reguler"] ?></span></p>
                                        <p>Ticket Available</p>
                                    </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <!-- Other -->
            <div class="recomend-text other-text"><h2>Another Event Coming Soon</h2></div>
            <div class="recomend other-2">
                <div class="recomend-container other-container">
                    <?php  foreach ($temp as $datas) { ?>
                        <a class="recomend-card other-recomend" href="detail.php?id=<?php echo $datas['id']?>">
                        <img class="img images" src="<?php  echo $datas["gambar_konser"] ?>" alt="">
                        <div class="detail-card other-card">
                            <h3><?php  echo $datas["nama_konser"] ?></h3>
                            <div class="location other-location">
                                <p class="status-available">Available</p>
                                <p><img src="img/icon/bxs-map.svg" alt=""><?php  echo $datas["lokasi"] ?></p>
                                <p><img src="img/icon/bx-calendar.svg" alt=""><?php  echo $datas["waktu_konser"] ?> | <?php  echo $datas["jam_konser"] ?></p>
                            </div>
                        </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
     <!-- Footer -->
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