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

    // Hapus tiket dari database
    $query = "DELETE FROM pembelian WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ticket_id);

    if ($stmt->execute()) {
        header("Location: list_tickets.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ticket ID provided.";
    exit();
}
?>
