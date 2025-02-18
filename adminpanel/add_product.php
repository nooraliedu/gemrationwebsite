<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gemratio_main";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and assign variables
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    
    // Handle image upload
    $image = $_FILES['image']['name'];
    $targetDir = "img/";
    $targetFile = $targetDir . basename($image);
    
    // Handle video upload
    $video = $_FILES['video']['name'];
    $videoDir = "videos/"; // Directory for videos
    $videoFile = $videoDir . basename($video);

    // Check if directories exist, if not create them
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    if (!file_exists($videoDir)) {
        mkdir($videoDir, 0777, true);
    }

    // SQL query to insert product details
    $sql = "INSERT INTO products (name, description, price, image, video_url) VALUES ('$name', '$description', '$price', '$image', '$video')";

    if ($conn->query($sql) === TRUE) {
        // Move uploaded files to the respective directories
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile) && move_uploaded_file($_FILES['video']['tmp_name'], $videoFile)) {
            header('Location: index.php');
            exit; // Important to prevent script from continuing after redirect
        } else {
            echo "Failed to upload image or video.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Product - Admin Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
        }

        .navbar-brand:hover {
            color: #d3d3d3;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }

        .footer p {
            margin: 0;
            text-align: center;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn {
            padding: 10px 20px;
            margin-bottom: 10px;
        }

        .table img {
            border-radius: 8px;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .table td, .table th {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>


<body>
    <!-- Header Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Gemration Orders </a>
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

    <div class="container mt-5">
        <h1 class="mb-4">Add New Product</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Upload Video</label>
                <input type="file" class="form-control" id="video" name="video" accept="video/*">
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>

         
     <!-- Footer Start -->
    <footer class="footer text-center">
        <div class="container">
            <p>&copy; Gemstones E. Shop. All Rights Reserved.</p>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
