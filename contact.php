<?php
// Database connection
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";  // Your MySQL password
$dbname = "gemratio_main";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for messages
$success_message = '';
$error_message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $subject = $conn->real_escape_string(trim($_POST['subject']));
    $message = $conn->real_escape_string(trim($_POST['message']));

    // Basic validation
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Insert the data into the database
        $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Your message has been sent successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    } else {
        $error_message = "Please fill out all fields.";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<!-- Include head.html -->
<?php include 'head.html'; ?>

<body>
    <!-- Include the header -->
    <?php include 'header.html'; ?>
    
    <div class="contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="form">
                        <!-- Display success or error messages -->
                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success">
                                <?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Contact Form -->
                        <form action="" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="name" placeholder="Your Name" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div><button type="submit" class="btn btn-primary">Send Message</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Include the header -->
    <?php include 'footer.html'; ?>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>
