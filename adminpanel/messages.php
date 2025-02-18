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

// Fetch all contact messages from the database
$sql = "SELECT * FROM contact_messages ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact Messages - E Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

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



        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .search-bar {
            margin-bottom: 20px;
        }
        h2 {
            font-size: 2rem;
            margin-bottom: 30px;
        }
        .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

            <!-- Navbar Start -->
   <!-- Header Start -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <a class="navbar-brand" href="#">Gemstone Orders </a>
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
    </nav>
    <!-- Header End -->

    <div class="container my-5">
        <h2 class="text-center">Contact Messages</h2>
        
        <!-- Optional Search Bar for Future Use -->
       

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date Sent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['subject']); ?></td>
                            <td>
                                <button class="btn btn-outline-info btn-sm" data-toggle="collapse" data-target="#message-<?php echo $row['id']; ?>">
                                    View Message
                                </button>
                                <div id="message-<?php echo $row['id']; ?>" class="collapse mt-2">
                                    <p><?php echo htmlspecialchars($row['message']); ?></p>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                No messages found.
            </div>
        <?php endif; ?>

    </div>
        <!-- Footer Start -->
        <div class="footer">
        <div class="container">
            <p>&copy; 2024 Gemration Admin Panel. All Rights Reserved.</p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
