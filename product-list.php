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

// Fetch products from the database, including video_url
$sql = "SELECT id, name, description, price, image, video_url FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.html'; ?>
<body>
    <!-- Include the header -->
    <?php include 'header.html'; ?>

    <!-- Product List Start -->
    <div class="product-view">
        <div class="container">
            <div class="row">
                <!-- Fetch and display products dynamically -->
                <?php while($row = $result->fetch_assoc()) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card product-item shadow-sm">
                            <div class="position-relative">
                                <img src="img/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                                
                                <?php if (!empty($row['video_url'])) { ?>
                                    <a href="videos/<?php echo $row['video_url']; ?>" target="_blank" class="video-icon" title="Watch Video">
                                        <i class="fas fa-play-circle" style="font-size: 2em; color: red; position: absolute; top: 10px; left: 10px;"></i>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="card-body product-content">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"><?php echo substr($row['description'], 0, 100) . '...'; ?></p>
                                <h6 class="card-price">$<?php echo number_format($row['price'], 2); ?></h6>
                                <a href="product-detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Product List End -->

    <!-- Footer -->
    <?php include 'footer.html'; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
