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

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);


?>

<?php
session_start(); // Start the session
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: Admin_login.php'); // Redirect to login page if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Panel - StoneSite</title>
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

        .container h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn {
            padding: 10px 20px;
            margin-bottom: 10px;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .table td, .table th {
            text-align: center;
            vertical-align: middle;
        }

        .table img {
            border-radius: 8px;
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

    <!-- Main Content Start -->
    <div class="container mt-5">
        <h1 class="mb-4">Manage Products</h1>
        <a href="add_product.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add New Product</a>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td>$<?php echo number_format($row['price'], 2); ?></td>
                            <td><img src="img/<?php echo $row['image']; ?>" width="100" alt="<?php echo $row['name']; ?>"></td>
                            <td>
                                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fas fa-trash-alt"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No products found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Main Content End -->

    <!-- Footer Start -->
    <div class="footer">
        <div class="container">
            <p>&copy; 2024 Gemration Admin Panel. All Rights Reserved.</p>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>
