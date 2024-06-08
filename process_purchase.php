<?php
session_start(); // Mulai sesi di awal file

include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];
$konser_id= $_POST['konser_id'];
if($_POST['reguler']==""){
    $pesan_reguler = 0;
}else{
    $pesan_reguler = $_POST['reguler'];
}

if ($_POST['vip']=="") {
    $pesan_vip = 0;
}else{
    $pesan_vip=$_POST['vip'];
}

if($_POST['super_vip']==''){
    $pesan_super_vip=0;
}else{
    $pesan_super_vip = $_POST['super_vip'];
}





$quer = "SELECT stock_reguler,stock_vip,stock_supervip from konser where id='$konser_id[0]'";
$result = mysqli_query($conn, $quer);
$data = mysqli_fetch_assoc($result);

$reguler_now = $data['stock_reguler'];
$vip_now = $data['stock_vip'];
$super_vip_now = $data['stock_supervip'];

$kurang_reguler = $reguler_now-$pesan_reguler;
$kurang_vip = $vip_now-$pesan_vip;
$kurang_supervip = $super_vip_now-$pesan_super_vip;

$quert_update = "UPDATE konser set stock_reguler='$kurang_reguler',stock_vip='$kurang_vip',stock_supervip='$kurang_supervip' where id = $konser_id[0]";
mysqli_query($conn,$quert_update);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $konser_ids = $_POST['konser_id'];
    $types = $_POST['type'];
    $fnames = $_POST['fname'];
    $lnames = $_POST['lname'];
    $phone_numbers = $_POST['phone_number'];
    $emails = $_POST['email'];

    $valid_ticket_types = ["Reguler", "VIP", "Super VIP"];

    for ($i = 0; $i < count($types); $i++) {
        if (!in_array($types[$i], $valid_ticket_types)) {
            echo "Invalid ticket type.";
            exit();
        }

        $konser_id = $konser_ids[$i];
        $type = $types[$i];
        $fname = $fnames[$i];
        $lname = $lnames[$i];
        $phone_number = $phone_numbers[$i];
        $email = $emails[$i];

        // Insert data pemesanan tiket ke database
        $sql = "INSERT INTO pembelian (user_id, konser_id, type, first_name, last_name, phone_number, email)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error);
        }
        $stmt->bind_param("iisssss", $user_id, $konser_id, $type, $fname, $lname, $phone_number, $email);

        if ($stmt->execute()) {
            // Pemesanan tiket berhasil
        } else {
            echo "Pemesanan tiket gagal: " . $conn->error;
        }
        $stmt->close();
    }

    // Redirect ke halaman list tiket
    header("Location: list_tickets.php");
    exit();
} else {
    echo "Invalid request method.";
}
?>
