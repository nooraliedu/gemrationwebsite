<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gemratio_main";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

// Add a product to the cart
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = sanitizeInput($_GET['id']);
    $product_id = $conn->real_escape_string($product_id);

    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $_SESSION['cart'][$product_id] = array(
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
            );
        }
    }
}

// Remove a product from the cart
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $product_id = sanitizeInput($_GET['id']);
    unset($_SESSION['cart'][$product_id]);
}

// Update product quantities in the cart
if (isset($_POST['update'])) {
    foreach ($_POST['quantities'] as $product_id => $quantity) {
        $quantity = sanitizeInput($quantity);
        $quantity = filter_var($quantity, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)));

        if ($quantity <= 0) {
            unset($_SESSION['cart'][$product_id]);
        } else {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    }
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

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <h1>Your Shopping Cart</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Start -->
    <div class="container my-5">
        <h2>Your Shopping Cart</h2>

        <?php if (!empty($_SESSION['cart'])): ?>
            <form action="cart.php" method="post">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $product_id => $product):
                            $subtotal = $product['price'] * $product['quantity'];
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td>$<?php echo number_format($product['price'], 2); ?></td>
                                <td>
                                    <input type="number" name="quantities[<?php echo $product_id; ?>]" value="<?php echo $product['quantity']; ?>" min="1" class="form-control" style="width: 80px;">
                                </td>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                                <td>
                                    <a href="cart.php?action=remove&id=<?php echo $product_id; ?>" class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Total: $<?php echo number_format($total, 2); ?></h3>
                    <div>
                        <button type="submit" name="update" class="btn btn-primary">Update Cart</button>
                        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-warning">
                Your cart is empty.
            </div>
        <?php endif; ?>
    </div>
    <!-- Cart End -->

 <!-- Include the footer -->
<?php include 'footer.html'; ?>

</body>
</html>
