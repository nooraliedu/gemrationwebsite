<?php
session_start();

// Check if the order information is available
if (!isset($_SESSION['order'])) {
    header('Location: checkout.php');
    exit;
}

$order = $_SESSION['order'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Order Confirmation - Bakery Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-success">Order Placed Successfully!</h1>
        <p>Thank you for your purchase, <?php echo htmlspecialchars($order['name']); ?>. Your order has been placed successfully we will contact very soon.</p>

        <h3>Order Summary</h3>
        <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($order['address']); ?>, <?php echo htmlspecialchars($order['city']); ?></p>
        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($order['contact_number']); ?></p>
        <p><strong>Total Amount:</strong> $<?php echo number_format($order['total'], 2); ?></p>

        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
    </div>
</body>
</html>
