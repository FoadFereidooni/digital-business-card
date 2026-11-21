<?php
$host = 'localhost';
$db = 'business_cards';
$user = 'root';
$password = '';
$conn = new mysqli($host, $user, $password, $db);

$id = $_GET['id'];

$sql = "SELECT * FROM cards WHERE id = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();
$result = $stmt->get_result();
$card = $result->fetch_assoc();
if (!$card) {
    echo "Card not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Business Card</title>
        <link rel="stylesheet" href="card.css">
    </head>
    <body>
        <div class="card">
            <div class="card-header">
                <h1><?= htmlspecialchars($card['name']) ?></h1>
                <p><strong>Email:</strong> <?= htmlspecialchars($card['email']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($card['phone']) ?></p>
                <p><strong>Address:</strong> <?= htmlspecialchars($card['address']) ?></p>
            </div>
            <div class="card-body">
                <div class="images">
                    <img src="<?= htmlspecialchars($card['qr_code']) ?>" alt="QR Code" class="qr-code">
                    <img src="<?= htmlspecialchars($card['image']) ?>" alt="Image" class="profile-image">
                </div>
            </div>
        </div>
    </body>

</html>
