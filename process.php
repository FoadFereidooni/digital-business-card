<?php
require 'vendor/autoload.php';
use Endroid\QrCode\QrCode;

$host = 'localhost';
$db = 'business_cards';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image'];
    $imagePath = 'profile/' . uniqid() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);

    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        die("Error uploading image.");
    }
} else {
    die("No image uploaded.");
}

$sql = "INSERT INTO cards (name, phone, address, email, image, qr_code) VALUES (?, ?, ?, ?, ?, '')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $phone, $address, $email, $imagePath);

if ($stmt->execute()) {
    $cardId = $conn->insert_id;

    $baseUrl = 'http://localhost/Online%20Business%20Card%20with%20QR%20Code/profile/card.php';
    $data = $baseUrl . '?id=' . $cardId;
    $qrCode = new QrCode($data);
    $qrCodePath = 'qrcodes/' . $cardId . '.png';
    $qrCode->writeFile($qrCodePath);

    $updateSql = "UPDATE cards SET qr_code = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $qrCodePath, $cardId);
    $updateStmt->execute();

    header("Location: card.php?id=" . $cardId);
    exit();
} else {
    die("Error saving data: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
