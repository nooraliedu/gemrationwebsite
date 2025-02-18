<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gemratio_main";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all orders from the database
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>All Orders - Gemration Admin Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }

        .footer p {
            margin: 0;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <!-- Header Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Gemration </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../product-list.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header End -->

    <!-- Orders Section Start -->
    <div class="container my-5">
        <h2 class="text-center mb-4">All Orders</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Shipping Address</th>
                        <th>City</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_email']); ?></td>
                            <td><?php echo htmlspecialchars($row['contact_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['shipping_address']); ?></td>
                            <td><?php echo htmlspecialchars($row['city']); ?></td>
                            <td>$<?php echo number_format($row['total_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center" role="alert">
                No orders found.
            </div>
        <?php endif; ?>
    </div>
    <!-- Orders Section End -->

    <!-- Footer Start -->
    <footer class="footer text-center">
        <div class="container">
        <p>&copy; 2024 Gemration.com - All Rights Reserved./p>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>

