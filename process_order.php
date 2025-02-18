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

// Ensure the cart is not empty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// Ensure all required fields are set
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['contact_number'])) {
    // Sanitize user input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $city = htmlspecialchars(trim($_POST['city']));
    $contact_number = htmlspecialchars(trim($_POST['contact_number']));
    
    // Calculate the total order amount from the cart
    $total = 0;
    foreach ($_SESSION['cart'] as $product) {
        $total += $product['price'] * $product['quantity'];
    }

    // Insert the order into the database
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_email, shipping_address, city, total_price, contact_number) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssds", $name, $email, $address, $city, $total, $contact_number);

    if ($stmt->execute()) {
        // Store the order details in the session
        $_SESSION['order'] = array(
            'id' => $conn->insert_id,
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'contact_number' => $contact_number,
            'total' => $total
        );
        
        // Clear the cart after the order is placed
        unset($_SESSION['cart']);
        
        // Redirect to confirmation page
        header('Location: confirmation.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: checkout.php');
    exit;
}
?>
