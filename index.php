<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
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
                    <a class="icon-search" href="#"><img src="img/icon/bx-search.svg" alt=""></a>
                    <input class="search-box" type="text" placeholder="Search...">
                    <a class="cone-filter" href="#">
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
                    <a href="#" class="menu-bar cart"><img src="img/icon/bx-cart-alt-white.svg" alt=""></a>
                    <div class="dropdown">
                        <a href="#" class="menu-bar user"><img src="img/icon/bx-user.svg" alt=""></a>
                        <div class="dropdown-content">
                            <p>Hello, <?php echo htmlspecialchars($user['name']); ?>!</p>
                            <a href="logout.php">Logout</a>
                        </div>
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
                    <a class="recomend-card" href="detail.html">
                        <img class="img" src="img/asset/bruno.jpg" alt="">
                        <div class="detail-card">
                            <div class="location">
                                <p><img src="img/icon/bxs-map.svg" alt=""> Jakarta</p>
                                <p><img src="img/icon/bx-calendar.svg" alt="">15 Maret 2025</p>
                            </div>
                            <h3>Bruno Mars Concert in Jakarta</h3>
                                <div class="price-status">
                                    <p>Start From : <span>Rp 800.000</span></p>
                                    <p>Ticket Available</p>
                                </div>
                        </div>
                    </a>
                    <a class="recomend-card" href="detail.html">
                        <img class="img" src="img/asset/ed.jpg" alt="">
                        <div class="detail-card">
                            <div class="location">
                                <p><img src="img/icon/bxs-map.svg" alt=""> Bali</p>
                                <p><img src="img/icon/bx-calendar.svg" alt="">27 Desmber 2025</p>
                            </div>
                            <h3>Ed Sheeren Concert in Bali</h3>
                                <div class="price-status">
                                    <p>Start From <span>Rp: 500.000</span></p>
                                    <p>Ticket Available</p>
                                </div>
                        </div>
                    </a>
                    <a class="recomend-card" href="detail.html">
                        <img class="img" src="img/asset/taylor.jpg" alt="">
                        <div class="detail-card">
                            <div class="location">
                                <p><img src="img/icon/bxs-map.svg" alt="">Singapore</p>
                                <p><img src="img/icon/bx-calendar.svg" alt="">15 Maret 2026</p>
                            </div>
                            <h3>Taylor Swift Concert in Singapore</h3>
                                <div class="price-status">
                                    <p>Start From : <span>Rp 300.000</span></p>
                                    <p>Ticket Available</p>
                                </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Other -->
            <div class="recomend-text other-text"><h2>Another Event Coming Soon</h2></div>
            <div class="recomend other">
                <div class="container other-con">
                    <div class="recomend-container other-container">
                        <a class="recomend-card other-recomend" href="detail.html">
                            <img class="img" src="img/asset/bruno.jpg" alt="">
                            <div class="detail-card other-card">
                                <h3>Bruno Mars Concert in Jakarta</h3>
                                <div class="location other-location">
                                    <p class="status-available">Available</p>
                                    <p><img src="img/icon/bxs-map.svg" alt=""> Jakarta</p>
                                    <p><img src="img/icon/bx-calendar.svg" alt="">15/04/2025 17.00 WIB</p>
                                </div>
                                <p class="status other-status"> Start From : <span>Rp 80.000</span></p>
                            </div>
                        </a>
                    </div>
                    <div class="recomend-container other-container">
                        <a class="recomend-card other-recomend" href="detail.html">
                            <img class="img" src="img/asset/bruno.jpg" alt="">
                            <div class="detail-card other-card">
                                <h3>Bruno Mars Concert in Jakarta</h3>
                                <div class="location other-location">
                                    <p class="status-available">Available</p>
                                    <p><img src="img/icon/bxs-map.svg" alt=""> Jakarta</p>
                                    <p><img src="img/icon/bx-calendar.svg" alt="">15/04/2025 17.00 WIB</p>
                                </div>
                                <p class="status other-status"> Start From : <span>Rp 80.000</span></p>
                            </div>
                        </a>
                    </div>
                    <div class="recomend-container other-container">
                        <a class="recomend-card other-recomend" href="detail.html">
                            <img class="img" src="img/asset/bruno.jpg" alt="">
                            <div class="detail-card other-card">
                                <h3>Bruno Mars Concert in Jakarta</h3>
                                <div class="location other-location">
                                    <p class="status-available">Available</p>
                                    <p><img src="img/icon/bxs-map.svg" alt=""> Jakarta</p>
                                    <p><img src="img/icon/bx-calendar.svg" alt="">15/04/2025 17.00 WIB</p>
                                </div>
                                <p class="status other-status"> Start From : <span>Rp 80.000</span></p>
                            </div>
                        </a>
                    </div>
                    <div class="recomend-container other-container">
                        <a class="recomend-card other-recomend" href="detail.html">
                            <img class="img" src="img/asset/bruno.jpg" alt="">
                            <div class="detail-card other-card">
                                <h3>Bruno Mars Concert in Jakarta</h3>
                                <div class="location other-location">
                                    <p class="status-available">Available</p>
                                    <p><img src="img/icon/bxs-map.svg" alt=""> Jakarta</p>
                                    <p><img src="img/icon/bx-calendar.svg" alt="">15/04/2025 17.00 WIB</p>
                                </div>
                                <p class="status other-status"> Start From : <span>Rp 80.000</span></p>
                            </div>
                        </a>
                    </div> 
                </div>
            </div>

            <div class="recomend other-2">
                <div class="recomend-container other-container">
                    <a class="recomend-card other-recomend" href="detail.html">
                        <img class="img" src="img/asset/bruno.jpg" alt="">
                        <div class="detail-card other-card">
                            <h3>Bruno Mars Concert in Jakarta</h3>
                            <div class="location other-location">
                                <p class="status-available">Available</p>
                                <p><img src="img/icon/bxs-map.svg" alt=""> Jakarta</p>
                                <p><img src="img/icon/bx-calendar.svg" alt="">15/04/2025 17.00 WIB</p>
                            </div>
                            <p class="status other-status"> Start From : <span>Rp 80.000</span></p>
                        </div>
                    </a>
                </div>
                <div class="recomend-container other-container">
                    <a class="recomend-card other-recomend" href="detail.html">
                        <img class="img" src="img/asset/bruno.jpg" alt="">
                        <div class="detail-card other-card">
                            <h3>Bruno Mars Concert in Jakarta</h3>
                            <div class="location other-location">
                                <p class="status-available">Available</p>
                                <p><img src="img/icon/bxs-map.svg" alt=""> Jakarta</p>
                                <p><img src="img/icon/bx-calendar.svg" alt="">15/04/2025 17.00 WIB</p>
                            </div>
                            <p class="status other-status"> Start From : <span>Rp 80.000</span></p>
                        </div>
                    </a>
                </div>
                <div class="recomend-container other-container">
                    <a class="recomend-card other-recomend" href="detail.html">
                        <img class="img" src="img/asset/bruno.jpg" alt="">
                        <div class="detail-card other-card">
                            <h3>Bruno Mars Concert in Jakarta</h3>
                            <div class="location other-location">
                                <p class="status-available">Available</p>
                                <p><img src="img/icon/bxs-map.svg" alt=""> Jakarta</p>
                                <p><img src="img/icon/bx-calendar.svg" alt="">15/04/2025 17.00 WIB</p>
                            </div>
                            <p class="status other-status"> Start From : <span>Rp 80.000</span></p>
                        </div>
                    </a>
                </div>
                <div class="recomend-container other-container">
                    <a class="recomend-card other-recomend" href="detail.html">
                        <img class="img" src="img/asset/bruno.jpg" alt="">
                        <div class="detail-card other-card">
                            <h3>Bruno Mars Concert in Jakarta</h3>
                            <div class="location other-location">
                                <p class="status-available">Available</p>
                                <p><img src="img/icon/bxs-map.svg" alt=""> Jakarta</p>
                                <p><img src="img/icon/bx-calendar.svg" alt="">15/04/2025 17.00 WIB</p>
                            </div>
                            <p class="status other-status"> Start From : <span>Rp 80.000</span></p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- View More -->
            <div class="view-more">
                <h2>View More</h2>
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
