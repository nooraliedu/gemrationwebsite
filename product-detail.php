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

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the product details from the database
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

// Check if the product exists
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<!-- Include head.html -->
<?php include 'head.html'; ?>

<body>

    <!-- Include the header -->
    <?php include 'header.html'; ?>

    <!-- Product Detail Start -->
    <div class="container product-detail">
        <div class="row">
            <div class="col-md-6">
                <img src="img/<?php echo $product['image']; ?>" class="img-fluid" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="col-md-6">
                <h1><?php echo $product['name']; ?></h1>
                <p><?php echo $product['description']; ?></p>
                <h3 class="text-success">$<?php echo number_format($product['price'], 2); ?></h3>
                <a href="cart.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>
    </div>
    <!-- Product Detail End -->

    <!-- Footer -->
    <?php include 'footer.html'; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
