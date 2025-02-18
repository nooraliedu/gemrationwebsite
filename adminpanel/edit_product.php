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

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "img/".basename($image);

    if (empty($image)) {
        $sql = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id='$id'";
    } else {
        $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$image' WHERE id='$id'";
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM products WHERE id='$id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Product - Admin Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Include necessary stylesheets -->
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

     <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Gemration Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="Admin_registration.php">Registration</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="Admin_login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="messages.php">messages</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
    <div class="container mt-5">
        <h1 class="mb-4">Edit Product</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="img/<?php echo $product['image']; ?>" width="100" alt="<?php echo $product['name']; ?>" class="mt-3">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</body>

    <!-- Footer Start -->
    <div class="footer">
        <div class="container">
            <p>&copy; 2024 Gemration.com - All Rights Reserved.</p>
        </div>
    </div>
    <!-- Footer End -->

</html>

<?php
$conn->close();
?>
