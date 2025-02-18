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

// Get the search query
$search_query = isset($_GET['query']) ? $_GET['query'] : '';

// Search the database for matching products
$sql = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ?";
$stmt = $conn->prepare($sql);
$search_param = '%' . $search_query . '%';
$stmt->bind_param('ss', $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<!-- Include head.html -->
<?php include 'head.html'; ?>

<body>

    <!-- Include head.html -->
    <?php include 'header.html'; ?>

    <!-- Search Results Start -->
    <div class="container mt-5">
        <h2>Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h2>
        
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="img/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"><?php echo substr($row['description'], 0, 100) . '...'; ?></p>
                                <h6 class="card-price">$<?php echo number_format($row['price'], 2); ?></h6>
                                <a href="product-detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning">
                        No products found for your search query.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Search Results End -->

     <!-- Include head.html -->
     <?php include 'footer.html'; ?>

</body>
</html>
