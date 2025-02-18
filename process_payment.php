<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proceed with payment processing

    // You can check if the form fields are set
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['payment_method'])) {
        // Process the payment
        
        // For now, just a simple redirect to a success page or PayPal payment processing
        header('Location: payment_success.php'); // This is just a placeholder, you would send them to PayPal here
        exit;
    } else {
        echo "Required fields are missing.";
    }
} else {
    echo "Form not submitted.";
}
?>
