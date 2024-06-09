<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $konser_id = $_POST['konser_id'];
    $ticket_type = $_POST['ticket_type'];
    $quantity = $_POST['quantity'];

    $query = "INSERT INTO orders (konser_id, ticket_type, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isi", $konser_id, $ticket_type, $quantity);

    if ($stmt->execute()) {
        echo "<script>alert('Order placed successfully'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Failed to place order'); window.location.href='index.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: index.php');
}
?>