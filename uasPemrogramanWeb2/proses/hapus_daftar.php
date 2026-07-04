<?php
include '../config.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: ../daftar.php");
    exit;
}

$id = $_GET['id'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("DELETE FROM pendaftar WHERE no_daftar = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Set success message for the notification
    $_SESSION['notification'] = [
        'type' => 'success',
        'message' => 'Data pendaftar berhasil dihapus.'
    ];
} else {
    // Set error message for the notification
    $_SESSION['notification'] = [
        'type' => 'danger',
        'message' => 'Gagal menghapus data: ' . htmlspecialchars($stmt->error)
    ];
}

$stmt->close();
$conn->close();

// Redirect back to the list page
header("Location: ../daftar.php");
exit;
?>